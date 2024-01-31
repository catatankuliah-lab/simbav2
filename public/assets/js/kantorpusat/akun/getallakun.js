$.ajax({
  url: "http://localhost:8080/api/v1/hakakses",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const hakakses = $("#hakakses");
    $.each(data, function (index, listhakakses) {
      const listoption =
        "<option value='" +
        listhakakses.id_hak_akses +
        "'>" +
        listhakakses.nama_hak_akses +
        "</option>";
      hakakses.append(listoption);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

// GET AKUN BY HAK AKSES
$("#hakakses").on("change", function () {
  const hakakses = $("#hakakses").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/akun/hakakses/" + hakakses,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const dataakun = $("#getTableAkun");
      dataakun.empty();
      var no = 1;
      $.each(data, function (index, akun) {
        const listdata =
          "<tr><td>" +
          akun.username +
          "</td><td>" +
          akun.nama_lengkap +
          "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showdataAkun(" +
          akun.id_akun +
          ")'><i class='fas fa-search-plus'></i></a></td></tr>";
        dataakun.append(listdata);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
});

function showdataAkun(id) {
  console.log(id);
  window.location.href =
    "http://localhost:8080/kantorpusat/akun/detail-akun/" + id;
}

$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/v1/akun",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, akun) {
        datanya.push({
          username: akun.username,
          deksripsi: akun.nama_lengkap,
          link:
            "http://localhost:8080/kantorpusat/akun/detail-akun/" +
            akun.id_akun,
        });
      });
      $("#tableakun").DataTable({
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
          { data: "username" },
          { data: "deksripsi" },
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

function cari() {
  var keyword = $("#keyword").val();
  $("#tableakun").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tableakun").DataTable().page.len(selectedLength).draw();
}
