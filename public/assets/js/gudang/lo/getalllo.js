const datalo = $("#datalo");

// GET DETAIL GUDANG
function getDetailGudang(idgudang) {
  $.ajax({
    url: "http://localhost:8080/api/gudang/" + idgudang,
    type: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#pilihgudang").val(data.nama_gudang);
      idkantor = data.id_kantor;
      getWilayahKerja(data.id_kantor);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// GET WILAYAH KERJA/ GET WILAYAH KERJA
function getWilayahKerja(idkantor) {
  datadtt.empty();
  $.ajax({
    url: "http://localhost:8080/api/wilayahkerja/" + idkantor,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const kabupatenkota = $("#pilihkabupatenkota");
      $.each(data, function (index, listkabupatenkota) {
        const listoptionkabupatenkota =
          "<option value='" +
          listkabupatenkota.nama_kabupaten_kota +
          "'>" +
          listkabupatenkota.nama_kabupaten_kota +
          "</option>";
        kabupatenkota.append(listoptionkabupatenkota);
      });
    },
    error: function (error) {
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
      "http://localhost:8080/api/kecamatan/kabupatenkota/" +
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

$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/v1/spmbast",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, spm) {
        datanya.push({
          tanggal_pembuatan: spm.tanggal_pembuatan,
          nomor_spm: spm.nomor_spm,
          pengirim:
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            "(" +
            spm.nomor_driver +
            ")",
          muatan: spm.total,
          link: "http://localhost:8080/gudang/spmbast/detail/" + spm.nomor_spm,
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
          { data: "tanggal_pembuatan" },
          { data: "nomor_spm" },
          { data: "pengirim" },
          { data: "muatan" },
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
      console.error("Error:", error);
    },
  });
});

$("#filterSPM").on("click", function () {
  var alokasi = $("#alokasi option:selected").data("id_alokasi");
  var namakabupaten = $("#pilihkabupatenkota option:selected").data(
    "nama_kabupaten" );
  var namakecamatan = $("#pilihkecamatan").val();

  console.log({
    alokasi,
    namakabupaten,
    namakecamatan,
  });

  if (alokasi != 0 && namakabupaten == 0 && namakecamatan == 0) {
    $.ajax({
      url: "http://localhost:8080/api/v1/spmbast/idlokasi/" + alokasi,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
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
  } else if (alokasi == 0 && namakabupaten != 0 && namakecamatan == 0) {
    console.log(namakabupaten);
    $.ajax({
      url:
        "http://localhost:8080/api/v1/spmbast/namakabupaten/" + namakabupaten,
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
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        console.log(error);
        datalo.empty();
      },
    });
  } else if (alokasi == 0 && namakabupaten != 0 && namakecamatan != 0) {
    console.log({
      namakabupaten,
      namakecamatan,
    });
    $.ajax({
      url:
        "http://localhost:8080/api/v1/spmbast/kabupatenkecamatan/" +
        namakabupaten +
        "/" +
        namakecamatan,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        console.log(error);
        datalo.empty();
      },
    });
  } else if (alokasi != 0 && namakabupaten != 0 && namakecamatan == 0) {
    console.log({
      alokasi,
      namakabupaten,
    });
    $.ajax({
      url:
        "http://localhost:8080/api/v1/spmbast/alokasikabupaten/" +
        alokasi +
        "/" +
        namakabupaten,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        console.log(error);
        datalo.empty();
      },
    });
  } else if (alokasi != 0 && namakabupaten != 0 && namakecamatan != 0) {
    console.log({
      alokasi,
      namakabupaten,
      namakecamatan,
    });
    $.ajax({
      url:
        "http://localhost:8080/api/v1/spmbast/alokasikabupatenkecamatan/" +
        alokasi +
        "/" +
        namakabupaten +
        "/" +
        namakecamatan,
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      success: function (data) {
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        console.log(error);
        datalo.empty();
      },
    });
  } else {
    $.ajax({
      url: "http://localhost:8080/api/v1/spmbast",
      type: "GET",
      dataType: "json",
      success: function (data) {
        datalo.empty();
        $.each(data, function (index, spm) {
          var listspm =
            "<tr>" +
            "<td>" +
            spm.tanggal_pembuatan +
            "</td>" +
            "<td>" +
            spm.nomor_spm +
            "</td>" +
            "<td>" +
            spm.nopol_mobil +
            " / " +
            spm.nama_driver +
            " (" +
            spm.nomor_driver +
            ")" +
            "</td>" +
            "<td>" +
            spm.total +
            "</td>" +
            "<td class='text-center'>" +
            "<a href='http://localhost:8080/gudang/spmbast/detail/" +
            spm.nomor_spm +
            "' type='button' class='text-primary' style='border-radius: 5px;'>" +
            "<i class='fas fa-search-plus'></i>" +
            "</a>" +
            "</td>" +
            "</tr >";
          datalo.append(listspm);
        });
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  }
});

function cari() {
  var keyword = $("#keyword").val();
  $("#tablelo").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tablelo").DataTable().page.len(selectedLength).draw();
}
