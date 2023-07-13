<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <!-- <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-danger">
          <h6 class="m-0 font-weight-bold text-white">Tabel <?= $title ?></h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Nama Balita</th>
                  <th class="text-center">Usia</span></th>
                  <th class="text-center">BB</span></th>
                  <th class="text-center">TB</span></th>
                  <th class="text-center">Berat</th>
                  <th class="text-center">Tinggi</th>
                  <th class="text-center">Gizi</th>
                  <th class="text-center">Bulan Ukur</th>
                  <th class="text-center">Tahun Ukur</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center"><?= $i++ ?></td>
                  <td><?= $du['nama'] ?></td>
                  <td class="text-center"><?= $du['usia_ukur'] ?> bulan</td>
                  <td class="text-center"><?= $du['bb_ukur'] ?> kg</td>
                  <td class="text-center"><?= $du['tb_ukur'] ?> cm</td>
                  <td class="text-center font-weight-bold <?= $du['sberat'] == 'Kurang' || $du['sberat'] == 'Lebih' ? 'bg-warning text-dark' : '' ?> <?= $du['sberat'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $du['sberat'] == 'Sangat kurang' || $du['sberat'] == 'Risiko BB lebih' ? 'bg-danger text-light' : '' ?>"><?= $du['sberat'] ?></td>
                  <td class="text-center font-weight-bold <?= $du['stinggi'] == 'Pendek' || $du['stinggi'] == 'Tinggi' ? 'bg-warning text-dark' : '' ?> <?= $du['stinggi'] == 'Normal' ? 'bg-success text-light' : '' ?> <?= $du['stinggi'] == 'Sangat pendek' ? 'bg-danger text-light' : '' ?>"><?= $du['stinggi'] ?></td>
                  <td class="text-center font-weight-bold <?= $du['sgizi'] == 'Gizi kurang' || $du['sgizi'] == 'Gizi lebih' || $du['sgizi'] == 'Berisiko gizi lebih' ? 'bg-warning text-dark' : '' ?> <?= $du['sgizi'] == 'Gizi normal' ? 'bg-success text-light' : '' ?> <?= $du['sgizi'] == 'Gizi buruk' || $du['sgizi'] == 'Obesitas' ? 'bg-danger text-light' : '' ?>"><?= $du['sgizi'] ?></td>
                  <td class="text-center"><?= $du['bulan'] ?></td>
                  <td class="text-center"><?= $du['tahun'] ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> -->


  <!-- Content Row -->
  <div class="row">
    <div class="col">
      <h6>Nama balita: <?= $balitaa['nama'] ?></h6>
      <table class="table table-stripped">
        <thead>
          <tr>
            <th>Bulan ukur</th>
            <th>Usia</th>
            <th>BB ukur</th>
            <th>TB ukur</th>
            <th>Status Berat</th>
            <th>Status Tinggi</th>
            <th>Status Gizi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($balita as $b) : ?>
            <tr>
              <td><?= $b['bulan'] ?></td>
              <td><?= $b['usia_ukur'] ?></td>
              <td><?= $b['bb_ukur'] ?></td>
              <td><?= $b['tb_ukur'] ?></td>
              <td class=" <?= $b['sberat'] == 'Risiko BB lebih' || $b['sberat'] == 'Sangat kurang' ?
                            'text-danger font-weight-bold' : '' ?>
                                      <?= $b['sberat'] == 'Kurang' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $b['sberat'] == 'Normal' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $b['sberat'] ?></td>
              <td class=" <?= $b['stinggi'] == 'Sangat pendek' || $b['stinggi'] == 'Tinggi' ?
                            'text-danger font-weight-bold' : '' ?>
                                      <?= $b['stinggi'] == 'Pendek' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $b['stinggi'] == 'Normal' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $b['stinggi'] ?></td>
              <td class="<?= $b['sgizi'] == 'Gizi buruk' || $b['sgizi'] == 'Obesitas' ?
                            'text-danger font-weight-bold' : '' ?>
                                      <?= $b['sgizi'] == 'Gizi kurang' || $b['sgizi'] == 'Berisiko gizi lebih' || $b['sgizi'] == 'Gizi lebih' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $b['sgizi'] == 'Gizi normal' ? 'text-success font-weight-bold' : '' ?>
                                      "><?= $b['sgizi'] ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

      <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class=" font-weight-bold text-info text-uppercase mb-1">Saran menurut pengukuran bulan terakhir untuk hasil status berat
                  </div>
                  <div class="h6 mb-0 mr-3 text-gray-700"><small><b><?= $saran_b ?></b></small></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class=" font-weight-bold text-info text-uppercase mb-1">
                    Saran menurut pengukuran bulan terakhir untuk hasil status tinggi</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-700"><small><b><?= $saran_t ?></b></small></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class=" font-weight-bold text-info text-uppercase mb-1">
                    Saran menurut pengukuran bulan terakhir untuk hasil status gizi</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800"><small><b><?= $saran_g ?></b></small></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->