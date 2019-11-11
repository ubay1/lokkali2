<template>
    <div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <img :src="article.gambar" alt="Card image cap" class="img-fluid img-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="title">{{ article.judul }}</h5>
                <p class="isi">{{ article.isi }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>

export default {
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
