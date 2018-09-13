<template>
    <transition name="fade">
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
    .fade-enter-active, .fade-leave-active {
        transition: opacity 2s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>