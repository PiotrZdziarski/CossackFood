<template>
    <div class="wrapper">
        <div class="container">
            <div class="menuTag" data-aos="flip-up" data-aos-duration="600" data-aos-once="true">
                Pizza
            </div>

            <div class="menuList">
                <div class="menuItem" data-aos="fade-in" data-aos-once="true" v-for="record in records">
                    <div class="menuFood">
                        {{ record.pizza }}
                        <div class="subText">{{ record.ingredients }}</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">{{ record.price }}$</div>
                </div>
            </div>

            <button v-if="pages < max_pages" @click="nextPage" class="showMore">
                Show More
            </button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {
        name: "pizzas_menu",
        props: {
            api_link: {
                Type: String
            }
        },
        data() {
            return {
                records: [],
                pages: 1,
                max_pages: 1
            }
        },
        methods: {
            nextPage() {
                const next_page = this.pages + 1;
                const self = this;

                axios.get(this.api_link + '/api/pizza_pages' + `?pages=${next_page}`).then(function (Response) {
                    self.records = Response.data.data;
                    self.pages += 1;
                    self.records.pop();
                });

            }
        },
        mounted() {
            const self = this;
            axios.get(this.api_link + '/api/pizza_pages?pages=1').then(function (Response) {
                self.records = Response.data.data;
                self.max_pages = Response.data.data.pop();
                self.max_pages = self.max_pages.maxPages;
            });
        }
    }
</script>

<style scoped>
    .wrapper {
        width: 100%;
        border-top: 5px solid #f34949
    }
</style>