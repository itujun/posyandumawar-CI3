<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{

  public function getUser($email)
  {
    $hasil = $this->db->get_where('user', ['email' => $email]);
    return $hasil->row_array();
  }

  public function tambahData($isinya)
  {
    $this->db->insert('user', $isinya);
  }

  public function hapusData($email)
  {
    $this->db->delete('user', ['email' => $email]);
  }

  public function buatToken($isinya)
  {
    $this->db->insert('user_token', $isinya);
  }

  public function getToken($token)
  {
    return $this->db->get_where('user_token', ['token' => $token])->row_array();
  }

  public function hapusToken($token)
  {
    $this->db->delete('user_token', ['token' => $token]);
  }

  public function hapusTokenWtEmail($email)
  {
    $this->db->delete('user_token', ['email' => $email]);
  }

  public function updateData($email)
  {
    $this->db->set('is_active', 1);
    $this->db->where('email', $email);
    $this->db->update('user');
  }

  public function updatePw($email, $password)
  {
    $this->db->set('password', $password);
    $this->db->where('email', $email);
    $this->db->update('user');
  }
}

/* End of file Auth_m.php */
