var idkantor = $("#kantor").val();
const datalo = $("#datalo");
console.log(idkantor);

$.ajax({
  url: "http://localhost:8080/api/alokasi",
  method: "GET",
  dataType: "json",
  success: function (data) {
    const alokasi = $("#alokasi");
    $.each(data, function (index, datanya) {
      const listalokasi =
        "<option value='" +
        datanya.id_alokasi +
        "'>" +
        datanya.nama_alokasi +
        "</option>";
      alokasi.append(listalokasi);
    });
  },
});

$.ajax({
  url: "http://localhost:8080/api/gudang/kantor/" + idkantor,
  method: "GET",
  dataType: "json",
  success: function (data) {
    console.log("Data Gudang Ditemukan :", data);
    var gudang = $("#pilihgudang");
    gudang.empty();
    gudang.append('<option value="">Pilih Gudang</option>');
    $.each(data, function (index, datagudang) {
      const listgudang =
        "<option data-nama_gudang='" +
        datagudang.nama_gudang +
        "' value='" +
        datagudang.id_gudang +
        "'>" +
        datagudang.nama_gudang +
        "</option>";
      gudang.append(listgudang);
    });
  },
  error: function (error) {
    console.error("Gagal mengambil data Gudang:", error);
  },
});

$.ajax({
  url: "http://localhost:8080/api/wilayahkerja/" + idkantor,
  method: "GET",
  dataType: "json",
  success: function (data) {
    console.log("Data Kabupaten Berdasarkan Wilayah Kerja Ditemukan :", data);
    var kabupatenkota = $("#pilihkabupatenkota");
    kabupatenkota.empty();
    kabupatenkota.append('<option value="">Pilih Kabupaten/Kota</option>');
    $.each(data, function (index, wilayah) {
      const listKabupatenKota =
        "<option data-nama_kabupaten='" +
        wilayah.nama_kabupaten_kota +
        "' value='" +
        wilayah.kode_kabupaten_kota +
        "'>" +
        wilayah.nama_kabupaten_kota +
        "</option>";
      kabupatenkota.append(listKabupatenKota);
    });
  },
  error: function (error) {
    console.error("Gagal mengambil data Wilayah Kerja:", error);
  },
});

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

$("#filterLO").on("click", function () {
  if ($("#alokasi").val() === null) {
    Swal.fire({
      icon: "warning",
      title: "Peringatan!",
      text: "Anda harus memilih alokasi terlebih dahulu",
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false,
    });
  } else {
    var gudang = $("#pilihgudang").val();
    var kabupaten = $("#pilihkabupatenkota").val();
    var kecamatan = $("#pilihkecamatan").val();
    var alokasi = $("#alokasi").val();

    // DOWNLOAD EXCEL
    document.getElementById("idAlokasi").value = alokasi;
    document.getElementById("formDownload").action =
      "http://localhost:8080/kantorcabang/lo/1/downloadexcel/" + alokasi;

    // FILTER
    // IF ALOKASI GUDANG
    // IF GUDANG DAN KABUPATEN
    // IF ALOKASI DAN KABUPATEN
    // IF KABUPATEN DAN KECAMATAN

    if (gudang != 0 && kabupaten == 0 && kecamatan == 0) {
      $.ajax({
        url:
          "http://localhost:8080/api/lo/" +
          alokasi +
          "/gudangbykantor/" +
          idkantor,
        method: "GET",
        dataType: "json",
        success: function (data) {},
      });
    } else if (gudang != 0 && kabupaten != 0 && kecamatan == 0) {
      $.ajax({
        url: "",
        method: "GET",
        dataType: "json",
        success: function (data) {},
      });
    } else if (gudang == 0 && kabupaten != 0 && kecamatan == 0) {
      $.ajax({
        url:
          "http://localhost:8080/lo/" +
          alokasi +
          "/namakabupatenkantor/" +
          idkantor,
        method: "GET",
        dataType: "json",
        success: function (data) {
          console.log(data);
        },
      });
    } else if (gudang == 0 && kabupaten != 0 && kecamatan != 0) {
      $.ajax({
        url: "",
        method: "GET",
        dataType: "json",
        success: function (data) {},
      });
    }

    // DATA LOADING ORDER BY ID_KANTOR
    $.ajax({
      url:
        " http://localhost:8080/api/lo/" +
        $("#alokasi").val() +
        "/getbyidkantor/" +
        idkantor,

      method: "GET",
      dataType: "json",
      success: function (data) {
        console.log("Loading Order Ditemukan : ", data);
        $("#filterSearch").removeClass("d-none");
        $("#tabelhilangdulu").removeClass("d-none");
        $("#hilang").removeClass("d-none");

        if ($.fn.DataTable.isDataTable("#tablelo")) {
          $("#tablelo").DataTable().destroy();
        }

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
            link:
              "http://localhost:8080/kantorcabang/lo/" +
              $("#alokasi").val() +
              "/detail/" +
              lo.nomor_lo,
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
        console.log("Error Semua LO : ", error);
        datalo.empty();
        console.log(error);
        Swal.fire({
          icon: "warning",
          title: "Peringatan!",
          text:
            "Data Alokasi Bulan " +
            $("#alokasi option:selected").text() +
            " Tidak Ditemukan",
          timer: 3000,
          timerProgressBar: true,
          showConfirmButton: false,
        });

        $("#filterSearch").addClass("d-none");
        $("#tabelhilangdulu").addClass("d-none");
        $("#tombolDownload").addClass("d-none");
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
