// UPDATE HAK AKSES
var id = $("#id").val();
$.ajax({
    url: "http://localhost:8080/api/v1/hakakses/" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
        $("#nama").val(data.nama_hak_akses);
        $("#deskripsi").val(data.deskripsi_hak_akses);
    },
    error: function (error) {
        Swal.fire({
            icon: "error",
            title: "Hak Akses",
            text: error.responseJSON.messages.error,
            timer: 2000,
            showConfirmButton: false,
        }).then(() => {
            window.location.href = "http://localhost:8080/kantorpusat/akses";
        });
    },
});

function toUpperNama() {
    var inputanNama = $("#nama").val();
    $("#nama").val(inputanNama.toUpperCase());
}

function toUpperDeskripsi() {
    var inputanDeskripsi = $("#deskripsi").val();
    $("#deskripsi").val(inputanDeskripsi.toUpperCase());
}

$("#simpanHakAkses").click(function () {
    var inputanNama = $("#nama").val();
    var inputanDeskripsi = $("#deskripsi").val();

    var dataHakAkses = {
        nama_hak_akses: inputanNama,
        deskripsi_hak_akses: inputanDeskripsi,
    };

    $.ajax({
        url: "http://localhost:8080/api/v1/hakakses/" + id,
        type: "PUT",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(dataHakAkses),
        success: function (data) {
            Swal.fire({
                icon: "success",
                title: "Hak Akses",
                text: data.messages,
                timer: 2000,
                showConfirmButton: false,
            }).then(() => {
                window.location.href = "http://localhost:8080/kantorpusat/akses";
            });
        },
        error: function (error) {
            console.log(error.responseJSON.messages.nama_hak_akses);
            if (error.responseJSON.messages.nama_hak_akses) {
                Swal.fire({
                    icon: "error",
                    title: "Hak Akses",
                    text: error.responseJSON.messages.nama_hak_akses,
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Hak Akses!",
                    text: error.responseJSON.messages.deskripsi_hak_akses,
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        },
    });
});

// DELETE HAK AKSES
$("#deleteHakAkses").click(function () {
    Swal.fire({
        title: 'Hak Akses',
        text: 'Apakah Anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batalkan!',
        confirmButtonColor: '#526AE5',
        cancelButtonColor: '#FF4F70'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "http://localhost:8080/api/v1/hakakses/" + id,
                type: "DELETE",
                dataType: "json",
                success: function (data) {
                    Swal.fire({
                        icon: "success",
                        title: "Hak Akses",
                        text: data.messages,
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = "http://localhost:8080/kantorpusat/akses";
                    });
                },
                error: function (error) {
                    console.log(error.responseJSON.messages.nama_hak_akses);
                    if (error.responseJSON.messages.nama_hak_akses) {
                        Swal.fire({
                            icon: "error",
                            title: "Hak Akses",
                            text: error.responseJSON.messages.nama_hak_akses,
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hak Akses!",
                            text: error.responseJSON.messages.deskripsi_hak_akses,
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        }
    });
});