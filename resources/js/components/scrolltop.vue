<template>
    <transition name="slide-fade">
        <div v-if="append" @click="scrollTopMethod" class="scrollTop">
            <i class="arrow top"></i>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "scrolltop",
        data() {
            return {
                append: false
            }
        },
        mounted() {
            const self = this;
            window.addEventListener('scroll', function () {
                if(this.scrollY > 300) {
                    self.append = true;
                }
                if(this.scrollY < 300) {
                    self.append = false;
                }
            });
        },
        methods: {
            scrollTopMethod() {
                document.getElementById('mainnav').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
        opacity: 0;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(200px);
        opacity: 0;
    }
    .scrollTop {
        position: fixed;
        background-color: white;
        border-radius: 50%;
        box-shadow: 0 1px 2px #dddddd;
        cursor: pointer;
        width: 50px;
        height: 50px;
        bottom: 25px;
        right: 25px;
        display: flex;
        justify-content: center;
        align-items: center;

        i {
            border: solid #d31f3c;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3.5px;
            margin-top: 5px;
            transition: 1s all ease-in-out;
        }
        .top {
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }

        @media(min-width: 768px) {
            bottom: 40px;
            right: 40px;
        }
    }

    .scrollTop {
        outline: none;
    }

    .scrollTop:active {
        outline: none;
    }


</style>