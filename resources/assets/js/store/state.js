// state bisa dikatakan sebagai sumber data kita. bisa saja kita ambilnya dari API, dari localstorage, atau kita buat langsung disini. state.js mengandung data murni, tidak boleh edit" atau modifikasi di area ini, jika ingin mengolah data-datanya seperti pengurutan nilai tertinggi atau lainnya kita bisa buat di getters.js

export default {
    article:{},
    datacase:[],
    blog:{},
    members: [
        {
            id:1,
            name:'man',
            point: 10,
            img: 'why1.png'
        },
        {
            id:2,
            name:'woman',
            point: 20,
            img: 'why2.png'
        },
        {
            id:3,
            name:'marvel',
            point: 30,
            img: 'why3.png'
        }
    ]
}
