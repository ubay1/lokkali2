<template>
    <div>
        <div class="case-header-background">
            <Menu/>
        </div>
    <div class="bg-luar">
        <div class="container">
            <router-link to="/case" class="btn btn-lg btn-primary mb-4">
                <span class="fa fa-arrow-left"></span> kembali
            </router-link>

            <div class="shadow">
                <div>
                    <img :src="article.gambar" alt="Card image cap" class="img-fluid img-header">
                </div>
                <h5 class="title">{{ article.judul }}</h5>
                <p class="isi">{{ article.isi }}</p>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import Menu from '../components/Menu'

export default {
    components:{
        Menu
    },
  computed: {
    article () { return this.$store.state.article }
  }
}
</script>

<style>
    .bg-luar{
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .shadow{
        box-shadow: 0px 2px 6px darkgrey;
    }
    .img-header{
        height: 300px;
        object-fit: cover;
        width: 100%;
        object-position: center;
    }
    .title{
        margin-bottom: 0px;
        font-family: inherit;
        font-size: 30pt;
        text-align: center;
        background: #14a6cb;
        color: white;
        padding: 10px;
        text-shadow: 0px 2px 4px #0d2228;
    }
    .isi{
        font-family: inherit;
        font-size: medium;
        line-height: 30px;
        text-indent: 20px;
        text-align: justify;
        padding: 20px;
        height: auto;
        background: white;
    }
</style>
