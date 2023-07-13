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
                <img src="<?= base_url('assets/sample/posyandumawar-logo.png') ?>" class="img-fluid">
                <h1 class="h4 text-gray-900">Ganti password email:</h1>
                <h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h3>
              </div>

              <form class="user" action="<?= base_url('auth/gantipassword') ?>" method="post">
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password baru">
                  <?= form_error('password1', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password baru">
                  <?= form_error('password2', '<small class="text-danger pl-2">', '</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Kirim
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>