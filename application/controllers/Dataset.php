<?php


defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property View_m $View_m
 * @property session $session
 * @property Dataset_m $Dataset_m
 * @property form_validation $form_validation
 * @property input $input
 */

class Dataset extends CI_Controller
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
    $this->load->model('Dataset_m');
  }

  public function index()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Dataset';
    $page = 'admin/dataset';
    $data['dataset'] = $this->Dataset_m->getAll();
    $this->View_m->halamanUtama($data, $page);
  }

  public function tambahdataset()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Tambah Dataset';
    $page = 'admin/tambahdataset';

    $this->form_validation->set_rules('usia', 'Usia', 'trim|required|numeric|max_length[2]|less_than[61]');
    $this->form_validation->set_rules('bb', 'Berat Badan', 'trim|required|max_length[5]|greater_than[0]|less_than[100]');
    $this->form_validation->set_rules('tb', 'Tinggi Badan', 'trim|required|numeric|max_length[5]|greater_than[0]|less_than[1000]');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanUtama($data, $page);
    } else {
      $u = htmlspecialchars($this->input->post('usia', true));
      $b = htmlspecialchars($this->input->post('bb', true));
      $t = htmlspecialchars($this->input->post('tb', true));
      $cekberat = $this->Dataset_m->cekSberat($u, $b);
      $cektinggi = $this->Dataset_m->cekStinggi($u, $t);
      $cekgizi = $this->Dataset_m->cekSgizi($u, $b, $t);

      $bbzs = $cekberat['zscore'];
      $sbb = $cekberat['sberat'];
      $tbzs = $cektinggi['zscore'];
      $stb = $cektinggi['stinggi'];
      $sgzs = $cekgizi['zscore'];
      $sg = $cekgizi['sgizi'];

      $this->Dataset_m->tambah($u, $b, $t, $bbzs, $sbb, $tbzs, $stb, $sgzs, $sg);
      $this->session->set_flashdata('flash-y', 'Dataset dengan usia ' . $u . ' bulan, berat badan ' . $b . ' kg, dan tinggi badan ' . $t . ' cm berhasil ditambahkan.');
      redirect('dataset');
    }
  }

  public function hapusdataset($id)
  {
    $dataset = $this->Dataset_m->getDatasetbyId($id);
    $this->Dataset_m->hapus($id);
    $this->session->set_flashdata('flash-y', 'Dataset dengan usia: ' . $dataset['usia'] . ' bulan, berat badan: ' . $dataset['bb'] . ' kg, dan tinggi badan: ' . $dataset['tb'] . ' cm berhasil dihapus.');
    redirect('dataset');
  }
}

/* End of file Dataset.php */
