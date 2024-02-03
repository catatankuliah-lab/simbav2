// VARIABEL
var idgudang = "";
var idkantor = "";
var idakun = "";
var idalokasi = "";
var idspm = "";
var kodekabupatenkota = "";
var kodekecamatan = "";
var kodealokasi = "";
var alokasitahap = "";
const datalo = $("#datalo");
var dataprosesspm = {};

// DATA SESSION
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/lo/sessionya",
    method: "GET",
    dataType: "json",
    success: function (data) {
      // console.log(data);
      idakun = data.id_akun;
      idgudang = data.id_gudang;
      idakun = data.id_akun;
      idkantor = data.id_kantor_cabang;

      // FUNCTION GET DATA
      getDataAllLo(idkantor);
      getDetailKantor(idkantor);
      getWilayahKerja(idkantor);
      // getDetailGudang(idgudang);
    },

    error: function (error) {
      console.error("Gagal mengambil data sesi:", error);
    },
  });
});

function getWilayahKerja(idkantor) {
  $.ajax({
    url: "http://localhost:8080/api/wilayahkerja/" + idkantor,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const kabupatenkota = $("#pilihkabupatenkota");
      $.each(data, function (index, listkabupatenkota) {
        const listoptionkabupatenkota =
          "<option data-nama_kabupaten='" +
          listkabupatenkota.nama_kabupaten_kota +
          "' value='" +
          listkabupatenkota.kode_kabupaten_kota +
          "'>" +
          listkabupatenkota.nama_kabupaten_kota +
          "</option>";
        kabupatenkota.append(listoptionkabupatenkota);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

function showKecamatan() {
  const kabupatenkotadipilih = $("#pilihkabupatenkota").find(":selected").val();
  const kecamatan = $("#pilihkecamatan");
  if (kabupatenkotadipilih == 0) {
    kecamatan.empty();
    var listoptionkecamatan = "<option value='0'>Pilih Kecamatan</option>";
    kecamatan.append(listoptionkecamatan);
  }
  $.ajax({
    url:
      "http://localhost:8080/api/v1/kecamatan/kabupatenkota/" +
      kabupatenkotadipilih,
    type: "GET",
    dataType: "json",
    success: function (data) {
      kecamatan.empty();
      var listoptionkecamatan = "<option value='0'>Pilih Kecamatan</option>";
      kecamatan.append(listoptionkecamatan);
      $.each(data, function (index, listkecamatan) {
        listoptionkecamatan =
          "<option value='" +
          listkecamatan.nama_kecamatan +
          "'>" +
          listkecamatan.nama_kecamatan +
          "</option>";
        kecamatan.append(listoptionkecamatan);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

function getDetailKantor(idkantor) {
  $.ajax({
    url: "http://localhost:8080/api/gudang/kantor/" + idkantor,
    method: "GET",
    dataType: "json",
    success: function (data) {
      const pilihgudang = $("#pilihgudang");
      $.each(data, function (index, datagudang) {
        const listgudang =
          "<option data-nama_gudang='" +
          datagudang.nama_gudang +
          "' value='" +
          datagudang.id_gudang +
          "'>" +
          datagudang.nama_gudang +
          "</option>";
        pilihgudang.append(listgudang);
      });
    },
    error: function (error) {
      console.error("Gagal mengambil data sesi:", error);
    },
  });
}

function getDataAllLo(idkantor) {
  $.ajax({
    url: "http://localhost:8080/api/lo/getbyidkantor/" + idkantor,
    method: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, lo) {
        datanya.push({
          tanggal_muat: lo.tanggal_muat,
          gudang: lo.nama_gudang,
          nomor_lo: lo.nomor_lo,
          pengirim:
            lo.nomor_mobil +
            " / " +
            lo.nama_driver +
            "(" +
            lo.nomor_driver +
            ")",
          muatan: lo.jumlah_penyaluran_januari,
          status: lo.status_dokumen_muat,
          link: "http://localhost:8080/kantorcabang/lo/detail/" + lo.nomor_lo,
        });
      });
      $("#tablelo").DataTable({
        paging: true,
        info: false,
        language: {
          paginate: {
            next: ">",
            previous: "<",
          },
        },
        data: datanya,
        columns: [
          { data: "tanggal_muat" },
          { data: "gudang" },
          { data: "nomor_lo" },
          { data: "pengirim" },
          { data: "muatan" },
          { data: "status" },
          {
            data: "link",
            render: function (data, type, row, meta) {
              return (
                "<a href=" +
                data +
                " type='button' class='text-primary' style='border-radius: 5px;'>" +
                "<i class='fas fa-search-plus'></i></a>"
              );
            },
            className: "text-center",
          },
        ],
      });
    },

    error: function (error) {
      console.error("Gagal mengambil data sesi:", error);
    },
  });
}

// GET ALOKASI
$.ajax({
  url: "http://localhost:8080/api/alokasi",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const alokasi = $("#alokasi");
    $.each(data, function (index, dataalokasi) {
      const listalokasi =
        "<option data-id_alokasi='" +
        dataalokasi.id_alokasi +
        "' value='" +
        dataalokasi.kode_alokasi +
        "'>" +
        dataalokasi.nama_alokasi +
        "</option>";
      alokasi.append(listalokasi);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

// // FILTERRING
$("#filterSPM").on("click", function () {
  var alokasi = $("#alokasi option:selected").data("id_alokasi");
  var gudang = $("#pilihgudang option:selected").data("nama_gudang");
  var namakabupaten = $("#pilihkabupatenkota option:selected").data(
    "nama_kabupaten"
  );
  var namakecamatan = $("#pilihkecamatan").val();

  console.log({
    alokasi,
    gudang,
    namakabupaten,
    namakecamatan,
  });

  // IF GUDANG SAJA
  // IF KAB/KOTA SAJA
  // IF GUDANG, KAB/KOTA, KEC
  // IF KAB/KOTA, KEC
  // ELSE TIDAK MEMILIH SEMUANYA -> TAMPILKAN SEMUA DATA

  if (gudang != 0 && namakabupaten == 0 && namakecamatan == 0) {
    $.ajax({
      url: "http://localhost:8080/api/lo/namagudangkantor/" + gudang,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        console.log(data);
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_muat +
            "</td>" +
            "<td>" +
            spm.nama_gudang +
            "</td>" +
            "<td>" +
            spm.nomor_lo +
            "</td>" +
            "<td>" +
            spm.nomor_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td>" +
            spm.status_dokumen_muat +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_lo +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        datalo.empty();
      },
    });
  } else if (gudang == 0 && namakabupaten != 0 && namakecamatan == 0) {
    $.ajax({
      url: "http://localhost:8080/api/lo/namakabupatenkantor/" + namakabupaten,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        console.log(data);
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_muat +
            "</td>" +
            "<td>" +
            spm.nama_gudang +
            "</td>" +
            "<td>" +
            spm.nomor_lo +
            "</td>" +
            "<td>" +
            spm.nomor_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td>" +
            spm.status_dokumen_muat +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_lo +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        datalo.empty();
      },
    });
  } else if (gudang == 0 && namakabupaten != 0 && namakecamatan != 0) {
    $.ajax({
      url:
        "http://localhost:8080/api/v1/lo/kabupatenkecamatankantor/" +
        namakabupaten +
        "/" +
        namakecamatan,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        console.log(data);
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_muat +
            "</td>" +
            "<td>" +
            spm.nama_gudang +
            "</td>" +
            "<td>" +
            spm.nomor_lo +
            "</td>" +
            "<td>" +
            spm.nomor_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td>" +
            spm.status_dokumen_muat +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_lo +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        datalo.empty();
      },
    });
  }
});

// function generatereport() {
//   $("#tomboldownload").empty();
//   var idalokasi = $("#alokasi option:selected").data("id_alokasi");
//   var tomboldownload =
//     "<a href='http://localhost:8080/kantorcabang/spmbast/rekap/" +
//     idalokasi +
//     "' style='font-weight: bolder;' class='text-primary' id='downloadspm'>Download</a> File Rekap Penyaluran";
//   $("#tomboldownload").append(tomboldownload);
// }
