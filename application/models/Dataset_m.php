<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dataset_m extends CI_Model
{

  public function getAll()
  {
    return $this->db->get('dataset')->result_array();
  }

  public function getDatasetbyId($id)
  {
    return $this->db->get_where('dataset', ['id' => $id])->row_array();
  }

  public function getTotalDataset()
  {
    return $this->db->get('dataset')->num_rows();
  }

  public function getJarak($k)
  {
    $this->db->order_by('jarak');
    $this->db->limit($k);

    $query = $this->db->get('dataset')->result_array();
    return $query;
  }

  public function tambah($u, $b, $t, $bbzs, $sbb, $tbzs, $stb, $sgzs, $sg)
  {
    $data = [
      'usia' => $u,
      'bb' => $b,
      'tb' => $t,
      'jberat' => $bbzs,
      'sberat' => $sbb,
      'jtinggi' => $tbzs,
      'stinggi' => $stb,
      'jgizi' => $sgzs,
      'sgizi' => $sg,
    ];
    $this->db->insert('dataset', $data);
  }

  public function getTotalDs()
  {
    $this->db->count_all('dataset');
  }

  public function hapus($id)
  {
    $this->db->delete('dataset', ['id' => $id]);
  }

  public function cekSberat($usia, $berat)
  {
    $query =  $this->db->get_where('bb_u', ['usia' => $usia]);

    if ($query->num_rows() > 0) {
      $antropometri = $query->row_array();

      if ($berat < $antropometri['median']) {
        $zscore = ($berat - $antropometri['median']) / ($antropometri['median'] - $antropometri['-1sd']);
      } else if ($berat >= $antropometri['median']) {
        $zscore = ($berat - $antropometri['median']) / ($antropometri['+1sd'] - ($antropometri['median']));
      }

      if ($zscore < -3) {
        $statusberat = 'Sangat kurang';
      } else if ($zscore >= -3 && $zscore < -2) {
        $statusberat = 'Kurang';
      } else if ($zscore >= -2 && $zscore <= 1) {
        $statusberat = 'Normal';
      } else if ($zscore > 1) {
        $statusberat = 'Risiko BB lebih';
      }
      $data['hasilberat'] = ['zscore' => $zscore, 'sberat' => $statusberat];
      return $data['hasilberat'];
    }
  }

  public function cekStinggi($usia, $tinggi)
  {
    $query = $this->db->get_where('tb_u', ['usia' => $usia]);
    if ($query->num_rows() > 0) {
      $antropometri = $query->row_array();

      if ($tinggi < $antropometri['median']) {
        $zscore = ($tinggi - $antropometri['median']) / ($antropometri['median'] - $antropometri['-1sd']);
      } else if ($tinggi >= $antropometri['median']) {
        $zscore = ($tinggi - $antropometri['median']) / ($antropometri['+1sd'] - $antropometri['median']);
      }

      if ($zscore < -3) {
        $statustinggi = 'Sangat pendek';
      } else if ($zscore >= -3 && $zscore < -2) {
        $statustinggi = 'Pendek';
      } else if ($zscore >= -2 && $zscore <= 3) {
        $statustinggi = 'Normal';
      } else if ($zscore > 3) {
        $statustinggi = 'Tinggi';
      }

      $data['hasiltinggi'] = ['zscore' => $zscore, 'stinggi' => $statustinggi];
      return $data['hasiltinggi'];
    }
  }

  public function cekSgizi($usia, $berat, $tinggi)
  {
    if ($usia >= 0 && $usia < 24) {
      $usia = 1;
      return $this->lanjutcekSgizi($usia, $berat, $tinggi);
    } else if ($usia >= 24 && $usia <= 60) {
      $usia = 2;
      return $this->lanjutcekSgizi($usia, $berat, $tinggi);
    } else {
      echo 'Usia tidak dikenali.';
    }
  }

  public function lanjutcekSgizi($usia, $berat, $tinggi)
  {
    $tinggii = round($tinggi * 2) / 2;
    $query = $this->db->get_where('bb_tb', ['usia' => $usia, 'tb' => $tinggii]);
    if ($query->num_rows() > 0) {
      $antropometri = $query->row_array();
      if ($berat < $antropometri['median']) {
        $zscore = ($berat - $antropometri['median']) / ($antropometri['median'] - $antropometri['-1sd']);
      } else if ($berat >= $antropometri['median']) {
        $zscore = ($berat - $antropometri['median']) / ($antropometri['+1sd'] - $antropometri['median']);
      }

      if ($zscore < -3) {
        $statusgizi = 'Gizi buruk';
      } else if ($zscore >= -3 && $zscore < -2) {
        $statusgizi = 'Gizi kurang';
      } else if ($zscore >= -2 && $zscore < 1) {
        $statusgizi = 'Gizi normal';
      } else if ($zscore >= 1 && $zscore < 2) {
        $statusgizi = 'Berisiko gizi lebih';
      } else if ($zscore >= 2 && $zscore < 3) {
        $statusgizi = 'Gizi lebih';
      } else if ($zscore >= 3) {
        $statusgizi = 'Obesitas';
      }

      $data['hasilgizi'] = ['zscore' => $zscore, 'sgizi' => $statusgizi];
      return $data['hasilgizi'];
    }
  }
}

/* End of file Dataset_m.php */
