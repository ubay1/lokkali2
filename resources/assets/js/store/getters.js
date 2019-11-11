// getters sebagai tempat pengolahan data-data yang didapat dari state, jika tidak ingin ada modifikasi bisa langsung direturn, lihat contoh dibawah.

export default {
    members : state => {
        return state.members
    },
    datacase : state => {
        return state.datacase
    }
}
