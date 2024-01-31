// INISIASI
var kantorcabang = $("#kantorcabang");
var id = $("#id").val();

// FITUR UNTUK MEMBUAT INPUTAN MENJADI KAPITAL
function toUpperGudang() {
  var inputanGudang = $("#namagudang").val();
  $("#namagudang").val(inputanGudang.toUpperCase());
}
function toUpperAlamatGudang() {
  var inputanAlamat = $("#alamatGudang").val();
  $("#alamatGudang").val(inputanAlamat.toUpperCase());
}

// SHOW DATA GUDANG
$.ajax({
  url: "http://localhost:8080/api/v1/gudang/" + id,
  type: "GET",
  dataType: "json",
  success: function (data) {
    $("#namagudang").val(data.nama_gudang);

    // Mengambil Inputan Gudang by Kantor Cabang
    const dataKantorCabang =
      "<option value='" + data.id_kantor + "'>" + data.id_kantor + "</option>";
    kantorcabang.append(dataKantorCabang);

    $("#alamatGudang").val(data.alamat_gudang);
  },

  error: function (error) {
    Swal.fire({
      icon: "error",
      title: "Gudang",
      text: error.responseJSON.messages.error,
      timer: 2000,
      showConfirmButton: false,
    }).then(() => {
      window.location.href = "http://localhost:8080/kantorpusat/gudang";
    });
  },
});

// UPDATE DATA GUDANG
$("#simpanDataGudang").click(function () {
  var inputanGudang = $("#namagudang").val();
  var inputanKantorcabang = $("#kantorcabang").val();
  var inputanAlamat = $("#alamatGudang").val();

  var dataGudang = {
    nama_gudang: inputanGudang,
    id_kantor: inputanKantorcabang,
    alamat_gudang: inputanAlamat,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/gudang/" + id,
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataGudang),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Gudang",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        window.location.href = "http://localhost:8080/kantorpusat/gudang";
      });
    },
    error: function (error) {
      if (error.responseJSON.messages.nama_kantor) {
        Swal.fire({
          icon: "error",
          title: "Gudang",
          text: error.responseJSON.messages.nama_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Gudang",
          text: error.responseJSON.messages.alamat_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

// HAPUS GUDANG
$("#hapusGudang").click(function () {
  Swal.fire({
    title: "Gudang",
    text: "Apakah Anda yakin ingin menghapus data?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batalkan!",
    confirmButtonColor: "#526AE5",
    cancelButtonColor: "#FF4F70",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "http://localhost:8080/api/v1/gudang/" + id,
        type: "DELETE",
        dataType: "json",
        success: function (data) {
          Swal.fire({
            icon: "success",
            title: "Gudang",
            text: data.messages,
            timer: 2000,
            showConfirmButton: false,
          }).then(() => {
            window.location.href = "http://localhost:8080/kantorpusat/gudang";
          });
        },
        error: function (error) {
          console.log(error.responseJSON.messages.nama_gudang);
          if (error.responseJSON.messages.nama_gudang) {
            Swal.fire({
              icon: "error",
              title: "Gudang",
              text: error.responseJSON.messages.nama_gudang,
              timer: 2000,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gudang!",
              text: error.responseJSON.messages.alamat_gudang,
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });
});
