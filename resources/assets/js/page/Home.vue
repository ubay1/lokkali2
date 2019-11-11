<template>
    <div>
        <div class="homepage-header-background">

            <Menu/>

            <div class="bg-banner">
                <div class="row">
                    <div class="col-lg-5 col-xl-5 col-md-12 home-banner">
                        <div class="teks">
                            You're in the right time, <br>
                            and the right place <br>
                            to get the best solution
                        </div>
                        <div class="bg-button-teks">
                            <router-link to="service">
                            <button class="button-teks">START YOUR JOURNEY</button>
                            </router-link>
                        </div>
                        <div class="nama-pt">
                            PT Lokkali Cipta Indonesia
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-7 slide-banner">
                        <img class="img-slider"  src="../../img/slide_banner.png" alt="">
                    </div>
                </div>
            </div>

        </div>

        <div class="about">
            <div class="row" v-for="(data, index) in about" :key="index">
                <div class=" col-md-12 col-lg-7 col-xl-7 bg-teks-about">
                        <div class="teks-header-about">
                            {{data.judul}}
                        </div>
                        <div class="teks-about">
                            {{data.isi}}
                        </div>
                        <router-link to="service">
                        <div class="start-journey">
                            Start Your Journey <span class="fas fa-chevron-right"></span>
                        </div>
                        </router-link>
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5">
                    <img class="image-about" v-lazy="data.gambar" :key="data.gambar" alt="">
                </div>
            </div>
        </div>

        <div class="service">
            <!-- <img class="img-service" src="../../img/home_service_bg.png" alt=""> -->
            <div class="img"></div>
            <div class="teks-service">
                OUR SERVICE
            </div>
            <!-- <div class="container"></div> -->
            <div class="service-list">
                <div class="row row1-icon-service">
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                        <img class="icon-service" src="../../img/icon/bisnis.png" alt="">
                        <div class="text-icon-service">
                            BUSINESS MANAGEMENT
                        </div>
                        </router-link>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                        <img class="icon-service" src="../../img/icon/strategic.png" alt="">
                        <div class="text-icon-service">
                            DIGITAL STRATEGIC
                        </div>
                        </router-link>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                        <img class="icon-service" src="../../img/icon/activation.png" alt="">
                        <div class="text-icon-service">
                            DIGITAL ACTIVATION
                        </div>
                        </router-link>
                    </div>
                </div>
                <div class="row row2-icon-service">
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                            <img class="icon-service" src="../../img/icon/dev.png" alt="" >
                            <div class="text-icon-service">
                                WEB & MOBILE <br> DEVELOPMENT
                            </div>
                        </router-link>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                        <img class="icon-service" src="../../img/icon/security.png" alt="">
                        <div class="text-icon-service" style="margin-top:30px;">
                            CYBER SECURITY
                        </div>
                        </router-link>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-12">
                        <router-link to="service">
                        <img class="icon-service" src="../../img/icon/creative.png" alt="">
                        <div class="text-icon-service">
                            CREATIVES
                        </div>
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <router-link to="service" class="moreinfo-service">
                    <div class="">
                        More Info <span class="fas fa-chevron-right"></span>
                    </div>
                    </router-link>
                </div>
            </div>
        </div>

        <div class="why-lokali">
            <div class="teks-why">
                WHY LOKKALI ?
            </div>
            <div class="lokali-list">
                <div class="row">
                    <div class="bg-icon col-lg-4 col-md-12" v-for="(data, index) in visimisi" :key="index">
                        <img class="icon-why" v-lazy="data.gambar" :key="data.gambar" alt="" >
                        <div class="text-icon-why">
                           {{data.isi}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- carousel -->
            <carousel :loop="true" :autoplay="true" :autoplayTimeout="5000" :perPage="1" class="caro-list">
                <slide v-for="(data, index) in visimisi" :key="index" >
                    <div class=" container text-center">
                        <img :src="data.gambar" alt="" class="img-fluid">
                        <p>{{data.isi}}</p>
                    </div>
                </slide>
            </carousel>
            <!-- <carousel :items='1'>
                <img v-for="(data, index) in imagess" :key="index" :src="data" class="img-fluid" >
            </carousel> -->
        </div>

        <Footer/>
    </div>
</template>

<script>
import Menu from '../components/Menu'
import Footer from '../components/Footer'
import axios from 'axios'
// import carousel from 'vue-owl-carousel'
import { Carousel, Slide } from 'vue-carousel';

    export default {
        data() {
            return {
                about: [],
                visimisi :[],
                visimisi2 :[],
                imagess: [
                    "http://localhost:8000/uploads/visimisi/828147914203aa764a2a1107ef1b8d61bee5ab1f6.png",
                    "http://localhost:8000/uploads/visimisi/828147914203aa764a2a1107ef1b8d61bee5ab1f6.png",
                    "http://localhost:8000/uploads/visimisi/828147914203aa764a2a1107ef1b8d61bee5ab1f6.png",
                ]
            }
        },
        components:{
            Menu, Footer, Carousel, Slide
        },
        mounted () {
            console.log(this.imagess)
            axios.get(process.env.MIX_API_URL+'user/getAllAbout')
            .then(response => {
                this.about = response.data
            });

            axios.get(process.env.MIX_API_URL+'user/getAllVisimisi')
            .then(response => {
                this.visimisi = response.data
                // this.visimisi.forEach(el => {
                //     console.log(el.gambar.toString())
                // });
            });

            // axios.get(process.env.MIX_API_URL+'user/getAllVisimisi')
            // .then(response2 => {
            //     console.log(response2.data)
            //     response2.data.forEach(el => {
            //         this.visimisi2.push(el.gambar)
            //     });
            //     console.log(this.visimisi2)
            // });
        }
    }
</script>

<style>
    @media(min-width: 992px) {
        .caro-list{
            display: none;
        }
    }
    @media(max-width: 991px){
        .lokali-list{
            display: none;
        }
        .footer{
            text-align: center !important;
        }
    }

    .VueCarousel-dot{
        background-color: rgb(226, 177, 177) !important;
    }
    .VueCarousel-dot--active{
        background-color: rgb(0, 0, 0) !important;
    }
</style>
