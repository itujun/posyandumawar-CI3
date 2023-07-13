<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KNN_m extends CI_Model
{

  public function totalukur()
  {
    return $this->db->get('ukur_balita')->num_rows();
  }

  public function tambahDataUkur()
  {
    $data = [
      'id_balita' => htmlspecialchars($this->input->post('pilih_balita', true)),
      'usia_ukur' => htmlspecialchars($this->input->post('usia', true)),
      'bb_ukur' => htmlspecialchars($this->input->post('bb', true)),
      'tb_ukur' => htmlspecialchars($this->input->post('tb', true)),
      'lk_ukur' => htmlspecialchars($this->input->post('lk', true)),
      'bulan' => htmlspecialchars($this->input->post('bulan', true)),
      'tahun' => htmlspecialchars($this->input->post('tahun', true)),
    ];
    $this->db->insert('ukur_balita', $data);
  }

  public function getDataUkurById($id)
  {
    return $this->db->get_where('ukur_balita', ['id_ukur' => $id])->row_array();
  }

  public function getDataTerakhir()
  {
    return $this->db->get('ukur_balita')->last_row();
  }

  public function getUkurBalita()
  {
    return $this->db->get('ukur_balita')->result_array();
  }

  public function ubahDataUkur($data)
  {
    $this->db->where('id_ukur', $data['id_ukur']);
    $this->db->update('ukur_balita', $data);
    return $this->db->affected_rows();
  }

  public function hapusDU($id)
  {
    $this->db->delete('ukur_balita', ['id_ukur' => $id]);
  }

  public function joinTabel()
  {
    $this->db->select('ukur_balita.*, balita.nama');
    $this->db->from('ukur_balita');
    $this->db->join('balita', 'ukur_balita.id_balita = balita.id', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function detailDataUkur($id)
  {
    $this->db->select('ukur_balita.*, balita.nama');
    $this->db->from('ukur_balita');
    $this->db->join('balita', 'ukur_balita.id_balita = balita.id', 'left');
    $this->db->where('id_ukur', $id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getJarakBerat($usia, $berat_badan, $k)
  {
    $query = 'SQRT(POW((usia - ' . $usia . '), 2) + POW((bb - ' . $berat_badan . '), 2)) ';
    $this->db->select('id, usia, bb, sberat');
    $this->db->select($query . '  AS jarak');
    $this->db->order_by('jarak', 'asc');

    $this->db->limit($k);

    $query = $this->db->get('dataset')->result_array();
    return $query;
  }

  public function getJarakTinggi($usia, $tinggi_badan, $k)
  {
    $query = 'SQRT(POW((usia - ' . $usia . '), 2) + POW((tb - ' . $tinggi_badan . '), 2))';
    $this->db->select('id,usia, tb, stinggi');
    $this->db->select($query . ' AS jarak');
    $this->db->order_by('jarak', 'asc');

    $this->db->limit($k);

    $query = $this->db->get('dataset')->result_array();
    return $query;
  }

  public function getJarakLK($usia, $lk, $k)
  {
    $query = 'SQRT(POW((usia - ' . $usia . '), 2) + POW((lk - ' . $lk . '), 2))';
    $this->db->select('id,usia, lk, skepala');
    $this->db->select($query . ' AS jarak');
    $this->db->order_by('jarak', 'asc');

    $this->db->limit($k);

    $query = $this->db->get('dataset')->result_array();
    return $query;
  }

  public function getJarakGizi($berat_badan, $tinggi_badan, $k)
  {
    $query = 'SQRT(POW((bb - ' . $berat_badan . '),2) + POW((tb - ' . $tinggi_badan . '), 2))';
    $this->db->select('id, bb, tb, sgizi');
    $this->db->select($query . 'AS jarak');
    $this->db->order_by('jarak', true);

    $this->db->limit($k);

    $query = $this->db->get('dataset')->result_array();
    return $query;
  }

  public function totalUkurBeratSK()
  {
    $this->db->select('sberat');
    $this->db->where('sberat', 'Sangat kurang');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurBeratK()
  {
    $this->db->select('sberat');
    $this->db->where('sberat', 'Kurang');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurBeratN()
  {
    $this->db->select('sberat');
    $this->db->where('sberat', 'Normal');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurBeratR()
  {
    $this->db->select('sberat');
    $this->db->where('sberat', 'Risiko BB lebih');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurTinggiSP()
  {
    $this->db->select('stinggi');
    $this->db->where('stinggi', 'Sangat Pendek');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurTinggiP()
  {
    $this->db->select('stinggi');
    $this->db->where('stinggi', 'Pendek');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurTinggiN()
  {
    $this->db->select('stinggi');
    $this->db->where('stinggi', 'Normal');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurTinggiT()
  {
    $this->db->select('stinggi');
    $this->db->where('stinggi', 'Tinggi');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziB()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Gizi buruk');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziK()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Gizi kurang');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziN()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Gizi normal');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziBL()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Berisiko gizi lebih');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziL()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Gizi lebih');
    return $this->db->get('ukur_balita')->num_rows();
  }
  public function totalUkurGiziO()
  {
    $this->db->select('sgizi');
    $this->db->where('sgizi', 'Obesitas');
    return $this->db->get('ukur_balita')->num_rows();
  }
}

/* End of file KNN_m.php */
