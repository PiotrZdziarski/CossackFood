<template>
    <footer>
        <div class="footer">
            <div class="footerColumn">
                <p>CossackFood</p>
                <p>1111 Lorem Streer</p>
                <p>Carthage, 12001</p>
                <p>Lorem Ipsum</p>
            </div>
            <div class="footerColumn">
                <p>France Restaurant</p>
                <p>68, rue  de la Couronne</p>
                <p>75002 PARIS</p>
                <p>02.94.23.69.56</p>
            </div>
            <div class="footerColumn">
                <p>Blog</p>
                <p>Careers</p>
                <p>Privacy Policy</p>
                <p>Contact</p>
            </div>
            <div class="footerColumn">
                <img class="imageFooter" data-aos="fade-left" data-aos-once="true" :src="api_link + '/images/logo2.png'">
                <p>No rights reserved</p>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "mainfooter",
        props: {
            api_link: {
                type: String
            }
        }
    }
</script>

<style lang="scss" scoped>
    .footer {
        margin-top: 220px;
        min-height: 317px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr;
        background-color: #3B3B3B;
        position: relative;

        @media(min-width: 768px) {
            grid-template-columns: 1fr 1fr;
        }

        @media(min-width: 1200px) {
            padding-left: 100px;
            padding-right: 100px;
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }

        .footerColumn {
            margin-left: auto; margin-right: auto;
            padding: 40px;
            text-align: center;

            @media(min-width: 1200px) {
                padding: 80px;
            }
            color: white;
            font-size: 14px;


            .imageFooter {
                width: 60%;

                @media(min-width: 1200px) {
                    width: 100%;
                }
            }
        }
    }
</style>