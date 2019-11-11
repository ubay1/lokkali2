<template>
   <div class="search-portfolio">
            <div class="container">
                <form action="" method="post" v-on:submit.prevent="onSubmit">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-search-portfolio"  placeholder="Search Portfolio" name="judul" v-model="info.search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <span class="fa fa-search" style="padding-left:20px; padding-right:20px;"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
    import axios from 'axios'
    import ArticlesSearch from "../components/PaginateBlog/ArticlesSearch";

    export default {
        data() {
            return {
                info:[],
                search: '',
            }
        },
        methods: {
            onSubmit() {
                axios.get(process.env.MIX_API_URL+'user/page', {
                        search: this.info.search,
                    })
                    .then(response => {
                        console.log(response);
                        let ell = document.querySelector('#bloglist');

                        if (ell.classList.contains('hiden')) {
                            ell.classList.remove('hiden');
                        }else{
                            ell.classList.add('hiden');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                        this.success = false
                    });

            },
        },
    }

</script>
