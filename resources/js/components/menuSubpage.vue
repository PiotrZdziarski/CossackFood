<template>
    <div class="wrapper">
        <div :style="{backgroundImage: 'url(' + this.api_link + '/images/claimMenu.jpg' + ')'}" class="claimImage">
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
        <div v-if="food === 'pizza'">ppizza</div>
        <div v-if="food === 'dishes'">dishes</div>
    </div>
</template>

<script>
    export default {
        name: "menuSubpage",
        data() {
            return {
                food: 'pizza'
            }
        },
        props: {
            api_link: {
                Type: String
            }
        },
        methods: {

            pizza() {
                document.getElementById('pizza').classList.add('active');
                document.getElementById('dishes').classList.remove('active');

                this.food = 'pizza';
            },

            dishes() {
                document.getElementById('dishes').classList.add('active');
                document.getElementById('pizza').classList.remove('active');

                this.food = 'dishes';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .wrapper {

        .claimImage {
            height: 373px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 1px 2px #b9bbbe;


            .title {
                margin-top: 100px;
                font-size: 36px;
                font-family: 'Great Vibes', cursive;
                color: #444444;
                margin-bottom: 50px;
            }

            .subpage {
                font-family: 'Great Vibes', cursive;
                font-size: 30px;
                float:left;
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
    }
</style>