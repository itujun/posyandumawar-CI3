<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property View_m $View_m
 * @property session $session
 * @property Balita_m $Balita_m
 * @property form_validation $form_validation
 * @property input $input
 * @property Dataset_m $Dataset_m
 * @property KNN_m $KNN_m
 */

class Admin extends CI_Controller
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
    $this->load->model('Dataset_m');
    $this->load->model('KNN_m');
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['totaldata'] = $this->Balita_m->countAll();
    $data['login'] = $this->View_m->getUserBySession();
    $data['totaldataset'] = $this->Dataset_m->getTotalDataset();
    $data['totalukur'] = $this->KNN_m->totalukur();
    $page = 'admin/dashboard';

    $data['tbbsk'] = $this->KNN_m->totalUkurBeratSK();
    $data['tbbk'] = $this->KNN_m->totalUkurBeratK();
    $data['tbbn'] = $this->KNN_m->totalUkurBeratN();
    $data['tbbr'] = $this->KNN_m->totalUkurBeratR();

    $data['ttbsp'] = $this->KNN_m->totalUkurTinggiSP();
    $data['ttbp'] = $this->KNN_m->totalUkurTinggiP();
    $data['ttbn'] = $this->KNN_m->totalUkurTinggiN();
    $data['ttbt'] = $this->KNN_m->totalUkurTinggiT();

    $data['tgb'] = $this->KNN_m->totalUkurGiziB();
    $data['tgk'] = $this->KNN_m->totalUkurGiziK();
    $data['tgn'] = $this->KNN_m->totalUkurGiziN();
    $data['tgbl'] = $this->KNN_m->totalUkurGiziBL();
    $data['tgl'] = $this->KNN_m->totalUkurGiziL();
    $data['tgo'] = $this->KNN_m->totalUkurGiziO();


    $this->View_m->halamanUtama($data, $page);
  }
}

/* End of file Admin.php */
