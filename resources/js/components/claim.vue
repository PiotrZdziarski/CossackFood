<template>
    <div id="claim" class="claim">
        <div class="claimTitle">CossackFood</div>
        <div class="claimSubTitle">Fictional Restaurant Website</div>
    </div>
</template>

<script>
    export default {
        name: "claim",
        mounted() {
            const claim = document.getElementById('claim');
            window.addEventListener('scroll', function () {
               let offset = window.pageYOffset;
               claim.style.backgroundPositionY = offset * 0.7 + 'px';
            });
        }
    }
</script>

<style lang="scss" scoped>
    .claim {
        height: 100vh;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
                rgba(0, 0, 0, 0.7),
                rgba(0, 0, 0, 0.7)
        ), url('/images/claim.jpg');
        background-size: cover;
        background-position: 50%;
    }

    .claimTitle {
        margin-top: 40px;
        color: white;
        width: 100%;
        text-align: center;
        font-size: 44px;
        font-weight: 700;
    @media(min-width: 476px) {
        font-size: 60px;
    }

    @media(min-width: 768px) {
        font-size: 80px;
        font-weight: 500;
    }

    @media(min-width: 1000px) {
        font-size: 100px;
    }
    animation: 1s ease-out 0s 1 slideInFromTop;
    }

    .claimSubTitle {
        margin-top: 33px;
        color: white;
        font-size: 16px;
        animation: 1s ease-out 0s 1 slideInFromTopMore;
    }

    @keyframes slideInFromTop {
        0% {
            transform: translateY(150%);
        }
        100% {
            transform: translateX(0);
        }
    }

    @keyframes slideInFromTopMore {
        0% {
            transform: translateY(500%);
        }
        100% {
            transform: translateX(0);
        }
    }
</style>