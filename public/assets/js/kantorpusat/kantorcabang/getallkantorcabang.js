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
            "http://localhost:8080/kantorpusat/kc/detail-kc/" +
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
      const datakantor = $("#gettablekantorcabang");
      datakantor.empty();
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
      console.log(data);
      const datakantor = $("#gettablekantorcabang");
      datakantor.empty();
      var no = 1;
      $.each(data, function (index, kantor) {
        const listdata =
          "<tr><td>" +
          kantor.nama_kantor +
          "</td><td>" +
          kantor.alamat_kantor +
          "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showDetailkantorcabang(" +
          kantor.id_kantor +
          ")'><i class='fas fa-search-plus'></i></a></td></tr>";
        datakantor.append(listdata);
      });
    },
    error: function (error) {
      const datakantor = $("#gettablekantorcabang");
      datakantor.empty();
      console.error("Error:", error);
    },
  });
});

function showDetailkantorcabang(id) {
  window.location.href =
    "http://localhost:8080/kantorpusat/kc/detail-kc/" + +id;
}
