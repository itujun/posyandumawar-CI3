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
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 text-dark font-weight-bold text-primary"><?= $balita['nama'] ?></h5>

        </div>
        <div class="card-body">
          <h6 class="card-subtitle  text-muted mt-2">Usia pengukuran: <?= $balita['usia_ukur'] ?> bulan.</h6>
          <div class="badge mt-1 bg-info text-white p-2">Berat Badan ukur: <?= $balita['bb_ukur'] ?> kg</div>
          <div class="badge mt-1 bg-info text-white p-2">Tinggi Badan ukur: <?= $balita['tb_ukur'] ?> cm</div>
          <div class="badge mt-1 bg-info text-white p-2">Lebar Kepala ukur: <?= $balita['lk_ukur'] ?> cm</div>
          <br><br>
          <table class="table tablestripped">
            <thead>
              <tr>
                <th>Status BB/U</th>
                <th>Status TB/U</th>
                <th>Status LK/U</th>
                <th>Status Gizi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="<?= $class1 ?> font-weight-bold">Berat Badan <?= $balita['sberat'] ?></td>
                <td class="<?= $class2 ?> font-weight-bold">Tinggi Badan <?= $balita['stinggi'] ?></td>
                <td class="<?= $class2 ?> font-weight-bold">Lebar Kepala <?= $balita['skepala'] ?></td>
                <td class="<?= $class3 ?> font-weight-bold"><?= $balita['sgizi'] ?></td>
              </tr>
            </tbody>
          </table>
          <div>Saran menurut hasil berat badan: <?= $saranb ?> </div>
          <hr>
          <div>Saran menurut hasil tinggi badan: <?= $sarant ?> </div>
          <hr>
          <div>Saran menurut hasil status gizi: <?= $sarang ?> </div>
          <p class="card-text mt-2"><small class="text-muted">Bulan pengukuran: <?= $balita['bulan'] . ' ' . $balita['tahun'] ?></small></p>
        </div>
      </div>

      <!-- Collapsable Card Berat -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardBerat" class="d-block card-header py-3 bg-gradient-success" data-toggle="collapse" role="button">
          <h6 class="m-0 font-weight-bold text-white">5 Data terdekat menurut Status BB/U</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardBerat">
          <div class="card-body">
            <table class="table table-stripped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usia</th>
                  <th>BB</th>
                  <th>Status Berat Badan</th>
                  <th>Jarak Berat</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($berat as $b) : ?>
                  <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= $b['usia'] ?> bulan</td>
                    <td><?= $b['bb'] ?> kg</td>
                    <td><span class=" <?= $b['sberat'] == 'Risiko BB lebih' || $b['sberat'] == 'Sangat kurang' ?
                                        'text-danger font-weight-bold' : '' ?>
                                      <?= $b['sberat'] == 'Kurang' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $b['sberat'] == 'Normal' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $b['sberat'] ?></span></td>
                    <td><?= $b['jarak'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Collapsable Card Tinggi -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardTinggi" class="d-block card-header py-3 bg-gradient-warning" data-toggle="collapse" role="button">
          <h6 class="m-0 font-weight-bold text-dark">5 Data terdekat menurut Status TB/U</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardTinggi">
          <div class="card-body">
            <table class="table table-stripped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usia</th>
                  <th>TB</th>
                  <th>Status Tinggi Badan</th>
                  <th>Jarak Tinggi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($tinggi as $t) : ?>
                  <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= $t['usia'] ?> bulan</td>
                    <td><?= $t['tb'] ?> cm</td>
                    <td><span class=" <?= $t['stinggi'] == 'Sangat pendek' || $t['stinggi'] == 'Tinggi' ?
                                        'text-danger font-weight-bold' : '' ?>
                                      <?= $t['stinggi'] == 'Pendek' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $t['stinggi'] == 'Normal' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $t['stinggi'] ?></span></td>
                    <td><?= $t['jarak'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Collapsable Card Lebar Kepala -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardLebarKepala" class="d-block card-header py-3 bg-gradient-info" data-toggle="collapse" role="button">
          <h6 class="m-0 font-weight-bold text-light">5 Data terdekat menurut Status LK/U</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardLebarKepala">
          <div class="card-body">
            <table class="table table-stripped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usia</th>
                  <th>LK</th>
                  <th>Status Lebar Kepala</th>
                  <th>Jarak LK</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lk as $t) : ?>
                  <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= $t['usia'] ?> bulan</td>
                    <td><?= $t['lk'] ?> cm</td>
                    <td><span class=" <?= $t['skepala'] == 'Terlalu kecil' || $t['skepala'] == 'Terlalu besar' ?
                                        'text-danger font-weight-bold' : '' ?>
                                      <?= $t['skepala'] == 'Normal' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $t['skepala'] ?></span></td>
                    <td><?= $t['jarak'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Collapsable Card Gizi -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardGizi" class="d-block card-header py-3 bg-gradient-primary" data-toggle="collapse" role="button">
          <h6 class="m-0 font-weight-bold text-white">5 Data terdekat menurut Status Gizi (BB/TB)</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardGizi">
          <div class="card-body">
            <table class="table table-stripped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>BB</th>
                  <th>TB</th>
                  <th>Status Gizi</th>
                  <th>Jarak Gizi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($gizi as $g) : ?>
                  <tr>
                    <td><?= $g['id'] ?></td>
                    <td><?= $g['bb'] ?> kg</td>
                    <td><?= $g['tb'] ?> cm</td>
                    <td><span class=" <?= $g['sgizi'] == 'Gizi buruk' || $g['sgizi'] == 'Obesitas' ?
                                        'text-danger font-weight-bold' : '' ?>
                                      <?= $g['sgizi'] == 'Gizi kurang' || $g['sgizi'] == 'Berisiko gizi lebih' || $g['sgizi'] == 'Gizi lebih' ? 'text-warning font-weight-bold' : '' ?>
                                      <?= $g['sgizi'] == 'Gizi baik' ? 'text-success font-weight-bold' : '' ?>
                                      ?> "><?= $g['sgizi'] ?></span></td>
                    <td><?= $g['jarak'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  <a href="<?= base_url('knn') ?>" class="btn btn-secondary float-left font-weight-bold">Kembali</a>

  <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->

<!-- Modal -->