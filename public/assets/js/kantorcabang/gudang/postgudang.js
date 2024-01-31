// CREATE GUDANG
function toUpperGudang() {
  var inputanGudang = $("#namagudang").val();
  $("#namagudang").val(inputanGudang.toUpperCase());
}

function toUpperAlamatGudang() {
  var inputanAlamatGudang = $("#alamatGudang").val();
  $("#alamatGudang").val(inputanAlamatGudang.toUpperCase());
}

$("#simpangGudang").click(function () {
  var inputanNamaGudang = $("#namagudang").val();
  var inputanAlamatGudang = $("#alamatGudang").val();

  const inputanIdKantor = $("#kantorcabang").find(":selected").val();

  var dataGudang = {
    id_kantor: inputanIdKantor,
    nama_gudang: inputanNamaGudang,
    alamat_gudang: inputanAlamatGudang,
  };
  console.log(dataGudang);
  $.ajax({
    url: "http://localhost:8080/api/v1/gudang",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataGudang),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Data Gudang",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        window.location.href = "http://localhost:8080/kantorpusat/gudang";
      });
    },
    error: function (error) {
      console.log(error);
      if (error) {
        Swal.fire({
          icon: "error",
          title: "Data Gudang",
          text: error,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Data Gudang!",
          text: error.responseJSON.messages,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

$.ajax({
  url: "http://localhost:8080/api/v1/kantor",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const kantor = $("#kantorcabang");
    $.each(data, function (index, listkantor) {
      const listoption =
        "<option value='" +
        listkantor.id_kantor +
        "'>" +
        listkantor.nama_kantor +
        "</option>";
      kantor.append(listoption);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});
