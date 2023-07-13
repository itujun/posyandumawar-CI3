<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property View_m $View_m
 * @property session $session
 * @property Balita_m $Balita_m
 * @property form_validation $form_validation
 * @property input $input
 * @property KNN_m $KNN_m
 * @property Dataset_m $Dataset_m
 * @property db $db
 */

class Knn extends CI_Controller
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
    $this->load->model('KNN_m');
    $this->load->model('Dataset_m');
  }

  public function index()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Ukur Balita';
    $page = 'admin/ukurbalita';
    // $data['dataukur'] = $this->KNN_m->getUkurBalita();
    $data['namabalita'] = $this->KNN_m->joinTabel();
    // var_dump($data['dataukur']);
    // die;

    $this->View_m->halamanUtama($data, $page);
  }

  public function tambahdataukur()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Tambah Data Ukur Balita';
    $page = 'admin/tambahukurbalita';
    $data['balita'] = $this->Balita_m->getAll();
    $data['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $this->form_validation->set_rules('pilih_balita', 'Pilih balita', 'required');
    $this->form_validation->set_rules('bb', 'Berat Badan', 'required');
    $this->form_validation->set_rules('tb', 'Tinggi Bedan', 'required');
    $this->form_validation->set_rules('lk', 'Lingkar Kepala', 'required');
    $this->form_validation->set_rules('bulan', 'Bulan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->View_m->halamanUtama($data, $page);
    } else {
      $id = $this->input->post('pilih_balita');
      $id_balita = $this->Balita_m->getBalitaById($id);
      $this->KNN_m->tambahDataUkur();
      $this->klasifikasi();


      $this->session->set_flashdata('flash-y', 'Data ukur balita atas nama ' . $id_balita['nama'] . ', pada bulan pengukuran ' . $this->input->post('bulan') . ' tahun ' . $this->input->post('tahun') . ' berhasil ditambahkan.');
      redirect('knn');
    }
  }

  public function klasifikasi()
  {
    $databaru = $this->KNN_m->getDataTerakhir();

    $iddb = $databaru->id_ukur;
    $udb = $databaru->usia_ukur;
    $bdb = $databaru->bb_ukur;
    $tdb = $databaru->tb_ukur;
    $lkdb = $databaru->lk_ukur;

    $query = $this->db->get('dataset')->result_array();

    $jarakberat = [];
    $jaraktinggi = [];
    $jarakgizi = [];
    $jaraklk = [];

    foreach ($query as $key) {
      $jarakberat[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['bb'] - $bdb, 2));
      $jaraktinggi[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['tb'] - $tdb, 2));
      $jarakgizi[$key['id']] = sqrt(pow($key['bb'] - $bdb, 2) + pow($key['tb'] - $tdb, 2));
      $jaraklk[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['lk'] - $lkdb, 2));
    }

    asort($jarakberat);
    asort($jaraktinggi);
    asort($jarakgizi);
    asort($jaraklk);

    $k = 5;
    $knnberat = array_slice($jarakberat, 0, $k, true);
    $knntinggi = array_slice($jaraktinggi, 0, $k, true);
    $knngizi = array_slice($jarakgizi, 0, $k, true);
    $knnlk = array_slice($jaraklk, 0, $k, true);

    $totalstatusberat = [];

    foreach ($knnberat as $kb => $value) {
      $statusberat = $this->db->get_where('dataset', ['id' => $kb])->row()->sberat;
      if (isset($totalstatusberat[$statusberat])) {
        $totalstatusberat[$statusberat]++;
      } else {
        $totalstatusberat[$statusberat] = 1;
      }
    }
    foreach ($knntinggi as $kb => $value) {
      $statustinggi = $this->db->get_where('dataset', ['id' => $kb])->row()->stinggi;
      if (isset($totalstatustinggi[$statustinggi])) {
        $totalstatustinggi[$statustinggi]++;
      } else {
        $totalstatustinggi[$statustinggi] = 1;
      }
    }
    foreach ($knngizi as $kb => $value) {
      $statusgizi = $this->db->get_where('dataset', ['id' => $kb])->row()->sgizi;
      if (isset($totalstatusgizi[$statusgizi])) {
        $totalstatusgizi[$statusgizi]++;
      } else {
        $totalstatusgizi[$statusgizi] = 1;
      }
    }
    foreach ($knnlk as $kb => $value) {
      $statuslk = $this->db->get_where('dataset', ['id' => $kb])->row()->skepala;
      if (isset($totalstatuslk[$statuslk])) {
        $totalstatuslk[$statuslk]++;
      } else {
        $totalstatuslk[$statuslk] = 1;
      }
    }

    $sberat = array_search(max($totalstatusberat), $totalstatusberat);
    $stinggi = array_search(max($totalstatustinggi), $totalstatustinggi);
    $sgizi = array_search(max($totalstatusgizi), $totalstatusgizi);
    $slk = array_search(max($totalstatuslk), $totalstatuslk);

    $this->db->set('sberat', $sberat);
    $this->db->set('stinggi', $stinggi);
    $this->db->set('sgizi', $sgizi);
    $this->db->set('skepala', $slk);
    $this->db->where('id_ukur', $iddb);
    $this->db->update('ukur_balita');

    $this->db->set('usia', $udb);
    $this->db->set('bb', $bdb);
    $this->db->set('tb', $tdb);
    $this->db->set('lk', $lkdb);
    $this->db->set('sberat', $sberat);
    $this->db->set('stinggi', $stinggi);
    $this->db->set('sgizi', $sgizi);
    $this->db->set('skepala', $slk);
    $this->db->insert('dataset');
  }

  public function detailukur($id)
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Detail Ukur Balita';
    $page = 'admin/detailukur';
    $data['balita'] = $this->KNN_m->detailDataUkur($id);
    $data['saranb'] = $this->saranberat($data['balita']['sberat']);
    $data['sarant'] = $this->sarantinggi($data['balita']['stinggi']);
    $data['sarang'] = $this->sarangizi($data['balita']['sgizi']);

    if ($data['balita']['sberat'] == 'Risiko BB lebih' || $data['balita']['sberat'] == 'Sangat kurang') {
      $data['class1'] = 'bg-gradient-danger text-light';
    } else if ($data['balita']['sberat'] == 'Kurang') {
      $data['class1'] = 'bg-gradient-warning text-dark';
    } else {
      $data['class1'] = 'bg-gradient-success text-light';
    }
    if ($data['balita']['stinggi'] == 'Sangat pendek' || $data['balita']['stinggi'] == 'Tinggi') {
      $data['class2'] = 'bg-gradient-danger text-light';
    } else if ($data['balita']['stinggi'] == 'Pendek') {
      $data['class2'] = 'bg-gradient-warning text-dark';
    } else {
      $data['class2'] = 'bg-gradient-success text-light';
    }
    if ($data['balita']['sgizi'] == 'Gizi buruk' || $data['balita']['sgizi'] == 'Gizi lebih' || $data['balita']['sgizi'] == 'Obesitas') {
      $data['class3'] = 'bg-gradient-danger text-light';
    } else if ($data['balita']['sgizi'] == 'Gizi kurang' || $data['balita']['sgizi'] == 'Berisiko gizi lebih') {
      $data['class3'] = 'bg-gradient-warning text-dark';
    } else {
      $data['class3'] = 'bg-gradient-success text-light';
    }

    $usia = $data['balita']['usia_ukur'];
    $bb = $data['balita']['bb_ukur'];
    $tb = $data['balita']['tb_ukur'];
    $lk = $data['balita']['lk_ukur'];
    $k = 5;
    $data['berat'] = $this->KNN_m->getJarakBerat($usia, $bb, $k);
    $data['tinggi'] = $this->KNN_m->getJarakTinggi($usia, $tb, $k);
    $data['gizi'] = $this->KNN_m->getJarakGizi($bb, $tb, $k);
    $data['lk'] = $this->KNN_m->getJarakLk($usia, $lk, $k);

    $this->View_m->halamanUtama($data, $page);
  }

  public function ubahukur($id)
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Ubah Ukur Balita';
    $page = 'admin/ubahukur';
    $data['balita'] = $this->KNN_m->detailDataUkur($id);

    // var_dump($data['balita']);
    // die;
    $data['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $this->form_validation->set_rules('usia', 'Usia', 'required|numeric');
    $this->form_validation->set_rules('bb', 'Berat Badan', 'required');
    $this->form_validation->set_rules('tb', 'Tinggi Bedan', 'required');
    $this->form_validation->set_rules('lk', 'Lebar Kepala', 'required');
    $this->form_validation->set_rules('bulan', 'Bulan', 'required');

    if ($this->form_validation->run() ==  FALSE) {
      $this->View_m->halamanUtama($data, $page);
    } else {
      $data = [
        'id_balita' => htmlspecialchars($this->input->post('id_balita', true)),
        'usia_ukur' => htmlspecialchars($this->input->post('usia', true)),
        'bb_ukur' => htmlspecialchars($this->input->post('bb', true)),
        'tb_ukur' => htmlspecialchars($this->input->post('tb', true)),
        'lk_ukur' => htmlspecialchars($this->input->post('lk', true)),
        'bulan' => htmlspecialchars($this->input->post('bulan', true)),
        'tahun' => htmlspecialchars($this->input->post('tahun', true)),
      ];
      $dataukur = $this->KNN_m->detailDataUkur($id);
      if ($dataukur) {
        $data['id_ukur'] = $id;
        $perubahan = $this->KNN_m->ubahDataUkur($data);
        if ($perubahan > 0) {
          $this->klasifikasiulang($id);
          $this->session->set_flashdata('flash-y', 'Data ukur ' . $dataukur['nama'] . ' berhasil diubah.');
        } else {
          $this->session->set_flashdata('flash-i', 'Tidak ada perubahan pada data ukur ' . $dataukur['nama'] . '.');
        }
        redirect('knn');
      } else {
        $this->session->set_flashdata('flash-y', 'Data ukur ' . $dataukur['nama'] . ' tidak ditemukan.');
      }
      redirect('knn');
    }
  }

  public function klasifikasiulang($id)
  {
    $databaru = $this->KNN_m->getDataUkurById($id);
    $iddb = $databaru['id_ukur'];
    $udb = $databaru['usia_ukur'];
    $bdb = $databaru['bb_ukur'];
    $tdb = $databaru['tb_ukur'];
    $lkdb = $databaru['lk_ukur'];

    $query = $this->db->get('dataset')->result_array();

    $jarakberat = [];
    $jaraktinggi = [];
    $jarakgizi = [];
    $jaraklk = [];

    foreach ($query as $key) {
      $jarakberat[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['bb'] - $bdb, 2));
      $jaraktinggi[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['tb'] - $tdb, 2));
      $jarakgizi[$key['id']] = sqrt(pow($key['bb'] - $bdb, 2) + pow($key['tb'] - $tdb, 2));
      $jaraklk[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['lk'] - $lkdb, 2));
    }

    asort($jarakberat);
    asort($jaraktinggi);
    asort($jarakgizi);
    asort($jaraklk);

    $k = 5;
    $knnberat = array_slice($jarakberat, 0, $k, true);
    $knntinggi = array_slice($jaraktinggi, 0, $k, true);
    $knngizi = array_slice($jarakgizi, 0, $k, true);
    $knnlk = array_slice($jaraklk, 0, $k, true);

    foreach ($knnberat as $kb => $value) {
      $statusberat = $this->db->get_where('dataset', ['id' => $kb])->row()->sberat;
      if (isset($totalstatusberat[$statusberat])) {
        $totalstatusberat[$statusberat]++;
      } else {
        $totalstatusberat[$statusberat] = 1;
      }
    }
    foreach ($knntinggi as $kb => $value) {
      $statustinggi = $this->db->get_where('dataset', ['id' => $kb])->row()->stinggi;
      if (isset($totalstatustinggi[$statustinggi])) {
        $totalstatustinggi[$statustinggi]++;
      } else {
        $totalstatustinggi[$statustinggi] = 1;
      }
    }
    foreach ($knngizi as $kb => $value) {
      $statusgizi = $this->db->get_where('dataset', ['id' => $kb])->row()->sgizi;
      if (isset($totalstatusgizi[$statusgizi])) {
        $totalstatusgizi[$statusgizi]++;
      } else {
        $totalstatusgizi[$statusgizi] = 1;
      }
    }
    foreach ($knnlk as $kb => $value) {
      $statuslk = $this->db->get_where('dataset', ['id' => $kb])->row()->skepala;
      if (isset($totalstatuslk[$statuslk])) {
        $totalstatuslk[$statuslk]++;
      } else {
        $totalstatuslk[$statuslk] = 1;
      }
    }

    $sberat = array_search(max($totalstatusberat), $totalstatusberat);
    $stinggi = array_search(max($totalstatustinggi), $totalstatustinggi);
    $sgizi = array_search(max($totalstatusgizi), $totalstatusgizi);
    $slk = array_search(max($totalstatuslk), $totalstatuslk);

    $this->db->set('sberat', $sberat);
    $this->db->set('stinggi', $stinggi);
    $this->db->set('sgizi', $sgizi);
    $this->db->set('skepala', $slk);
    $this->db->where('id_ukur', $iddb);
    $this->db->update('ukur_balita');

    $this->db->set('usia', $udb);
    $this->db->set('bb', $bdb);
    $this->db->set('tb', $tdb);
    $this->db->set('lk', $lkdb);
    $this->db->set('sberat', $sberat);
    $this->db->set('stinggi', $stinggi);
    $this->db->set('sgizi', $sgizi);
    $this->db->set('skepala', $slk);
    $this->db->insert('dataset');
  }

  public function hapusdataukur($id)
  {
    $ub = $this->KNN_m->detailDataUkur($id);
    $this->KNN_m->hapusDU($id);
    $this->session->set_flashdata('flash-y', 'Data ukur balita dengan nama ' . $ub['nama'] . ', pada bulan pengukuran ' . $ub['bulan'] . ' tahun ' . $ub['tahun'] . ' berhasil dihapus.');
    redirect('knn');
  }

  public function hitungusia()
  {
    $selectedBalitaId = $this->input->post('balita_id');
    $balita = $this->Balita_m->getBalitaById($selectedBalitaId);
    if ($balita) {
      // Ubah format tanggal menjadi objek DateTime
      $tglLahir = new DateTime($balita['tgl_lahir']);
      // Hitung usia dalam bulan
      $usiaBulan = $tglLahir->diff(new DateTime())->y * 12 + $tglLahir->diff(new DateTime())->m;
      echo $usiaBulan;
    } else {
      echo '';
    }
  }

  public function saranberat($sb)
  {
    if ($sb == 'Sangat kurang') {
      return 'Pastikan balita mendapatkan makanan yang seimbang dan bergizi. Tambahkan makanan kaya kalori dan nutrisi ke dalam dietnya, seperti susu, daging, ikan, telur, buah-buahan, sayuran, biji-bijian, dan makanan berlemak sehat.
      <br>Berikan makanan penambah berat badan: Beberapa balita mungkin membutuhkan makanan penambah berat badan khusus.';
    } else if ($sb == 'Kurang') {
      return '<p>Pastikan makanan yang diberikan kepada balita adalah makanan yang seimbang dan bergizi. Sertakan makanan tinggi protein seperti daging, ikan, telur, dan kacang-kacangan. Selain itu, berikan juga buah-buahan, sayuran, dan biji-bijian sebagai sumber vitamin dan serat.</p>';
    } else if ($sb == 'Normal') {
      return '<p>Selalu perhatikan porsi makan balita dan pastikan tidak terlalu kecil atau terlalu besar. Porsi makan yang tepat akan membantu menjaga berat badan balita dalam rentang normal.</p>';
    } else {
      return '<p>Hindari makanan olahan, makanan cepat saji, camilan tinggi gula dan lemak, serta minuman manis.
      <br>Dorong balita untuk aktif bergerak dan bermain. Aktivitas fisik membantu membakar kalori dan memperbaiki keseimbangan energi dalam tubuh balita.</p>';
    }
  }

  public function sarantinggi($st)
  {
    if ($st == 'Sangat pendek') {
      return '<p>Pastikan balita mendapatkan nutrisi yang cukup untuk mendukung pertumbuhan tinggi badannya. Sertakan makanan yang kaya akan protein, kalsium, vitamin D, dan zat besi dalam dietnya. Misalnya, konsumsi daging, ikan, telur, produk susu, kacang-kacangan, sayuran hijau, dan biji-bijian.</p>';
    } else if ($st == 'Pendek') {
      return '<p>Pastikan balita mendapatkan makanan sehat secara teratur dan porsi yang cukup. Hindari makanan olahan, makanan cepat saji, dan camilan yang kurang bernutrisi. Fokus pada makanan segar, termasuk buah-buahan, sayuran, biji-bijian, dan sumber protein.</p>';
    } else if ($st == 'Normal') {
      return '<p>Pastikan untuk selalu menjaga pola makan balita secara teratur untuk mendapatkan tinggi badan ideal</p>';
    } else {
      return '<p>Meskipun tinggi badan yang tinggi bukan masalah, penting untuk memastikan bahwa berat badan balita tetap seimbang dengan tingginya. Jaga agar balita tidak mengalami kelebihan berat badan atau obesitas yang dapat berdampak negatif pada kesehatannya.</p>';
    }
  }

  public function sarangizi($sg)
  {
    if ($sg == 'Gizi buruk') {
      return '<p>Berikan makanan yang kaya akan protein, karbohidrat, lemak sehat, vitamin, dan mineral. Diskusikan dengan dokter atau ahli gizi untuk mendapatkan rekomendasi tentang jenis dan jumlah makanan yang sesuai.</p>';
    } else if ($sg == 'Gizi kurang') {
      return '<p>Pastikan balita mendapatkan asupan nutrisi yang cukup untuk memperbaiki status gizinya. Berikan makanan yang kaya akan protein, karbohidrat, lemak sehat, vitamin, dan mineral. Pilih makanan yang bervariasi seperti daging, ikan, telur, produk susu, sayuran, buah-buahan, dan biji-bijian.</p>';
    } else if ($sg == 'Gizi baik') {
      return '<p>Lanjutkan memberikan makanan yang seimbang dan bergizi kepada balita. Pastikan dia mendapatkan asupan nutrisi yang cukup dari berbagai kelompok makanan seperti sayuran, buah-buahan, biji-bijian, protein, dan produk susu. Variasikan jenis makanan yang diberikan agar balita mendapatkan berbagai nutrisi penting.</p>';
    } else if ($sg == 'Berisiko gizi lebih ') {
      return '<p>Lakukan pemantauan teratur terhadap berat badan, tinggi badan, dan pertumbuhan balita. Diskusikan hasil pemantauan dengan dokter atau petugas kesehatan untuk mendapatkan panduan yang tepat.</p>';
    } else if ($sg == 'Gizi lebih') {
      return '<p>Perhatikan ukuran porsi makanan yang diberikan kepada balita. Jangan memaksa balita untuk makan lebih dari yang dibutuhkan. Berikan porsi yang sesuai dengan usia dan kebutuhan balita. </p>';
    } else if ($sg == 'Obesitas') {
      return '<p>Segera berkonsultasi dengan dokter atau ahli gizi untuk mengevaluasi dan memantau status gizi balita secara teratur. Mereka akan memberikan panduan yang tepat berdasarkan kondisi dan kebutuhan balita.</p>';
    }
  }



  public function nyobain()
  {
    $databaru = $this->KNN_m->getDataTerakhir();

    // $iddb = $databaru->id_ukur;
    $udb = 17;
    $bdb = 10;
    $tdb = 85;

    $query = $this->db->get('dataset')->result_array();

    $jarakberat = [];
    $jaraktinggi = [];
    $jarakgizi = [];

    foreach ($query as $key) {
      $jarakberat[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['bb'] - $bdb, 2));
      $jaraktinggi[$key['id']] = sqrt(pow($key['usia'] - $udb, 2) + pow($key['tb'] - $tdb, 2));
      $jarakgizi[$key['id']] = sqrt(pow($key['bb'] - $bdb, 2) + pow($key['tb'] - $tdb, 2));
    }

    asort($jarakberat);
    asort($jaraktinggi);
    asort($jarakgizi);


    $k = 5;
    $knnberat = array_slice($jarakberat, 0, $k, true);
    $knntinggi = array_slice($jaraktinggi, 0, $k, true);
    $knngizi = array_slice($jarakgizi, 0, $k, true);
    var_dump($knngizi);
    die;

    $totalstatusberat = [];

    foreach ($knnberat as $kb => $value) {
      $statusberat = $this->db->get_where('dataset', ['id' => $kb])->row()->sberat;
      if (isset($totalstatusberat[$statusberat])) {
        $totalstatusberat[$statusberat]++;
      } else {
        $totalstatusberat[$statusberat] = 1;
      }
    }
    foreach ($knntinggi as $kb => $value) {
      $statustinggi = $this->db->get_where('dataset', ['id' => $kb])->row()->stinggi;
      if (isset($totalstatustinggi[$statustinggi])) {
        $totalstatustinggi[$statustinggi]++;
      } else {
        $totalstatustinggi[$statustinggi] = 1;
      }
    }
    foreach ($knngizi as $kb => $value) {
      $statusgizi = $this->db->get_where('dataset', ['id' => $kb])->row()->sgizi;
      if (isset($totalstatusgizi[$statusgizi])) {
        $totalstatusgizi[$statusgizi]++;
      } else {
        $totalstatusgizi[$statusgizi] = 1;
      }
    }

    $sberat = array_search(max($totalstatusberat), $totalstatusberat);
    $stinggi = array_search(max($totalstatustinggi), $totalstatustinggi);
    $sgizi = array_search(max($totalstatusgizi), $totalstatusgizi);

    // $this->db->set('sberat', $sberat);
    // $this->db->set('stinggi', $stinggi);
    // $this->db->set('sgizi', $sgizi);
    // $this->db->where('id_ukur', $iddb);
    // $this->db->update('ukur_balita');
  }
}
/* End of file Knn.php */
