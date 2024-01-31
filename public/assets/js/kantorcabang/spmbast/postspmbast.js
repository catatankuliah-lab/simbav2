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
    url: 'http://localhost:8080/api/v1/spmbast/sessionya',
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
                "<option data-id_alokasi='" + dataalokasi.id_alokasi + "' value='" +
                dataalokasi.kode_alokasi +
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
            $("#pilihgudang").val(data.nama_gudang);
            idkantor = data.id_kantor;
            getWilayahKerja(data.id_kantor);
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function cekNomorSPM() {
    idalokasi = $('#alokasi option:selected').data('id_alokasi');
    kodealokasi = $("#alokasi").find(":selected").val();
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/ceknomorspm/" + idakun + "/" + idalokasi,
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('#tanggal_pembuatan').val(data[0].tanggal_pembuatan);
            $('#nomor_so').val(data[0].nomor_so);
            $('#nomor_do').val(data[0].nomor_do);
            $('#nomor_lo').val(data[0].nomor_lo);
            $('#pilihmobil').val(data[0].nopol_mobil);
            $('#pilihdriver').val(data[0].nama_driver);
            $('#nomordriver').val(data[0].nomor_driver);
            $('#nomor_spm').val(data[0].nomor_spm);
            $('#alokasi').prop('disabled', true);
            tampilkanDataMuat();
        },
        error: function (error) {
            generateNomorSPM();
            $('#alokasi').prop('disabled', true);
        },
    });
}

function generateNomorSPM() {
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/getnomorspm/" + idakun + "/" + idalokasi,
        type: "GET",
        dataType: "json",
        success: function (data) {
            var nomorspm = "LO-" + kodealokasi + idkantor + idgudang + parseInt(data.kode + 1);
            $("#nomor_spm").val(nomorspm);
        },
        error: function (error) {
            console.log('error : ', error);
            var nomorspm = "LO-" + kodealokasi + idkantor + idgudang + "1";
            $("#nomor_spm").val(nomorspm);
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
    const kabupatenkotadipilih = $("#pilihkabupatenkota").find(":selected").val();
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

function preprosesSPMBAST() {
    const kecamatandipilih = $("#pilihkecamatan").find(":selected").val();
    $.ajax({
        url: "http://localhost:8080/api/v1/desakelurahan/kecamatan/" + kecamatandipilih,
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
            datadtt.empty();
            $.each(data, function (index, dtt) {
                var dnone = "";
                var listdtt = "";
                if (kodealokasi == "880124") {
                    if (dtt.alokasi_tahap_1 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_1 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                } else if (kodealokasi == "880224") {
                    if (dtt.alokasi_tahap_2 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_2 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                } else if (kodealokasi == "880324") {
                    if (dtt.alokasi_tahap_3 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_3 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                } else if (kodealokasi == "880424") {
                    if (dtt.alokasi_tahap_4 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_4 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                } else if (kodealokasi == "880524") {
                    if (dtt.alokasi_tahap_5 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_5 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                } else if (kodealokasi == "880624") {
                    if (dtt.alokasi_tahap_6 == 0) {
                        dnone = "d-none";
                    }
                    listdtt = listdtt + "<tr class='" + dnone + "'>" +
                        "<td>" + dtt.nama_kabupaten_kota + "</td>" +
                        "<td>" + dtt.nama_kecamatan + "</td>" +
                        "<td>" + dtt.nama_desa_kelurahan + "</td>" +
                        "<td>" +
                        "<input id='alokasi" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + dtt.alokasi_tahap_6 + "' ></td>" +
                        "<td>" +
                        "<input id='input" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cek(" + index + ")'></td>";
                }
                listdtt = listdtt + "<td class='text-center'>" +
                    "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='proses(" + dtt.id_dtt + "," + index + ")'>" +
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

function proses(iddtt, index) {
    var dataspmtopost = {
        'id_akun': idakun,
        'id_dtt': iddtt,
        'id_alokasi': idalokasi,
        'tanggal_pembuatan': $("#tanggal_pembuatan").val(),
        'nomor_spm': $('#nomor_spm').val(),
        'nomor_so': $('#nomor_so').val(),
        'nomor_lo': $('#nomor_lo').val(),
        'nomor_do': $('#nomor_do').val(),
        'jumlah_penyaluran': parseInt($("#input" + index).val()),
        'jumlah_alokasi': parseInt($("#alokasi" + index).val()),
        'nopol_mobil': $('#pilihmobil').val(),
        'nama_driver': $('#pilihdriver').val(),
        'nomor_driver': $('#nomordriver').val(),
        'status_spm': 'DIPROSES',
        'kode_alokasi': $('#alokasi option:selected').val(),
    };
    console.log(dataspmtopost);
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/dtt/" + iddtt,
        type: "GET",
        dataType: "json",
        success: function (data) {
            idspm = data.id_spmbast;
            $.ajax({
                url: "http://localhost:8080/api/v1/spmbast/" + idspm,
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(dataspmtopost),
                success: function (data) {
                    Swal.fire({
                        icon: "success",
                        title: "Loading Order (LO)",
                        text: data.messages,
                        timer: 3000,
                        showConfirmButton: false,
                    });
                    tampilkanDataMuat();
                    preprosesSPMBAST();
                },
                error: function (error) {
                    if (error.responseJSON.messages.jumlah_penyaluran != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.jumlah_penyaluran,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        },
        error: function (error) {
            $.ajax({
                url: "http://localhost:8080/api/v1/spmbast",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(dataspmtopost),
                success: function (data) {
                    Swal.fire({
                        icon: "success",
                        title: "Loading Order (LO)",
                        text: data.messages,
                        timer: 3000,
                        showConfirmButton: false,
                    });
                    tampilkanDataMuat();
                    preprosesSPMBAST();
                },
                error: function (error) {
                    console.log('error : ', error);
                    if (error.responseJSON.messages.tanggal_pembuatan != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.tanggal_pembuatan,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    if (error.responseJSON.messages.nama_driver != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.nama_driver,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    if (error.responseJSON.messages.nopol_mobil != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.nopol_mobil,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    if (error.responseJSON.messages.nomor_driver != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.nomor_driver,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    if (error.responseJSON.messages.jumlah_penyaluran != null) {
                        Swal.fire({
                            icon: "error",
                            title: "Loading Order (LO)",
                            text: error.responseJSON.messages.jumlah_penyaluran,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        },
    });
}

function tampilkanDataMuat() {
    $("#simpanspm").removeClass("d-none");
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/spm/" + $('#nomor_spm').val(),
        type: "GET",
        dataType: "json",
        success: function (data) {
            datamuat.empty();
            var total = 0;
            var listspm = "";
            $.each(data, function (index, spm) {
                total = total + parseInt(spm.jumlah_penyaluran);
                listspm =
                    "<tr>" +
                    "<td>" + spm.nama_kabupaten_kota + "</td>" +
                    "<td>" + spm.nama_kecamatan + "</td>" +
                    "<td>" + spm.nama_desa_kelurahan + "</td>";
                if (kodealokasi == "880124") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                } else if (kodealokasi == "880224") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                } else if (kodealokasi == "880324") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                } else if (kodealokasi == "880424") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                } else if (kodealokasi == "880524") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                } else if (kodealokasi == "880624") {
                    listspm = listspm + "<td>" +
                        "<input id='alokasidata" + index + "' type='text' readonly style='border:none; background-color:transparent !important; width:75px' placeholder='0' value='" + spm.jumlah_alokasi + "' ></td>" +
                        "<td>" +
                        "<input value='" + spm.jumlah_penyaluran + "' id='inputdata" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px' placeholder='0' oninput='cekDataMuat(" + index + ")'>" +
                        "<input hidden value='" + spm.jumlah_penyaluran + "' id='inputdatalama" + index + "' type='number' style='border:none; background-color:transparent !important; width:75px'>" +
                        "</td>"
                }
                listspm = listspm + "<td class='text-center'>" +
                    "<a type='button' class='text-primary' style='border-radius: 5px;' onclick='prosesupdate(" + spm.id_spmbast + "," + spm.id_dtt + "," + index + ")'>" +
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
            console.error("Error:", error);
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

function prosesupdate(idspmupdate, iddttupdate, index) {
    var sementara = parseInt($("#inputdatalama" + index).val());
    var dataudpate = 0;
    if ($("#inputdata" + index).val() === "") {
        $("#inputdata" + index).val("");
    } else {
        var inputpenyaluran = parseInt($("#inputdata" + index).val());
    }
    if (inputpenyaluran == sementara) {
    } else if (inputpenyaluran == 0) {
        dataudpate = sementara;
        hapusSPM(idspmupdate, iddttupdate, dataudpate);
    } else if (inputpenyaluran > sementara) {
        dataudpate = -(inputpenyaluran - sementara);
        udpdateSPM(idspmupdate, iddttupdate, dataudpate, inputpenyaluran);
    } else {
        dataudpate = sementara - inputpenyaluran;
        udpdateSPM(idspmupdate, iddttupdate, dataudpate, inputpenyaluran);
    }
}

function hapusSPM(idspmupdate, iddttupdate, dataudpate) {
    var dataspmtodelete = {
        'jumlah_penyaluran': dataudpate,
        'iddtt': iddttupdate,
        'kode_alokasi': $('#alokasi option:selected').val(),
    };
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/delete/" + idspmupdate,
        type: "DELETE",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(dataspmtodelete),
        success: function (data) {
            Swal.fire({
                icon: "success",
                title: "Loading Order (LO)",
                text: data.messages,
                timer: 3000,
                showConfirmButton: false,
            });
            preprosesSPMBAST();
            tampilkanDataMuat();
        },
        error: function (error) {
        },
    });
}

function udpdateSPM(idspmupdate, iddttupdate, dataudpate, databaru) {
    var dataspmtodelete = {
        'jumlah_penyaluran': dataudpate,
        'jumlah_penyaluran_baru': databaru,
        'iddtt': iddttupdate,
        'kode_alokasi': $('#alokasi option:selected').val(),
    };
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/spm/" + idspmupdate,
        type: "PUT",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(dataspmtodelete),
        success: function (data) {
            Swal.fire({
                icon: "success",
                title: "Loading Order (LO)",
                text: data.messages,
                timer: 3000,
                showConfirmButton: false,
            });
            preprosesSPMBAST();
            tampilkanDataMuat();
        },
        error: function (error) {
        },
    });
}

$("#simpanspm").on("click", function () {
    var nomorspmbast = $('#nomor_spm').val();
    var dataprosesspm = {
        "nomorspmbast": nomorspmbast
    }
    $.ajax({
        url: "http://localhost:8080/api/v1/spmbast/spm/status/" + nomorspmbast,
        type: "PUT",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(dataprosesspm),
        success: function (data) {
            console.log(data);
            Swal.fire({
                icon: "success",
                title: "Loading Order (LO)",
                text: data.messages,
                timer: 3000,
                showConfirmButton: false,
            }).then(() => {
                window.location.href = "http://localhost:8080/gudang/spmbast";
            });
        },
        error: function (error) {
            console.log('error:', error);
        },
    });
});

