<template>
    <transition name="fade">
        <div v-if="messageVisible" class="message">
            <!--{{ message }}-->
            Reservation successfully added!
        </div>
    </transition>
</template>

<script>
    export default {
        name: "flashMessage",
        props: {
            messageFlash: {
                type: String
            }
        },
        data() {
            return {
                messageVisible: true
            }
        },
        mounted() {
            const self = this;
            setTimeout(function(){
                self.messageVisible = false;
            },3000);
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
        width: 500px;
        left: 50%;
        transform: translateX(-50%);
        padding: 20px;
        background: #353a3e;
        bottom: 20px;
        text-align: center;
        border-radius: 5px;
        color: white;
        z-index: 999999;
    }
</style>