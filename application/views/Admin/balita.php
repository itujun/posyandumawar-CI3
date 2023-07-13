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
          <a href="<?= base_url('balita/tambahbalita') ?>" class="btn btn-primary btn-sm font-weight-bold mb-3">Tambah Data Balita</a>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th class="text-center">JK</th>
                  <th class="text-center">Tanggal Lahir</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $n = 1;
                foreach ($user as $u) : ?>
                  <tr>
                    <td><?= $n++ ?></td>
                    <td><?= $u['nik'] ?></td>
                    <td><?= $u['nama'] ?></td>
                    <td class="text-center"><?= $u['jenis_kelamin'] ?></td>
                    <td class="text-center"><?= $u['tgl_lahir'] ?></td>
                    <td class="text-center">
                      <a href="" data-id="<?= $u['id'] ?>" data-toggle="modal" data-target="#modalbalita"><span class="btn btn-success btn-sm font-weight-bold detailModalBalita">Detail</span></a>
                      <a href="<?= base_url('balita/ubahbalita/' . $u['id']) ?>"><span class="btn btn-warning btn-sm font-weight-bold">Ubah</span></a>
                      <a href="<?= base_url('balita/hapusbalita/' . $u['id'])  ?>" data-namabalita="<?= $u['nama'] ?>" class="tombolHapus"><span class="font-weight-bold btn btn-sm btn-danger">Hapus</span></a>
                    </td>
                  </tr>
                <?php endforeach ?>
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

<!-- Modal -->
<div class="modal fade" id="modalbalita" tabindex="-1" aria-labelledby="modalbalitaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalbalitaLabel">Detail data balita:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="nikbalita" class="col-sm-4 ml-2 col-form-label">NIK</label>
          <div class="form-control col-sm-7" id="nikbalita">
          </div>
        </div>
        <div class="form-group row">
          <label for="namabalita" class="col-sm-4 ml-2 col-form-label">Nama</label>
          <div class="form-control col-sm-7" id="namabalita">
          </div>
        </div>
        <div class="form-group row">
          <label for="jkbalita" class="col-sm-4 ml-2 col-form-label">Jenis Kelamin</label>
          <div class="form-control col-sm-7" id="jkbalita">
          </div>
        </div>
        <div class="form-group row">
          <label for="tgllahirbalita" class="col-sm-4 ml-2 col-form-label">Tanggal Lahir</label>
          <div class="form-control col-sm-7" id="tgllahirbalita">
          </div>
        </div>
        <div class="form-group row">
          <label for="ibubalita" class="col-sm-4 ml-2 col-form-label">Nama Ibu</label>
          <div class="form-control col-sm-7" id="ibubalita">
          </div>
        </div>
        <div class="form-group row">
          <label for="alamatbalita" class="col-sm-4 ml-2 col-form-label">Alamat</label>
          <div class="form-control col-sm-7" id="alamatbalita">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>