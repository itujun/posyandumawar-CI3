$(document).ready(function() {

    // flash tambah data
    const flashData = $('.flash-data').data('flashdata1');
    if (flashData) {
        if (flashData.includes('berhasil')) {
            Swal.fire(
                'Berhasil!',
                '' + flashData,
                'success'
            )
        } else if (flashData.includes('Tidak ada')) {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '' + flashData,
            })
        }
    }

    $('.select2').select2({
        theme: 'bootstrap'
    });
    $('#dataTable').DataTable();

    // Modal detail balita
    $('.detailModalBalita').on('click', function() {
        // Mengambil ID balita dari atribut data-id
        var idBalita = $(this).closest('a').data('id');
        $.ajax({
            url: 'http://localhost/posyandumawar/balita/detailbalita/' + idBalita,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                $('#nikbalita').text(response.nik); // Mengisi nilai NIK balita ke elemen dengan ID 'nikbalita'
                $('#namabalita').text(response.nama);

                // Menginisasi jenis kelamin
                var jk = response.jenis_kelamin;
                if (jk == 'P') {
                    jk = 'Perempuan';
                } else if (jk == 'L') {
                    jk = 'Laki-laki';
                } else {
                    jk = 'Tidak diketahui';
                }

                $('#jkbalita').text(jk);
                $('#tgllahirbalita').text(response.tgl_lahir);
                $('#ibubalita').text(response.nama_ibu);
                $('#alamatbalita').text(response.alamat);
            }
        })
    })

});