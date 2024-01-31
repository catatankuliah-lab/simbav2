// INDEX DATA TABLE KANTOR
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/v1/kantor",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, kantorcabang) {
        datanya.push({
          nama_kantor: kantorcabang.nama_kantor,
          alamat_kantor: kantorcabang.alamat_kantor,
          link:
            "http://localhost:8080/kantorpusat/wilayahkerja/detail-wilayahkerja/" +
            kantorcabang.id_kantor,
        });
      });
      $("#tableKantorCabang").DataTable({
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
          { data: "nama_kantor" },
          { data: "alamat_kantor" },
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

// FUNGSI SEARCH
function cari() {
  var keyword = $("#keyword").val();
  $("#tableKantorCabang").DataTable().search(keyword).draw();
}

// FUNGSI TOTAL DATA
function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tableKantorCabang").DataTable().page.len(selectedLength).draw();
}

// AMBIL DATA KANTOR BY PROVINSI
$("#provinsi").on("change", function () {
  const provinsiDipilih = $("#provinsi").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/kantor/provinsi/" + provinsiDipilih,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const datakantor = $("#gettablekantorcabang");
      datakantor.empty();
      var no = 1;
      $.each(data, function (index, kantor) {
        const listdata =
          "<tr><td>" +
          no++ +
          "</td><td>" +
          kantor.username +
          "</td><td>" +
          kantor.deskripsi_hak_akses +
          "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showdataAkun(" +
          kantor.id_akun +
          ")'><i class='fas fa-eye'></i></a></td></tr>";
        datakantor.append(listdata);
      });
    },
    error: function (error) {
      datakantor.empty();
      console.error("Error:", error);
    },
  });
});

// FITUR FILTER KANTOR CABANG BY PROVINSI
// function showKantorCabangByProvinsi() {
//   const provinsiDipilih = $("#provinsi").find(":selected").val();
//   console.log(provinsiDipilih);
//   $.ajax({
//     url: "http://localhost:8080/api/v1/kantor/provinsi/" + provinsiDipilih,
//     type: "GET",
//     dataType: "json",
//     success: function (data) {
//       datakantorcabang.empty();
//       var no = 1;
//       $.each(data, function (index, kantorcabang) {
//         const listdatakantorcabang =
//           "<tr><td>" +
//           no++ +
//           "</td><td>" +
//           kantorcabang.nama_kantor +
//           "</td><td>" +
//           kantorcabang.alamat_kantor +
//           ", " +
//           "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showDetailkantorcabang(" +
//           kantorcabang.id_kantor +
//           ")'><i class='fas fa-eye'></i></a></td></tr>";
//         datakantorcabang.append(listdatakantorcabang);
//       });
//     },
//     error: function (error) {
//       datakantorcabang.empty();
//       console.error("Error:", error);
//     },
//   });
// }
