var idkantor = "";
const datawo = $("#datawo");

$(function () {
  $('input[name="datatanggal"]').daterangepicker(
    {
      opens: "left",
    },
    function (start, end, label) {
      console.log(
        "A new date selection was made: " +
          start.format("YYYY-MM-DD") +
          " to " +
          end.format("YYYY-MM-DD")
      );
    }
  );
});

$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/lo/sessionya",
    method: "GET",
    dataType: "json",
    success: function (data) {
      idakun = data.id_akun;
      idgudang = data.id_gudang;
      idakun = data.id_akun;
      idkantor = data.id_kantor_cabang;

      getDataAllWO(idkantor);
      getWoByIdKantor(idkantor);
      getWilayahKerja(idkantor);
    },

    error: function (error) {
      console.error("Gagal mengambil data sesi:", error);
    },
  });
});

function getWoByIdKantor(idkantor) {
  $.ajax({
    url: "http://localhost:8080/api/wo/getwobyidkantor/" + idkantor,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const pilihwo = $("#pilihwo");
      $.each(data, function (index, datawo) {
        const listwo =
          "<option data-nomor_wo='" +
          datawo.id_wo +
          "' value='" +
          datawo.nomor_wo +
          "'>" +
          datawo.nomor_wo +
          "</option>";
        pilihwo.append(listwo);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

function getWilayahKerja(idkantor) {
  $.ajax({
    url: "http://localhost:8080/api/wilayahkerja/" + idkantor,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const kabupatenkota = $("#pilihkabupaten");
      $.each(data, function (index, listkabupatenkota) {
        const listoptionkabupatenkota =
          "<option data-nama_kabupaten='" +
          listkabupatenkota.nama_kabupaten_kota +
          "' value='" +
          listkabupatenkota.nama_kabupaten_kota +
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
  const kabupatenkotadipilih = $("#pilihkabupaten").find(":selected").val();
  const kecamatan = $("#pilihkecamatan");
  if (kabupatenkotadipilih == 0) {
    kecamatan.empty();
    var listoptionkecamatan = "<option value='0'>Pilih Kecamatan</option>";
    kecamatan.append(listoptionkecamatan);
  }
  $.ajax({
    url:
      "http://localhost:8080/api/pbp/getkecamatanbykabupaten/" +
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

function showDesa() {
  const kecamatandipilih = $("#pilihkecamatan").find(":selected").val();
  const desa = $("#pilihdesa");
  if (kecamatandipilih == 0) {
    desa.empty();
    var listoptiondesa = "<option value='0'>Pilih Desa</option>";
    desa.append(listoptiondesa);
  }

  $.ajax({
    url:
      " http://localhost:8080/api/pbp/getdesabykecamatan/" + kecamatandipilih,
    type: "GET",
    dataType: "json",
    success: function (data) {
      desa.empty();
      var listoptiondesa = "<option value='0'>Pilih Desa</option>";
      desa.append(listoptiondesa);
      $.each(data, function (index, listdesa) {
        listoptiondesa =
          "<option value='" +
          listdesa.nama_desa_kelurahan +
          "'>" +
          listdesa.nama_desa_kelurahan +
          "</option>";
        desa.append(listoptiondesa);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

function getDataAllWO(idkantor) {
  console.log(idkantor);
  $.ajax({
    url: "http://localhost:8080/api/wo/getalldatawo/" + idkantor,
    method: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      var datanya = [];
      $.each(data, function (index, lo) {
        datanya.push({
          tanggal_wo: lo.tanggal_wo,
          nomor_wo: lo.nomor_wo,
          pengirim:
            lo.nomor_mobil +
            " / " +
            lo.nama_driver +
            "(" +
            lo.nomor_driver +
            ")",
          muatan: lo.jumlah_penyaluran_januari,
          status: lo.status_dokumen_muat,
          link: "http://localhost:8080/kantorcabang/lo/detail/" + lo.nomor_wo,
        });
      });
      $("#tablewo").DataTable({
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
          { data: "tanggal_wo" },
          { data: "nomor_wo" },
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

function generatereport() {
  $("#tomboldownload").empty();
  var tanggalWO = $("#datatanggal option:selected").data("tanggal_wo");
  var tomboldownload =
    "<a href='http://localhost:8080/kantorcabang/lo/generatelaporanwo/" +
    tanggal_wo +
    "' style='font-weight: bolder;' class='text-primary' id='downloadspm'>Download</a> File Rekap Working Order";
  $("#tomboldownload").append(tomboldownload);
}
