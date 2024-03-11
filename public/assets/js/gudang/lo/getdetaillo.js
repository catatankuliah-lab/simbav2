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

function loadingswal() {
  Swal.fire({
    text: 'Uploading data...',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}

// get data lo by nomor lo
$.ajax({
  url: "http://localhost:8080/api/lo/detail/" + alokasi + "/" + nomor_Lo,
  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log(data);
    var output1 = $("#out1");
    var output2 = $("#out2");
    var output3 = $("#out3");
    output1.attr("src", "http://localhost:8080/" + data.data.path_upload_wo + data.data.file_upload_wo);
    output2.attr("src", "http://localhost:8080/" + data.data.path_lo + data.data.file_uplaod_lo);
    output3.attr("src", "http://localhost:8080/" + data.data.path_uplaod_do + data.data.file_upload_do);
    $('#tanggal_pembuatan').val(data.data.tanggal_muat);
    $('#alokasi').val(alokasi);
    $('#idlo').val(data.data.id_lo);
    $('#nomor_lo').val(data.data.nomor_lo);
    $('#nomor_so').val(data.data.nomor_so);
    $('#nomor_wo').val(data.data.nomor_wo);
    $('#nomor_do').val(data.data.nomor_do);
    $('#totalpengiriman').val(data.data.total + " Kg");
    $('#nopolmobil').val(data.data.nomor_mobil);
    $('#namadriver').val(data.data.nama_driver);
    $('#nomordriver').val(data.data.nomor_driver);
    $('#jampengiriman').val(data.data.jam_pemberangkatan);
    getallsj(data.data.nomor_lo);
  },
  error: function (error) {
    console.log("ERROR DATA LO : ", error);
  },
});

// AMBIL DATA SJ DARI NOMOR LO
function getallsj(nomorlo) {
  $.ajax({
    url: "http://localhost:8080/api/suratjalan/" + $('#alokasi').val() + "/datasj/" + $('#nomor_lo').val(),
    type: "GET",
    dataType: "json",
    success: function (data) {
      const datasj = $('#datasj');
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
            "<input  id='penerimaan" + index + "' value='" + sj.jam_penerimaan + "' onchange='editpenerimaan(" + sj.id_sj + "," + index + ")' class='border-0' style='background-color: transparent !important;' type='time' placeholder='00:00' id='jamditerima' name='jamditerima'>" +
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

function editpenerimaan(idsj, index) {
  var additionalData = {
    'jam_penerimaan': $("#penerimaan" + index).val(),
  };
  $.ajax({
    url: "http://localhost:8080/api/sj/" + $('#alokasi').val() + "/jampenerimaan/editdatajs/" + idsj,
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(additionalData),
    success: function (data) {
      console.log("BERHASIL GANTI JAM PENERIMAAN : ", data);
    },
    error: function (error) {
      console.log("GAGAL GANTI JAM PENERIMAAN : ", error);
    },
  });
}

$('#file1').change(function (e) {
  // UPLOAD
  nomor_wo = $("#nomor_wo").val();
  kode_wo = nomor_wo.replace(/[\/.]/g, '');
  var formData = new FormData($('#uploadForm')[0]);
  var additionalData = {
    'kode_wo': kode_wo,
    'idlo': $('#idlo').val()
  };
  console.log(additionalData);
  formData.append('additionalData', JSON.stringify(additionalData));
  loadingswal();
  $.ajax({
    url: "http://localhost:8080/api/lo/" + $('#alokasi').val() + "/uploadfile/1/" + $('#idlo').val(),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      Swal.close();
      Swal.fire({
        icon: "success",
        title: "WO",
        text: "Berkas WO berhasil diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    },
    error: function (error) {
      Swal.close();
      Swal.fire({
        icon: "error",
        title: "WO",
        text: "Berkas WO gagal diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    }
  });
});

$('#file2').change(function (e) {
  // UPLOAD
  nomor_lo = $("#nomor_lo").val();
  var formData = new FormData($('#uploadForm')[0]);
  var additionalData = {
    'nomor_lo': nomor_lo,
    'idlo': $('#idlo').val()
  };
  console.log(additionalData);
  formData.append('additionalData', JSON.stringify(additionalData));
  loadingswal();
  $.ajax({
    url: "http://localhost:8080/api/lo/" + $('#alokasi').val() + "/uploadfile/2/" + $('#idlo').val(),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      Swal.close();
      Swal.fire({
        icon: "success",
        title: "Loasing Order (LO) dan Surat Jalan",
        text: "Berkas Loasing Order (LO) dan Surat Jalan berhasil diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    },
    error: function (error) {
      Swal.close();
      Swal.fire({
        icon: "error",
        title: "Loasing Order (LO) dan Surat Jalan",
        text: "Berkas Loasing Order (LO) dan Surat Jalan gagal diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    }
  });
});

$('#file3').change(function (e) {
  nomor_do = $("#nomor_do").val();
  kode_do = nomor_do.replace(/[\/.]/g, '');
  var formData = new FormData($('#uploadForm')[0]);
  var additionalData = {
    'kode_do': kode_do,
    'idlo': $('#idlo').val()
  };
  console.log(additionalData);
  formData.append('additionalData', JSON.stringify(additionalData));
  loadingswal();
  $.ajax({
    url: "http://localhost:8080/api/lo/" + $('#alokasi').val() + "/uploadfile/3/" + $('#idlo').val(),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      Swal.close();
      Swal.fire({
        icon: "success",
        title: "DO",
        text: "Berkas DO berhasil diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    },
    error: function (error) {
      Swal.close();
      Swal.fire({
        icon: "error",
        title: "DO",
        text: "Berkas DO gagal diupload.",
        showConfirmButton: false,
        timer: 3000,
      });
    }
  });
});

// UPDATE DOKUMEN
$('#prosesedit').click(function (e) {
  nomor_wo = $("#nomor_wo").val();
  nomor_do = $("#nomor_do").val();
  nomor_so = $("#nomor_so").val();
  jam_pemberangkatan = $("#jampengiriman").val();
  kode_wo = nomor_wo.replace(/[\/.]/g, '');
  kode_do = nomor_do.replace(/[\/.]/g, '');
  kode_so = nomor_so.replace(/[\/.]/g, '');
  var additionalData = {
    'jam_pemberangkatan': jam_pemberangkatan,
    'kode_wo': kode_wo,
    'kode_do': kode_do,
    'kode_so': kode_so,
    'nomor_wo': nomor_wo,
    'nomor_do': nomor_do,
    'nomor_so': nomor_so,
    'tanggal_muat': $('#tanggal_pembuatan').val(),
    'nomor_mobil': $('#nopolmobil').val(),
    'nama_driver': $('#namadriver').val(),
    'nomor_driver': $('#nomordriver').val(),
    'idlo': $('#idlo').val()
  };
  $.ajax({
    url: "http://localhost:8080/api/lo/" + $('#alokasi').val() + "/editdatalo/" + $('#idlo').val(),
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(additionalData),
    success: function (data) {
      console.log(data);
      // Swal.fire({
      //   icon: "success",
      //   title: "Loading Order (LO)",
      //   text: "Berkas Loading Order (LO) berhasil diupload.",
      //   showConfirmButton: false,
      //   timer: 3000,
      // }).then(() => {
      //   window.history.back();
      // });
    },
    error: function (error) {
      console.log("ERROR EDIT DATA : ", error);
    },
  });
});
