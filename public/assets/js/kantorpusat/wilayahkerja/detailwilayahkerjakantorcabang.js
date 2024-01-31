// INISIASI
var id = $("#id").val();

// SHOW DATA
$.ajax({
  url: "http://localhost:8080/api/v1/wilayahkerja/" + id,
  type: "GET",
  dataType: "json",
  success: function (data) {
    $("#namakantorcabang").val(data[0].nama_kantor);
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

// // Fungsi untuk menampilkan detail wilayah
// function showDetailWilayah(idkantor, idwilayah) {
//   console.log({
//     idkantor,
//     idwilayah,
//   });
//   window.location.href =
//     "http://localhost:8080/kantorpusat/wilayahkerja/detail-wilayahkerjakabupaten/" +
//     idkantor +
//     "/" +
//     idwilayah;
// }

// // Fungsi untuk menghapus wilayah by id_kantor
// function deleteWilayahKantorcabang(id_kantor, id_wilayah_kerja) {
//   Swal.fire({
//     title: "Wilayah Kantor Cabang",
//     text: "Apakah Anda yakin ingin menghapus data?",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonText: "Ya, Hapus!",
//     cancelButtonText: "Batalkan!",
//     confirmButtonColor: "#526AE5",
//     cancelButtonColor: "#FF4F70",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       $.ajax({
//         url:
//           "http://localhost:8080/api/v1/wilayahkerja/" +
//           id_kantor +
//           "/" +
//           id_wilayah_kerja,
//         type: "DELETE",
//         dataType: "json",
//         success: function (data) {
//           Swal.fire({
//             icon: "success",
//             title: "Kantor Cabang",
//             text: data.messages,
//             timer: 2000,
//             showConfirmButton: false,
//           }).then(() => {
//             location.reload();
//           });
//         },
//         error: function (error) {
//           if (
//             error.responseJSON.messages &&
//             error.responseJSON.messages.nama_kantor
//           ) {
//             Swal.fire({
//               icon: "error",
//               title: "Kantor Cabang",
//               text: error.responseJSON.messages.nama_kantor,
//               timer: 2000,
//               showConfirmButton: false,
//             });
//           } else {
//             Swal.fire({
//               icon: "error",
//               title: "Kantor Cabang",
//               text: "Terjadi kesalahan saat menghapus data.",
//               timer: 2000,
//               showConfirmButton: false,
//             });
//           }
//         },
//       });
//     }
//   });
// }

// // fungsi untuk hapus wilayah
// $("#hapusDataWilayahKerja").click(function () {
//   Swal.fire({
//     title: "Kantor Cabang",
//     text: "Apakah Anda yakin ingin menghapus data?",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonText: "Ya, Hapus!",
//     cancelButtonText: "Batalkan!",
//     confirmButtonColor: "#526AE5",
//     cancelButtonColor: "#FF4F70",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       $.ajax({
//         url: "http://localhost:8080/api/v1/wilayahkerja/" + id,
//         type: "DELETE",
//         dataType: "json",
//         success: function (data) {
//           Swal.fire({
//             icon: "success",
//             title: "Kantor Cabang",
//             text: data.messages,
//             timer: 2000,
//             showConfirmButton: false,
//           }).then(() => {
//             window.location.href = "http://localhost:8080/kantorpusat/kc";
//           });
//         },
//         error: function (error) {
//           if (
//             error.responseJSON.messages &&
//             error.responseJSON.messages.nama_kantor
//           ) {
//             Swal.fire({
//               icon: "error",
//               title: "Kantor Cabang",
//               text: error.responseJSON.messages.nama_kantor,
//               timer: 2000,
//               showConfirmButton: false,
//             });
//           } else {
//             Swal.fire({
//               icon: "error",
//               title: "Kantor Cabang",
//               text: "Terjadi kesalahan saat menghapus data.",
//               timer: 2000,
//               showConfirmButton: false,
//             });
//           }
//         },
//       });
//     }
//   });
// });

// INDEX DATA TABLE WILAYAH KERJA
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/v1/wilayahkerja/" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, wilayahkerja) {
        datanya.push({
          nama_kabupaten_kota: wilayahkerja.nama_kabupaten_kota,
          link:
            "http://localhost:8080/kantorpusat/wilayahkerja/detail-wilayahkerja/" +
            wilayahkerja.id_kantor +
            wilayahkerja.id_wilayah_kerja,
        });
      });
      $("#tablewilayakerja").DataTable({
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
            data: "link",
            render: function (data, type, row, meta) {
              return (
                "<a href=" +
                data +
                " type='button' class='text-primary' style='border-radius: 5px;'>" +
                "<i class='fas fa-search-plus'></i></a>"
              );
            },
            className: "text-center",
          },
        ],
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
});
