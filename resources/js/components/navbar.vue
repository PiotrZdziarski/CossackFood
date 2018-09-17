<template>
    <div>
        <div id="navbar" class="navbar" :class="{boxShadow: !nav_active}">
            <div class="logo">
                <a :href="api_link"><img class="logo-image" :src="api_link + '/images/logo.png'"></a>
            </div>
            <div class="dropdown-menu">
                <div class="dropdown-item">
                    <a class="href" :href="api_link+ '/menu'">Menu</a>
                </div>
                <div class="dropdown-item">
                    <a class="href" :href="api_link+ '/order'">Order</a>
                </div>
                <div class="dropdown-item">
                    News
                </div>
                <div class="dropdown-item">
                    <a class="href" :href="api_link+ '/reservations'">Reserevations</a>
                </div>
                <div class="dropdown-item">
                    Contact
                </div>
            </div>
            <div class="hamburger-div">
                <a id="hamburger" class="burger" @click="show_nav">
                    <div></div>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <transition name="slide-fade">
            <div v-if="nav_active" class="menu">
                <div class="menu-item"><a class="href" :href="api_link+ '/menu'">Menu</a></div>
                <div class="menu-item"><a class="href" :href="api_link+ '/order'">Order</a></div>
                <div class="menu-item">News</div>
                <div class="menu-item"><a class="href" :href="api_link+ '/reservations'">Reservations</a></div>
                <div class="menu-item">Contact</div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "navbar",
        props: {
            api_link: {
                type: String
            }
        },
        data() {
            return {
                nav_active: false
            }
        },
        mounted() {
            window.addEventListener('scroll', function () {
                if(this.scrollY !== 0) {
                    document.getElementById('navbar').classList.add('heightvh');
                }
                if(this.scrollY === 0) {
                    document.getElementById('navbar').classList.remove('heightvh');
                }
            });
        },
        methods: {
            show_nav() {
                document.getElementById('hamburger').classList.toggle('open');

                if (this.nav_active === false) {
                    this.nav_active = true;
                } else if (this.nav_active === true) {
                    this.nav_active = false;
                }

            }
        }
    }
</script>

<style lang="scss" scoped>

    .boxShadow {
        box-shadow: 0 2px 4px #f1f1f1;
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
        position: absolute;
    }

    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
        opacity: 0;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(1000px);
        opacity: 0;
    }

    @media(max-width: 999.99px) {
        .menu {
            width: 100%;
            top: 10vh;
            position: fixed;
            background: white;
            z-index: 1000;
        }

        .menu-item {
            text-align: center;
            width: 100%;
            min-height: 50px;
            font-size: 15px;
            border-bottom: 1px solid #f1f1f1;
            font-family: 'Open Sans', sans-serif;
            justify-content: center;
            display: flex;
            align-items: center;
        }
        .menu-item:first-child {
            border-top: 1px solid #f1f1f1;
        }
        .navbar {
            width: 100%;
            height: 10vh;
            display: flex;
            padding: 15px;
            z-index: 1000;
            position: fixed;
            background: white;
            transition: .25s all ease-in-out;
        }

        .burger {
            display: block;
            position: absolute;
            right: 20%;
            width: 40px;
            height: 45px;
            cursor: pointer;
        }

        .burger.open div {
            background: none;
            box-shadow: none !important;
        }

        .burger.open div:before, .burger.open div:after {
            top: 0;
        }

        .burger.open div:before {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .burger.open div:after {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .burger.open:hover div:before {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .burger.open:hover div:after {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .burger:hover:not(.open) div:before {
            top: -15px;
        }

        .burger:hover:not(.open) div:after {
            top: 15px;
        }

        .burger div,
        .burger div:before,
        .burger div:after {
            width: 100%;
            height: 6px;
            background: #d31f3c;
            border-radius: 2px;
            box-shadow: 0 2px 4px #b9bbbe;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .burger div {
            position: relative;
            margin: 20px auto 0;
        }

        .burger div:before, div:after {
            content: "";
            position: absolute;
        }

        .burger div:before {
            top: -15px;
        }

        .burger div:after {
            top: 15px;
        }

        .hamburger-div {
            display: flex;
            justify-content: right;
            align-items: center;
            float: left;
            position: relative;
            width: 40%;
        }

        .dropdown-menu {
            display: none;
        }

        .logo-image {
            max-width: 100%;

            @media(min-width: 476px) {
                max-width: 75%;
            }

            @media(min-width: 768px){
                max-width: 55%;
            }
        }
    }

    @media(min-width: 1000px) {
        .heightvh {
            height: 9vh !important;
        }
        .heightvh * {
            opacity: 1 !important;
        }
        .logo-image {
            width: 60%;
            height: 60%;
        }
        .navbar {
            margin-left: auto;
            margin-right: auto;
            height: 14vh;
            position: fixed;
            width: 100%;
            box-shadow: 0 1.5px 3px #b9bbbe;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: .3s all ease-in-out;
        }

        .logo {
            display: flex;
            justify-content: center;
            width: 25%;
        }

        .dropdown-menu {
            width: 75%;
            display: flex;
            justify-content: left;
        }

        .dropdown-item {
            text-align: center;
            font-size: 15px;
            color: #111111;
            width: 18%;
            font-family: 'Open Sans', sans-serif;
        }
    }
    .logo {
        display: flex;
        width: 60%;
        align-items: center;
        justify-content: center;
        float: left;
        position: relative;
    }

    .href {
        text-decoration: none;
        font-size: 15px;
        color: #111111;
        transition: .2s all ease-in-out;
        font-family: 'Open Sans', sans-serif;
    }

    .href:hover {
        color: #b91d19;
    }
</style>