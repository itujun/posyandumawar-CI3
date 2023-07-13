<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Data Balita</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totaldata ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-baby fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dataset
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totaldataset ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-archive fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Ukur Balita</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalukur ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-weight fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <hr>
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow">
        <h5 class="card-header bg-gradient-success text-white">Status Berat</h5>
        <div class="card-body">
          <h5 class="card-title">Statistik</h5>
          <button class="btn font-weight-bold btn-danger"><span class="icon text-white"><?= $tbbsk ?> |</span>
            <span class="text">Sangat kurang</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-warning"><span class="icon text-black"><?= $tbbk ?> |</span>
            <span class="text">Kurang</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-success"><span class="icon text-white"><?= $tbbn ?> |</span>
            <span class="text">Normal</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-danger"><span class="icon text-white"><?= $tbbr ?> |</span>
            <span class="text">Risiko BB lebih</span>
          </button>
          <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
        </div>
      </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow">
        <h5 class="card-header bg-gradient-warning text-black">Status Tinggi</h5>
        <div class="card-body">
          <h5 class="card-title">Statistik</h5>
          <button class="btn font-weight-bold btn-danger"><span class="icon text-white"><?= $ttbsp ?> |</span>
            <span class="text">Sangat pendek</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-warning"><span class="icon text-black"><?= $ttbp ?> |</span>
            <span class="text">Pendek</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-success"><span class="icon text-white"><?= $ttbn ?> |</span>
            <span class="text">Normal</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-danger"><span class="icon text-white"><?= $ttbt ?> |</span>
            <span class="text">Tinggi</span>
          </button>
          <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
        </div>
      </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow">
        <h5 class="card-header bg-gradient-primary text-white">Status Gizi</h5>
        <div class="card-body">
          <h5 class="card-title">Statistik</h5>
          <button class="btn font-weight-bold btn-danger"><span class="icon text-white"><?= $tgb ?> |</span>
            <span class="text">Gizi buruk</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-warning"><span class="icon text-black"><?= $tgk ?> |</span>
            <span class="text">Gizi kurang</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-success"><span class="icon text-white"><?= $tgn ?> |</span>
            <span class="text">Gizi normal</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-warning"><span class="icon text-black"><?= $tgbl ?> |</span>
            <span class="text">Berisiko gizi lebih</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-warning"><span class="icon text-black"><?= $tgl ?> |</span>
            <span class="text">Gizi lebih</span>
          </button><br>
          <button class="btn font-weight-bold mt-2 btn-danger"><span class="icon text-white"><?= $tgo ?> |</span>
            <span class="text">Obesitas</span>
          </button>
          <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->