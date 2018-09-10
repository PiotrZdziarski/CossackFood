<template>
    <div class="container">
        <div class="tables">
            <img class="image" :src="api_link + '/images/view3.jpg'">
            <div @click="reserve_table(1)" id="table1" class="table">
                <i id="tableicon1" class="demo-icon icon-restaurant"></i>
            </div>
            <div class="twoInOne">
                <div @click="reserve_table(2)" id="table2" class="table twoInOneTable"><i
                        id="tableicon2" class="demo-icon icon-restaurant"></i></div>
                <div @click="reserve_table(3)" id="table3" class="table twoInOneTable"><i id="tableicon3"
                                                    class="demo-icon icon-restaurant"></i></div>
            </div>
            <div class="twoInOne">
                <div @click="reserve_table(4)" id="table4" class="table twoInOneTable"><i
                        id="tableicon4" class="demo-icon icon-restaurant"></i></div>
                <div @click="reserve_table(5)" id="table5" class="table twoInOneTable"><i id="tableicon5"
                                                                                          class="demo-icon icon-restaurant"></i></div>
            </div>

            <div></div>

            <div></div>

            <div @click="reserve_table(6)" id="table6" class="table">
                <i id="tableicon6" class="demo-icon icon-restaurant"></i>
            </div>

            <div @click="reserve_table(7)" id="table7" class="table">
                <i id="tableicon7" class="demo-icon icon-restaurant"></i>
            </div>

            <div @click="reserve_table(8)" id="table8" style="width: 200%;" class="table">
                <i id="tableicon8" class="demo-icon icon-restaurant"></i>
            </div>


            <div @click="reserve_table(8)" style="z-index: -1000;" id="table8" class="table">
            </div>


            <div @click="reserve_table(9)" id="table9" class="table">
                <i id="tableicon9" class="demo-icon icon-restaurant"></i>
            </div>

            <div @click="reserve_table(10)" id="table10" class="table">
                <i id="tableicon10" class="demo-icon icon-restaurant"></i>
            </div>

            <div @click="reserve_table(11)" id="table11" class="table">
                <i id="tableicon11" class="demo-icon icon-restaurant"></i>
            </div>


            <div @click="reserve_table(12)" id="table12" style="width: 200%;" class="table">
                <i id="tableicon12" class="demo-icon icon-restaurant"></i>
            </div>

            <div @click="reserve_table(12)" style="z-index: -1000;" id="table12" class="table">
            </div>

            <div @click="reserve_table(13)" id="table13" class="table">
                <i id="tableicon13" class="demo-icon icon-restaurant"></i>
            </div>


        </div>
        <transition name="fade">
            <div v-if="reserving" class="modal-container">
                <div id="modal" class="modal">
                </div>
            </div>
        </transition>
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
                tables: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                reserving: false
            }
        },
        methods: {

            reserve_table(table) {
                this.reserving = true;
                let x = window.scrollX;
                let y = window.scrollY;
                window.onscroll = function () {
                    window.scrollTo(x, y);
                };
                this.closing_modal_on_click(table);
            },

            closing_modal_on_click(tableNumber) {
                const self = this;
                document.addEventListener('click', function closing_modalino(event) {
                    if (self.reserving === true) {

                        if (event.target !== document.getElementById('modal')
                            && event.target !== document.getElementById('table' + tableNumber)
                            && event.target !== document.getElementById('tableicon' + tableNumber)) {
                            window.onscroll = null;
                            self.reserving = false;
                            console.log(tableNumber);
                            document.removeEventListener('click', closing_modalino);
                        }
                    }
                });

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

    .container {
        margin-top: 200px;

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
            background-size: cover;
            background-position: 50%;
            background-repeat: no-repeat;
            z-index: 1;

            .image {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
            .table {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px 0 20px 0;
                cursor: pointer;
                transition: .2s all ease-in-out;
                box-shadow: 0 0 10px white;
                .icon-restaurant {
                    font-size: 20px;
                }

                @media(min-width: 476px) {
                    .icon-restaurant {
                        font-size: 24px;
                    }
                    padding: 25px 5px 25px 5px;
                }

                @media(min-width: 768px) {
                    padding: 40px 15px 40px 15px;
                }

                @media(min-width: 1000px) {
                    .icon-restaurant {
                        font-size: 28px;
                    }
                    padding: 80px 20px 80px 20px;
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
                background: gray;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 95%;
                height: 40vh;
                z-index: 400;
                top: 50%;

                @media(min-width: 768px) {
                    width: 70%;
                }
                @media(min-width: 1000px) {
                    width: 60%;
                }

            }

        }
    }
</style>