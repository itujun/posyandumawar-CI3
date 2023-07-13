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
          <a href="<?= base_url('knn/tambahdataukur') ?>" class="btn btn-primary btn-sm mb-3 font-weight-bold">Tambah Data Ukur Balita</a>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Nama Balita</th>
                  <th class="text-center">Usia</th>
                  <th class="text-center">BB</th>
                  <th class="text-center">TB</th>
                  <th class="text-center">LK</th>
                  <th class="text-center">Berat</th>
                  <th class="text-center">Tinggi</th>
                  <th class="text-center">Gizi</th>
                  <th class="text-center">Lebar Kepala</th>
                  <!-- <th class="text-center">Bulan Ukur</th>
                  <th class="text-center">Tahun Ukur</th> -->
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- <?php $i = 1;
                      foreach ($namabalita as $du) : ?> -->
                <tr>
                  <td class="text-center"><?= $i++ ?></td>
                  <td><?= $du['nama'] ?></td>
                  <td class="text-center"><?= $du['usia_ukur'] ?> bulan</td>
                  <td class="text-center"><?= $du['bb_ukur'] ?> kg</td>
                  <td class="text-center"><?= $du['tb_ukur'] ?> cm</td>
                  <td class="text-center"><?= $du['lk_ukur'] ?> cm</td>
                  <td class="text-center font-weight-bold <?= $du['sberat'] == 'Kurang' || $du['sberat'] == 'Lebih' ? 'bg-warning text-dark' : '' ?> <?= $du['sberat'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $du['sberat'] == 'Sangat kurang' || $du['sberat'] == 'Risiko BB lebih' ? 'bg-danger text-light' : '' ?>"><?= $du['sberat'] ?></td>
                  <td class="text-center font-weight-bold <?= $du['stinggi'] == 'Pendek' || $du['stinggi'] == 'Tinggi' ? 'bg-warning text-dark' : '' ?> <?= $du['stinggi'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $du['stinggi'] == 'Sangat pendek' ? 'bg-danger text-light' : '' ?>"><?= $du['stinggi'] ?></td>
                  <td class="text-center font-weight-bold <?= $du['sgizi'] == 'Gizi kurang' || $du['sgizi'] == 'Gizi lebih' || $du['sgizi'] == 'Berisiko gizi lebih' ? 'bg-warning text-dark' : '' ?> <?= $du['sgizi'] == 'Gizi baik' ? 'bg-success text-light' : '' ?> <?= $du['sgizi'] == 'Gizi buruk' || $du['sgizi'] == 'Obesitas' ? 'bg-danger text-light' : '' ?>"><?= $du['sgizi'] ?></td>
                  <td class="text-center font-weight-bold <?= $du['skepala'] == 'Terlalu kecil' || $du['skepala'] == 'Terlalu besar' ? 'bg-danger text-light' : '' ?> <?= $du['skepala'] == 'Normal' ? 'bg-success text-light' : '' ?>"><?= $du['skepala'] ?></td>
                  <!-- <td class="text-center"><?= $du['bulan'] ?></td>
                  <td class="text-center"><?= $du['tahun'] ?></td> -->
                  <td class="text-center">
                    <a href="<?= base_url('knn/detailukur/' . $du['id_ukur']) ?> "><span class="font-weight-bold btn btn-sm btn-success ">Detail</span></a>
                    <a href="<?= base_url('knn/ubahukur/' . $du['id_ukur']) ?> "><span class="font-weight-bold btn btn-sm btn-warning ">Ubah</span></a>
                    <a href="<?= base_url('knn/hapusdataukur/' . $du['id_ukur'])  ?>" class="tombolHapus" data-nama="<?= $du['nama'] ?>" data-bulan="<?= $du['bulan'] ?>" data-tahun="<?= $du['tahun'] ?>"><span class="font-weight-bold btn btn-sm btn-danger">Hapus</span></a>
                  </td>
                </tr>
                <!-- <?php endforeach; ?> -->
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