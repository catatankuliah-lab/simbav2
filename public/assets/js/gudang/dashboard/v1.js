$.ajax({
    url: "http://localhost:8080/api/v1/lo/sessionya",
    method: "GET",
    dataType: "json",
    success: function (data) {
        dashboardSemua(data.id_akun);
    },
    error: function (error) {
        console.error("Gagal mengambil data sesi:", error);
    },
});

function dashboardSemua(idakun) {
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/dashboard/" + idakun,
        method: "GET",
        dataType: "json",
        success: function (data) {
            var total = 0;
            var lengkap = 0;
            var tidak = 0;
            $.each(data, function (index, datanya) {
                total++;
                if (datanya.status_dokumen_muat == "LENGKAP") {
                    lengkap++;
                } else {
                    tidak++;
                }
            });
            $('#card1').text(total);
            $('#card2').text(lengkap);
            $('#card3').text(total - lengkap);
        },
        error: function (error) {
            console.error("ERROR: ", error);
        },
    });
}