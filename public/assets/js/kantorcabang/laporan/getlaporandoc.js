console.log($("#kodewo").val());
console.log($("#alokasi").val());

$.ajax({
  url:
    "http://localhost:8080/api/lo/" +
    $("#alokasi").val() +
    "/laporan/detail/" +
    $("#kodewo").val(),

  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log("Data Detail WO : ", data);

    $("#tanggalpembuatan").val(data.data[0].tanggal_muat);
    $("#nomorwo").val(data.data[0].nomor_wo);
    const datalo = $("#datalo");
    var total = 0;

    $.each(data.data, function (index, wo) {
      total += parseInt(wo.jumlah_penyaluran_januari);

      if (wo.status_pbp !== "DIBUAT") {
        DIBUAT = false;
      }

      var listwo =
        "<tr>" +
        "<td>" +
        (parseInt(index) + 1) +
        "</td>" +
        "<td>" +
        wo.nama_kabupaten_kota +
        "</td>" +
        "<td>" +
        wo.nama_kecamatan +
        "</td>" +
        "<td>" +
        wo.nama_desa_kelurahan +
        "</td>" +
        "<td>" +
        wo.jumlah_penyaluran_januari +
        "</td>" +
        "<td>" +
        wo.status_dokumen_muat +
        "</td>" +
        "</tr >";
      datalo.append(listwo);
    });
    var totalRow =
      "<tr><td colspan='4' style='text-align: center; font-weight:bold'>Total</td><td style='font-weight:bold'>" +
      total +
      "</td><td></td></tr>";

    datalo.append(totalRow);
  },
  error: function (error) {
    console.error("Data Detail WO Error :", error);
  },
});

$("#downloadwo").on("click", function () {
  window.location.href =
    "http://localhost:8080/itkantorcabang/lo/1/generatelaporanwo/" +
    $("#kodewo").val();
});

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
  } else {
    var tanggal = $("#datatanggal").val();
    var awalTanggal = tanggal.substring(3, 5);
    var awalBulan = tanggal.substring(0, 2);
    var awalTahun = tanggal.substring(6, 10);
    var tanggalMulai = awalTahun + "-" + awalBulan + "-" + awalTanggal;

    var akhirTanggal = tanggal.substring(16, 18);
    var akhirBulan = tanggal.substring(13, 15);
    var akhirTahun = tanggal.substring(19, 23);
    var tanggalAkhir = akhirTahun + "-" + akhirBulan + "-" + akhirTanggal;
    console.log({
      tanggalMulai,
      tanggalAkhir,
    });

    $.ajax({
      url:
        "http://localhost:8080/api/lo/alokasi/" +
        $("#alokasi").val() +
        "/awal/" +
        tanggalMulai +
        "/akhir/" +
        tanggalAkhir,

      method: "GET",
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == "200") {
          $("#filterdatatable").removeClass("d-none");
          $("#tablelo").removeClass("d-none");
          var datanya = [];
          var nomorwo = "";
          $.each(data.data, function (index, lo) {
            if (lo.nomor_wo == "") {
              nomorwo = "BELUM DIISI";
            } else {
              nomorwo = lo.nomor_wo;
            }
            datanya.push({
              tanggal_muat: lo.tanggal_muat,
              nomor_wo: nomorwo,
              nomor_lo: lo.nomor_lo,
              pengirim:
                lo.nomor_mobil +
                " / " +
                lo.nama_driver +
                " (" +
                lo.nomor_driver +
                ")",
              muatan: lo.total,
              status: lo.status_dokumen_muat,
              link:
                "http://localhost:8080/itkantorcabang/lo/laporan/1/detail/" +
                lo.kode_wo,
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
              { data: "nomor_wo" },
              { data: "nomor_lo" },
              { data: "pengirim" },
              {
                data: "muatan",
                className: "text-center",
              },
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
        } else {
          $("#filterdatatable").addClass("d-none");
          $("#tablelo").addClass("d-none");
          $("#tablelo_paginate").addClass("d-none");
          Swal.fire({
            icon: "error",
            title: "Loading Order (LO)",
            text: "Data Loading Order (LO) tidak ditemukan.",
            showConfirmButton: false,
            timer: 3000,
          });
        }
      },

      error: function (error) {
        console.log("Error Semua LO : ", error);
        datawo.empty();
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
  $("#tablewo").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tablewo").DataTable().page.len(selectedLength).draw();
}
