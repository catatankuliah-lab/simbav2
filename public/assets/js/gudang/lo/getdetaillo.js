var url_string = window.location.href;
var url = new URL(url_string);
var pathname = url.pathname;
var segments = pathname.split('/');
var nomor_Lo = segments[4];
var arraylo = nomor_Lo.split('');
var alokasi = arraylo[15];
var kode_wo = "";
var kode_do = "";
var kode_so = "";
var nomor_wo = "";
var nomor_do = "";
var nomor_so = "";

// get data lo by nomor lo
$.ajax({
  url: "http://localhost:8080/api/lo/detail/" + alokasi + "/" + nomor_Lo,
  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log("DATA LO : ", data);
    $('#tanggal_pembuatan').val(data.data.tanggal_muat);
    $('#alokasi').val(alokasi);
    $('#idlo').val(data.data.id_lo);
    $('#nomor_lo').val(data.data.nomor_lo);
    $('#nomor_so').val(data.data.nomor_so);
    $('#nomor_wo').val(data.data.nomor_wo);
    $('#nomor_do').val(data.data.nomor_do);
    $('#totalpengiriman').val(data.data.total + " Kg");
    getallsj(data.data.nomor_lo);
  },
  error: function (error) {
    console.log("ERROR DATA LO : ", error);
  },
});

var kode_wo = "";
var kode_do = "";
var kode_so = "";

// AMBIL DATA SJ DARI NOMOR LO
function getallsj(nomorlo) {
  $.ajax({
    url: "http://localhost:8080/api/suratjalan/" + $('#alokasi').val() + "/datasj/" + $('#nomor_lo').val(),
    type: "GET",
    dataType: "json",
    success: function (data) {
      const datasj = $('#datasj');
      console.log(data);
      if (data.status == "200") {
        var total = 0;
        var listdo = "";
        $.each(data.data, function (index, sj) {
          listdo =
            "<tr>" +
            "<td>" + sj.nama_kabupaten_kota + "</td>" +
            "<td>" + sj.nama_kecamatan + "</td>" +
            "<td>" + sj.nama_desa_kelurahan + "</td>" +
            "<td>" +
            "<input readonly value='" + sj.jumlah_penyaluran_januari + " Kg'type='text' style='border:none; background-color:transparent !important; width:75px'>" +
            "</td>" +
            "<td class='text-center'>" +
            "<a type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datasj.append(listdo);
        });
      }
    },
    error: function (error) {
    },
  });
}

$('#filewo').change(function (e) {
  ceknomor();
  var output = document.getElementById('outwo');
  output.src = URL.createObjectURL(event.target.files[0]);
});
$('#filelo').change(function (e) {
  ceknomor();
  var output = document.getElementById('outlo');
  output.src = URL.createObjectURL(event.target.files[0]);
});
$('#filepenyerahan').change(function (e) {
  ceknomor();
  var output = document.getElementById('outpenyerahan');
  output.src = URL.createObjectURL(event.target.files[0]);
});
$('#filedo').change(function (e) {
  ceknomor();
  var output = document.getElementById('outdo');
  output.src = URL.createObjectURL(event.target.files[0]);
});
$('#filesjbulog').change(function (e) {
  ceknomor();
  var output = document.getElementById('outsjbulog');
  output.src = URL.createObjectURL(event.target.files[0]);
});
$('#filebast').change(function (e) {
  ceknomor();
  var output = document.getElementById('outbast');
  output.src = URL.createObjectURL(event.target.files[0]);
});

// PERSIAPAN UPLOAD DAN UPDATE
function ceknomor() {
  var nomor_wo = $("#nomor_wo").val();
  var nomor_do = $("#nomor_do").val();
  var nomor_so = $("#nomor_so").val();
  kode_wo = nomor_wo.replace(/[\/.]/g, '');
  kode_do = nomor_do.replace(/[\/.]/g, '');
  kode_so = nomor_so.replace(/[\/.]/g, '');
  if (nomor_wo == "" || nomor_do == "" || nomor_so == "") {
    Swal.fire({
      icon: "error",
      title: "Loading Order (LO)",
      text: "Mohon Lengkapi Data Loading Order (LO) Terlebih Dahulu.",
      timer: 3000,
      showConfirmButton: false,
    });
  }
}

// PROSES UPLOAD DAN UPDATE
$('#prosesupdate').click(function (e) {
  console.log("CLIK");
  ceknomor();
  var formData = new FormData($('#uploadForm')[0]);
  var additionalData = {
    'kode_wo': kode_wo,
    'kode_do': kode_do,
    'kode_so': kode_so,
    'nomor_wo': nomor_wo,
    'nomor_do': nomor_do,
    'nomor_so': nomor_so,
    'idlo': $('#idlo').val()
  };
  formData.append('additionalData', JSON.stringify(additionalData));
  $.ajax({
    url: "http://localhost:8080/api/lo/" + $('#alokasi').val() + "/uploadfile/" + $('#idlo').val(),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
    },
    error: function (error) {
      console.log(error);
    }
  });
});
