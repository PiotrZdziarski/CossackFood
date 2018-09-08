<template>
    <div class="container" data-aos="fade-in">
        <div class="featuredDishesTitle">
            <div class="featuredTitle">
                Featured Dishes
            </div>
            <div class="borderDiv"></div>

            <div class="pages">
                <div class="page active">
                </div>
                <div class="page inactive">

                </div>
                <div class="page inactive">

                </div>
                <div class="page inactive">

                </div>
            </div>
        </div>
        <div class="dishes">
            <div class="dish">
                <div class="image"></div>
                <div class="description">
                    <div class="title">
                        Traditional Soutzoukakia
                    </div>
                    <div class="price">
                        23$
                    </div>
                </div>
            </div>

            <div class="dish">
                <div class="image"></div>
                <div class="description">
                    <div class="title">
                        Traditional Soutzoukakia
                    </div>
                    <div class="price">
                        23$
                    </div>
                </div>
            </div>

            <div class="dish">
                <div class="image"></div>
                <div class="description">
                    <div class="title">
                        Traditional Soutzoukakia
                    </div>
                    <div class="price">
                        23$
                    </div>
                </div>
            </div>

            <div class="dish">
                <div class="image"></div>
                <div class="description">
                    <div class="title">
                        Traditional Soutzoukakiaqweqweqw qw
                    </div>
                    <div class="price">
                        23$
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "featuredDishes"
    }
</script>

<style lang="scss" scoped>
    .featuredDishesTitle {

        width: 100%;
        display: flex;
        justify-content: left;
        align-items: center;

        @media(min-width: 476px) {
            margin-top: 150px;
            width: 100%;
        }

        margin-top: 80px;
        position: relative;

        .featuredTitle {
            padding: 15px;
            font-size: 22px;
            text-transform: uppercase;
            color: #3B3B3B;
        }
        @media(min-width: 768px) {
            .borderDiv {
                width: 40%;
                margin-right: 15px;
                height: 0;
                position: relative;
                border: 1px solid #E5E3E3;
            }
        }

        .pages {
            position: absolute;
            right: 5px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            min-width: 20%;

            @media(min-width: 768px) {
                min-width: 14%;
            }
            @media(min-width: 1000px) {
                min-width: 9%;
            }
            .page {
                width: 10px;
                height: 10px;
                cursor: pointer;
                border-radius: 50%;

            }
        }
    }

    .dishes {
        margin-top: 20px;
        display: grid;
        grid-template-columns: 1fr;

        @media(min-width: 768px) {
            grid-template-columns: 1fr 1fr;
        }

        @media(min-width: 1000px)
        {
            grid-auto-flow: row;
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
        .dish {
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 60px;

            @media(min-width: 768px) {
                margin-left: 25px;
                margin-right: 25px;
                margin-bottom: 25px;
            }
            @media(min-width: 1000px)
            {
                margin-bottom: 0;
            }

            .image {
                height: 250px;
                @media(min-width: 476px) {
                    height: 400px;
                }

                @media(min-width: 768px) {
                    height: 250px;
                }

                @media(min-width: 1000px) {
                    height: 200px;
                }
                width: 100%;
                background-size: cover;
                background-image: url('/images/dish.jpg');
                background-position: 50%;
            }

            .description {
                width: 100%;
                margin-top: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;

                .title {
                    width: 86%;
                    font-size: 16px;
                    word-break: break-word;
                }

                .price {
                    text-align: center;
                    width: 14%;
                    font-size: 16px;
                }
            }
        }

    }

    .active {
        background-color: #9B9B9B;
    }

    .inactive {
        background-color: #DEDEDE;
    }
</style>