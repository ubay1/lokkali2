<template>
    <div>
        <nav class="menu" id="myTopnav">
            <router-link :to="{ name: 'home' }" class="navbar-brand">
                <img src="../../img/logo.png" alt="" class="logo">
            </router-link>
            <a href="javascript:void(0);" class="icon" @click="isHidden = !isHidden">
                <i class="fa fa-bars fa- icon_hamburger"></i>
            </a>
            <div class="right_menu">

                <router-link :to="{ name: 'home' }" class="nav-link home-link"> HOME </router-link>

                <router-link :to="{ name: 'service' }" class="nav-link service-link"> SERVICE </router-link>

                <router-link :to="{ name: 'case' }" class="nav-link case-link"> CASE STUDY </router-link>

                <router-link :to="{ name: 'blog' }" class="nav-link blog-link"> BLOG </router-link>

                <router-link :to="{ name: 'contact' }" class="nav-link contact-link"> CONTACT </router-link>
            </div>

            <!-- for mobile -->
            <div class="right_menu2" v-if="isHidden">

                <router-link :to="{ name: 'home' }" class="nav-link home-link"> HOME </router-link>

                <router-link :to="{ name: 'service' }" class="nav-link service-link"> SERVICE </router-link>

                <router-link :to="{ name: 'case' }" class="nav-link case-link"> CASE STUDY </router-link>

                <router-link :to="{ name: 'blog' }" class="nav-link blog-link"> BLOG </router-link>

                <router-link :to="{ name: 'contact' }" class="nav-link contact-link"> CONTACT </router-link>
            </div>
        </nav>
    </div>
</template>

<style>
    @import url('../../css/app.css');

</style>

<script>
    export default {
        data() {
            return {
                isHidden: false,
            }
        },
        methods: {
            menu: ()=> {
                this.isHidden = !this.isHidden;
            }
        }
    }

</script>
