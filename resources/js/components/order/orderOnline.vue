<template>
    <div class="wrapper">
        <div id="claim" :style="{background: 'linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)) ,url(' + api_link + '/images/orderClaim.jpg' + ')'}"
             class="claimImage">
            <div>
                <div class="title">Order Online!</div>
            </div>
        </div>
        <div class="container">
            <div class="products">
                <div class="subpages">
                    <div @click="dishes" id="dishes" class="subpage active">
                        Dishes
                    </div>
                    <div @click="pizza" id="pizza" class="subpage" style="margin-left: 100px;">
                        Pizza
                    </div>
                </div>

                <div data-aos="fade-in"
                     :style="{background: 'linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(' + api_link + '/images/dishes/' + record.image + ')'}"
                     data-aos-offset="-100" data-aos-once="true" v-if="food === 'dishes'" class="product"
                     v-for="record in records" v-cloak @click="storeProduct(record.id, 'dish')">
                    <div class="productTitle">
                        {{ record.dish }}
                    </div>

                    <div class="price">
                        ${{ record.price }}
                    </div>
                </div>

                <div data-aos="fade-in" data-aos-offset="-100" data-aos-once="true" v-if="food === 'pizza'"
                     class="product pizzaHover" v-for="record in records" @click="storeProduct(record.id, 'pizza')">
                    <div class="productTitle pizzaTitle">
                        {{ record.pizza }}
                    </div>

                    <div class="price">
                        ${{ record.price }}
                    </div>
                </div>

                <div v-if="loading" id="loader" class="lds-dual-ring"></div>
            </div>
            <order-menu
                    :api_link="api_link"
                    :productID="productID"
                    :productType="productType"
                    :addingProduct="addingProduct"
                    @showFlash="showFlash($event)">
            </order-menu>

            <flash-message :messageFlash="messageFlash" :flashCount="flashCount"></flash-message>
        </div>
    </div>
</template>

<script>
    import orderMenu from './orderMenu.vue';
    import axios from 'axios';

    export default {
        name: "orderOnline",
        components: {
            orderMenu: orderMenu
        },
        props: {
            api_link: {
                Type: String
            },
            dishes_data: {
                Type: Object
            },
            pizzas_data: {
                Type: Object
            }
        },
        computed: {
            dishesCompute: function () {
                return JSON.parse(this.dishes_data);
            },
            pizzaCompute: function () {
                return JSON.parse(this.pizzas_data);
            }
        },
        data() {
            return {
                food: 'dishes',
                records: [],
                loading: false,
                productID: 0,
                productType: '',
                addingProduct: false,

                messageFlash: '',
                flashCount: 0,
            }
        },
        mounted() {
            //convert data from controller to json
            this.records = this.dishesCompute;

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
                this.records = this.pizzaCompute;
            },

            dishes() {
                document.getElementById('dishes').classList.add('active');
                document.getElementById('pizza').classList.remove('active');

                this.food = 'dishes';
                this.records = this.dishesCompute;
            },

            storeProduct(id, type) {
                this.productID = id;
                this.productType = type;

                this.addingProduct = true;
            },

            showFlash(message) {
                this.addingProduct = false;
                this.messageFlash = message;
                this.flashCount += 1;
            }

        }
    }
</script>

<style lang="scss" scoped>


    .wrapper {

        .subpages {

            display: flex;
            justify-content: center;
            align-items: center;
            grid-column-start: 1;
            grid-column-end: 3;
            height: 90px;

            .subpage {
                font-family: 'Great Vibes', cursive;
                font-size: 35px;
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

        .claimImage {
            height: 60vh;
            background-repeat: no-repeat;
            background-position-x: 40% !important;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 1px 2px #b9bbbe;

            @media(min-width: 768px) {
                background-position-x: 20% !important;
            }
            @media(min-width: 1200px) {
                background-position-x: 0 !important;
            }

            .title {
                margin-top: 120px;
                @media(min-width: 768px) {
                    margin-top: 140px;
                    font-size: 62px;
                }
                font-size: 42px;
                font-family: 'Great Vibes', cursive;
                color: #ff5d65;
                margin-bottom: 50px;
            }
        }

        .container {

            margin-top: 30px;

            @media(min-width: 768px) {
                display: flex;
                align-items: flex-start;
            }
            .products {
                position: relative;

                @media(min-width: 768px) {
                    width: 70%;
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                }

                .product {
                    margin: 4%;
                    padding: 60px 30px 60px 30px;
                    transition: all ease-in-out .3s;
                    border-radius: 4px;
                    cursor: pointer;
                    display: grid;
                    grid-template-columns: 75% 25%;
                    position: relative;
                    border: 1px solid #f1f1f1;
                    background-size: cover !important;

                    @media(min-width: 768px) and (max-width: 1000px) {
                        padding:  30px 15px 30px 15px;
                    }
                    .productTitle {
                        display: flex;
                        justify-content: left;
                        align-items: center;
                        position: relative;
                        color: white;
                        word-wrap: break-word;
                        width: 100%;
                    }

                    .pizzaTitle {
                        color: black;
                    }

                    .price {
                        position: relative;
                        display: flex;
                        justify-content: center;
                        color: #fe404f;
                        font-size: 22px;
                        font-weight: 500;
                        align-items: center;
                        margin-left: 5px;

                        @media(min-width: 768px) {
                            font-size: 16px;
                        }

                        @media(min-width: 1000px) {
                            font-size: 20px;
                        }
                    }

                    @media(min-width: 768px) {
                        margin: 5%;
                    }
                }

                @media(min-width: 768px) {

                    .product:hover {
                        box-shadow: 0 1px 12px black;
                    }

                    .pizzaHover:hover {
                        box-shadow: 0 1px 12px #b9bbbe;
                    }
                }


            }
        }

        fade-enter-active, .fade-leave-active {
            transition: opacity .3s;
        }

        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        .lds-dual-ring {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: auto;
            height: 100px;
            width: 100px;
            margin-right: auto;
            margin-top: 150px;
            grid-column-start: 1;
            grid-column-end: 3;
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
    }
</style>