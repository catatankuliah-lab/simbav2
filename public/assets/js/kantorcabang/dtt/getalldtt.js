$.ajax({
    url: 'http://localhost:8080/api/v1/dtt/sessionya',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
        showdtt(data.id_akun);
    },
    error: function (error) {
        console.error('Gagal mengambil data sesi:', error);
    }
});

function showdtt(idakun) {
    $.ajax({
        url: "http://localhost:8080/api/v1/dtt/" + idakun,
        type: "GET",
        dataType: "json",
        success: function (data) {
            const datadtt = $("#datadtt");
            datadtt.empty();
            $.each(data, function (index, dtt) {
                const listdtt =
                    "<tr>" +
                    "<td>" + dtt.kode_dtt + "</td>" +
                    "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                    "<td>" + dtt.nama_kecamatan + "</td>" +
                    "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                    "<td>" + dtt.status_dtt + "</td>" +
                    "<td class='text-center'>" +
                    "<a href='http://localhost:8080/kantorcabang/dtt/detail/" + dtt.kode_dtt + "' class='text-primary' style='border-radius: 5px;'>" +
                    "<i class='fas fa-eye'></i>" +
                    "</a>" +
                    "</td>" +
                    "</tr >";
                datadtt.append(listdtt);
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}




