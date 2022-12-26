function sum() {
    var harga,
        element = document.getElementById('harga');
    if (element != null) {
        harga = element.value;
    } else {
        harga = null;
    }

    var durasi_kontrak,
        element = document.getElementById('durasi_kontrak');
    if (element != null) {
        durasi_kontrak = element.value;
    } else {
        durasi_kontrak = null;
    }

    var total = harga * durasi_kontrak;

    var bilangan = total;

    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');


    document.getElementById("total").innerHTML = ribuan;
}