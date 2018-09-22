<template>
    <div class="container">
        <div class="featuredDishesTitle">
            <div class="featuredTitle">
                Featured Dishes
            </div>
            <div class="borderDiv"></div>

            <div class="pages">
                <div @click="page(1)" id="page1" class="page active">
                </div>
                <div @click="page(2)" id="page2" class="page inactive">
                </div>
                <div @click="page(3)" id="page3" class="page inactive">
                </div>
                <div @click="page(4)" id="page4" class="page inactive">
                </div>
            </div>
        </div>
        <transition name="fade">
            <section v-if="loading === false" id="dishes" class="dishes">
                <div class="dish" :id="'dish' + record.id" v-for="record in records">
                    <div class="image"
                         :style="{backgroundImage: 'url(' +'/images/dishes/' + record.image + ')'}"></div>
                    <div class="description">
                        <div class="title">
                            {{ record.dish }}
                        </div>
                        <div class="price">
                            {{ record.price }}$
                        </div>
                    </div>
                </div>
            </section>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "featuredDishes",
        props: {
            api_link: {
                Type: String
            },
            dishes_prop: {
                Type: Object
            }
        },
        data() {
            return {
                records: [],
                pageNumber: 1,
                loading: true,
                dishes: [],
                carouselInterval: 0,
            }
        },
        computed: {
            dishes_propCompute: function () {
                return JSON.parse(this.dishes_prop);
            },
        },
        mounted() {
            this.dishes = this.dishes_propCompute;

            for (let i = 0; i < 4; i++) {
                this.records.push(this.dishes[i]);
            }
            this.loading = false;
            this.carousel();
        },
        methods: {
            page(page) {
                this.loading = true;
                this.pageNumber = page;
                this.records = [];
                let begin = (page - 1) * 4;
                let end = page * 4;

                for (let i = begin; i < end; i++) {
                    if (typeof this.dishes[i] !== 'undefined') {
                        this.records.push(this.dishes[i]);
                    }
                }

                for (let i = 1; i <= 4; i++) {
                    if (i === page) {
                        document.getElementById('page' + i).classList.add('active');
                        document.getElementById('page' + i).classList.remove('inactive');
                    } else {
                        document.getElementById('page' + i).classList.add('inactive');
                        document.getElementById('page' + i).classList.remove('active');
                    }
                }

                setTimeout(() => {
                    this.loading = false;
                }, 75);

                this.restartCarousel();
            },

            carousel() {
                this.carouselInterval = setInterval(() => {
                    if(this.pageNumber < 4) {
                        this.page(this.pageNumber + 1);
                    } else {
                        this.page(this.pageNumber = 1);
                    }
                }, 5000);
            },

            restartCarousel() {
                clearInterval(this.carouselInterval);

                this.carousel();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .8s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .fadeIn {
        -webkit-animation: fadeIn 1s;
        -moz-animation:    fadeIn 1s;
        -o-animation:      fadeIn 1s;
        animation:         fadeIn 1s;
    }
    @keyframes fadeIn {
        0%   { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

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
        position: relative;
        display: grid;
        grid-template-columns: 1fr;

        @media(min-width: 768px) {
            grid-template-columns: 1fr 1fr;
        }

        @media(min-width: 1000px) {
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
            @media(min-width: 1000px) {
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
                    width: 75%;
                    font-size: 16px;
                    word-break: break-word;
                }

                .price {
                    text-align: right;
                    width: 25%;
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