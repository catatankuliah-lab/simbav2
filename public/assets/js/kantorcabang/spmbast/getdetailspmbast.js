$.ajax({
  url: "http://localhost:8080/api/v1/spmbast/detail/" + $('#nomorlo').val(),
  type: "GET",
  dataType: "json",
  success: function (data) {
    var lengkap = true;
    $('#tanggalpembuatan').val(data[0].tanggal_pembuatan);
    $('#nopoldriver').val(data[0].nopol_mobil + " / " + data[0].nama_driver + " (" + data[0].nomor_driver + ")");
    $('#tanggalpembuatan').val(data[0].tanggal_pembuatan);
    const datalo = $('#datalo');
    if (data[0].file_spmbast != null) {
      $('#formupload').addClass('d-none');
    }
    var total = 0;
    $.each(data, function (index, spm) {
      total = total + parseInt(spm.jumlah_penyaluran);
      if (spm.file_spmbast != null && spm.file_surat_jalan && spm.file_penyerahan != null) {
        lengkap = true;
      } else {
        lengkap = false;
      }
      if (lengkap == false) {
        $('#lengkap').addClass('d-none');
      }
      var listspm =
        "<tr>" +
        "<td>" +
        parseInt(index + 1) +
        "</td>" +
        "<td>" +
        spm.nama_kabupaten_kota +
        "</td>" +
        "<td>" +
        spm.nama_kecamatan +
        "</td>" +
        "<td>" +
        spm.nama_desa_kelurahan +
        "</td>" +
        "<td>" +
        spm.jumlah_penyaluran +
        "</td>" +
        "<td class='text-center'>" +
        "<a href='http://localhost:8080/gudang/spmbast/suratjalan/" +
        spm.id_spmbast +
        "' type='button' class='text-primary' style='border-radius: 5px;'>" +
        "<i class='fas fa-search-plus'></i>" +
        "</a>" +
        "</td>" +
        "</tr >";
      datalo.append(listspm);
    });
    listspm = "<tr><td colspan='4' style='text-align: center; font-weight:bold'>Total</td><td style='font-weight:bold'>" + total + "</td><td></td></tr>"
    datalo.append(listspm);
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

$("#filebuktilo").on('change', function () {
  $.ajax({
    url: 'http://localhost:8080/api/v1/spmbast/detail/' + $('#nomorlo').val(),
    type: "GET",
    dataType: "json",
    success: function (data) {
      var formData = new FormData($('#uploadForm')[0]);
      var additionalData = {
        'nomor_spm': $('#nomorlo').val(),
        'nama_alokasi': data[0].nama_alokasi,
        'nama_provinsi': data[0].nama_provinsi,
        'nama_kantor': data[0].nama_kantor,
        'nama_gudang': data[0].nama_gudang,
      };
      formData.append('additionalData', JSON.stringify(additionalData));
      $.ajax({
        url: 'http://localhost:8080/api/v1/spmbast/uploadspm',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
          if (response.status == "200") {
            Swal.fire({
              icon: "success",
              title: "Loading Order (LO)",
              text: response.message,
              timer: 3000,
              showConfirmButton: false,
            });
            $('#formupload').addClass('d-none');
          } else {
            Swal.fire({
              icon: "error",
              title: "Loading Order (LO)",
              text: "Berkas Loading Order (LO) gagal diupload (File harus berupa .jpg .jpeg atau .png)",
              timer: 3000,
              showConfirmButton: false,
            });
          }
        },
        error: function (error) {
          Swal.fire({
            icon: "error",
            title: "Loading Order (LO)",
            text: "Berkas Loading Order (LO) gagal diupload (File harus berupa .jpg .jpeg atau .png)",
            timer: 3000,
            showConfirmButton: false,
          });
        }
      });
    },
    error: function (error) {
      console.log("ERROR : ", error);
    }
  });
});