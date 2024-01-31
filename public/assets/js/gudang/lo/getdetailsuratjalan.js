$.ajax({
  url: "http://localhost:8080/api/v1/spmbast/suratjalan/" + $('#idspmbast').val(),
  type: "GET",
  dataType: "json",
  success: function (data) {
    console.log(data);
    $('#tanggalpembuatan').val(data.tanggal_pembuatan);
    $('#nopoldriver').val(data.nopol_mobil + ' / ' + data.nama_driver + ' (' + data.nomor_driver + ')');
    $('#kabupaten').val(data.nama_kabupaten_kota);
    $('#kecamatan').val(data.nama_kecamatan);
    $('#desakelurahan').val(data.nama_desa_kelurahan);
    $('#iddtt').val(data.id_dtt);
    $('#totalpenyerahan').val(data.jumlah_penyaluran + ' Kg');
    if (data.file_surat_jalan != null) {
      $('#formsj').addClass('d-none');
    }
    if (data.file_penyerahan != null) {
      $('#formdriver').addClass('d-none');
    }
  },
  error: function (error) {
    console.error("Error:", error);
  },
});

$("#filebuktisj").on('change', function () {
  $.ajax({
    url: 'http://localhost:8080/api/v1/spmbast/suratjalan/' + $('#idspmbast').val(),
    type: "GET",
    dataType: "json",
    success: function (data) {
      var formData = new FormData($('#uploadForm')[0]);
      var additionalData = {
        'nomor_spm': $('#nomorlo').val(),
        'id_spmbast': $('#idspmbast').val(),
        'id_dtt': $('#iddtt').val(),
        'nama_alokasi': data.nama_alokasi,
        'nama_provinsi': data.nama_provinsi,
        'nama_kantor': data.nama_kantor,
        'jumlah_penyaluran': data.jumlah_penyaluran,
        'nama_gudang': data.nama_gudang,
      };
      console.log(additionalData);
      formData.append('additionalData', JSON.stringify(additionalData));
      $.ajax({
        url: 'http://localhost:8080/api/v1/spmbast/uploadsj',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
          if (response.status == "200") {
            Swal.fire({
              icon: "success",
              title: "Surat Jalan",
              text: response.message,
              timer: 3000,
              showConfirmButton: false,
            });
            $('#formsj').addClass('d-none');
          } else {
            Swal.fire({
              icon: "error",
              title: "Surat Jalan",
              text: "Berkas Surat Jalan gagal diupload (File harus berupa .jpg .jpeg atau .png)",
              timer: 3000,
              showConfirmButton: false,
            });
          }
        },
        error: function (error) {
          Swal.fire({
            icon: "error",
            title: "Surat Jalan",
            text: "Berkas Surat Jalan gagal diupload (File harus berupa .jpg .jpeg atau .png)",
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

$("#filebuktidriver").on('change', function () {
  $.ajax({
    url: 'http://localhost:8080/api/v1/spmbast/suratjalan/' + $('#idspmbast').val(),
    type: "GET",
    dataType: "json",
    success: function (data) {
      var formData = new FormData($('#uploadForm2')[0]);
      var additionalData = {
        'nomor_spm': $('#nomorlo').val(),
        'id_spmbast': $('#idspmbast').val(),
        'nama_alokasi': data.nama_alokasi,
        'nama_provinsi': data.nama_provinsi,
        'nama_kantor': data.nama_kantor,
        'nama_gudang': data.nama_gudang,
      };
      formData.append('additionalData', JSON.stringify(additionalData));
      $.ajax({
        url: 'http://localhost:8080/api/v1/spmbast/uploadsjdriver',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
          if (response.status == "200") {
            Swal.fire({
              icon: "success",
              title: "Surat Jalan",
              text: response.message,
              timer: 3000,
              showConfirmButton: false,
            });
            $('#formdriver').addClass('d-none');
          } else {
            Swal.fire({
              icon: "error",
              title: "Surat Jalan",
              text: "Berkas Surat Jalan gagal diupload (File harus berupa .jpg .jpeg atau .png)",
              timer: 3000,
              showConfirmButton: false,
            });
          }
        },
        error: function (error) {
          Swal.fire({
            icon: "error",
            title: "Surat Jalan",
            text: "Berkas Surat Jalan gagal diupload (File harus berupa .jpg .jpeg atau .png)",
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