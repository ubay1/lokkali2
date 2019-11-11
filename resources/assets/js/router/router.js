import Home from '../page/Home'
import Service from '../page/Service'
import CaseStudy from '../page/CaseStudy'
import Blog from '../page/Blog'
import Contact from '../page/Contact'
import SuccessMailService from '../page/SuccessMailService'
import SuccessMailContact from '../page/SuccessMailContact'
import DetailCase from '../page/DetailCase'
import DetailBlog from '../page/DetailBlog'

// const = 'test_laravel/public/';

   const routes = [
        {
            path : "/",
            name : 'home',
            component : Home
        },
        {
            path : "/service",
            name : 'service',
            component : Service,
        },
        {
            path : "/successmail",
            name : 'successmail',
            component : SuccessMailService,
        },
        {
            path : "/successmailcontact",
            name : 'successmailcontact',
            component : SuccessMailContact,
        },
        {
            path : "/case",
            name : 'case',
            component : CaseStudy,
        },
        ,
        {
            path : "/blog",
            name : 'blog',
            component : Blog,
        },
        ,
        {
            path : "/contact",
            name : 'contact',
            component : Contact,
        },
        {
            path : "/detailcase",
            name : 'detailcase',
            component : DetailCase,
        },
        {
            path : "/detailblog",
            name : 'detailblog',
            component : DetailBlog,
        }

    ]

export default routes;
