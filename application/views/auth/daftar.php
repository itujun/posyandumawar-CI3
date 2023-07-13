<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-12 col-md-9">

    <div class="card o-hidden bg-transparant border-0 shadow-lg my-5">
      <div class="card-body p-0 ">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-6 d-none d-lg-block bg-masuk"></div> -->
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <img src="<?= base_url('assets/sample/posyandumawar-logo.png') ?>" class="img-fluid" width="20%">
                <h5 class="mt-3 text-gray-900 mb-4">Silahkan masuk ke akun Anda</h5>
              </div>

              <?= $this->session->flashdata('message'); ?>

              <form class="user" action="<?= base_url('auth/daftar') ?>" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" autofocus id="nama" name="nama" placeholder="Nama" value="<?= set_value('nama') ?>">
                  <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                  <?= form_error('email', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                  <?= form_error('password1', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password">
                  <?= form_error('password2', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth') ?>">Masuk</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>