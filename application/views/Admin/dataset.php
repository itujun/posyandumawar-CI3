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

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-danger">
          <h6 class="m-0 font-weight-bold text-white">Tabel <?= $title ?></h6>
        </div>

        <?php if ($this->session->flashdata('flash-y')) {
          echo '<div class="flash-data" data-flashdata1="' . $this->session->flashdata('flash-y') . '"></div>';
        } else if ($this->session->flashdata('flash-i')) {
          echo '<div class="flash-data" data-flashdata1="' . $this->session->flashdata('flash-i') . '"></div>';
        } else {
          echo '<div class="flash-data" data-flashdata1="' . $this->session->flashdata('flash-n') . '"></div>';
        }
        ?>

        <div class="card-body">
          <a href="<?= base_url('dataset/tambahdataset') ?>" class="btn btn-primary btn-sm mb-3 font-weight-bold">Tambah Dataset</a>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Usia <span class="text-xs">(bulan)</span></th>
                  <th class="text-center">BB <span class="text-xs">(kg)</span></th>
                  <th class="text-center">TB <span class="text-xs">(cm)</span></th>
                  <th class="text-center">LK <span class="text-xs">(cm)</span></th>
                  <th class="text-center">Status BB/U</th>
                  <th class="text-center">Status TB/U</th>
                  <th class="text-center">Status Gizi</th>
                  <th class="text-center">Status LK</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($dataset as $ds) : ?>
                  <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= $ds['usia'] ?> bulan</td>
                    <td class="text-center"><?= $ds['bb'] ?> kg</td>
                    <td class="text-center"><?= $ds['tb'] ?> cm</td>
                    <td class="text-center"><?= $ds['lk'] ?> cm</td>
                    <td class="text-center font-weight-bold <?= $ds['sberat'] == 'Kurang' || $ds['sberat'] == 'Lebih' ? 'bg-warning text-dark' : '' ?> <?= $ds['sberat'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $ds['sberat'] == 'Sangat kurang' || $ds['sberat'] == 'Risiko BB lebih' ? 'bg-danger text-light' : '' ?>"><?= $ds['sberat'] ?></td>
                    <td class="text-center font-weight-bold <?= $ds['stinggi'] == 'Pendek' || $ds['stinggi'] == 'Tinggi' ? 'bg-warning text-dark' : '' ?> <?= $ds['stinggi'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $ds['stinggi'] == 'Sangat pendek' ? 'bg-danger text-light' : '' ?>"><?= $ds['stinggi'] ?></td>
                    <td class="text-center font-weight-bold <?= $ds['sgizi'] == 'Gizi kurang' || $ds['sgizi'] == 'Gizi lebih' || $ds['sgizi'] == 'Berisiko gizi lebih' ? 'bg-warning text-dark' : '' ?> <?= $ds['sgizi'] == 'Gizi baik' ? 'bg-success text-light' : '' ?> <?= $ds['sgizi'] == 'Gizi buruk' || $ds['sgizi'] == 'Obesitas' ? 'bg-danger text-light' : '' ?>"><?= $ds['sgizi'] ?></td>
                    <td class="text-center font-weight-bold <?= $ds['skepala'] == 'Terlalu kecil' || $ds['skepala'] == 'Terlalu besar'  ? 'bg-danger text-light' : '' ?> <?= $ds['skepala'] == 'Normal' ? 'bg-success text-light' : '' ?>"><?= $ds['skepala'] ?></td>
                    <td class="text-center"><a href="<?= base_url('dataset/hapusdataset/' . $ds['id'])  ?>" class="tombolHapus btn btn-sm btn-danger font-weight-bold" data-usia="<?= $ds['usia'] ?>" data-bb="<?= $ds['bb'] ?>" data-tb="<?= $ds['tb'] ?>"><span>Hapus</span=></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->