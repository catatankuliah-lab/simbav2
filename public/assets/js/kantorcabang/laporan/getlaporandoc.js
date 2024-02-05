var idkantor = "";

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
