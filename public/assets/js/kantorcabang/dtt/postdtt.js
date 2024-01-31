$.ajax({
    url: 'http://localhost:8080/api/v1/dtt/sessionya',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
        showkabupatenkota(data.kode_provinsi);
    },
    error: function (error) {
        console.error('Gagal mengambil data sesi:', error);
    }
});

function showkabupatenkota(kode) {
    $.ajax({
        url: "http://localhost:8080/api/v1/kabupatenkota/provinsi/" + kode,
        type: "GET",
        dataType: "json",
        success: function (data) {
            const kabupatenkota = $("#kabupatenkota");
            $.each(data, function (index, listkabupatenkota) {
                const listoptionkabupatenkota =
                    "<option value='" +
                    listkabupatenkota.kode_kabupaten_kota +
                    "'>" +
                    listkabupatenkota.nama_kabupaten_kota +
                    "</option>";
                kabupatenkota.append(listoptionkabupatenkota);
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function showKecamatan() {
    const kabupatenkotadipilih = $("#kabupatenkota").find(":selected").val();
    $.ajax({
        url: "http://localhost:8080/api/v1/kecamatan/kabupatenkota/" + kabupatenkotadipilih,
        type: "GET",
        dataType: "json",
        success: function (data) {
            const kecamatan = $("#kecamatan");
            kecamatan.empty();
            $.each(data, function (index, listkecamatan) {
                const listoptionkecamatan =
                    "<option value='" +
                    listkecamatan.kode_kecamatan +
                    "'>" +
                    listkecamatan.nama_kecamatan +
                    "</option>";
                kecamatan.append(listoptionkecamatan);
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function preprosesDTT() {
    const kecamatandipilih = $("#kecamatan").find(":selected").val();
    $.ajax({
        url:
            "http://localhost:8080/api/v1/desakelurahan/kecamatan/" +
            kecamatandipilih,
        type: "GET",
        dataType: "json",
        success: function (data) {
            showDesaKelurahan(data[0].nama_kecamatan, data[0].nama_kabupaten_kota, data[0].nama_provinsi)
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function showDesaKelurahan(nama_kecamatan, nama_kabupaten_kota, nama_provinsi) {
    $.ajax({
        url: "http://localhost:8080/api/v1/dtt/desakelurahan/" + nama_kecamatan + "/" + nama_kabupaten_kota + "/" + nama_provinsi,
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
                    "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='prosesDTT(" + dtt.id_dtt +
                    ")'>" +
                    "<i class='fas fa-print'></i>" +
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

function prosesDTT(id_dtt) {
    $.ajax({
        url: "http://localhost:8080/api/v1/dtt/detail/" + id_dtt,
        type: "GET",
        dataType: "json",
        success: function (data) {
            createDTT(data.nama_provinsi, data.nama_kabupaten_kota, data.nama_kecamatan, data.nama_desa_kelurahan, data.kode_dtt, id_dtt);
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function createDTT(nama_provinsi, nama_kabupaten_kota, nama_kecamatan, nama_desa_kelurahan, kode_dtt, id_dtt) {
    var bahandatadtt = {
        "nama_provinsi": nama_provinsi,
        "nama_kabupaten_kota": nama_kabupaten_kota,
        "nama_kecamatan": nama_kecamatan,
        "nama_desa_kelurahan": nama_desa_kelurahan,
        "kode_dtt": kode_dtt,
        "id_dtt": id_dtt
    }
    $.ajax({
        url: "http://localhost:8080/api/v1/dtt",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(bahandatadtt),
        success: function (data) {
            Swal.fire({
                icon: "success",
                title: "DTT",
                text: data.messages,
                timer: 3000,
                showConfirmButton: false,
            }).then(() => {
                window.location.href = "http://localhost:8080/kantorcabang/dtt";
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}