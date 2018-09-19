<template>
    <div id="order" class="order">
        <div class="orderTitle">
            Order
        </div>
        <div class="summary">
            <div class="summaryTitle">
                Summary
            </div>
            <div class="summaryPrice">
                9123.48$
            </div>
        </div>
        <div class="orderProducts">

            <div class="product">
                <div class="productName">
                    Id placeat sedeo
                </div>
                <div class="productPrice">
                    47.65$
                </div>
                <div class="deleteProduct">
                    <div class="close"></div>
                </div>
            </div>


        </div>
        <div class="orderLowWidthButton" @click="showBasketMethod">
            <i class="demo-icon icon-shopping-basket"></i>
            <div class="orderButtonTitle">Order</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "orderMenu",
        props: {
            productType: {
                Type: String
            },
            addingProduct: {
                Type: Number
            }
        },
        data() {
            return {
                showBasket: false,
            }
        },
        watch: {
            addingProduct: function(id) {
                this.addToOrder(id, this.productType);
            }
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
                alert(id);
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

                    @media(max-width: 768px){
                        font-size: 16px;
                    }
                }

                .deleteProduct {
                    .close {
                        width: 10px;
                        height: 10px;
                        padding: 30px 5px 30px 5px;
                        cursor: pointer;
                        &::before,
                        &::after {
                            position: absolute;
                            top: 50%;
                            right: 5px;
                            content: '';
                            width: 15px;
                            height: 2px;
                            background: black;
                            display: block;

                            @media(min-width: 768px) and (max-width: 1200px) {
                                right: 0;
                                top: 15%;
                            }

                            @media(max-width: 768px) {
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
                            background: #444444;
                        }
                    }
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
    }
</style>