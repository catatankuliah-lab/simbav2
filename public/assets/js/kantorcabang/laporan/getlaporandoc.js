var idkantor = "";
const datawo = $("#datawo");

// DATA ALOKASI
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

function dataJanuari(alokasidipilih) {
  $.ajax({
    url: "http://localhost:8080/api/lo/" + alokasidipilih + "/sessionya",
    method: "GET",
    dataType: "json",
    success: function (data) {
      idakun = data.id_akun;
      idgudang = data.id_gudang;
      idakun = data.id_akun;
      idkantor = data.id_kantor_cabang;

      getDataAllWO(idkantor);
      getWoByIdKantor(idkantor);
    },

    error: function (error) {
      console.error("Gagal mengambil data sesi:", error);
    },
  });
}

$("#filterWO").on("click", function () {
  if ($("#alokasi").val() === null) {
    Swal.fire({
      icon: "warning",
      title: "Peringatan!",
      text: "Anda harus memilih alokasi terlebih dahulu",
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false,
    });
    return;
  }

  const alokasidipilih = $("#alokasi").val();
  if (alokasidipilih == "1") {
    dataJanuari(alokasidipilih);
    $("#tableWO").removeClass("d-none");
    $("#tombolDownload").removeClass("d-none");
  } else {
    $("#tableWO").addClass("d-none");
    $("#tombolDownload").addClass("d-none");
  }
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

function getDataAllWO(idkantor) {
  if ($.fn.DataTable.isDataTable("#tablewo")) {
    $("#tablewo").DataTable().destroy();
  }
  $.ajax({
    url: "http://localhost:8080/api/wo/getwobyidkantor/" + idkantor,
    method: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      var datanya = [];
      $.each(data, function (index, lo) {
        datanya.push({
          tanggal_wo: lo.tanggal_wo,
          nomor_wo: lo.nomor_wo,
          pengirim: lo.nama_kabupaten_kota,
          muatan: lo.nama_kecamatan,
          status: lo.nama_desa_kelurahan,
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
      datawo.empty();
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
    },
  });
}

function cari() {
  var keyword = $("#keyword").val();
  $("#tablewo").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tablewo").DataTable().page.len(selectedLength).draw();
}

// function generatereport() {
//   window.location.href =
//     "http://localhost:8080/kantorcabang/lo/generatelaporanwo/" +
//     $("#datatanggal").val();
// }
