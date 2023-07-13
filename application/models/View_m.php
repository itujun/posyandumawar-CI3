<?php

defined('BASEPATH') or exit('No direct script access allowed');

class View_m extends CI_Model
{

  public function halamanAuth($data, $page)
  {
    $this->load->view('templates/auth_header', $data);
    $this->load->view($page);
    $this->load->view('templates/auth_footer');
  }

  public function halamanUtama($data, $page)
  {
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view($page);
    $this->load->view('templates/footer');
  }

  public function getUserBySession()
  {
    return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  }
}

/* End of file Vier_m.php */
