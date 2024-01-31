$(document).ready(function () {
    $.ajax({
        url: "http://localhost:8080/api/v1/akun/session",
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            getDataKantor(data.id_kantor);
        },
        error: function (error) {
            console.error("Gagal mengambil data sesi:", error);
        },
    });
});

function getDataKantor(idkantor) {
    $.ajax({
        url: "http://localhost:8080/api/v1/kantor/" + idkantor,
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            getWilayahKerja(idkantor);
        },
        error: function (error) {
            console.error("Gagal mengambil data sesi:", error);
        },
    });
}

function getWilayahKerja(idkantor) {
    $.ajax({
        url: "http://localhost:8080/api/v1/wilayahkerja/" + idkantor,
        method: "GET",
        dataType: "json",
        success: function (data) {
            let datadtt = [];
            $.each(data, function (index, datawilayahkerja) {
                $.ajax({
                    type: 'get',
                    url: "http://localhost:8080/api/v1/dtt/kabupatenkota/" + datawilayahkerja.kode_kabupaten_kota,
                    async: false,
                }).done(function (response) {
                    datadtt.push({
                        'namakabupaten': response[0].nama_kabupaten_kota,
                        'fix': response[0].fix,
                        'alokasi': response[0].alokasi,
                        'tersalurkan': response[0].tersalurkan,
                        'sisa': response[0].sisa,
                    });
                }).fail(function (error) {
                    console.log(error)
                });
            });

            $.each(datadtt, function (index, bahan) {
                var containergrafik = "";
                containergrafik = containergrafik + "<div class='col-md-6 col-sm-12 my-4'>" +
                    "<h6 id='namakabupaten" + index + "' class='my-3 text-primary' style='font-weight: bolder;'></h6>" +
                    "<h6>Total alokasi yang harus disalurkan adalah : <span id='totalalokasi" + index + "' style='font-weight: bolder;'></span></h6>" +
                    "<div id='chart" + index + "'></div>";
                $("#idgrafik").append(containergrafik);
                var options = {
                    series: [parseInt(bahan.alokasi), parseInt(bahan.tersalurkan)],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: ['Sisa', 'Disalurkan'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 320
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(document.querySelector("#chart" + index), options);
                chart.render();
                $('#namakabupaten' + index).text(bahan.namakabupaten);
                $('#totalalokasi' + index).text(bahan.fix + " Kg");
            });
        },
        error: function (error) {
            console.error("Gagal mengambil data sesi:", error);
        },
    });
}