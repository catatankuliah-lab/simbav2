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

function cari() {
  var keyword = $("#keyword").val();
  $("#tablelo").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tablelo").DataTable().page.len(selectedLength).draw();
}
