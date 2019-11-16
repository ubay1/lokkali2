<template>
    <div>
        <div class="contact-header-background">
            <Menu/>
        </div>

        <div class="explore-contact">
            <div class="row">
                <div class="col-lg-12">
                        <div class="teks-header-explore">
                            What Can We Do <br>
                            For You Today ?
                        </div>
                </div>
            </div>
        </div>

        <div class="bg-service-email-contact">
            <div class="teks-header-service-email">
                Your questions and special requests are always welcome
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="bg-form-service-email-contact">
                            <form action="" method="post" enctype="multipart/form-data" v-on:submit.prevent="onSubmit">
                                <input type="text" name="name" id="" class="form-control form-service" placeholder="Name*" v-model="name"> <br><br>
                                <input type="email" name="email" id="" class="form-control form-service" placeholder="Email*" v-model="email"> <br><br>
                                <input type="text" name="subject" id="" class="form-control form-service" placeholder="Subject*" v-model="subject"> <br><br>

                                <textarea name="message" id="" cols="30" rows="10" class="form-control form-service2" placeholder="Message*" v-model="message"></textarea> <br><br>

                                <input type="file" ref="fileupload" v-on:change="onImageChange" name="file" id="" class="form-control form-service" placeholder="Subject*"> <br><br>

                                <button type="submit" class="btn form-service3">SEND<img v-show="showloader" src="assets/img/loader/loading_send.gif" class="img_loader" alt=""></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="simply">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 teks-simply">
                                    <div class="teks-header-simply">
                                        Our Just Simply
                                        Meet Us.
                                    </div>
                                    <div class="teks-judul-footer">
                                        PT Lokkali Cipta Indonesia
                                    </div>
                                    <div class="teks-info-footer">
                                        t: +62 857 7269 5962 <br>
                                        e: info@lokkali.com
                                    </div>
                                    <div class="teks-year-footer">
                                        Gedung Menara 165 Suite Office,  <br>
                                        Lantai 2 & 4, Jl. TB Simatupang Kav. 1 <br><br>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 map-simply">
                                    <div class="mapouter">
                                        <div class="gmap_canvas">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7946746399944!2d106.80739641412156!3d-6.290695795447035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1fa599ef523%3A0xf8e80c6a42c4bb88!2s1%2C%20Menara%20165%2C%20Jl.%20Tahi%20Bonar%20Simatupang%2C%20RT.3%2FRW.3%2C%20Cilandak%20Tim.%2C%20Kec.%20Ps.%20Minggu%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012560!5e0!3m2!1sen!2sid!4v1573882333594!5m2!1sen!2sid" width="500" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <Footer /> -->
    </div>
</template>

<script>
import axios from 'axios'
import Menu from '../components/Menu'
import Footer from '../components/Footer'

    export default {
        data() {
            return {
                name: '',
                email: '',
                subject: '',
                message: '',
                file : '',
                success: false,
                text_send_service: false,
                showloader: false,
            }
        },
        components:{
            Menu, Footer
        },
        methods: {
            onImageChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            onSubmit() {
                this.text_send_service = !this.text_send_service;
                this.showloader = !this.showloader;

                let currentObj = this;

                const config = {
                    headers: { 'content-type' : 'multipart/form-data'}
                }

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('subject', this.subject);
                formData.append('message', this.message);
                formData.append('file', this.file);

                axios.post(process.env.MIX_API_URL+'user/kirimformcontact', formData, config)
                .then(response => {
                    // currentObj.success = response.data.success;
                    this.text_send_service = !this.text_send_service;
                    this.showloader = !this.showloader;
                    this.success = response.data.success;
                    console.log(response.data.success);
                    if (this.success) {
                        this.$swal("Terima Kasih Partisipasinya", 'pesan telah terkirim', "success");
                        this.name = '';
                        this.email = '';
                        this.subject = '';
                        this.message = '';
                        this.file = this.$refs.fileupload;
                        this.file.type = 'text';
                        this.file.type = 'file';
                    }
                })
                .catch(function (error){
                    currentObj.output = error;
                });
            }
        },
    }
</script>

<style>
    .text_send_service {
        opacity: .5;
    }

    .img_loader {
        width: 20px;
    }

    @media (min-width:992px){
        /* .bg-form-service-email-contact{ */

        /* } */
        .teks-header-simply{
            font-size: 25px !important;
        }
        .teks-judul-footer, .teks-info-footer, .teks-year-footer{
            font-size: 17px !important;
            font-weight: normal !important;
        }
    }

    @media (max-width: 991px) and (min-width: 768px){
        .gmap_canvas {
            height: 260px !important;
        }
    }

    @media (max-width:991px){
        .bg-form-service-email-contact{
            /* margin-right: 100px !important;
            margin-left: 100px !important; */
            margin-bottom: 40px;
        }
        .teks-header-simply{
            font-size: 25px !important;
        }
        .teks-judul-footer, .teks-info-footer, .teks-year-footer{
            font-size: 17px !important;
            font-weight: normal !important;
        }
        .gmap_canvas{
            width: 270px !important;
        }

        .teks-simply{
            margin-bottom: 0px !important;
        }
    }

</style>
