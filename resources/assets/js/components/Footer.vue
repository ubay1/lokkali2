<template>
    <div>
        <div class="footer">
            <div class="container">
                <div class="teks-judul-footer">
                    <div class="footer-brand">
                        <span class="copyright">
                            copyright@Lokkali 2019
                        </span>
                        <span class="logo">
                            <img class="img-fluid icon-sosmed2"  src="../../img/logo.png" alt="">
                        </span>
                        <span class="alamat">
                            PT Lokkali Cipta Indonesia <br><br>
                            t: +62 857 7269 5962 <br>
                            e: info@lokkali.com <br><br>
                            Gedung Menara 165 Suite Office,  <br>
                            Lantai 2 & 4, Jl. TB Simatupang Kav. 1
                        </span>
                    </div> <br><br>
                    <div class="text-center">
                        <span class="followus">
                            Follow Us
                        </span>
                        <div class="container d-flex justify-content-center p-2">
                            <img class="img-fluid icon-sosmed"  src="../../img/fb.png" alt="">
                            <img class="img-fluid icon-sosmed"  src="../../img/linkin.png" alt="">
                            <img class="img-fluid icon-sosmed"  src="../../img/ig.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

        .followus{
            font-size: 17px !important;
        }
        .copyright{
            font-size: 17px !important;
        }
        .alamat{
            text-align: right !important;
            font-size: 17px !important;
        }
        .icon-sosmed{
            width: 50px;
            margin: 20px;
        }
        .icon-sosmed2{
            width: 150px;
            margin: 10px;
        }
        .teks-judul-footer{
            font-weight: normal !important;
        }
    @media (min-width:992px){
        .footer-brand{
            margin-top: 40px;
            display: flex;
            justify-content: space-around;
            flex-direction: row;
        }
    }

    @media (max-width:991px){
        .footer-brand{
            margin-top: 40px;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
        }

        .logo{
            margin-bottom: 30px;
        }

        .alamat{
            text-align: center !important;
            font-size: 17px !important;
        }
    }
</style>
