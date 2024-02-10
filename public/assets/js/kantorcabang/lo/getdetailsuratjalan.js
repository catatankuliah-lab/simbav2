$.ajax({
  url: "http://localhost:8080/api/lo/1/detail/suratjalan/" + $("#idsj").val(),

  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log(data);
    $("#tanggalpembuatan").val(data[0].tanggal_muat);
    $("#nopoldriver").val(
      data[0].nomor_mobil +
        " / " +
        data[0].nama_driver +
        " (" +
        data[0].nomor_driver +
        ")"
    );
    $("#kabupaten").val(data[0].nama_kabupaten_kota);
    $("#kecamatan").val(data[0].nama_kecamatan);
    $("#desakelurahan").val(data[0].nama_desa_kelurahan);
    $("#totalpenyerahan").val(data[0].total + " Kg");
    if (data[0].file_surat_jalan != null) {
      $("#formsj").addClass("d-none");
    }
    if (data.file_penyerahan != null) {
      $("#formdriver").addClass("d-none");
    }
  },
  error: function (error) {
    console.error("Error:", error);
  },
});
