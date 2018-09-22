<template>
    <div class="wrapper">
        <div id="claim" :style="{background: 'linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)) ,url(' + api_link + '/images/claimMenu.jpg' + ')'}" class="claimImage">
            <div>
                <div class="title">Food Menu</div>
                <div>
                    <div @click="pizza" id="pizza" class="subpage active">
                        Pizza
                    </div>
                    <div @click="dishes" id="dishes" class="subpage" style="margin-left: 100px;">
                        Dishes
                    </div>
                </div>
            </div>
        </div>
        <div class="foodMenu container" v-if="food === 'pizza'">

            <div data-aos="fade-in" data-aos-once="true" class="foodItem" v-for="record in records">
                <div class="description">
                    <div class="foodName">{{ record.pizza }}</div>
                    <div class="ingredients">{{ record.ingredients }}</div>
                </div>
                <div class="price">
                    ${{ record.price }}
                </div>
            </div>

        </div>
        <div class="foodMenu container" v-if="food === 'dishes'">
            <div data-aos="fade-in" data-aos-once="true" class="foodItem" v-for="record in records">

                <div class="image" :style="{backgroundImage: 'url(' + api_link + '/images/dishes/' + record.image + ')'}"></div>

                <div class="descriptionDish">
                    <div class="foodName">{{ record.dish }}</div>
                    <div class="ingredients">{{ record.ingredients }}</div>
                </div>

                <div class="priceDish">
                    ${{ record.price }}
                </div>
            </div>
        </div>
        <div v-if="loading" id="loader" class="lds-dual-ring"></div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {
        name: "menuSubpage",
        data() {
            return {
                food: 'pizza',
                records: [],
                loading: true
            }
        },
        props: {
            api_link: {
                Type: String
            }
        },
        mounted() {
            const self = this;

            axios.get(this.api_link + '/api/pizza').then(function (Response) {
                self.records = Response.data.data;
                self.loading = false;
            });

            if(window.innerWidth > 476) {
                const claim = document.getElementById('claim');
                window.addEventListener('scroll', function () {
                    let offset = window.pageYOffset;
                    claim.style.backgroundPositionY = offset * 0.7 + 'px';
                });
            }
        },
        methods: {

            pizza() {
                document.getElementById('pizza').classList.add('active');
                document.getElementById('dishes').classList.remove('active');

                this.food = 'pizza';
                this.records = [];
                this.loading = true;

                const self = this;

                axios.get(this.api_link + '/api/pizza').then(function (Response) {
                    self.records = Response.data.data;
                    self.loading = false;
                });
            },

            dishes() {
                document.getElementById('dishes').classList.add('active');
                document.getElementById('pizza').classList.remove('active');

                this.food = 'dishes';
                this.records = [];
                this.loading = true;

                const self = this;

                axios.get(this.api_link + '/api/dishes').then(function (Response) {
                    self.records = Response.data.data;
                    self.loading = false;
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

    .lds-dual-ring {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 1396px;

        @media(min-width: 476px) {
            height: 1996px
        }

        @media(min-width: 768px) {
            height: 628px;
        }


        @media(min-width: 1000px) {
            height: 239px;
        }


        margin-left: auto;
        margin-right: auto;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 56px;
        height: 56px;
        margin: 1px;
        border-radius: 50%;
        border: 8px solid lightgray;
        border-color: lightgray transparent lightgray transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }


    .wrapper {
        .foodMenu {
            display: grid;
            margin-top: 40px;
            grid-template-columns: 1fr;
            color: #444444;

            @media(min-width: 768px) {
                grid-template-columns: 1fr 1fr;
            }
            .foodItem {
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid #f1f1f1;
                padding: 30px 20px 30px 20px;
                margin: 30px 10px 0 10px;

                @media(min-width: 1200px) {
                    margin: 40px 50px 0 50px;
                }

                .image {
                    width: 30%;
                    background-size: cover;
                    background-position: 50%;
                    height: 120px;
                }

                .descriptionDish {
                    width: 45%;
                    padding: 5px;

                    .foodName {
                        text-align: center;
                        font-weight: 700;
                        font-size: 16px;
                    }
                    .ingredients {
                        margin-top: 10px;
                        text-align: center;
                        font-size: 14px;
                    }
                }

                .priceDish {
                    width: 25%;
                    color: #b91d19;
                    font-weight: bold;
                    font-size: 24px;
                    text-align: center;
                }



                .description {
                    width: 60%;

                    .foodName {
                        text-align: center;
                        font-weight: 700;
                        font-size: 16px;
                    }
                    .ingredients {
                        margin-top: 10px;
                        text-align: center;
                        font-size: 14px;
                    }

                }

                .price {
                    width: 40%;
                    color: #b91d19;
                    font-weight: bold;
                    font-size: 24px;
                    text-align: center;
                }

            }
        }

        .claimImage {
            height: 60vh;
            background-size: cover !important;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 1px 2px #b9bbbe;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

            .title {
                margin-top: 50px;
                @media(min-width: 1000px) {
                    margin-top: 100px;
                }
                font-size: 52px;
                font-family: 'Great Vibes', cursive;
                color: white;
                margin-bottom: 50px;
            }

            .subpage {
                font-family: 'Great Vibes', cursive;
                font-size: 40px;
                float: left;
                cursor: pointer;
                transition: all .2s ease-in-out;
                color: #999999;
            }

            .subpage:hover {
                color: #cccccc;
            }

            .active {
                color: #ff7679;
            }
            .active:hover {
                color: #df676b;
            }
        }
    }
</style>