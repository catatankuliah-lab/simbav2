var idkantor = $('#idk').val();

$.ajax({
    url: "https://delapandelapanlogistics.com/api/wilayahkerja/" + idkantor,
    method: "GET",
    dataType: "json",
    success: function (data) {
        $('#namakantor').text(data[0].nama_kantor);
    },
    error: function (error) {
    },
});

$("#alokasi").change(function () {
    $.ajax({
        url: "https://delapandelapanlogistics.com/api/wilayahkerja/" + idkantor,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#namakantor').text(data[0].nama_kantor);
            let datagrafik = [];
            $.each(data, function (index, datapbpperkabupatenkota) {
                $.ajax({
                    type: 'get',
                    url: "https://delapandelapanlogistics.com/api/pbp/" + $('#alokasi').val() + "/dashboard/" + datapbpperkabupatenkota.nama_kabupaten_kota,
                    async: false,
                }).done(function (response) {
                    console.log(response);
                    $('#idgrafik').removeClass('d-none');
                    $('#idgrafik').empty();
                    if (response.datasj == null) {
                        var datasj = 0;
                    } else {
                        var datasj = response.datasj;
                    }
                    datagrafik.push({
                        'namakabupaten': response.datakabupaten,
                        'alokasi': response.dataalokasi * 10,
                        'tersalurkan': datasj,
                        'sisa': (response.dataalokasi * 10) - datasj,
                    });
                }).fail(function (error) {
                    console.log(error);
                    $('#idgrafik').addClass('d-none');
                });
            });
            $.each(datagrafik, function (index, bahan) {
                var containergrafik = "";
                containergrafik = containergrafik + "<div class='col-md-6 col-sm-12 my-4'>" +
                    "<h6 id='namakabupaten" + index + "' class='my-3 text-primary' style='font-weight: bolder;'></h6>" +
                    "<h6>Total alokasi yang harus disalurkan adalah : <span id='totalalokasi" + index + "' style='font-weight: bolder;'></span></h6>" +
                    "<div id='chart" + index + "'></div>";
                $("#idgrafik").append(containergrafik);
                var options = {
                    series: [parseInt(bahan.sisa), parseInt(bahan.tersalurkan)],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: ['Sisa', 'Disalurkan'],
                    responsive: [{
                        breakpoint: 400,
                        options: {
                            chart: {
                                width: 300
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
                $('#totalalokasi' + index).text(bahan.alokasi + " Kg");
            });
        },
        error: function (error) {
        },
    });
});
