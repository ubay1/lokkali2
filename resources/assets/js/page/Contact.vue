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
                            For YOu Today ?
                        </div>
                </div>
            </div>
        </div>

        <div class="bg-service-email-contact">
            <div class="teks-header-service-email">
                Your questions and special requests are always welcome
            </div>
            <div class="container">
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
        </div>

        <div class="container">
            <div class="simply">
                <div class="row">
                    <div class="col-lg-6 teks-simply">
                        <div class="teks-header-simply">
                            Our Just Simply  <br>
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
                            Jl. Sukasenang V No. 5A <br>
                            Bandung 40214
                        </div>
                    </div>
                    <div class="col-lg-6 map-simply">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Jl.%20Sukasenang%20V%20No.%205A&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
</style>
