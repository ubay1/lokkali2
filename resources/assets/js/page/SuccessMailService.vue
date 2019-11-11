<template>
<div>
    <div class="service-header-background">
        <Menu/>
    </div>
    <div class="container" v-if="success">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h2>{{ title }}</h2>
        </div>
    </div>
</div>
</template>
<script>
    import Menu from '../components/Menu'

    export default {
        data(){
            return{
                success:this.$route.params.success,
                title:'Trima kasih partisipasinya',
                email:this.$route.params.email
            }
        },
        components:{
            Menu
        },
    }

</script>
