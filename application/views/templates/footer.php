<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Dibuat oleh: <a href="http://instagram.com/itujun" target="_blank">Mohammad Junaedi</a> &copy; Posyandu Mawar 2023</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>



<script src="<?= base_url('assets/') ?>js/jquery-3.5.1.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('assets/js/myscript.js') ?>"></script>

<script>
  $(document).ready(function() {
    // hitung usia
    $('#pilih_balita').change(function() {
      var selectedBalitaId = $(this).val();
      $.post('http://localhost/posyandumawar/knn/hitungusia', {
        balita_id: selectedBalitaId
      }, function(response) {
        $('#usia').val(response);
      });
    });
  });

  // flash hapus data 
  $('.tombolHapus').on('click', function(e) {

    e.preventDefault();

    const link = $(this).attr('href')
    const balita = $(this).data('namabalita')
    const nama = $(this).data('nama')
    const usia = $(this).data('usia')
    const bb = $(this).data('bb')
    const tb = $(this).data('tb')
    const bulan = $(this).data('bulan')
    const tahun = $(this).data('tahun')

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })

    if (balita) {
      swalWithBootstrapButtons.fire({
        title: 'Hapus data?',
        text: "Data balita dengan nama " + balita + " hendak dihapus?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Iya!',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Aksi gagal.',
            "Data balita dengan nama " + balita + " tidak terhapus.",
            'error'
          )
        }
      })
    } else if (usia) {
      swalWithBootstrapButtons.fire({
        title: 'Hapus data?',
        text: "Dataset dengan usia " + usia + " bulan, berat badan " + bb + " kg, dan tinggi badan " + tb + " cm hendak dihapus?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Iya!',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Aksi gagal.',
            "Dataset dengan usia " + usia + " bulan, berat badan " + bb + " kg, dan tinggi badan " + tb + " cm tidak terhapus.",
            'error'
          )
        }
      })
    } else if (nama) {
      swalWithBootstrapButtons.fire({
        title: 'Hapus data?',
        text: "Data ukur balita dengan nama " + nama + " pada bulan " + bulan + " tahun " + tahun + " hendak dihapus?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Iya!',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Aksi gagal.',
            "Data ukur balita dengan nama " + nama + " pada bulan " + bulan + " tahun " + tahun + " tidak terhapus.",
            'error'
          )
        }
      })
    }
  });
</script>

</body>

</html>