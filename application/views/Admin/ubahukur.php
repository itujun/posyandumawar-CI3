<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col">
      <form action="<?= base_url('knn/ubahukur/' . $balita['id_ukur']) ?>" method="post">
        <div class="modal-body">

          <div class="form-group row">
            <label for="usia" class="col-sm-2 col-form-label">Nama Balita</label>
            <input type="hidden" name="id_balita" value="<?= $balita['id_balita'] ?>">
            <input type="text" class="form-control col-sm-5" readonly name="nama" value="<?= $balita['nama'] ?>">
          </div>
          <div class="form-group row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <input type="text" class="form-control col-sm-2" name="usia" value="<?= $balita['usia_ukur'] ?>">
            <div class="col-form-label col-sm-2"> Bulan.</div>
            <?= form_error('usia', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="bb" class="col-sm-2 col-form-label">Berat Badan</label>
            <input type="text" class="form-control col-sm-2" name="bb" placeholder="..... kg" value="<?= $balita['bb_ukur'] ?>">
            <div class="col-form-label col-sm-2"> Kg.</div>
            <?= form_error('bb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class=" form-group row">
            <label for="tb" class="col-sm-2 col-form-label">Tinggi Badan</label>
            <input type="text" class="form-control col-sm-2" id="tb" name="tb" placeholder="..... cm" value="<?= $balita['tb_ukur'] ?>">
            <div class="col-form-label col-sm-2"> Cm.</div>
            <?= form_error('tb', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class=" form-group row">
            <label for="lk" class="col-sm-2 col-form-label">Lebar Kepala</label>
            <input type="text" class="form-control col-sm-2" id="lk" name="lk" placeholder="..... cm" value="<?= $balita['lk_ukur'] ?>">
            <div class="col-form-label col-sm-2"> Cm.</div>
            <?= form_error('lk', '<small class="text-danger col-sm-5">', '</small>') ?>
          </div>
          <div class="form-group row">
            <label for="bulan" class="col-sm-2 col-form-label">Bulan pengukuran</label>
            <select class="form-control col-sm-4" id="bulan" name="bulan">
              <option hidden selected disabled>Pilih bulan pengukuran</option>
              <?php foreach ($bulan as $bln) : ?>
                <?php if ($bln == $balita['bulan']) : ?>
                  <option selected value="<?= $bln ?>"><?= $bln ?></option>
                <?php else : ?>
                  <option value="<?= $bln ?>"><?= $bln ?></option>
                <?php endif ?>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="tahun" readonly value="<?= $balita['tahun'] ?>">
            <div class="col-form-label col-sm-2"><?= $balita['tahun'] ?></div>
          </div>
        </div>
        <div class="container">
          <hr>
          <a href="<?= base_url('knn') ?>" class="btn btn-secondary float-left font-weight-bold">Kembali</a>
          <button type="submit" class="btn btn-primary float-right font-weight-bold">Ubah Data Ukur</button>
        </div>
      </form>
    </div>
  </div>


  <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->

<!-- Modal -->