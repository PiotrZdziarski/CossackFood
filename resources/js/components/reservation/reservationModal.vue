<template>
    <div>
        <transition name="fade">
            <div v-if="reserving" class="modal-container">
                <div id="modal" class="modal">
                    <div class="close"></div>

                    <div class="modalGrid notCloseModal">
                        <div class="form notCloseModal">
                            <div class="titleModal notCloseModal">Book Table no. {{ tableNumber }}</div>
                            <form method="post" id="reservationForm" class="notCloseModal">

                                <label class="notCloseModal" for="fullName">Fullname:</label>
                                <input v-model="fullName" id="fullName" name="fullName" class="notCloseModal"
                                       type="text">

                                <label class="notCloseModal" for="number">Contact number:</label>
                                <input v-model="number" id="number" name="number" class="notCloseModal" type="text">

                                <label class="notCloseModal" for="duration">Duration:</label>
                                <select v-model="duration" id="duration" name="duration" class="notCloseModal" type="text">
                                    <option value="0.5">0.5 h</option>
                                    <option value="1">1 h</option>
                                    <option value="1.5">1.5 h</option>
                                    <option value="2">2 h</option>
                                    <option value="2.5">2.5 h</option>
                                    <option value="3">3 h</option>
                                </select>

                                <input @click="submitForm" class="submit notCloseModal" value="Submit"
                                       type="button">
                            </form>
                        </div>
                        <div class="claimModal notCloseModal"
                             :style="{backgroundImage: 'url(' + api_link + '/images/waiter.jpg' + ')'}">


                        </div>
                    </div>
                </div>
            </div>
        </transition>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "reservationModal",
        props: {
            api_link: {
                Type: String
            },
            tableNumber: {
                Type: String
            },
            reserving: {
                Type: Boolean
            },
            timeStart: {
                Type: String
            },
            date: {
                Type: String
            }
        },
        data() {
            return {
                fullName: '',
                number: '',
                duration: '1',
            }
        },
        methods: {
            submitForm() {
                const self = this;
                let everything_good = true;

                if (this.fullName === '') {
                    everything_good = false;
                    document.getElementById('fullName').classList.add('error');
                    document.getElementsByName("fullName")[0].placeholder = "Fill in this field!";
                } else {
                    if (document.getElementById('fullName').classList.contains('error')) {
                        document.getElementById('fullName').classList.remove('error');
                    }
                }

                if (this.number === '') {

                    everything_good = false;
                    document.getElementById('number').classList.add('error');
                    document.getElementsByName("number")[0].placeholder = "Fill in this field!";
                } else if (!this.isNumeric(this.number) || this.number.length > 10) {
                    everything_good = false;
                    document.getElementById('number').classList.add('error');
                    document.getElementById('number').value = '';
                    document.getElementsByName("number")[0].placeholder = "Enter valid number!";
                }
                else {
                    if (document.getElementById('number').classList.contains('error')) {
                        document.getElementById('number').classList.remove('error');
                    }
                }

                if (everything_good === true) {
                    axios.post(this.api_link + '/api/store_reservation', {
                        'name': this.fullName,
                        'number': this.number,
                        'table': this.tableNumber,
                        'timeStart': this.timeStart,
                        'duration': this.duration,
                        'date': this.date,
                    }).then(function (Response) {
                        self.$emit(
                            'showFlashMessage', Response.data
                        );
                    });
                }
            },


            isNumeric(value) {
                return /^\d+$/.test(value);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
    .error {
        border-bottom: 1px solid #b91d19 !important;
    }


    .container {
        margin-top: 50px;

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
                box-shadow: 0 30px 30px - 10px rgba(0, 0, 0, .3);
                left: 50%;
                transform: translate(-50%, -50%);
                width: 95%;
                border-radius: 5px;
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
                        grid-template-columns: 1fr 1fr;
                    }
                    width: 100%;
                    height: 100%;
                    text-align: center;

                    .form {
                        padding: 8%;

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
                                color: white;
                                transition: .2s all ease-in-out;
                                cursor: pointer;
                                padding: 10px 20px 10px 20px;
                                border: 0;
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


                            select {
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

                            select:focus {
                                outline: none;
                                box-shadow: 0 8px 16px -8px #777777;
                            }
                        }
                    }

                    .claimModal {
                        background-position: 60%;
                        border-radius: 5px;
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