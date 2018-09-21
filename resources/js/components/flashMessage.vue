<template>
    <transition name="fade">
        <div v-if="flashQueue.includes(flashNumber)" class="message">
            {{ messageFlash }}
        </div>
    </transition>
</template>

<script>
    export default {
        name: "flashMessage",
        props: {
            messageFlash: {
                type: String
            },
            flashCount: {
                type: Number
            }
        },
        data() {
            return {
                previousFlash: true,
                flashNumber: 0,
                flashQueue: [],
            }
        },
        watch: {
            flashCount: function(flashNumber)  {
                this.flashQueue.push(flashNumber);
                this.flashNumber = flashNumber;

                setTimeout(() => {
                    this.flashQueue = this.flashQueue.filter(item => item !== flashNumber);
                }, 3500);
            }
        }
    }
</script>

<style lang="scss" scoped>

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .message {
        position: fixed;
        width: 90%;
        padding: 20px;
        right: 0;
        left: 0;
        margin-right: auto;
        margin-left: auto;

        background: #fafafa;
        bottom: 20px;
        text-align: center;
        border-radius: 5px;
        border: 1px solid #e8ede2;
        color: #e75949;
        z-index: 999999;
        font-weight: 700;
        font-size: 18px;
        font-family: 'Open Sans', sans-serif;

        @media(min-width: 476px) {
            width: 80%;
        }

        @media(min-width: 768px) {
            width: 50%;
        }

        @media(min-width: 1000px) {
            width: 25%;
        }

    }
</style>