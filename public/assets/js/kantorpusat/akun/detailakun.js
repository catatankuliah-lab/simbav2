// INISIASI
var id = $("#id").val();
// FITUR UNTUK MEMBUAT ON INPUT MENJADI KAPITAL
function toUpperNama() {
  var inputanNama = $("#nama").val();
  $("#nama").val(inputanNama.toUpperCase());
}

// SHOW DATA AKUN
$.ajax({
  url: "http://localhost:8080/api/v1/akun/" + id,
  type: "GET",
  dataType: "json",
  success: function (data) {
    $("#hakakses").val(data.deskripsi_hak_akses);
    $("#nama").val(data.nama_lengkap);
    $("#username").val(data.username);
    $("#password").val(data.password);

    if (data.deskripsi_hak_akses == 3) {
      $("#gudang").removeClass("d-none");
      $("#pilihgudang").val(data.id_gudang);
    } else if (data.deskripsi_hak_akses == 4) {
      $("#kantorcabang").removeClass("d-none");
      $("#pilihkantorcabang").val(data.id_kantor);
    }
    const kantorcabang = $("#pilihkantorcabang");
    const dataKantorCabang =
      "<option value='" +
      data.id_kantor +
      "'>" +
      data.nama_gudang +
      "</option>";
    kantorcabang.append(dataKantorCabang);

    $("#alamatGudang").val(data.alamat_gudang);
  },
  error: function (error) {
    Swal.fire({
      icon: "error",
      title: "Akun",
      text: error.responseJSON.messages.error,
      timer: 2000,
      showConfirmButton: false,
    }).then(() => {
      window.location.href = "http://localhost:8080/kantorpusat/akun";
    });
  },
});

// UPDATE AKUN
$("#simpanAkun").click(function () {
  var nama = $("#nama").val();
  var username = $("#username").val();
  var password = $("#password").val();

  var dataKantor = {
    nama_lengkap: nama,
    username: username,
    password: password,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/akun/" + id,
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataKantor),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Akun",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        window.location.href = "http://localhost:8080/kantorpusat/akun";
      });
    },
    error: function (error) {
      if (error.responseJSON.messages.nama_lengkap) {
        Swal.fire({
          icon: "error",
          title: "Akun",
          text: error.responseJSON.messages.nama_lengkap,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Akun",
          text: error.responseJSON.messages.username,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

// DELETE AKUN
$("#hapusAkun").click(function () {
  Swal.fire({
    title: "Hak Akses",
    text: "Apakah Anda yakin ingin menghapus data Akun?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batalkan!",
    confirmButtonColor: "#526AE5",
    cancelButtonColor: "#FF4F70",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "http://localhost:8080/api/v1/akun/" + id,
        type: "DELETE",
        dataType: "json",
        success: function (data) {
          Swal.fire({
            icon: "success",
            title: "Hak Akses",
            text: data.messages,
            timer: 2000,
            showConfirmButton: false,
          }).then(() => {
            window.location.href = "http://localhost:8080/kantorpusat/akun";
          });
        },
        error: function (error) {
          console.log(error.responseJSON.messages.username);
          if (error.responseJSON.messages.username) {
            Swal.fire({
              icon: "error",
              title: "Hak Akses",
              text: error.responseJSON.messages.username,
              timer: 2000,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Hak Akses!",
              text: error.responseJSON.messages.nama_lengkap,
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });
});
