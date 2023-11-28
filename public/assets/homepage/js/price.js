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

    var tgl_pemakaian,
        element = document.getElementById('tgl_pemakaian');
    if (element != null) {
        tgl_pemakaian = element.value;
    } else {
        tgl_pemakaian = null;
    }

    var jam,
        element = document.getElementById('jam');
    if (element != null) {
        jam = element.value;
    } else {
        jam = null;
    }

    var total = harga * durasi_kontrak;

    var bilangan = total;

    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');


    document.getElementById("total").innerHTML = ribuan;

    if (durasi_kontrak != null) {
        var Hjam = durasi_kontrak % 24;
        var hour = new Date($('input[name="tgl_pemakaian"]').val()).getHours();
        var menit = new Date($('input[name="tgl_pemakaian"]').val()).getMinutes();
        var tambah = Hjam + hour;
        var waktu = tambah + ":" + menit;
        $('input[name="textdurasi"]').val(waktu);


    }
    document.getElementById("totaldurasi").innerHTML = waktu;

}
