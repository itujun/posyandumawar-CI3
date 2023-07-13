<?php


defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property View_m $View_m
 * @property session $session
 * @property Balita_m $Balita_m
 * @property form_validation $form_validation
 * @property input $input
 */

class Balita extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('email')) {
      redirect('auth');
    } else {
      if ($this->session->userdata('role_id') != 1) {
        redirect('user');
      }
    }
    $this->load->model('View_m');
    $this->load->model('Balita_m');
  }

  public function index()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Data Balita';
    $page = 'admin/balita';
    $data['user'] = $this->Balita_m->getAll();

    $this->View_m->halamanUtama($data, $page);
  }

  public function tambahbalita()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Tambah Balita';
    $page = 'admin/tambahbalita';
    $this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|min_length[15]|max_length[16]');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
    $this->form_validation->set_rules('alamat', 'alamat', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->View_m->halamanUtama($data, $page);
    } else {
      $this->Balita_m->tambahBalita();
      $this->session->set_flashdata('flash-y', 'Data balita ' . $this->input->post('nama') . ' berhasil ditambahkan sebagai balita baru.');
      redirect('balita');
    }
  }

  public function hapusBalita($id)
  {
    $balita = $this->Balita_m->getBalitaById($id);
    $this->Balita_m->hapusBalita($id);
    $this->session->set_flashdata('flash-y', 'Data balita atas nama ' . $balita['nama'] . ' berhasil dihapus.');
    redirect('balita');
  }

  public function detailbalita($id)
  {
    echo json_encode($this->Balita_m->getBalitaById($id));
  }

  function ubahbalita($id)
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Ubah Data Balita';
    $page = 'admin/ubahbalita';

    $data['balita'] = $this->Balita_m->getBalitaById($id);
    $data['jk'] = ['P', 'L'];

    $this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|min_length[15]|max_length[16]');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
    $this->form_validation->set_rules('alamat', 'alamat', 'required');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanUtama($data, $page);
    } else {
      $data = [
        'nik' => htmlspecialchars($this->input->post('nik', true)),
        'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
        'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
        'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
        'nama_ibu' => strtoupper(htmlspecialchars($this->input->post('nama_ibu', true))),
        'alamat' => strtoupper(htmlspecialchars($this->input->post('alamat', true))),
      ];
      $balita = $this->Balita_m->getBalitaById($id);
      if ($balita) {
        $data['id'] = $id;
        $perubahan = $this->Balita_m->ubahBalita($data);

        if ($perubahan > 0) {
          $this->session->set_flashdata('flash-y', 'Data balita ' . $balita['nama'] . ' berhasil diubah.');
        } else {
          $this->session->set_flashdata('flash-i', 'Tidak ada perubahan pada balita ' . $balita['nama'] . '.');
        }
        redirect('balita');
      } else {
        $this->session->set_flashdata('flash-y', 'Data balita ' . $balita['nama'] . ' tidak ada ditemukan.');
      }
      redirect('balita');
    }
  }
}

/* End of file Balita.php */
