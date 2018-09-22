<template>
    <div>

        <div id="claim" :style="{background: 'linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)) ,url(' + api_link + '/images/claimMenu.jpg' + ')'}" class="claimImage">
            <div>
                <div class="title">Book your table!</div>
            </div>
        </div>

        <div class="container">
            <h3 class="openHours">CossackFood is open from 8am to 9pm</h3>

            <div class="selectTime">
                <div>
                    <label class="notCloseModal" for="date">Date:</label>
                    <input :min="dateMin" :max="dateMax" v-model="date" @input="handleTime" id="date"
                           name="date" class="notCloseModal" type="date">
                </div>

                <div>
                    <label class="notCloseModal" for="time">Time:</label>
                    <input id="time" value="14:00" v-model="time" @input="handleTime"
                           name="date" class="notCloseModal" type="time">
                </div>
            </div>
            <transition name="fade">
                <div id="tables" class="tables displayNone">
                    <img class="image" :src="api_link + '/images/view3.jpg'">
                    <div @click="reserve_table(1)" id="table1" class="table">
                        <i id="tableicon1" class="demo-icon icon-restaurant"></i>
                        <span class="infotable"
                              id="infotable1">1</span>
                    </div>
                    <div class="twoInOne">
                        <div @click="reserve_table(2)" id="table2" class="table twoInOneTable">
                            <i id="tableicon2" class="demo-icon icon-restaurant"></i>
                            <span class="infotable" id="infotable2">2</span>
                        </div>
                        <div @click="reserve_table(3)" id="table3" class="table twoInOneTable"><i id="tableicon3"
                                                                                                  class="demo-icon icon-restaurant"></i>
                            <span class="infotable" id="infotable3">3</span>
                        </div>
                    </div>
                    <div class="twoInOne">
                        <div @click="reserve_table(4)" id="table4" class="table twoInOneTable"><i
                                id="tableicon4" class="demo-icon icon-restaurant"></i>
                            <span class="infotable"
                                  id="infotable4">4</span>
                        </div>
                        <div @click="reserve_table(5)" id="table5" class="table twoInOneTable"><i id="tableicon5"
                                                                                                  class="demo-icon icon-restaurant"></i>
                            <span @click="reserve_table(5)"
                                  class="infotable" id="infotable5">5</span>
                        </div>
                    </div>

                    <div class="boxShadow"></div>

                    <div class="boxShadow"></div>

                    <div @click="reserve_table(6)" id="table6" class="table">
                        <i id="tableicon6" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable6">6</span>
                    </div>

                    <div @click="reserve_table(7)" id="table7" class="table">
                        <i id="tableicon7" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable7">7</span>
                    </div>

                    <div @click="reserve_table(8)" id="table8" style="width: 200%;" class="table">
                        <i id="tableicon8" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable8">8</span>
                    </div>


                    <div style="z-index: -1000;" class="table">
                    </div>


                    <div @click="reserve_table(9)" id="table9" class="table">
                        <i id="tableicon9" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable9">9</span>
                    </div>

                    <div @click="reserve_table(10)" id="table10" class="table">
                        <i id="tableicon10" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable10">10</span>
                    </div>

                    <div @click="reserve_table(11)" id="table11" class="table">
                        <i id="tableicon11" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable11">11</span>
                    </div>


                    <div @click="reserve_table(12)" id="table12" style="width: 200%;" class="table">
                        <i id="tableicon12" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable12">12</span>
                    </div>

                    <div style="z-index: -1000;" class="table">
                    </div>

                    <div @click="reserve_table(13)" id="table13" class="table">
                        <i id="tableicon13" class="demo-icon icon-restaurant"></i>
                        <span class="infotable" id="infotable13">13</span>
                    </div>

                </div>
            </transition>

            <div v-if="loading" class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <closed :restaurantClosed="restaurantClosed"></closed>

            <reservation-modal @reservationAdd="reservationAdd($event)"
                               :time-start="time"
                               :date="date"
                               :table-number="tableNumber"
                               :api_link="api_link"
                               :reserving="reserving"
                               :availableReservation="availableReservation"></reservation-modal>

            <flash-message :messageFlash="messageFlash" :flashCount="flashCount"></flash-message>
        </div>
    </div>
</template>

<script>
    import debounce from 'lodash.debounce';
    import closed from './closed.vue';
    import reservationModal from './reservationModal.vue'
    import axios from 'axios';

    export default {
        name: "reservations",
        components: {
            closed: closed,
            reservationModal: reservationModal
        },
        props: {
            api_link: {
                Type: String
            }
        },
        data() {
            return {
                reserving: false,
                tableNumber: 0,
                date: '',
                dateMin: '',
                dateMax: '',
                tableCount: 13,
                time: '14:00',
                restaurantClosed: false,
                availableHoursAtTable: [],
                availableReservation: 6,
                loading: true,
                removeClosingModal: false,

                messageFlash: '',
                flashCount: 0
            }
        },
        mounted() {
            //set default time to time picker
            this.setTime();

            //get reservations
            this.getReservations();
            if(window.innerWidth > 476) {
                const claim = document.getElementById('claim');
                window.addEventListener('scroll', function () {
                    let offset = window.pageYOffset;
                    claim.style.backgroundPositionY = offset * 0.7 + 'px';
                });
            }

        },
        methods: {
            handleTime: debounce(function () {
                let time = document.getElementById('time').value;
                if (parseInt(time) < 8 || parseInt(time) > 20) {

                    document.getElementById('tables').classList.add('displayNone');
                    this.restaurantClosed = true;

                } else {

                    this.restaurantClosed = false;
                    this.loading = true;

                    //reservations need to exist to edit them
                    if (this.restaurantClosed === false) {
                        //reset all previous reservations
                        for (let i = 1; i <= this.tableCount; i++) {
                            if (document.getElementById('table' + i).hasAttribute('reserved')) {
                                document.getElementById('table' + i).removeAttribute('reserved');
                                document.getElementById('table' + i).classList.remove('reservedTable');
                                document.getElementById('infotable' + i).innerHTML = i;
                            }
                        }
                    }

                    document.getElementById('tables').classList.remove('animationFadeIn');
                    document.getElementById('tables').classList.add('displayNone');

                    this.getReservations();
                }


            }, 400),

            reservationAdd(message) {
                //show communicat
                this.messageFlash = message;
                this.flashCount += 1;

                document.getElementById('tables').classList.remove('animationFadeIn');
                document.getElementById('tables').classList.add('displayNone');


                document.getElementById('table' + this.tableNumber).style.background = '';
                window.onscroll = null;
                this.reserving = false;
                document.removeEventListener('click', this.closing_modalino);
                this.availableReservation = 6;

                this.getReservations();
            },


            getReservations() {

                //right scope
                const self = this;
                this.availableHoursAtTable = [];
                this.availableReservation = 6;

                //get reservations
                axios.get(this.api_link + '/api/reservations/' + this.date + '/' + this.time).then(function (Response) {

                    let reservationArray = Response.data.data;

                    let arraylength = reservationArray.length - 1;

                    for (let i = 0; i <= arraylength; i++) {

                        //from RestAPI last item is list of available reservations

                        //normal reservation
                        if (reservationArray[i] !== 'undefined' && i !== arraylength) {

                            //loop starts at 0 so index need to be incremented
                            let htmlindex = reservationArray[i].table;

                            //prevent from reserving and add some styles
                            document.getElementById('table' + htmlindex).setAttribute('reserved', 'true');
                            document.getElementById('table' + htmlindex).classList.add('reservedTable');

                            // display reservation  ending time and cut seconds they are always 0
                            let reservationTime = reservationArray[i].reservation_end;
                            document.getElementById('infotable' + htmlindex).innerHTML = reservationTime.substring(0, reservationTime.length - 3);
                        }

                        //list of available reservation
                        if (reservationArray[i] !== 'undefined' && i === arraylength) {

                            reservationArray[i].forEach(function (table) {
                                self.availableHoursAtTable.push(table)
                            });
                        }
                    }

                    self.loading = false;
                    document.getElementById('tables').classList.remove('displayNone');
                    document.getElementById('tables').classList.add('animationFadeIn');
                });
            },


            reserve_table: function (table) {
                const self = this;
                //check if table isnt already reserved
                let reserved = document.getElementById('table' + table).getAttribute('reserved');

                if (reserved === 'true') {
                    return null;
                }


                //set max availble reservation time if it needed
                this.availableHoursAtTable.forEach(function (tableAvailableHours) {

                    for (let tableIndex in tableAvailableHours) {
                        let tableNumber = tableIndex.substring(1);
                        if (tableNumber.toString() === table.toString()) {
                            self.availableReservation = tableAvailableHours[tableIndex];
                        }
                    }
                });


                //open modal
                this.reserving = true;
                document.getElementById('table' + table).style.background = 'linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3))';
                this.tableNumber = table;

                //turn off scrolling
                let x = window.scrollX;
                let y = window.scrollY;
                window.onscroll = function () {
                    window.scrollTo(x, y);
                };

                //call function to close modal when not clicking it
                this.closing_modal_on_click();
            },

            closing_modal_on_click() {

                //need for right scope
                const self = this;

                //event listener that closes modal when user didnt clicked on it
                document.addEventListener('click', self.closing_modalino);

            },

            closing_modalino(event) {
                const self = this;
                let tableNumber = this.tableNumber;

                if (self.reserving === true) {

                    if (event.target !== document.getElementById('modal') &&
                        !event.target.classList.contains('notCloseModal')
                        && event.target !== document.getElementById('table' + tableNumber)
                        && event.target !== document.getElementById('tableicon' + tableNumber)
                        && event.target !== document.getElementById('infotable' + tableNumber)) {

                        document.getElementById('table' + tableNumber).style.background = '';
                        window.onscroll = null;
                        self.reserving = false;
                        self.availableReservation = 6;
                        document.removeEventListener('click', self.closing_modalino);

                    }
                }
            },

            setTime() {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1; //January is 0!
                let yyyy = today.getFullYear();

                let minDay = dd;
                let maxDay = dd + 14;

                if (dd < 10) {
                    dd = '0' + dd
                }

                if (mm < 10) {
                    mm = '0' + mm
                }

                today = yyyy + '-' + mm + '-' + dd;
                let dateMin = yyyy + '-' + mm + '-' + minDay;
                let dateMax = yyyy + '-' + mm + '-' + maxDay;

                this.date = today;
                this.dateMin = dateMin;
                this.dateMax = dateMax;
            }
        }
    }

</script>

<style lang="scss" scoped>
    .container {
        @media(max-width: 476px) {
            width: 99%;
        }
    }
    .reservedTable {
        cursor: auto !important;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background: linear-gradient(
                        rgba(245, 67, 57, 0.5),
                        rgba(245, 67, 57, 0.5)
        );
    }

    .reservedTable:hover {
        background: linear-gradient(
                        rgba(245, 67, 57, 0.5),
                        rgba(245, 67, 57, 0.5)
        ) !important;
        box-shadow: 0 0 2px white !important;
    }

    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .animationFadeIn {
        display: block;
        -webkit-animation: fadeIn .5s;
        animation: fadeIn .5s;
    }

    .displayNone {
        display: none !important;
    }

    .lds-ring {
        display: block;
        position: relative;
        margin-left: auto;
        margin-top: 200px;
        margin-right: auto;
        transform: translateX(15%);
        width: 104px;
        height: 104px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 71px;
        height: 71px;
        margin: 6px;
        border: 7px solid #cccccc;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #b9bbbe transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .openHours {
        text-align: center;
        color: #b91d19;
        display: block;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .selectTime {
        text-align: center;
        margin-bottom: 50px;
        display: grid;
        grid-template-columns: 1fr;
        @media(min-width: 768px) {
            grid-template-columns: 1fr 1fr;
        }

        #date {
            margin-bottom: 60px;
            @media(min-width: 768px) {
                margin-bottom: 20px;
            }
        }

        label {
            color: #b91d19;
            font-size: 26px;
            font-weight: 700;

        }
        input {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            background: none;
            color: #444444;
            text-align: center;
            font-size: 22px;
            border: 0;
            border-bottom: 1px solid #777777;
        }

        input:focus {
            outline: none;
            box-shadow: 0 8px 16px -8px #777777;
        }
    }

    .error {
        border-bottom: 1px solid #b91d19 !important;
    }

    .claimImage {
        height: 60vh;
        background-size: cover !important;
        background-position: 50% 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        box-shadow: 0 1px 2px #b9bbbe;

        .title {
            margin-top: 50px;
            @media(min-width: 768px) {
                margin-top: 140px;
                font-size: 62px;
            }
            font-size: 42px;
            font-family: 'Great Vibes', cursive;
            color: #ff7e7b;
            margin-bottom: 50px;
        }
    }

    .claimReservations {
        display: block;
        color: #b91d19;
        text-align: center;
        margin-bottom: 80px;
    }

    .boxShadow {
        box-shadow: 0 0 2px white;
    }

    .container {
        margin-top: 50px;

        .tables {
            .twoInOne {
                display: grid;
                position: relative;
                grid-template-columns: 50% 50%;

                .twoInOneTable {
                    width: 100%;
                    height: 100%;
                    grid-row: 1;
                }
            }
            margin-left: auto;
            margin-right: auto;
            display: grid;
            position: relative;
            border: 1px solid #f1f1f1;
            grid-template-columns: 20% 20% 20% 20% 20%;
            z-index: 1;

            .image {
                position: absolute;
                width: 100%;
                height: 100%;
                filter: brightness(70%);
                z-index: -1;
            }
            .table {
                font-weight: 700;
                color: white;
                padding: 35% 0 35% 0;
                cursor: pointer;
                transition: .2s all ease-in-out;
                box-shadow: 0 0 2px white;
                font-size: 10px;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;

                .infotable {
                    word-wrap: break-word;
                }

                .icon-restaurant {
                    font-size: 12px;
                }

                @media(min-width: 476px) {
                    .icon-restaurant {
                        font-size: 16px;
                    }

                    font-size: 13px;
                }

                @media(min-width: 768px) {
                    .icon-restaurant {
                        font-size: 20px;
                    }
                    font-size: 16px;
                }

                @media(min-width: 1000px) {
                    .icon-restaurant {
                        font-size: 28px;
                    }
                    font-size: 18px;
                }

                @media(min-width: 1200px) {
                    .icon-restaurant {
                        font-size: 32px;
                    }
                    font-size: 22px;
                }
            }
            .table:hover {
                box-shadow: 0 0 7px white;
                background: linear-gradient(rgba(0, 0, 0, 0.2),
                        rgba(0, 0, 0, 0.2));
            }
        }
    }
</style>