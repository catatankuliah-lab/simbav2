// GET ALOKASI
// ONCLICK BUTTON KONDISI ALOKASI DIPILIH DAN TANGGAL
// DETAIL MENGGUNAKAN NO_WO

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
        "http://localhost:8080/api/wo/alokasi/" +
        $("#alokasi").val() +
        "/awal/" +
        tanggalMulai +
        "/akhir/" +
        tanggalAkhir,

      method: "GET",
      dataType: "json",
      success: function (data) {
        console.log("Data Semua LO : ", data);
        $("#filterSearch").removeClass("d-none");
        $("#tableWO").removeClass("d-none");
        $("#tombolDownload").removeClass("d-none");
        var datanya = [];
        $.each(data, function (index, lo) {
          datanya.push({
            tanggal_wo: lo.tanggal_wo,
            nomor_wo: lo.nomor_wo,
            pengirim: lo.nama_kabupaten_kota,
            muatan: lo.nama_kecamatan,
            status: lo.nama_desa_kelurahan,
            link:
              "http://localhost:8080/kantorcabang/wo/" + $("#alokasi").val() + "/getdetailwo/" + lo.nomor_wo,
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
