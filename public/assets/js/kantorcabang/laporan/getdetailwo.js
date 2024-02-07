$.ajax({
  url: "http://localhost:8080/api/wo/1/detailwo/" + $("#nomorwo").val(),
  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log("Data Detail WO : ", data);
    $("#tanggalpembuatan").val(data[0].tanggal_muat);
    $("#nopoldriver").val(
      data[0].nomor_mobil +
        " / " +
        data[0].nama_driver +
        " (" +
        data[0].nomor_driver +
        ")"
    );
    $("#tanggalpembuatan").val(data[0].tanggal_muat);
    const datalo = $("#datalo");
    var total = 0;

    $.each(data, function (index, wo) {
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
        // "<td class='text-center'>" +
        // "<a href='http://localhost:8080/kantorcabang/lo/suratjalan/" +
        // wo.id_lo +
        // "' type='button' class='text-primary' style='border-radius: 5px;'>" +
        // "<i class='fas fa-search-plus'></i>" +
        // "</a>" +
        // "</td>" +
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
  $.ajax({
    url: "http://localhost:8080/api/wo/1/" + $("#alokasi").val() + "/download/" + $('#nomor_wo').val(),
    type: "GET",
    data: {
      status_dokumen_muat: "DIBUAT",
    },
    success: function (response) {
      // Handle success, mungkin tampilkan pesan atau manipulasi data jika diperlukan
      window.location.href = response.file_url;
    },
    error: function (error) {
      console.error("Error saat mengunduh dokumen:", error);
      Swal.fire({
        icon: "error",
        title: "Gagal Mengunduh Dokumen",
        text: "Terjadi kesalahan saat mengunduh dokumen.",
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
      });
    },
  });
});
