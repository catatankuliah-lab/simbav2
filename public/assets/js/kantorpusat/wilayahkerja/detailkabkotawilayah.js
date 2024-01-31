var kantor = $("#idkantor").val();
var wilayah = $("#idwilayah").val();

$.ajax({
  url: "http://localhost:8080/api/v1/wilayahkerja/" + kantor + "/" + wilayah,
  type: "GET",
  dataType: "json",
  success: function (data) {
    $("#namakabupatenkota").val(data[0].nama_kabupaten_kota);
    $("#namakantor").val(data[0].nama_kantor);
    $("#alamatkantor").val(data[0].alamat_kantor);
  },
  error: function (error) {
    Swal.fire({
      icon: "error",
      title: "Wiayah Kerja Kantor Cabang",
      text: error.responseJSON.messages.error,
      timer: 2000,
      showConfirmButton: false,
    }).then(() => {
      window.location.href = "http://localhost:8080/kantorpusat/wilayahkerja";
    });
  },
});

// UPDATE DATA
$("#simpanDataKabupatenWilayah").click(function () {
  var inputanKabupatenKota = $("#namakabupatenkota").val();
  var inputanNamaKantor = $("#namakantor").val();
  var inputanAlamat = $("#alamatkantor").val();

  var datadetailwilayah = {
    nama_kabupaten_kota: inputanKabupatenKota,
    nama_kantor: inputanNamaKantor,
    alamat_kantor: inputanAlamat,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja/" + kantor + "/" + wilayah,
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(datadetailwilayah),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Wilayah Kerja Kantor Cabang",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        window.location.href = "http://localhost:8080/kantorpusat/kc";
      });
    },
    error: function (error) {
      if (error.responseJSON.messages.nama_kantor) {
        Swal.fire({
          icon: "error",
          title: "Wilayah Kerja Kantor Cabang",
          text: error.responseJSON.messages.nama_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Wilayah Kerja Kantor Cabang",
          text: error.responseJSON.messages.alamat_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});
