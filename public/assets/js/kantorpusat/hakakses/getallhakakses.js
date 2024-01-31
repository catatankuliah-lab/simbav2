// INDEX HAK AKSES
$.ajax({
  url: "http://localhost:8080/api/v1/hakakses",
  type: "GET",
  dataType: "json",
  success: function (data) {
    const dataHakAkses = $("#getDataHakAkses");
    $.each(data, function (index, hakakses) {
      const listDataHakAkses =
        "<tr><td>" +
        hakakses.nama_hak_akses +
        "</td><td class='text-center'> <a type='button' class='text-primary' style='border-radius: 5px;' onclick='showDetailHakAkses(" +
        hakakses.id_hak_akses +
        ")'><i class='fas fa-eye'></i></a></td></tr>";
      dataHakAkses.append(listDataHakAkses);
    });
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

function showDetailHakAkses(id) {
  window.location.href =
    "http://localhost:8080/kantorpusat/akses/detail-hakakses/" + id;
}
