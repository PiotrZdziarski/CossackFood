<template>
    <div id="order" class="order">
        <div class="orderTitle">
            Order
        </div>
        <div class="summary">
            <div class="summaryTitle">
                Summary
            </div>
            <transition name="fade">
                <div class="summaryPrice" v-if="loading === false">
                    ${{ summary }}
                </div>
            </transition>
        </div>
        <transition name="fade">
            <div class="orderProducts" v-if="loading === false">
                <div class="product" v-for="record in records">
                    <div class="productName">
                        {{ record.product }}
                    </div>
                    <div class="productPrice">
                        ${{ record.price }}
                    </div>
                    <div class="deleteProduct">
                        <div @click="deleteProduct(record.id)" class="close"></div>
                    </div>
                </div>
            </div>
        </transition>
        <transition name="fade">
            <div class="utilities"  v-if="summary !== 0 && loading === false">
                <div class="submitDiv">
                    <button @click="sumbitOrder" class="submit">Order</button>
                </div>
                <div class="clearAll">
                    <div @click="clearAll" class="clearAllTitle">Clear all</div>
                </div>
            </div>
        </transition>
        <div class="orderLowWidthButton" @click="showBasketMethod">
            <i class="demo-icon icon-shopping-basket"></i>
            <div class="orderButtonTitle">Order</div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "orderMenu",
        props: {
            productType: {
                Type: String
            },
            productID: {
                Type: Number
            },
            api_link: {
                Type: String
            },
            addingProduct: {
                Type: Boolean
            }
        },
        data() {
            return {
                showBasket: false,
                records: [],
                loading: true,
                summary: 0,
            }
        },
        watch: {
            addingProduct: function (productAdding) {
                if (productAdding === true) {
                    this.addToOrder(this.productID, this.productType);
                }
            }
        },
        mounted() {
            axios.get(this.api_link + '/api/basket_products').then((Response) => {
                this.records = Response.data.data;
                this.loading = false;
                this.updateSummary();
            });
        },
        methods: {

            showBasketMethod() {
                if (this.showBasket === false) {
                    document.getElementById('order').style.right = '0';
                    this.showBasket = true;
                } else {
                    this.showBasket = false;
                    document.getElementById('order').style.right = '-70%';
                }
            },

            addToOrder(id, type) {
                this.loading = true;

                axios.post(this.api_link + '/api/basket_store', {
                    'id': id,
                    'type': type
                }).then((Response) => {
                    this.records = Response.data.data;
                    this.loading = false;
                    this.$emit('showFlash', 'Product successfully added!');
                    this.updateSummary();
                });
            },

            deleteProduct(id) {
                this.loading = true;

                axios.post(this.api_link + '/api/basket_delete', {
                    'id': id
                }).then((Response) => {
                    this.records = Response.data.data;
                    this.loading = false;
                    this.$emit('showFlash', 'Product successfully deleted!');
                    this.updateSummary();
                });
            },

            updateSummary() {
                this.summary = 0;
                this.records.forEach((record) => {
                    this.summary += record.price;
                });
                this.summary = Math.round(this.summary * 100) / 100;
            },

            clearAll() {
                this.loading = true;

                axios.delete(this.api_link + '/api/basket_delete_all').then(() => {
                    this.records = [];
                    this.loading = false;
                    this.$emit('showFlash', 'All products successfully deleted!');
                    this.updateSummary();
                });
            },

            sumbitOrder(){
                this.loading = true;

                axios.delete(this.api_link + '/api/basket_delete_all').then(() => {
                    this.records = [];
                    this.loading = false;
                    this.$emit('showFlash', 'Ordered!');
                    this.updateSummary();
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .order {
        font-size: 24px;

        @media(max-width: 768px) {
            position: fixed;
            right: -70%;
            top: 50%;
            transform: translateY(-50%);
            width: 70%;
            z-index: 999;
            background: white;
            padding: 15px;
            border-radius: 4px;
            transition: right .3s ease-in-out;
        }

        @media(min-width: 768px) {
            width: 30%;
            margin: 20px;
            padding: 20px;
            box-shadow: 0 1px 2px #cfcfcf;
        }

        .orderTitle {
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 10px;
        }

        .summary {
            margin-top: 20px;
            padding-bottom: 15px;
            display: grid;
            grid-template-columns: 1.4fr 0.6fr;
            border-bottom: 1px solid #eeeeee;

            .summaryTitle {
                font-size: 16px;
            }

            .summaryPrice {
                color: #b91d19;
                font-weight: 500;
                font-size: 20px;
                margin-left: 10px;
                text-align: right;

                @media(min-width: 768px) and (max-width: 1000px) {
                    font-size: 16px;
                }

            }
        }
        .orderProducts {

            @media(max-width: 768px) {
                overflow-y: scroll;
                height: 40vh;
            }
            .product {
                display: grid;
                grid-template-columns: 1fr 0.7fr 0.3fr;
                position: relative;
                align-items: center;
                border-bottom: 1px solid #f1f1f1;
                padding: 5px 0 5px 0;

                .productName {
                    font-size: 16px;
                    position: relative;
                    padding: 10px 0 10px 0;
                }

                .productPrice {
                    font-weight: 500;
                    font-size: 18px;
                    color: #b91d19;
                    text-align: right;

                    @media(min-width: 768px) and (max-width: 1200px) {
                        font-size: 16px;
                    }

                    @media(max-width: 768px) {
                        font-size: 16px;
                    }
                }

                .deleteProduct {
                    position: relative;
                    .close {
                        width: 80%;
                        height: 40px;
                        //padding: 30px 5px 30px 5px;

                        margin-left: 20%;
                        cursor: pointer;
                        &::before,
                        &::after {
                            position: absolute;
                            top: 50%;
                            right: 5px;
                            content: '';
                            width: 15px;
                            height: 2px;
                            background: #434343;
                            display: block;
                            cursor: pointer;

                            @media(min-width: 768px) and (max-width: 1000px) {
                                right: 0;
                                top: 15%;
                            }

                            @media(max-width: 768px) {
                                right: 15px;
                            }

                            @media(max-width: 476px) {
                                right: 10px;
                            }
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
                            background: #727272;
                        }
                    }
                }
            }
        }
        .utilities {
            display: grid;
            grid-template-columns: 40% 60%;
            position: relative;

            .submitDiv {

                .submit {
                    margin-top: 20px;
                    background-color: #f54339;
                    color: white;
                    transition: .2s all ease-in-out;
                    cursor: pointer;
                    padding: 8px 16px 8px 16px;
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
            }

            .clearAll {
                color: #666666;
                font-family: 'Open Sans', sans-serif;
                font-size: 14px;
                position: relative;
                height: 100%;
                text-align: right;

                .clearAllTitle {
                    position: absolute;
                    right: 0;
                    top: 50%;
                    cursor: pointer;
                }

                .clearAllTitle:hover {
                    color: #999999;
                }
            }
        }

        .orderLowWidthButton {
            font-size: 22px;
            cursor: pointer;
            position: fixed;
            right: 100%;
            top: 50%;
            padding: 8px 12px 8px 12px;
            background: white;
            border-radius: 3px;
            transform: translateY(-50%);
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            box-shadow: 0 1px 2px #b9bbbe;
            z-index: 999999;

            @media(min-width: 768px) {
                display: none;
            }

            .orderButtonTitle {
                font-size: 12px;
                text-align: center;
            }
        }

        .loaderContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding-top: 30px;
            padding-bottom: 5px;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }

        .fade-enter, .fade-leave-to {
            opacity: 0;
        }
    }
</style>