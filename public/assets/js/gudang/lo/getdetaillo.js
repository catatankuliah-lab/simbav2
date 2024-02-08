var url_string = window.location.href;
var url = new URL(url_string);
var pathname = url.pathname;
var segments = pathname.split('/');
var nomor_Lo = segments[4];
var arraylo = nomor_Lo.split('');
var alokasi = arraylo[15];

// get data lo by nomor lo
$.ajax({
  url: "http://localhost:8080/api/lo/detail/" + alokasi + "/" + nomor_Lo,
  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log("DATA LO : ", data);
    $('#tanggal_pembuatan').val(data.data.tanggal_muat);
    $('#alokasi').val(alokasi);
    $('#nomor_lo').val(data.data.nomor_lo);
    $('#nomor_so').val(data.data.nomor_so);
    $('#nomor_wo').val(data.data.nomor_wo);
    $('#nomor_do').val(data.data.nomor_do);
    $('#totalpengiriman').val(data.data.total + " Kg");
  },
  error: function (error) {
    console.log("ERROR DATA LO : ", error);
  },
});
