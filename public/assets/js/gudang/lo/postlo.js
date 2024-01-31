var idgudang = "";
var idkantor = "";
var idakun = "";
var idalokasi = "";
var idspm = "";
var kodekabupatenkota = "";
var kodekecamatan = "";
var kodealokasi = "";
var alokasitahap = "";
const datadtt = $("#datadtt");
const datamuat = $("#datamuat");

$.ajax({
    url: 'http://localhost:8080/api/v1/lo/sessionya',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
        idgudang = data.id_gudang;
        idakun = data.id_akun;
        getDetailGudang(data.id_gudang);
    },
    error: function (error) {
        console.error('Gagal mengambil data sesi:', error);
    }
});

$.ajax({
    url: "http://localhost:8080/api/v1/alokasi",
    type: "GET",
    dataType: "json",
    success: function (data) {
        const alokasi = $("#alokasi");
        $.each(data, function (index, dataalokasi) {
            const listalokasi =
                "<option value='" +
                dataalokasi.id_alokasi +
                "'>" +
                dataalokasi.nama_alokasi +
                "</option>";
            alokasi.append(listalokasi);
        });
    },
    error: function (error) {
        console.error("Error:", error);
    },
});

function getDetailGudang(idgudang) {
    $.ajax({
        url: "http://localhost:8080/api/v1/gudang/" + idgudang,
        type: "GET",
        dataType: "json",
        success: function (data) {
            $("#gudang").val(data.nama_gudang);
            idkantor = data.id_kantor;
            getWilayahKerja(data.id_kantor);
        },
        error: function (error) {
        },
    });
}

function cekNomorLO() {
    kodealokasi = $("#alokasi").find(":selected").val();
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/ceknomorlo/" + idakun,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#tanggal_pembuatan').val(data[0].tanggal_pembuatan);
            $('#nomor_so').val(data[0].nomor_so);
            $('#nomor_do').val(data[0].nomor_do);
            $('#nomor_lo').val(data[0].nomor_lo);
            $('#nomor_wo').val(data[0].nomor_wo);
            $('#pilihmobil').val(data[0].nopol_mobil);
            $('#pilihdriver').val(data[0].nama_driver);
            $('#nomordriver').val(data[0].nomor_driver);
            $('#alokasi').prop('disabled', true);
            tampilkanDataMuat();
        },
        error: function (error) {
            console.log("error generate nomor lo : ", error);
            generateNomorLo();
            $('#alokasi').prop('disabled', true);
        },
    });
}

function generateNomorLo() {
    kodealokasi = $("#alokasi").find(":selected").val();
    var kodealokasijadi = kodealokasi;
    if (kodealokasijadi < 10) {
        kodealokasijadi = "0" + kodealokasijadi;
    }
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/getnomorlo/" + idakun,
        type: "GET",
        dataType: "json",
        success: function (data) {
            var idkantorjadi = idkantor;
            if (idkantorjadi < 10) {
                idkantorjadi = "00" + idkantorjadi;
            } else if (idkantorjadi < 100) {
                idkantorjadi = "0" + idkantorjadi;
            }
            var idgudangjadi = idgudang;
            if (idgudangjadi < 10) {
                idgudangjadi = "00" + idgudangjadi;
            } else if (idgudangjadi < 100) {
                idgudangjadi = "0" + idgudangjadi;
            }
            var nomorlo = "LO-88LOGISTICS" + kodealokasijadi + idkantorjadi + idgudangjadi + "-" + parseInt(data.kode + 1);
            $("#nomor_lo").val(nomorlo);
        },
        error: function (error) {
            var idkantorjadi = idkantor;
            if (idkantorjadi < 10) {
                idkantorjadi = "00" + idkantorjadi;
            } else if (idkantorjadi < 100) {
                idkantorjadi = "0" + idkantorjadi;
            }
            var idgudangjadi = idgudang;
            if (idgudangjadi < 10) {
                idgudangjadi = "00" + idgudangjadi;
            } else if (idgudangjadi < 100) {
                idgudangjadi = "0" + idgudangjadi;
            }
            var nomorlo = "LO-88LOGISTICS" + kodealokasijadi + idkantorjadi + idgudangjadi + "-1";
            $("#nomor_lo").val(nomorlo);
        },
    });
}

function getWilayahKerja(idkantor) {
    datadtt.empty();
    $.ajax({
        url: "http://localhost:8080/api/v1/wilayahkerja/" + idkantor,
        type: "GET",
        dataType: "json",
        success: function (data) {
            const kabupatenkota = $("#pilihkabupatenkota");
            $.each(data, function (index, listkabupatenkota) {
                const listoptionkabupatenkota =
                    "<option value='" +
                    listkabupatenkota.nama_kabupaten_kota +
                    "'>" +
                    listkabupatenkota.nama_kabupaten_kota +
                    "</option>";
                kabupatenkota.append(listoptionkabupatenkota);
            });
        },
        error: function (error) {
        },
    });
}

function showKecamatan() {
    const kabupatenkotadipilih = $("#pilihkabupatenkota").find(":selected").val();
    console.log(kabupatenkotadipilih);
    datadtt.empty();
    const kecamatan = $("#pilihkecamatan");
    if (kabupatenkotadipilih == 0) {
        kecamatan.empty();
        var listoptionkecamatan =
            "<option value='0'>Pilih Kecamatan</option>";
        kecamatan.append(listoptionkecamatan);
    }
    $.ajax({
        url: "http://localhost:8080/api/v1/kecamatan/kabupatenkota/" + kabupatenkotadipilih,
        type: "GET",
        dataType: "json",
        success: function (data) {
            kecamatan.empty();
            var listoptionkecamatan =
                "<option value='0'>Pilih Kecamatan</option>";
            kecamatan.append(listoptionkecamatan);
            $.each(data, function (index, listkecamatan) {
                listoptionkecamatan =
                    "<option value='" +
                    listkecamatan.nama_kecamatan +
                    "'>" +
                    listkecamatan.nama_kecamatan +
                    "</option>";
                kecamatan.append(listoptionkecamatan);
            });
        },
        error: function (error) {
        },
    });
}

function showDesaKelurahan() {
    const kecamatandipilih = $("#pilihkecamatan").find(":selected").val();
    $.ajax({
        url: "http://localhost:8080/api/v1/pbpjanuari/" + kecamatandipilih,
        type: "GET",
        dataType: "json",
        success: function (data) {
            datadtt.empty();
            $.each(data, function (index, dtt) {
                var dnone = "";
                var listdtt = "";
                if (dtt.jumlah_alokasi == 0) {
                    dnone = "d-none";
                }
                listdtt = listdtt + "<tr class='" + dnone + "'>" +
                    "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                    "<td>" + dtt.nama_kecamatan + "</td>" +
                    "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                    "<td>" +
                    "<input hidden id='alokasifix" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.jumlah_alokasi + "' >" +
                    "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.jumlah_alokasi + "' ></td>" +
                    "<td>" +
                    "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>" +
                    "<td class='text-center'>" +
                    "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='proses(" + dtt.id_pbp_januari + "," + index + ")'>" +
                    "<i class='fas fa-plus'></i>" +
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

function cek(index) {
    var alokasi = parseInt($("#alokasi" + index).val());
    if ($("#input" + index).val() === "") {
        $("#input" + index).val("");
    } else {
        var inputpenyaluran = parseInt($("#input" + index).val());
    }
    if (inputpenyaluran > alokasi) {
        $("#input" + index).val(alokasi);
    }
}

function proses(idpbp, index) {
    var nomor_surat_jalan = $('#nomor_lo').val();
    var nomor_surat_jalan_tambahan = "";

    $.ajax({
        type: 'get',
        url: "http://localhost:8080/api/v1/lo/suratjalan/ceknomorlo/" + nomor_surat_jalan + "/" + idpbp,
        async: false,
    }).done(function (response) {
        nomor_surat_jalan_tambahan = response.nomorsuratjalan;
    }).fail(function (error) {
        console.log(error)
    });

    nomor_surat_jalan_tambahan = parseInt(nomor_surat_jalan_tambahan) + 1;

    nomor_surat_jalan = "SJ" + nomor_surat_jalan.slice(2) + "-" + nomor_surat_jalan_tambahan;

    var datapostlo = {
        'id_gudang': idgudang,
        'id_kantor': idkantor,
        'id_akun': idakun,
        'nomor_lo': $('#nomor_lo').val(),
        'tanggal_muat': $("#tanggal_pembuatan").val(),
        'nama_driver': $("#namadriver").val(),
        'nomor_driver': $("#nomordriver").val(),
        'nomor_mobil': $("#nopolmobil").val(),
        'id_pbp': idpbp,
        'jumlah_penyaluran_januari': $('#input' + index).val(),
        'alokasifix': $('#alokasifix' + index).val(),
        'nomor_do': $('#nomor_do').val(),
        'nomor_so_bulog': $('#nomor_so').val(),
        'nomor_wo': $('#nomor_wo').val(),
        'nomor_surat_jalan': nomor_surat_jalan,
    };
    console.log(datapostlo);
    if ($('#alokasi').val() == "1") {
        $.ajax({
            url: "http://localhost:8080/api/v1/lo/pbpjanuari/prosestambahdokumenmuat/" + idpbp,
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(datapostlo),
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    title: "Loading Order (LO)",
                    text: "Data Loading Order (LO) berhasil ditambahkan.",
                    showConfirmButton: false,
                });
                tampilkanDataMuat();
            },
            error: function (error) {
                console.log("ERROR ANJING : ", error);
                Swal.fire({
                    icon: "error",
                    title: "Loading Order (LO)",
                    text: "Mohon isi terlebih dahulu data tanggal pembuatan, nama driver, nomor telpon driver dan nopol mobil.",
                    showConfirmButton: false,
                });
            },
        });
    }
}

function tampilkanDataMuat() {
    $("#simpanspm").removeClass("d-none");
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/getdatasuratjalan/" + $('#nomor_lo').val(),
        type: "GET",
        dataType: "json",
        success: function (data) {
            datamuat.empty();
            console.log(data);
            var total = 0;
            var listspm = "";
            $.each(data, function (index, spm) {
                showDesaKelurahan();
                total = total + parseInt(spm.total_januari);
                listspm =
                    "<tr>" +
                    "<td>" + spm.nama_kabupaten_kota + "</td>" +
                    "<td>" + spm.nama_kecamatan + "</td>" +
                    "<td>" + spm.nama_desa_kelurahan + "</td>" +
                    "<td><input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                    "<td>" +
                    "<input readonly value='" + spm.total_januari + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                    "<input hidden value='" + spm.jumlah_alokasi + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='hapusLo(" + spm.id_pbp + "," + index + ")'>" +
                    "<i class='fas fa-edit'></i>" +
                    "</a>" +
                    "</td>" +
                    "</tr >";
                datamuat.append(listspm);
            });
            listspm = "";
            listspm = "<tr><td colspan='4' style='text-align: center; font-weight:bold'>Total</td><td style='font-weight:bold'>" + total + "</td><td></td></tr>"
            datamuat.append(listspm);
            $('#totalpengiriman').val(total);
        },
        error: function (error) {
            datamuat.empty();
        },
    });
}

function cekDataMuat(index) {
    var alokasi = parseInt($("#alokasidata" + index).val());
    if ($("#inputdata" + index).val() === "") {
        $("#inputdata" + index).val("");
    } else {
        var inputpenyaluran = parseInt($("#inputdata" + index).val());
    }
    if (inputpenyaluran > alokasi) {
        $("#inputdata" + index).val(alokasi);
    }
}

function hapusLo(idpbp, index) {
    var datahapus = {
        'bahanhapus': $("#inputdata" + index).val(),
        'nomor_lo': $('#nomor_lo').val(),
        'id_pbp': idpbp,
        'alokasifix': $('#alokasidata' + index).val(),
    };
    console.log(datahapus);
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/pbpjanuari/delete/" + $('#nomor_lo').val() + "/" + idpbp,
        type: "DELETE",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(datahapus),
        success: function (data) {
            showDesaKelurahan();
            tampilkanDataMuat();
            Swal.fire({
                icon: "success",
                title: "Loading Order (LO)",
                text: "Loading Order (LO) Berhasil Dihapus",
                timer: 3000,
                showConfirmButton: false,
            });
        },
        error: function (error) {
        },
    });
}

$("#simpanspm").on("click", function () {
    $.ajax({
        url: "http://localhost:8080/api/v1/lo/getsuratjalannynomorLo/" + $('#nomor_lo').val(),
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var datasimpan = {
                'status_dokumen_muat': "DIPRINT"
            };
            $.ajax({
                url: "http://localhost:8080/api/v1/lo/udpatestatus/" + data.id_dokumen_muat,
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(datasimpan),
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "Loading Order (LO)",
                        text: "Loading Order (LO) berhasil dibuat.",
                        timer: 3000,
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = "http://localhost:8080/gudang/lo";
                    });
                },
                error: function (error) {
                    console.log('error:', error);
                },
            });
        },
        error: function (error) {
            console.log(data);
        },
    });
});

