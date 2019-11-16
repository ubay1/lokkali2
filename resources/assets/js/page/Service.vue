<template>
    <div>
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.3/dist/vue-multiselect.min.css">

        <div class="service-header-background">
            <Menu />
        </div>

        <div class="explore">
            <div class="row">
                <div class="col-lg-12">
                    <div class="teks-header-explore">
                        Exploring your Brand possibilities <br>
                        through these integrated services
                    </div>
                    <div class="teks-explore">
                        Select one or more service from all our integrated services
                    </div>
                </div>
            </div>
        </div>

        <!-- business management -->
        <div class="btn-bisnis ">
            <div class="teks-btn-bisnis">
                BUSINESS MANAGEMENT
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in BusinessManagement" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- digital strategic -->
        <div class="btn-digital-strategic">
            <div class="teks-btn-digital-strategic">
                DIGITAL STRATEGIC
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in digitalStrategic" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- digital activation -->
        <div class="btn-digital-activation">
            <div class="teks-btn-digital-activation">
                DIGITAL ACTIVATION
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in digitalActivation" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- web & mobile dev -->
        <div class="btn-development">
            <div class="teks-btn-development">
                WEB & MOBILE DEVELOPMENT
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in webmobileDev" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- cyber security -->
        <div class="btn-security">
            <div class="teks-btn-security">
                CYBER SECURITY
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in cyberSecurity" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- creativ -->
        <div class="btn-creative">
            <div class="teks-btn-creative">
                CREATIVES
            </div>
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4 lebarbtn col-sm-6 mb-4"
                        v-for="(item, index) in creativ" :key="index">
                        <button :title="item.name" class="list-group-item" :id="'item'+item.id" :value="item.name"  @click="filter(item.id, item.name)" >{{item.name}}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-service-email">
            <div class="teks-header-service-email">
                Your questions and special requests are always welcome
            </div>
            <!-- <FormMailService/> -->
            <div class="container">
                <div class="bg-form-service-email">
                    <form action="" method="post" v-on:submit.prevent="onSubmit">
                        <input type="text" name="nama" id="nama" class="form-control form-service" placeholder="Name*"
                            required v-model="info.name"> <br><br>
                        <input type="email" name="email" id="email" class="form-control form-service"
                            placeholder="Email*" required v-model="info.email"> <br><br>
                        <input type="text" name="industry" id="industry" class="form-control form-service"
                            placeholder="Sector Of Industry*" required v-model="info.industry"> <br><br>

                        Items You've Picked :
                        <multiselect required v-model="checkedButton" :multiple="true" selected
                            :options="checkedButton" disabled></multiselect>
                        <br><br>

                        <textarea required name="message" id="message" cols="30" rows="10"
                            class="form-control form-service2" placeholder="Message*" v-model="info.message"></textarea>
                        <br><br>

                        <button type="submit" class="btn form-service3"> <span :class="{text_send_service}">SEND</span>
                            <img v-show="showloader" src="assets/img/loader/loading_send.gif" class="img_loader" alt="">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>

<script>
    import axios from 'axios'
    import Menu from '../components/Menu'
    import Footer from '../components/Footer'
    import Multiselect from 'vue-multiselect'

    // register globally
    // Vue.component('multiselect', Multiselect)

    export default {
        data() {
            return {
                info: [],
                checkedButton: [],
                text_send_service: false,
                showloader: false,
                BusinessManagement: [
                    { id: 1, name: 'Business Management System' },
                    { id: 2, name: 'Business Growth and Company Development' },
                    { id: 3, name: 'Corporate Finance' },
                    { id: 4, name: 'Business Operations' },
                    { id: 5, name: 'Standard Operating Procedure' },
                    { id: 6, name: 'Business Invesment and Divesment' }
                ],
                digitalStrategic: [
                    { id: 7, name: 'Consulting' },
                    { id: 8, name: 'Research & Planning' },
                    { id: 9, name: 'Measurement and Analytics' },
                    { id: 10, name: 'Google & FB Ads' },
                    { id: 11, name: 'SEO' },
                    { id: 12, name: 'KOL' },
                    { id: 13, name: 'Mobile Ads' },
                    { id: 14, name: 'Email Marketing' }
                ],
                digitalActivation: [
                    { id: 15, name: 'Brand Activation' },
                    { id: 16, name: 'Social Media Campaign' },
                    { id: 17, name: 'Social Media Optimization' },
                    { id: 18, name: 'Digital Influencer' },
                    { id: 19, name: 'Activation Content & Engagement' }
                ],
                webmobileDev: [
                    { id: 20, name: 'UI & UX' },
                    { id: 21, name: 'Website Development' },
                    { id: 22, name: 'Content Management System' },
                    { id: 23, name: 'E-Commerce' },
                    { id: 24, name: 'Web Application' },
                    { id: 25, name: 'Mobile Application' },
                    { id: 26, name: 'Hosting & Email' },
                    { id: 27, name: 'Web Maintenance' }
                ],
                cyberSecurity: [
                    { id: 28, name: 'Manage Web Security' },
                    { id: 29, name: 'Network Access Control' },
                    { id: 30, name: 'Web Performance & Optimization' },
                    { id: 31, name: 'Managed SIEM & Log Management' },
                    { id: 32, name: 'Security Posture Assessment' },
                    { id: 33, name: 'Penetration Testing' },
                    { id: 34, name: 'IPv6 & Network Audit' },
                    { id: 35, name: 'Application Load & Stress Test' }
                ],
                creativ: [
                    { id: 36, name: 'Logo Design' },
                    { id: 37, name: 'Illustration' },
                    { id: 38, name: 'Company Profile' },
                    { id: 39, name: 'Financial Report' },
                    { id: 40, name: 'Prints' },
                    { id: 41, name: 'Company Identity' },
                    { id: 42, name: '2D Motion Graphic' }
                ],
            }
        },
        components: {
            Menu,
            Footer,
            Multiselect
        },
        methods: {
            onSubmit() {
                this.text_send_service = !this.text_send_service;
                this.showloader = !this.showloader;

                    axios.post(process.env.MIX_API_URL+'user/kirimform', {
                        name: this.info.name,
                        email: this.info.email,
                        industry: this.info.industry,
                        picked: this.checkedButton,
                        message: this.info.message,
                    })
                    .then(response => {
                        console.log(response);
                        this.text_send_service = !this.text_send_service;
                        this.showloader = !this.showloader;
                        this.success = response.data.success;
                        if (this.success) {
                            this.$swal("Terima Kasih Partisipasinya", 'pesan telah terkirim', "success");
                            this.info.name = '';
                            this.info.email = '';
                            this.info.industry = '';
                            this.checkedButton = [];
                            this.info.message = '';

                            let ell = document.querySelectorAll('.active');
                            console.log(ell.length);
                            for (let i = 0; i< ell.length; i++) {
                                ell[i].classList.remove('active');
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error)
                        this.success = false
                    });

            },
            filter(index,value) {
                let ell = document.querySelector('#item'+index);

                if (ell.classList.contains('active')) {
                    ell.classList.remove('active');
                    var index = this.checkedButton.indexOf(value);
                    if (index > -1) {
                        this.checkedButton.splice(index, 1);
                    }
                    console.log(this.checkedButton);
                }else{
                    ell.classList.add('active');
                    this.checkedButton.push(value);
                }
            },
        }
    }
</script>

<style>

    .multiselect__tag {
        padding: 4px 10px 4px 10px !important;
    }
    .multiselect__tag-icon{
        display: none;
    }

    .text_send_service {
        opacity: .5;
    }

    .img_loader {
        width: 20px;
    }

    .hidden {
        display: none !important;
        visibility: hidden !important;
    }

    .list-group-item:first-child{
        border-radius: 10px;
    }

    .list-group-item{
        margin-bottom: 0;
        border-bottom: 0;
        text-align: center;
        background: #e4e2e2;
        box-shadow: 0px 2px 6px #9e9e9e;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100px;
        width: 100%;
        font-size: 12pt;
        font-weight: bold;
        transform: skewX(-10deg); /* Standard syntax */

    }

    .judul_btn {
        font-size: 17pt;
        font-weight: bold;
    }


    .list-group-item.active {
        background-color: #ff4646 !important
    }

    .col-lg-4 {
        cursor: pointer;
    }

    /* tooltip */
    .tooltip {
        display: inline;
        position: relative;
    }
    .tooltip:hover:after{
        display: -webkit-flex;
        display: flex;
        -webkit-justify-content: center;
        justify-content: center;
        background: #444;
        border-radius: 8px;
        color: #fff;
        content: attr(title);
        margin: -82px auto 0;
        font-size: 16px;
        padding: 13px;
        width: 220px;
    }
    .tooltip:hover:before{
        border: solid;
        border-color: #444 transparent;
        border-width: 12px 6px 0 6px;
        content: "";
        left: 45%;
        bottom: 30px;
        position: absolute;
    }

    @media (min-width: 992px){
        .bg-form-service-email {
            margin-right: 100px !important;
            margin-left: 100px !important;
        }
        .teks-header-explore {
            font-size: 25px !important;
        }
        .teks-btn-bisnis, .teks-btn-digital-strategic, .teks-btn-digital-activation, .teks-btn-development, .teks-btn-security, .teks-btn-creative{
            font-size: 25px !important;
            height: 3em !important;
        }
        .teks-header-service-email{
            font-size: 25px !important;
        }
        .teks-explore{
            font-size: 25px !important;
        }
        .form-service, .form-service2, .form-service3{
            font-size: 17px !important;
        }
    }

    @media (min-width: 320px) and (max-width: 991px){
        .bg-form-service-email {
            /* margin-right: 100px !important;
            margin-left: 100px !important; */
        }
        .teks-header-explore {
            font-size: 25px !important;
        }
        .teks-btn-bisnis, .teks-btn-digital-strategic, .teks-btn-digital-activation, .teks-btn-development, .teks-btn-security, .teks-btn-creative{
            font-size: 25px !important;
            height: 3em !important;
        }
        .teks-header-service-email{
            font-size: 17px !important;
        }
        .teks-explore{
            font-size: 17px !important;
        }
        .form-service, .form-service2, .form-service3{
            font-size: 17px !important;
        }
    }

    @media (min-width:320px) and (max-width: 575px) {
        .lebarbtn{
                width: 50%;
        }
        .list-group-item{
            margin-bottom: 0;
            border-bottom: 0;
            text-align: center;
            background: #e4e2e2;
            box-shadow: 0px 2px 6px #9e9e9e;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 120px;
            width: 100%;
            font-size: 12pt;
            font-weight: bold;
        }
    }
</style>
