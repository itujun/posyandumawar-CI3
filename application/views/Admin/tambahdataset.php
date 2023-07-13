<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form <span class="text-primary"><?= $title ?> Baru</span></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col">

      <form action="<?= base_url('dataset/tambahdataset') ?>" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <input type="text" class="form-control col-sm-5" id="usia" name="usia" placeholder="..... bulan" value="<?= set_value('usia') ?>" autofocus>
            <?= form_error('usia', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="bb" class="col-sm-2 col-form-label">Berat Badan</label>
            <input type="text" class="form-control col-sm-5" id="bb" name="bb" placeholder="..... kg" value="<?= set_value('bb') ?>">
            <?= form_error('bb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="tb" class="col-sm-2 col-form-label">Tinggi Badan</label>
            <input type="text" class="form-control col-sm-5" id="tb" name="tb" placeholder="..... cm" value="<?= set_value('tb') ?>">
            <?= form_error('tb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="tb" class="col-sm-2 col-form-label">Lebar Kepala</label>
            <input type="text" class="form-control col-sm-5" id="tb" name="tb" placeholder="..... cm" value="<?= set_value('tb') ?>">
            <?= form_error('tb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
        </div>
        <div class="container">
          <hr>
          <a href="<?= base_url('dataset') ?>" class="btn btn-secondary float-left font-weight-bold">Kembali</a>
          <button type="submit" class="btn btn-primary float-right font-weight-bold">Tambah Data Balita</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->