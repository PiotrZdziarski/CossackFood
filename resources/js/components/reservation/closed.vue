<template>
    <transition name="fadeClosed">
        <h1 class="closed" v-if="restaurantClosed === true">CossackFood is closed! :(</h1>
    </transition>
</template>

<script>
    export default {
        name: "closed",
        props: {
            restaurantClosed: {
                type: Boolean
            }
        }
    }
</script>

<style lang="scss" scoped>
    .closed {
        text-align: center;
        margin-top: 150px;
    }
    .fadeClosed-enter-active {
        transition: opacity .5s;
    }

    .fadeClosed-enter, .fadeClosed-leave-to
    {
        opacity: 0;
    }
</style>