// INDEX GUDANG
$.ajax({
  url: "http://localhost:8080/api/v1/gudang",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const dataGudang = $("#getDataGudang");
    var no = 1;
    $.each(data, function (index, gudang) {
      const listdataGudang =
        "<tr><td>" +
        no++ +
        "</td><td>" +
        gudang.nama_gudang +
        "</td><td>" +
        gudang.alamat_gudang +
        "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showDetailGudang(" +
        gudang.id_gudang +
        ")'><i class='fas fa-eye'></i></a></td></tr>";
      dataGudang.append(listdataGudang);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

function showDetailGudang(id) {
  // alert(id);
  window.location.href =
    "http://localhost:8080/kantorpusat/gudang/detail-gudang/" + id;
}

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

// GET GUDANG BY KANTOR
function showGudangByProvinsi() {
  const kantorcabang = $("#kantorcabang").find(":selected").val();
  $.ajax({
    url: "http://localhost:8080/api/v1/gudang/kantor/" + kantorcabang,
    type: "GET",
    dataType: "json",
    success: function (data) {
      const datakantor = $("#getDataGudang");
      datakantor.empty();
      var no = 1;
      $.each(data, function (index, gudang) {
        const listdatagudangbycabang =
          "<tr><td>" +
          no++ +
          "</td><td>" +
          gudang.nama_gudang +
          "</td><td>" +
          gudang.alamat_gudang +
          "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showDetailgudang(" +
          gudang.id_gudang +
          ")'><i class='fas fa-eye'></i></a></td></tr>";
        datakantor.append(listdatagudangbycabang);
      });
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}
