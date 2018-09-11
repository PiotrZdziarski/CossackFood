<template>
    <div>
        <div :style="{backgroundImage: 'url(' + api_link + '/images/claimMenu.jpg' + ')'}" class="claimImage">
            <div>
                <div class="title">Choose your table!</div>
            </div>
        </div>
        <div class="container">
            <div data-aos="fade-in" data-aos-once="true" class="tables">
                <img class="image" :src="api_link + '/images/view3.jpg'">
                <div @click="reserve_table(1)" id="table1" class="table">
                    <i id="tableicon1" class="demo-icon icon-restaurant"></i>1
                </div>
                <div class="twoInOne">
                    <div @click="reserve_table(2)" id="table2" class="table twoInOneTable"><i
                            id="tableicon2" class="demo-icon icon-restaurant"></i> 2
                    </div>
                    <div @click="reserve_table(3)" id="table3" class="table twoInOneTable"><i id="tableicon3"
                                                                                              class="demo-icon icon-restaurant"></i>3
                    </div>
                </div>
                <div class="twoInOne">
                    <div @click="reserve_table(4)" id="table4" class="table twoInOneTable"><i
                            id="tableicon4" class="demo-icon icon-restaurant"></i>4
                    </div>
                    <div @click="reserve_table(5)" id="table5" class="table twoInOneTable"><i id="tableicon5"
                                                                                              class="demo-icon icon-restaurant"></i>5
                    </div>
                </div>

                <div class="boxShadow"></div>

                <div class="boxShadow"></div>

                <div @click="reserve_table(6)" id="table6" class="table">
                    <i id="tableicon6" class="demo-icon icon-restaurant"></i>6
                </div>

                <div @click="reserve_table(7)" id="table7" class="table">
                    <i id="tableicon7" class="demo-icon icon-restaurant"></i>7
                </div>

                <div @click="reserve_table(8)" id="table8" style="width: 200%;" class="table">
                    <i id="tableicon8" class="demo-icon icon-restaurant"></i>8
                </div>


                <div @click="reserve_table(8)" style="z-index: -1000;" class="table">
                </div>


                <div @click="reserve_table(9)" id="table9" class="table">
                    <i id="tableicon9" class="demo-icon icon-restaurant"></i>9
                </div>

                <div @click="reserve_table(10)" id="table10" class="table">
                    <i id="tableicon10" class="demo-icon icon-restaurant"></i>10
                </div>

                <div @click="reserve_table(11)" id="table11" class="table">
                    <i id="tableicon11" class="demo-icon icon-restaurant"></i>11
                </div>


                <div @click="reserve_table(12)" id="table12" style="width: 200%;" class="table">
                    <i id="tableicon12" class="demo-icon icon-restaurant"></i>12
                </div>

                <div @click="reserve_table(12)" style="z-index: -1000;" class="table">
                </div>

                <div @click="reserve_table(13)" id="table13" class="table">
                    <i id="tableicon13" class="demo-icon icon-restaurant"></i>13
                </div>


            </div>
            <transition name="fade">
                <div v-if="reserving" class="modal-container">
                    <div id="modal" class="modal">
                        <div class="close"></div>

                        <div class="modalGrid notCloseModal">
                            <div class="form notCloseModal">
                                <div class="titleModal notCloseModal">Book Table no. {{ tableNumber }}</div>
                                <form id="reservationForm" class="notCloseModal">

                                    <label class="notCloseModal" for = "name">Fullname:</label>
                                    <input id="name" class="notCloseModal" type="text">

                                    <label class="notCloseModal" for = "email">Email:</label>
                                    <input id="email" class="notCloseModal" type="text">

                                    <label class="notCloseModal" for = "date">Date:</label>
                                    <input id="date" class="notCloseModal" type="datetime-local">

                                    <button class="submit" type="submit">Submit</button>
                                </form>
                            </div>
                            <div class="claimModal notCloseModal" :style="{backgroundImage: 'url(' + api_link + '/images/waiter.jpg' + ')'}">


                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: "reservations",
        props: {
            api_link: {
                Type: String
            }
        },
        data() {
            return {
                reserving: false,
                tableNumber: 0
            }
        },
        methods: {

            reserve_table(table) {
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
                this.closing_modal_on_click(table);
            },

            closing_modal_on_click(tableNumber) {

                //need for right scope
                const self = this;

                //event listere that closes modal when user didnt clicked it
                document.addEventListener('click', function closing_modalino(event) {
                    event.preventDefault();
                    if (self.reserving === true) {

                        if (event.target !== document.getElementById('modal') &&
                                !event.target.classList.contains('notCloseModal')
                            && event.target !== document.getElementById('table' + tableNumber)
                            && event.target !== document.getElementById('tableicon' + tableNumber)) {

                            document.getElementById('table' + tableNumber).style.background = '';
                            window.onscroll = null;
                            self.reserving = false;
                            document.removeEventListener('click', closing_modalino);

                        }
                    }
                });

            }
        }
    }
</script>

<style lang="scss" scoped>
    .claimImage {
        height: 373px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        box-shadow: 0 1px 2px #b9bbbe;

        .title {
            margin-top: 50px;
            @media(min-width: 1000px) {
                margin-top: 140px;
                font-size: 62px;
            }
            font-size: 42px;
            font-family: 'Great Vibes', cursive;
            color: #b91d19;
            margin-bottom: 50px;
        }

        .subpage {
            font-family: 'Great Vibes', cursive;
            font-size: 30px;
            float: left;
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .subpage:hover {
            color: #777777;
        }

        .active {
            color: #b91d19;
        }
        .active:hover {
            color: #b91d19;
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

    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }

    .container {
        margin-top: 50px;

        .tables {

            .twoInOne {
                display: flex;
                justify-content: center;
                align-items: center;

                .twoInOneTable {
                    float: left;
                    width: 100%;
                }
            }
            margin-left: auto;
            margin-right: auto;
            display: grid;
            position: relative;
            border: 1px solid #f1f1f1;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            z-index: 1;

            .image {
                position: absolute;
                width: 100%;
                height: 100%;
                filter: brightness(70%);
                z-index: -1;
            }
            .table {
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: 700;
                color: white;
                padding: 35% 0 35% 0;
                cursor: pointer;
                transition: .2s all ease-in-out;
                box-shadow: 0 0 2px white;
                font-size: 14px;
                .icon-restaurant {
                    font-size: 16px;
                }

                @media(min-width: 476px) {
                    .icon-restaurant {
                        font-size: 20px;
                    }

                    font-size: 20px;
                }

                @media(min-width: 768px) {
                    .icon-restaurant {
                        font-size: 24px;
                    }
                    font-size: 22px;
                }

                @media(min-width: 1000px) {
                    .icon-restaurant {
                        font-size: 28px;
                    }
                    font-size: 22px;
                }

                @media(min-width: 1200px) {
                    .icon-restaurant {
                        font-size: 32px;
                    }
                    font-size: 26px;
                }
            }
            .table:hover {
                box-shadow: 0 0 7px white;
                background: linear-gradient(rgba(0, 0, 0, 0.2),
                        rgba(0, 0, 0, 0.2));
            }
        }

        .modal-container {
            position: fixed;
            z-index: 399;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            .modal {
                position: fixed;
                background: #f5f5f5;
                box-shadow: 0 30px 30px - 10px rgba(0,0,0, .3);
                left: 50%;
                transform: translate(-50%, -50%);
                width: 95%;
                height: 60vh;
                z-index: 400;
                top: 50%;

                @media(min-width: 768px) {
                    width: 70%;
                }
                @media(min-width: 1000px) {
                    width: 60%;
                }

                .modalGrid {
                    display: grid;
                    grid-template-columns: 1fr;
                    @media(min-width: 476px) {
                        grid-template-columns: 1.1fr 0.9fr;
                    }
                    width: 100%;
                    height: 100%;
                    text-align: center;

                    .form {
                        padding: 5%;

                        .titleModal {
                            font-size: 26px;
                            font-weight: 500;
                            color: #b91d19;
                            margin-bottom: 30px;
                        }

                        #reservationForm {

                            .submit {
                                margin-top: 40px;
                                background-color: #f54339;
                                color:white;
                                transition: .2s all ease-in-out;
                                cursor:pointer;
                                padding: 10px 20px 10px 20px;
                                border:0;
                                border-radius: 3px;
                            }

                            .submit:hover {
                                background-color: #f5543f;
                            }

                            .submit:focus {
                                outline: none;
                                box-shadow: 0 3.75px 7.5px #b9bbbe;
                            }

                            label {
                                display: block;
                                font-size: 20px;
                                margin-top: 25px;
                            }
                            input {
                                display: block;
                                margin-left: auto;
                                margin-right: auto;
                                margin-top: 15px;
                                background: none;
                                color: #444444;
                                text-align: center;
                                font-size: 16px;
                                border: 0;
                                border-bottom: 1px solid #777777;
                            }

                            input:focus {
                                outline: none;
                                box-shadow: 0 8px 16px -8px #777777;
                            }
                        }
                    }

                    .claimModal {
                        background-position: 60%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        @media(max-width: 476px) {
                            display: none;
                        }
                    }
                }

                .close {
                    position: absolute;
                    width: 30px;
                    height: 30px;
                    padding: 30px;
                    right: 0;
                    top: 0;
                    cursor: pointer;
                    &::before,
                    &::after {
                        position: absolute;
                        top: 30px;
                        right: 20px;
                        content: '';
                        width: 20px;
                        height: 2px;
                        background: black;
                        display: block;
                    }
                    &::before {
                        transform: rotate(45deg);
                    }
                    &::after {
                        transform: rotate(-45deg);
                    }
                }
                .close:hover {
                    &::before,
                    &::after {
                        background: #444444;
                    }
                }

            }

        }
    }
</style>