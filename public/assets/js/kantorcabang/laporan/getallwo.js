var idkantor = $("#kantor").val();


function pilihtanggal() {
    $.ajax({
        url:
            "https://delapandelapanlogistics.com/api/wo/" +
            $("#alokasi").val() +
            "/tanggal",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const pilihtanggal = $("#pilihtanggal");
            $.each(data.data, function (index, tanggal) {
                const listTanggal =
                    "<option value='" +
                    tanggal.tanggal_muat +
                    "'>" +
                    tanggal.tanggal_muat +
                    "</option>";
                pilihtanggal.append(listTanggal);
            });
        },
        error: function (error) {
            console.error("ERROR TANGGAL : ", error);
        },
    });
}

$("#alokasi").on("change", function () {
    pilihtanggal();
});

$("#tampilkan").on("click", function () {
    if ($("#alokasi").val() === null || $("#pilihtanggal").val() === null) {
        Swal.fire({
            icon: "warning",
            title: "Peringatan!",
            text: "Anda harus memilih alokasi dan Tanggal terlebih dahulu",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
        });
    } else {
        $.ajax({
            url:
                "https://delapandelapanlogistics.com/api/wo/" +
                $("#alokasi").val() +
                "/getallwo/" +
                $("#pilihtanggal").val(),
            method: "GET",
            dataType: "json",
            success: function (data) {
                console.log("WO Ditemukan : ", data);
                $("#filterSearch").removeClass("d-none");
                $("#tablelo").removeClass("d-none");
                $("#hilang").removeClass("d-none");
                if ($.fn.DataTable.isDataTable("#tablelo")) {
                    $("#tablelo").DataTable().destroy();
                }
                var datanya = [];
                $.each(data.data, function (index, wo) {
                    datanya.push({
                        tanggal_muat: wo.tanggal_muat,
                        gudang: wo.nama_gudang,
                        nomor_wo: wo.nomor_wo,
                        link:
                            "https://delapandelapanlogistics.com/itkantorcabang/wo/" +
                            $("#alokasi").val() +
                            "/downloadwo/" +
                            wo.kode_wo,
                    });
                });
                $("#tablelo").DataTable({
                    paging: true,
                    info: false,
                    language: {
                        paginate: {
                            next: ">",
                            previous: "<",
                        },
                    },
                    data: datanya,
                    columns: [
                        { data: "tanggal_muat" },
                        { data: "gudang" },
                        { data: "nomor_wo" },
                        {
                            data: "link",
                            render: function (data, type, row, meta) {
                                return (
                                    "<a href=" +
                                    data +
                                    " type='button' class='text-danger' style='border-radius: 5px;'>" +
                                    "<i class='fas fa-download'></i></a>"
                                );
                            },
                            className: "text-center",
                        },
                    ],
                });
            },
            error: function (error) {
                console.log("Error Semua LO : ", error);
                datalo.empty();
                console.log(error);
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan!",
                    text:
                        "Data Alokasi Bulan " +
                        $("#alokasi option:selected").text() +
                        " Tidak Ditemukan",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });

                $("#filterSearch").addClass("d-none");
                $("#tabelhilangdulu").addClass("d-none");
                $("#tombolDownload").addClass("d-none");
            },
        });
    }
})