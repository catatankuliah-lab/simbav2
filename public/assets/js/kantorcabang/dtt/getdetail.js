var kodedtt = $("#kodedtt").val();
var nama_provinsi = "";
var nama_kabupaten_kota = "";
var nama_kecamatan = "";
var nama_desa_kelurahan = "";
var id_dtt = "";
$.ajax({
    url: "http://localhost:8080/api/v1/dtt/detailbykode/" + kodedtt,
    type: "GET",
    dataType: "json",
    success: function (data) {
        nama_provinsi = data[0].nama_provinsi;
        nama_kabupaten_kota = data[0].nama_kabupaten_kota;
        nama_kecamatan = data[0].nama_kecamatan;
        nama_desa_kelurahan = data[0].nama_desa_kelurahan;
        id_dtt = data[0].id_dtt;
        if (data[0].status_dtt == 'DISALURKAN') {
            $("#uploadForm").addClass("d-none");
            var pdfPath = "../../../../dtt/" + nama_provinsi + "/" + nama_kabupaten_kota + "/" + nama_kecamatan + "/" + nama_desa_kelurahan + "/dtt/" + data[0].file_dtt;
            var iframeTag = '<iframe src="' + pdfPath + '" width="100%" height="1000px"></iframe>';
            $("#showpdf").html(iframeTag);
        } else {
            const headdtt = $("#headdtt");
            const kontendtt = $("#kontendtt");
            headdtt.empty();
            kontendtt.empty();
            const listheaddtt =
                "<tr>" +
                "<td width='95px' style='padding: 10px' rowspan='2'><img width='75px' src='../../../../dtt/JAWA BARAT/KABUPATEN CIANJUR/CIBEBER/CIPETIR/dtt/DTT88-3203032001.png' alt=''></td>" +
                "<td style='padding: 10px'>DTT</td>" +
                "<td style='padding: 10px'> PROVINSI " + data[0].nama_provinsi + "</td>" +
                "<td style='padding: 10px'> KECAMATAN " + data[0].nama_kecamatan + "</td>" +
                "</tr >" +
                "<tr>" +
                "<td style='padding: 10px'>" + data[0].kode_dtt + "</td>" +
                "<td style='padding: 10px'>KABUPATEN/KOTA " + data[0].nama_kabupaten_kota + "</td>" +
                "<td style='padding: 10px'>DESA/KELURAHAN " + data[0].nama_desa_kelurahan + "</td>" +
                "</tr >" +
                "<tr>" +
                "<td style='padding: 10px' colspan='4'>Saya yang bertanda tangan dibawah ini dengan sebenar-benarnya bahwa saya menerima 10 Kg beras bantuan pangan dengan kualitas baik.</td>" +
                "</tr >";
            headdtt.append(listheaddtt);
            counter = 0;
            var listkontendtt = "<tr><td style='padding: 10px' >NAMA PBP</td><td style='padding: 10px' >QR CODE</td><td style='padding: 10px; text-align:center' >TTD</td><td style='padding: 10px' >NAMA PBP</td><td style='padding: 10px' >QR CODE</td><td style='padding: 10px; text-align:center' >TTD</td></tr>";
            kontendtt.append(listkontendtt);
            $.each(data, function (index, dtt) {
                if (index % 2 == 0) {
                    listkontendtt = "<tr>";
                    kontendtt.append(listkontendtt);
                    listkontendtt = "<td valign='top' style='padding: 10px' >" + dtt.nama_kepala_kk + "<br><span style='font-size: 12px'>" + dtt.alamat + "</span><br><span style='font-size: 12px'>" + dtt.nomor_kpm + "</span></td>" +
                        "<td width='95px' style='padding: 10px'><img width='75px' src='../../../../dtt/" + dtt.nama_provinsi + "/" + dtt.nama_kabupaten_kota + "/" + dtt.nama_kecamatan + "/" + dtt.nama_desa_kelurahan + "/kpm/" + dtt.nomor_kpm + ".png' alt=''></td>" +
                        "<td valign='top' width='95px' style='padding: 10px; font-size: 12px'>" + (index + 1) + "</td>";
                    kontendtt.append(listkontendtt);
                } else {
                    listkontendtt = "<td valign='top' style='padding: 10px' >" + dtt.nama_kepala_kk + "<br><span style='font-size: 12px'>" + dtt.alamat + "</span><br><span style='font-size: 12px'>" + dtt.nomor_kpm + "</span></td>" +
                        "<td width='95px' style='padding: 10px'><img width='75px' src='../../../../dtt/" + dtt.nama_provinsi + "/" + dtt.nama_kabupaten_kota + "/" + dtt.nama_kecamatan + "/" + dtt.nama_desa_kelurahan + "/kpm/" + dtt.nomor_kpm + ".png' alt=''></td>" +
                        "<td valign='top' width='95px' style='padding: 10px; font-size: 12px'>" + (index + 1) + "</td>";
                    kontendtt.append(listkontendtt);
                    listkontendtt = "</tr>";
                    kontendtt.append(listkontendtt);
                }
            });
        }
    },
    error: function (error) {
        console.error("Error:", error);
    },
});

$("#uploaddtt").click(function () {
    var formData = new FormData($('#uploadForm')[0]);
    var additionalData = {
        'nama_provinsi': nama_provinsi,
        'nama_kabupaten_kota': nama_kabupaten_kota,
        'nama_kecamatan': nama_kecamatan,
        'nama_desa_kelurahan': nama_desa_kelurahan,
        'id_dtt': id_dtt,
    };
    formData.append('additionalData', JSON.stringify(additionalData));
    $.ajax({
        url: 'http://localhost:8080/api/v1/dtt/uploaddtt',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.fire({
                icon: "success",
                title: "DTT",
                text: response.message,
                timer: 3000,
                showConfirmButton: false,
            }).then(() => {
                window.location.href = "http://localhost:8080/kantorcabang/dtt";
            });
        },
        error: function (error) {
            Swal.fire({
                icon: "error",
                title: "DTT",
                text: error.responseJSON.message,
                timer: 3000,
                showConfirmButton: false,
            }).then(() => {
                window.location.href = "http://localhost:8080/kantorcabang/dtt";
            });
        }
    });
});




