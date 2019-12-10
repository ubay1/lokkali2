<template>
    <div>
        <div class="blog-header-background">
            <Menu />
        </div>

        <div class="myblog">
            <div class="row">
                <div class="col-lg-12">
                        <div class="teks-header-myblog">
                            Blog
                        </div>
                </div>
            </div>
        </div>

        <!-- modal -->
        <div v-if="showModal">
        <transition name="modal">
        <div class="modal">
            <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <img class="modal-title img-fluid img-header" id="exampleModalLabel" :src="statearticle.gambar" alt="Card image cap">
                    <button type="button" @click="hideModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="title">{{ statearticle.judul }}</h5>
                    <p class="isi">{{ statearticle.isi }}</p>
                </div>
                <div class="modal-footer">
                     <button type="button" @click="hideModal" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">CLose </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </transition>
        </div>

        <div class="blog-panel-popular">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bg-img-blog-popular">
                            <img class="img-blog-popular col-md-8" v-lazy="this.allblogpopuler.gambar" :key="this.allblogpopuler.gambar" alt="">
                            <div class="text-head-blog col-md-4">
                                {{ this.allblogpopuler.judul }}
                                <div class="text-isi-blog-popular">
                                   {{ this.allblogpopuler.isi }}
                                </div>
                                <!-- <button @click="openDetail2()" class="btn btn-primary">Selengkapnya</button> -->
                                <button @click="openDetail2a()" data-backdrop="static" class="btn btn-primary">Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-portfolio">
            <div class="container">
                <input type="text" class="form-control form-search-portfolio"  placeholder="Search Portfolio" name="judul" v-model="searchItem" v-on:keyup="searchInTheList(searchItem)">
                <span class="d-flex justify-content-center"><strong>{{filteredItems.length | numeral}}</strong>  of {{items.length | numeral}} portfolio found</span>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 mb-2 mt-4" v-for="(item,index) in paginatedItems" :key="index">
                    <div class="card">
                        <img class="card-img-top" v-lazy="item.gambar" :key="item.gambar" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{item.header}}</h4>
                            <p class="card-text">{{item.isi}}</p>
                            <!-- <button @click="openDetail(item)" class="btn btn-primary">selengkapnya</button> -->
                            <button @click="openDetail2b(item)" class="btn btn-primary">selengkapnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center pagination">
            <nav class="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" v-on:click="selectPage(paginationItems[0])"
                            v-bind:class="{'disabledbutton-pagination': this.pagination.currentPage==this.paginationItems[0] || this.paginationItems.length==0}">
                            First
                        </a>
                    </li>
                    <li class="is-space"></li>

                    <li class="page-item" v-for="(item,index) in paginationItems" :key="index">
                        <a class="page-link" v-on:click="selectPage(item)"
                            v-bind:class="{'activebutton-pagination': item == pagination.currentPage}">{{item | numeral}}</a>
                    </li>

                    <li class="is-space"></li>
                    <li class="page-item">
                        <a class="page-link" v-on:click="selectPage(paginationItems[paginationItems.length-1])"
                            v-bind:class="{'disabledbutton-pagination': this.pagination.currentPage==this.paginationItems[this.paginationItems.length-1] || this.paginationItems.length==0}">
                            Last
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <Footer />
    </div>
</template>

<script>
    import axios from 'axios'
    import _ from 'lodash'
    var Chance = require('chance')
    var chance = new Chance()
    var numeral = require("numeral");
    import Menu from '../components/Menu'
    import Footer from '../components/Footer'
    import { mapActions } from 'vuex'

//   for(var i=0; i<100; i++){
//     items.push({
//         key: i+1,
//         ssn: chance.ssn(),  // SSN as person ID
//         name: chance.name(),
//         email: chance.email(),
//         address: chance.address(),
//         phone: chance.phone(),
//         selected: false
//     })
//     }

    // console.log(paginatedItems);

    export default {
        components: {
            Menu,
            Footer
        },
        data() {
            return {
                showModal: false,
                allblogpopuler: [],
                searchItem: '',
                items: [],
                filteredItems: [],

                selectedItems: [],
                pagination: {
                    range: 5,
                    currentPage: 1,
                    itemPerPage: 6,
                    // filteredItems: [],
                }
            }
        },
        computed: {
            statearticle () { return this.$store.state.article },
            paginatedItems() {
                return this.filteredItems.filter((v, k) => {
                    return Math.ceil((k + 1) / this.pagination.itemPerPage) == this.pagination.currentPage
                })
            },
            paginationItems(){
                let numberOfPage = Math.ceil(this.filteredItems.length / this.pagination.itemPerPage)
                let paginationItems = []
                for (var i = 0; i < numberOfPage; i++) {
                    paginationItems.push(i + 1)
                }

                return paginationItems
            }
        },
        mounted() {
            // let itemss = [];
            axios.get(process.env.MIX_API_URL+'user/getAllBlog')
            .then(data=>{
                let datas = data.data.articles;

                this.items = datas.map((el)=>{
                    return {
                        id: el.id,
                        gambar: el.gambar,
                        isi: el.isi,
                        judul: el.judul
                    }
                })

                this.filteredItems = datas.map((el)=>{
                    return {
                        id: el.id,
                        gambar: el.gambar,
                        isi: el.isi,
                        judul: el.judul
                    }
                })


            });

            this.selectPage(1)

            axios.get(process.env.MIX_API_URL+'user/getAllBlogPopuler')
            .then(({ data }) => {
                this.allblogpopuler = data.articles;
            });

        },
        updated(){

        },
        methods: {
            // openDetail(item) {
            //     this.$store.commit('setArticle', item)
            //     this.$router.replace({
            //         'path': '/detailblog'
            //     })
            // },
            // openDetail2 () {
            //     this.$store.commit('setArticle', this.allblogpopuler)
            //     this.$router.replace({ 'path': '/detailblog' })
            // },
            openDetail2a () {
                this.$store.commit('setArticle', this.allblogpopuler)
                this.showModal = true;
            },
            openDetail2b (item) {
                this.$store.commit('setArticle', item)
                this.showModal = true;
            },
            hideModal(){
                this.showModal = false;
            },
            clearSearchItem() {
                this.searchItem = undefined
                this.searchInTheList('')
            },
            searchInTheList(searchText, currentPage) {
                if (_.isUndefined(searchText)) {
                    this.filteredItems = _.filter(this.items, function (v, k) {
                        return !v.selected
                    })
                } else {
                    this.filteredItems = _.filter(this.items, function (v, k) {
                        return !v.selected && v.judul.toLowerblog().indexOf(searchText.toLowerblog()) > -1
                    })
                }
                this.filteredItems.forEach(function (v, k) {
                    v.key = k + 1
                })
                // this.buildPagination()

                if (_.isUndefined(currentPage)) {
                    this.selectPage(1)
                } else {
                    this.selectPage(currentPage)
                }
            },
            selectPage(item) {
                this.pagination.currentPage = item

                let start = 0
                let end = 0
                if (this.pagination.currentPage < this.pagination.range - 2) {
                    start = 1
                    end = start + this.pagination.range - 1
                } else if (this.pagination.currentPage <= this.paginationItems.length && this.pagination.currentPage >
                    this.paginationItems.length - this.pagination.range + 2) {
                    start = this.paginationItems.length - this.pagination.range + 1
                    end = this.paginationItems.length
                } else {
                    start = this.pagination.currentPage - 2
                    end = this.pagination.currentPage + 2
                }
                if (start < 1) {
                    start = 1
                }
                if (end > this.paginationItems.length) {
                    end = this.paginationItems.length
                }

                this.pagination.filteredItems = []
                for (var i = start; i <= end; i++) {
                    this.pagination.filteredItems.push(i);
                }
            },
            selectItem(item) {
                item.selected = true
                this.selectedItems.push(item)
                this.searchInTheList(this.searchItem, this.pagination.currentPage)
            },
            removeSelectedItem(item) {
                item.selected = false
                this.selectedItems.$remove(item)
                this.searchInTheList(this.searchItem, this.pagination.currentPage)
            }
        },
        filters:{
            numeral(value) {
                return numeral(value).format('0,0');
            }
        }

    }

</script>


<style>
    @media (min-width: 992px){
        .teks-header-myblog{
            font-size: 25px !important;
        }
        .text-isi-blog-popular{
            font-size: 17px !important;
            font-weight: normal !important;
        }
        .form-search-portfolio{
            font-size: 17px !important;
        }
    }
    @media (max-width: 991px){
        .teks-header-myblog{
            font-size: 25px !important;
        }
        .text-isi-blog-popular{
            font-size: 17px !important;
            font-weight: normal !important;
        }
        .form-search-portfolio{
            font-size: 17px !important;
        }
    }

    .m-pagination{
        margin-bottom:40px;
    }

    .is-space{
        width: 20px;
    }

    .card .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-text {
        height: 100px !important;
        overflow: hidden;
    }

    /* form search */
    .search-portfolio .form-search-portfolio {
        height: 70px;
        font-size: 30px;
        border-radius: 50px;
        text-align: center;
        border: unset;
        color: #646464;
        box-shadow: 0px 2px 6px lightslategrey;
    }

    .modal {
        display: block;
        padding-right: 15px;
        overflow-x: hidden;
        overflow-y: auto;
        background: rgb(0, 0, 0, .5);
    }

    .modal-dialog{
        max-width: 700px !important;
    }
    .modal-wrapper {
        /* display: table-cell; */
        vertical-align: middle;
    }

    .disabledbutton-pagination{
        background: #cacaca;
        color: #8a8a8a !important;
        opacity: .5;
    }
    .activebutton-pagination{
        background: #3490dc;
        color: #fff !important;
    }
    .page-link:hover {
        z-index: 2;
        color: #1d68a7;
        text-decoration: none;
        background-color: unset;
        border-color: #dee2e6;
    }

</style>
