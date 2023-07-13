<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property form_validation $form_validation
 * @property Auth_m $Auth_m
 * @property View_m $View_m
 * @property session $session
 * @property input $input
 * @property email $email
 */

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('View_m');
    $this->load->model('Auth_m');
  }

  public function index()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $data['title'] = 'Masuk';
    $page = 'auth/masuk';
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_dash');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanAuth($data, $page);
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = $this->input->post('email', true);
    $password = $this->input->post('password', true);
    $user = $this->Auth_m->getUser($email);

    if ($user) {
      if ($user['is_active'] == 1) {
        if (password_verify($password, $user['password'])) {

          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];

          if ($data['role_id'] == 1) {
            $this->session->set_userdata($data);
            redirect('admin');
          } else {
            $this->session->set_userdata($data);
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Password yang Anda masukkan salah! Silahkan coba lagi.
        </div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Akun Anda belum diaktivasi! Silahkan cek email kamu lalu lakukan aktivasi.
      </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Email yang Anda masukkan tidak terdaftar. Silahkan membuat akun pendaftaran.
    </div>');
      redirect('auth');
    }
  }

  public function daftar()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $data['title'] = 'Pendaftaran';
    $page = 'auth/daftar';

    $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|alpha_dash');
    $this->form_validation->set_rules(
      'email',
      'Email',
      'trim|required|valid_email|is_unique[user.email]',
      ['is_unique' => 'Email yang Anda masukkan telah terdaftar!']
    );
    $this->form_validation->set_rules('password1', 'Password', 'trim|required|alpha_dash|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|alpha_dash|min_length[6]|matches[password1]');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanAuth($data, $page);
    } else {
      $data = [
        'nama' => htmlspecialchars($this->input->post('nama', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
        'avatar' => 'default.png',
        'role_id' => 2,
        'is_active' => 0,
      ];

      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => htmlspecialchars($this->input->post('email', true)),
        'token' => $token,
        'created_at' => time()
      ];

      $this->Auth_m->tambahData($data);
      $this->Auth_m->buatToken($user_token);

      $this->_sendEmail($token, 'verifikasi');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Akun berhasil dibuat! Kami telah mengirimkan email berisi link aktivasi. Silahkan cek email Anda lalu lakukan aktivasi.
    </div>');
      redirect('auth');
    }
  }

  public function verifikasi()
  {
    $email = $this->input->get('email');
    $user = $this->Auth_m->getUser($email);
    if ($user) {
      $token = $this->input->get('token');
      $user_token = $this->Auth_m->getToken($token);
      if ($user_token) {
        if (time() - $user_token['created_at'] < (60 * 60 * 24)) {
          $this->Auth_m->hapusToken($token);
          $this->Auth_m->updateData($email);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Verifikasi akun berhasil! Silahkan login.
        </div>');
          redirect('auth');
        } else {
          $this->Auth_m->hapusToken($token);
          $this->Auth_m->hapusData($email);
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Link verifikasi telah kadaluarsa! Silahkan lakukan pendaftaran kembali.
      </div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Verifikasi token tidak ditemukan!
      </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Verifikasi email tidak ditemukan!
        </div>');
      redirect('auth');
    }
  }

  public function lupapassword()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $data['title'] = 'Lupa Password';
    $page = 'auth/lupapw';

    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanAuth($data, $page);
    } else {
      $email = $this->input->post('email');
      $user = $this->Auth_m->getUser($email);
      if ($user) {
        $token = base64_encode(random_bytes(32));
        $data = [
          'email' => $email,
          'token' => $token,
          'created_at' => time()
        ];
        $this->Auth_m->buatToken($data);
        $this->_sendEmail($token, 'resetpw');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Permintaan reset password berhasil dibuat! Kami telah mengirimkan email berisi link untuk mereset password Anda,silahkan cek email dan segera lakukan reset password.
      </div>');
        redirect('auth');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Email yang Anda masukkan tidak terdaftar! Silahkan lakukan pendaftaran akun terlebih dahulu.
      </div>');
        redirect('auth/lupapassword');
      }
    }
  }

  public function resetpw()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->Auth_m->getUser($email);
    if ($user) {
      $user_token = $this->Auth_m->getToken($token);
      if ($user_token) {
        $this->session->set_userdata('reset_email', $email);
        redirect('auth/gantipassword');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Gagal mereset password! Token yang Anda masukkan salah.
      </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Gagal mereset password! Email yang Anda masukkan salah.
      </div>');
      redirect('auth');
    }
  }

  public function gantipassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    } else {
      $data['title'] = 'Ganti Password';
      $page = 'auth/gantipw';

      $this->form_validation->set_rules('password1', 'Password Baru', 'trim|required|min_length[6]|alpha_dash|matches[password2]');
      $this->form_validation->set_rules('password2', 'Ulangi Password Baru', 'trim|required|min_length[6]|alpha_dash|matches[password1]');

      if ($this->form_validation->run() ==  FALSE) {
        $this->View_m->halamanAuth($data, $page);
      } else {
        $password = password_hash($this->input->post('password1', true), PASSWORD_DEFAULT);
        $email = $this->session->userdata('reset_email');

        $this->Auth_m->hapusTokenWtEmail($email);
        $this->Auth_m->updatePw($email, $password);
        $this->session->unset_userdata('reset_email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil mengubah password! Silahkan masuk menggunakan password baru.
      </div>');
        redirect('auth');
      }
    }
  }

  private function _sendEmail($token, $tipe)
  {
    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'posyandumawarbisma@gmail.com',
      'smtp_pass' => 'qrhybipfdfbqswdm',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->from('posyandumawarbisma@gmail.com', 'Posyandu Mawar Bibis Tama');
    $this->email->to($this->input->post('email'));

    if ($tipe == 'verifikasi') {
      $this->email->subject('Aktivasi akun');
      $this->email->message('Hai ' . $this->input->post('nama') . '.<br><br> Untuk mengaktifkan akun Anda, silahkan klik link berikut ini ya: <a href="' . base_url() . 'auth/verifikasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan akun</a>');
    } else if ($tipe == 'resetpw') {
      $this->email->subject('Reset Password');
      $this->email->message('Untuk mereset password Anda, silahkan klik link berikut ini ya: <a href="' . base_url('auth/resetpw?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '') . '">Reset Password</a>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function logout()
  {
    if (!$this->session->userdata('email')) {
      redirect('auth');
    } else {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Berhasil keluar dari akun.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('auth');
    }
  }
}

/* End of file Auth.php */
