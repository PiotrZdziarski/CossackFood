<template>
    <transition name="fade">
        <div v-if="showFlash" class="message">
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
            showFlash: {
                type: Boolean
            }
        }
    }
</script>

<style lang="scss" scoped>

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to
    {
        opacity: 0;
    }

    .message {
        position: fixed;
        width: 90%;
        left: 50%;
        transform: translateX(-50%);
        padding: 20px;
        background: #353a3e;
        bottom: 20px;
        text-align: center;
        border-radius: 5px;
        color: white;
        z-index: 999999;

        @media(min-width: 476px) {
            width: 80%;
        }

        @media(min-width: 768px) {
            width: 70%;
        }

        @media(min-width: 1000px) {
            width: 40%;
        }


    }
</style>