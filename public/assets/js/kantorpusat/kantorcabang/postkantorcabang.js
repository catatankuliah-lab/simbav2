// CREATE KANTOR CABANG
function toUpperKantorCabang() {
  var inputanKantorCabang = $("#namakantorcabang").val();
  $("#namakantorcabang").val(inputanKantorCabang.toUpperCase());
}

function toUpperAlamat() {
  var inputanAlamat = $("#alamat").val();
  $("#alamat").val(inputanAlamat.toUpperCase());
}

$("#simpanKantorCabang").click(function () {
  var inputanKantorCabang = $("#namakantorcabang").val();
  var inputanProvinsi = $("#provinsi").val();
  var inputanAlamat = $("#alamat").val();

  var dataHakAkses = {
    nama_kantor: inputanKantorCabang,
    alamat_kantor: inputanAlamat,
    kode_provinsi: inputanProvinsi,
  };
  $.ajax({
    url: "http://localhost:8080/api/v1/kantor",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataHakAkses),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Kantor Cabang",
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

$.ajax({
  url: "http://localhost:8080/api/v1/provinsi",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const provinsi = $("#provinsi");
    $.each(data, function (index, listprovinsi) {
      const listoption =
        "<option value='" +
        listprovinsi.kode_provinsi +
        "'>" +
        listprovinsi.nama_provinsi +
        "</option>";
      provinsi.append(listoption);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});
