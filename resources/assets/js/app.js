import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/router'
import App from './components/App'
import VueLazyload from 'vue-lazyload'
import store from './store/index.js'
import VueSwal from 'vue-swal'
import lodash from 'lodash'
import VModal from 'vue-js-modal'


Vue.use(VModal,{ dialog: true })

Vue.prototype._ = lodash
Vue.use(VueSwal)

Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: './assets/img/loader/404.png',
    loading: './assets/img/loader/loading.gif',
    attempt: 5,
    observer: true
})

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
});
