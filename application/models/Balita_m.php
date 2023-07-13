<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Balita_m extends CI_Model
{

  public function getAll()
  {
    return $this->db->get('balita')->result_array();
  }

  public function getBalitaById($id)
  {
    return $this->db->get_where('balita', ['id' => $id])->row_array();
  }

  public function tambahBalita()
  {
    $data = [
      'nik' => htmlspecialchars($this->input->post('nik', true)),
      'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
      'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
      'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
      'nama_ibu' => strtoupper(htmlspecialchars($this->input->post('nama_ibu', true))),
      'alamat' => strtoupper(htmlspecialchars($this->input->post('alamat', true))),
    ];
    $this->db->insert('balita', $data);
  }

  public function countAll()
  {
    return $this->db->get('balita')->num_rows();
  }

  public function hapusBalita($id)
  {
    $this->db->delete('balita', ['id' => $id]);

    $cekdu = $this->db->get_where('ukur_balita', ['id_balita' => $id]);
    if ($cekdu) {
      $this->db->where('id_balita', $id)->delete("ukur_balita");
    }
  }

  public function ubahBalita($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('balita', $data);
    return $this->db->affected_rows();
  }
}

/* End of file Balita_m.php */
