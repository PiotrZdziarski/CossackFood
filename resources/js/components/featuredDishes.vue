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
        <div id="dishes" class="dishes">
            <div data-aos-once="true" data-aos="fade-in" class="dish" v-for="record in records">
                <div class="image" :style="{backgroundImage: 'url(' +'/images/dishes/' + record.image + ')'}"></div>
                <div class="description">
                    <div class="title">
                        {{ record.dish }}
                    </div>
                    <div class="price">
                        {{ record.price }}$
                    </div>
                </div>
            </div>
        </div>
        <div v-if="loading" id="loader" class="lds-dual-ring"></div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "featuredDishes",
        props: {
            api_link: {
                Type: String
            }
        },
        data() {
            return {
                records: [],
                pages: 1,
                max_pages: 1,
                loading: true
            }
        },
        mounted() {
            const self = this;
            axios.get(this.api_link + '/api/dishes_page?page=1').then(function (Response) {
                self.records = Response.data.data;
                self.loading = false;
            });
        },
        methods : {
            page(page) {

                this.records = [];
                const self = this;
                self.loading = true;

                axios.get(this.api_link + '/api/dishes_page?page=' + page).then(function (Response) {
                    self.loading = false;
                    self.records = Response.data.data;
                });

                for(let i = 1; i <= 4; i++) {
                    if(i === page) {
                        document.getElementById('page' + i).classList.add('active');
                        document.getElementById('page' + i).classList.remove('inactive');
                    } else {
                        document.getElementById('page' + i).classList.add('inactive');
                        document.getElementById('page' + i).classList.remove('active');
                    }
                }
            },
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