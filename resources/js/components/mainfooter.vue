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
                <img data-aos="fade-in" data-aos-once="true" data-aos-offset="-300" class="imageFooter"  :src="api_link + '/images/logo2.png'">
                <p>I do not reserve the right to the images placed on this website</p>
                <p>
                    2018 &copy Piotr Zdziarski
                </p>
                <p>
                    <a target="_blank" class="hrefGithub" href="https://github.com/PiotrZdziarski">Github</a>
                </p>
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
        background-color: #1e1e1e;
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
            width: 100%;
            text-align: center;

            @media(min-width: 1200px) {
                padding: 80px;
                text-align: left;
            }
            color: white;
            font-size: 14px;


            .imageFooter {
                width: 60%;

                @media(min-width: 1200px) {
                    width: 100%;
                }
            }

            .hrefGithub {
                color: white;
                border-bottom: 1px solid white;
                text-decoration: none;
            }
            .hrefGithub:hover {
                color: #cccccc;
                border-bottom: 1px solid #cccccc;
            }
        }
    }
</style>