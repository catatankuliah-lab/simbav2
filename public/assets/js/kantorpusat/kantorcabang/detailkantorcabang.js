// INISIASI
var id = $("#id").val();
const provinsi = $("#provinsi");
const kode_provinsi = 0;

function toUpperKantorCabang() {
  var inputanKantorCabang = $("#namakantorcabang").val();
  $("#namakantorcabang").val(inputanKantorCabang.toUpperCase());
}

function toUpperAlamat() {
  var inputanAlamat = $("#alamat").val();
  $("#alamat").val(inputanAlamat.toUpperCase());
}

// GET DATA PROVINSI
$.ajax({
  url: "http://localhost:8080/api/v1/provinsi",
  type: "GET",
  dataType: "json",
  success: function (data) {
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

// SHOW DATA
$.ajax({
  url: "http://localhost:8080/api/v1/kantor/" + id,
  type: "GET",
  dataType: "json",
  success: function (data) {
    $("#namakantorcabang").val(data.nama_kantor);
    $("#provinsi").val(data.kode_provinsi);
    $("#kodeprovinsisementara").val(data.kode_provinsi);
    $("#alamat").val(data.alamat_kantor);
    showPilihWilayahKerja(data.kode_provinsi);
  },
  error: function (error) {
    Swal.fire({
      icon: "error",
      title: "Kantor Cabang",
      text: error.responseJSON.messages.error,
      timer: 2000,
      showConfirmButton: false,
    }).then(() => {
      window.location.href = "http://localhost:8080/kantorpusat/kc";
    });
  },
});

function showPilihWilayahKerja(kodeprovinsi) {
  $.ajax({
    url: "http://localhost:8080/api/v1/kabupatenkota/provinsi/" + kodeprovinsi,
    type: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      const kabupatenkota = $("#wilayahkerja");
      $.each(data, function (index, listKabupaten) {
        const listoption =
          "<option value='" +
          listKabupaten.kode_kabupaten_kota +
          "'>" +
          listKabupaten.nama_kabupaten_kota +
          "</option>";
        kabupatenkota.append(listoption);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// UPDATE DATA
$("#simpanKantorCabang").click(function () {
  var inputanKantorCabang = $("#namakantorcabang").val();
  var inputanProvinsi = $("#provinsi").val();
  var inputanAlamat = $("#alamat").val();

  var dataKantor = {
    nama_kantor: inputanKantorCabang,
    alamat_kantor: inputanAlamat,
    kode_provinsi: inputanProvinsi,
  };

  $.ajax({
    url: "http://localhost:8080/api/v1/kantor/" + id,
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(dataKantor),
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
          title: "Kantor Cabang",
          text: error.responseJSON.messages.alamat_kantor,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

// HAPUS DATA
$("#hapusKantorCabang").click(function () {
  Swal.fire({
    title: "Hak Akses",
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
        url: "http://localhost:8080/api/v1/kantor/" + id,
        type: "DELETE",
        dataType: "json",
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
          console.log(error);
        },
      });
    }
  });
});

// HAPUS KANTOR CABANG
$("#hapusKantorCabang").click(function () {
  Swal.fire({
    title: "Kantor Cabang",
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
        url: "http://localhost:8080/api/v1/kantor/" + id,
        type: "DELETE",
        dataType: "json",
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
          console.log(error.responseJSON.messages.nama_kantor);
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
              title: "Kantor Cabang",
              text: error.responseJSON.messages.alamat_kantor,
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });
});

// INDEX DATA TABLE WILAYAH KERJA
$(document).ready(function showDataTable() {
  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja/" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, wilayahkerja) {
        datanya.push({
          id_wilayah_kerja: wilayahkerja.id_wilayah_kerja,
          nama_kabupaten_kota: wilayahkerja.nama_kabupaten_kota,
        });
      });

      dataTable = $("#tablewilayakerja").DataTable({
        paging: true,
        info: false,
        language: {
          paginate: {
            next: ">", // Mengganti teks tombol "Selanjutnya" dengan "Berikutnya"
            previous: "<", // Mengganti teks tombol "Sebelumnya" (opsional)
          },
        },
        data: datanya,
        columns: [
          { data: "nama_kabupaten_kota" },
          {
            data: "id_wilayah_kerja",
            render: function (data, type, row, meta) {
              return (
                "<a href='javascript:void(0);' class='delete-btn text-danger' data-id='" +
                data +
                "' style='border-radius: 5px;'>" +
                "<i class='fa fa-trash'></i></a>"
              );
            },
            className: "text-center",
          },
        ],
      });
      $("#tablewilayakerja").on("click", ".delete-btn", function () {
        var idWilayahKerja = $(this).data("id");
        deleteWilayahKerja(idWilayahKerja);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });

  // HAPUS DATA WILAYAH KERJA
  function deleteWilayahKerja(idWilayahKerja) {
    Swal.fire({
      title: "Wilayah Kerja",
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
          url: "http://localhost:8080/api/v1/wilayahkerja/" + idWilayahKerja,
          type: "DELETE",
          dataType: "json",
          success: function (data) {
            Swal.fire({
              icon: "success",
              title: "Wilayah Kerja",
              text: data.messages,
              timer: 2000,
              showConfirmButton: false,
            }).then(() => {
              window.location.href =
                "http://localhost:8080/kantorpusat/kc/detail-kc/" + id;
            });
          },
          error: function (error) {
            console.log(error.responseJSON.messages.nama_kabupaten_kota);
            if (error.responseJSON.messages.nama_kabupaten_kota) {
              Swal.fire({
                icon: "error",
                title: "Wilayah Kerja",
                text: error.responseJSON.messages.nama_kabupaten_kota,
                timer: 2000,
                showConfirmButton: false,
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Wilayah Kerja",
                text: error.responseJSON.messages.nama_kabupaten_kota,
                timer: 2000,
                showConfirmButton: false,
              });
            }
          },
        });
      }
    });
  }
});

// BUAT ON CLICK BUTTON
$("#tambahDataWilayahKerja").click(function () {
  var inputanWilayahKerja = {
    id_kantor: id,
    kode_kabupaten_kota: $("#wilayahkerja").val(),
  };
  // PROSES INSERT AMBIL DATA ID_KANTOR DAN KODE_WILAYAH_KERJA
  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(inputanWilayahKerja),
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Wilayah Kerja",
        text: data.messages,
        timer: 2000,
        showConfirmButton: false,
      }).then(() => {
        console.log("1");
        showDataWilayah();
      });
    },
    error: function (error) {
      if (error.responseJSON.messages.nama_kabupaten_kota) {
        Swal.fire({
          icon: "error",
          title: "Wilayah Kerja Sudah Ada",
          text: error.responseJSON.messages.nama_kabupaten_kota,
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Wilayah Kerja Sudah Ada",
          text: error.responseJSON.messages.nama_kabupaten_kota,
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },
  });
});

function showDataWilayah() {
  console.log("2");
  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja/" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      const datawilayahkerja = $("#datawilayahkerja");
      datawilayahkerja.empty();
      $.each(data, function (index, wilayahkerja) {
        const listdata =
          "<tr>" +
          "<td>" +
          wilayahkerja.nama_kabupaten_kota +
          "</td> " +
          "<td class='text-center'>" +
          "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='deleteWilayahKerja(" +
          wilayahkerja.id_wilayah_kerja +
          ")'><i class='fas fa-eye'></i></a>" +
          "</td>" +
          "</tr>";
        datawilayahkerja.append(listdata);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}
