$("#simpanWilayahKerja").click(function () {
  var id_kantor = $("#id_kantor").val();

  var kodekabupatenkota = $("#kodekabupatenkota").val();
  var datawilayah = {
    kode_kabupaten_kota: kodekabupatenkota,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja/" + id_kantor,
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(datawilayah),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Kantor Cabang",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        window.location.href = "http://localhost:8080/kantorpusat/wilayahkerja";
      });
    },
    error: function (error) {
      if (error.responseJSON.messages.nama_kantor) {
        Swal.fire({
          icon: "error",
          title: "Kantor Cabang",
          text: error.responseJSON.messages.nama_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Kantor Cabang!",
          text: error.responseJSON.messages.alamat_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});
