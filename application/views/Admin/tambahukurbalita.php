<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form <span class="text-primary"><?= $title ?> Baru</span></h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col">

      <form action="<?= base_url('knn/tambahdataukur') ?>" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="pilih_balita" class="col-sm-2 col-form-label">Pilih Balita</label>
            <select class="select2 form-control col-sm-5" id="pilih_balita" name="pilih_balita" autofocus>
              <option hidden disabled selected>Pilih balita yang akan diukur</option>
              <?php foreach ($balita as $b) :
                $selectedBalita = null; ?>
                <option value="<?= $b['id'] ?>">
                  <?= ($selectedBalita && $b['id'] == $selectedBalita['id']) ? 'selected' : '' ?>
                  <?= $b['nik'] . ' | ' . $b['nama'] . ' | ';
                  if ($b['jenis_kelamin'] == 'P') {
                    echo 'Perempuan';
                  } else {
                    echo 'Laki-laki';
                  } ?>
                </option>
              <?php endforeach ?>
            </select>
            <?= form_error('pilih_balita', '<small class="text-danger col-sm-3">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <input type="text" class="form-control col-sm-2" readonly id="usia" name="usia" placeholder="....." value="">
            <div class="col-form-label col-sm-2"> Bulan.</div>
            <?= form_error('usia', '<small class="text-danger col-sm-5 ml-5 pl-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="bb" class="col-sm-2 col-form-label">Berat Badan</label>
            <input type="text" class="form-control col-sm-2" id="bb" name="bb" placeholder="..... kg" value="<?= set_value('bb') ?>">
            <div class=" col-form-label col-sm-2"> Kg.
            </div>
            <?= form_error('bb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="tb" class="col-sm-2 col-form-label">Tinggi Badan</label>
            <input type="text" class="form-control col-sm-2" id="tb" name="tb" placeholder="..... cm" value="<?= set_value('tb') ?>">
            <div class="col-form-label col-sm-2"> Cm.</div>
            <?= form_error('tb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="tb" class="col-sm-2 col-form-label">Lingkar Kepala</label>
            <input type="text" class="form-control col-sm-2" id="lk" name="lk" placeholder="..... cm" value="<?= set_value('lk') ?>">
            <div class="col-form-label col-sm-2"> Cm.</div>
            <?= form_error('tb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="bulan" class="col-sm-2 col-form-label">Bulan pengukuran</label>
            <select class="form-control col-sm-4" id="bulan" name="bulan">
              <option hidden selected disabled>Pilih bulan pengukuran</option>
              <?php foreach ($bulan as $bln) : ?>
                <option value="<?= $bln ?>"><?= $bln ?></option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="tahun" value="<?= Date('Y') ?>">
            <div class="col-form-label col-sm-2"><?= Date('Y') ?></div>
            <?= form_error('bulan', '<small class="text-danger ml-n5  col-sm-2">', '</small>') ?>
          </div>
        </div>
        <div class="container">
          <hr>
          <a href="<?= base_url('knn') ?>" class="btn btn-secondary float-left font-weight-bold">Kembali</a>
          <button type="submit" class="btn btn-primary float-right font-weight-bold">Tambah Data Balita</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->