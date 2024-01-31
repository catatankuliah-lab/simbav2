// GET ALL KANTOR CABANG UNTUK SELECT OPTION KANTOR CABANG
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

$("#kantorcabang").on("change", function () {
  const kantorcabang = $("#kantorcabang").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/gudang/kantor/" + kantorcabang,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const datagudang = $("#getDataGudang");
      datagudang.empty();
      var no = 1;
      $.each(data, function (index, gudang) {
        const listdata =
          "<tr><td>" +
          gudang.nama_gudang +
          "</td><td>" +
          gudang.alamat_gudang +
          "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showdatagudang(" +
          gudang.id_gudang +
          ")'><i class='fas fa-search-plus'></i></td></tr>";
        datagudang.append(listdata);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
});

function showdatagudang(id) {
  window.location.href =
    "http://localhost:8080/kantorpusat/gudang/detail-gudang/" + id;
}

// DATA TABLE GUDANG
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/api/v1/gudang",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var datanya = [];
      $.each(data, function (index, gudang) {
        datanya.push({
          namagudang: gudang.nama_gudang,
          alamatgudang: gudang.alamat_gudang,
          link:
            "http://localhost:8080/kantorpusat/gudang/detail-gudang/" +
            gudang.id_gudang,
        });
      });
      $("#tableGudang").DataTable({
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
          { data: "namagudang" },
          { data: "alamatgudang" },
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
  $("#tableGudang").DataTable().search(keyword).draw();
}

function banyaknya() {
  var selectedLength = $("#banyaknya").val();
  $("#tableGudang").DataTable().page.len(selectedLength).draw();
}
