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
                    async: false, //add
                }).done(function (response) {
                    datadtt.push({
                        'namakabupaten': response[0].nama_kabupaten_kota,
                        'jumlahperkabupaten': response[0].jumlahperkabupaten
                    });
                }).fail(function (error) {
                    console.log(error)
                });
            });
            var datanya = [];
            var kategorinya = [];
            $.each(datadtt, function (index, databahan) {
                datanya.push(databahan.jumlahperkabupaten);
                kategorinya.push(databahan.namakabupaten);
            });
            console.log(datadtt);
            var options = {
                series: [{
                    data: datanya
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function (chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: kategorinya,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        },
        error: function (error) {
            console.error("Gagal mengambil data sesi:", error);
        },
    });
}