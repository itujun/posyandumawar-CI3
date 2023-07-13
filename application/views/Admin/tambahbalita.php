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

      <form action="<?= base_url('balita/tambahbalita') ?>" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
            <input type="text" class="form-control col-sm-5" id="nik" name="nik" placeholder="xxxxxxxxxxx.." value="<?= set_value('nik') ?>" autofocus>
            <?= form_error('nik', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Balita</label>
            <input type="text" class="form-control col-sm-5" id="nama" name="nama" placeholder="....." value="<?= set_value('nama') ?>">
            <?= form_error('nama', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <input type="date" class="form-control col-sm-4" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir') ?>">
            <?= form_error('tgl_lahir', '<small class="text-danger ml-5 pl-5 col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <select class="form-control col-sm-4" id="jenis_kelamin" name="jenis_kelamin">
              <option disabled hidden selected>Pilih Jenis Kelamin</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
            <?= form_error('jenis_kelamin', '<small class="text-danger ml-5 pl-5 col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
            <input type="text" class="form-control col-sm-5" id="nama_ibu" name="nama_ibu" placeholder="....." value="<?= set_value('nama_ibu') ?>">
            <?= form_error('nama_ibu', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <input type="text" class="form-control col-sm-5" id="alamat" name="alamat" placeholder="....." value="<?= set_value('alamat') ?>">
            <?= form_error('alamat', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
        </div>
        <div class="container">
          <hr>
          <a href="<?= base_url('balita') ?>" class="btn btn-secondary font-weight-bold float-left ">Kembali</a>
          <button type="submit" class="btn btn-primary font-weight-bold float-right">Tambah Data Balita</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->