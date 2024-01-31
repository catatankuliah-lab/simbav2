// GET DATA ALL HAK AKSES
$.ajax({
  url: "http://localhost:8080/api/v1/hakakses",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const allHakakses = $("#pilihhakakses");
    $.each(data, function (index, listHakAkses) {
      const listoption =
        "<option value='" +
        listHakAkses.id_hak_akses +
        "'>" +
        listHakAkses.nama_hak_akses +
        "</option>";
      allHakakses.append(listoption);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

function showDataHakAkses() {
  const inputanIdHakAkses = $("#pilihhakakses").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/kantor",
    type: "GET",
    dataType: "json",
    success: function (data1) {
      const kantorcabang = $("#pilihkantorcabang");
      $.each(data1.data, function (index, listkantorcabang) {
        const listoptionkantorcabang =
          "<option value='" +
          listkantorcabang.id_kantor +
          "'>" +
          listkantorcabang.nama_kantor +
          "</option>";
        kantorcabang.append(listoptionkantorcabang);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
  if (inputanIdHakAkses == 3) {
    $("#gudang").addClass("d-none");
  } else if (inputanIdHakAkses == 4) {
    $("#gudang").removeClass("d-none");
  }
}

function showGudang() {
  const kantorcabangdipilih = $("#pilihkantorcabang").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/gudang/kantor/" + kantorcabangdipilih,
    type: "GET",
    dataType: "json",
    success: function (data2) {
      console.log(data2);
      const gudang = $("#pilihgudang");
      $.each(data2, function (index, listgudang) {
        const listoptionkantorcabang =
          "<option value='" +
          listgudang.id_gudang +
          "'>" +
          listgudang.nama_gudang +
          "</option>";
        gudang.append(listoptionkantorcabang);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// CREATE HAK AKSES
$("#simpanAkun").click(function () {
  var inputanIdHakAkses = $("#pilihhakakses").find(":selected").val();
  var inputKantorCabang = $("#pilihkantorcabang").find(":selected").val();
  var inputanGudang = $("#pilihgudang").find(":selected").val();
  var inputanNamaLengkap = $("#nama").val();
  var inputanUsername = $("#username").val();
  var inputanPassword = $("#password").val();

  if (inputanIdHakAkses == 3) {
    inputanGudang = $("#pilihgudang").val();
  } else if (inputanIdHakAkses == 4) {
    inputKantorCabang = $("#pilihkantorcabang").val();
  }

  var dataAkun = {
    id_hak_akses: inputanIdHakAkses,
    id_kantor: inputKantorCabang,
    id_gudang: inputanGudang,
    username: inputanUsername,
    password: inputanPassword,
    nama_lengkap: inputanNamaLengkap,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/akun",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataAkun),
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
      console.log(error);
      if (error.responseJSON.messages) {
        Swal.fire({
          icon: "error",
          title: "Akun",
          text: error.responseJSON.messages,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Akun!",
          text: error.responseJSON.messages,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

//
