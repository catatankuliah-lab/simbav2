// CREATE HAK AKSES
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
    // console.log(dataHakAkses);
    $.ajax({
        url: "http://localhost:8080/api/v1/hakakses",
        type: "POST",
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