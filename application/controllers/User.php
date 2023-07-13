<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property session $session
 * @property db $db
 * @property KNN_m $KNN_m
 * @property View_m $View_m
 */

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
    $this->load->model('View_m');
    $this->load->model('KNN_m');
  }

  public function index()
  {
    $data['login'] = $this->View_m->getUserBySession();
    $data['title'] = 'Info Balita';
    $page = 'user/infobalita';
    // $data['namabalita'] = $this->KNN_m->joinTabel();

    $this->db->select('bulan, id_balita, bb_ukur, tb_ukur, usia_ukur,sberat, stinggi, sgizi');
    $this->db->where('id_balita', 28);
    $data['balita'] = $this->db->get('ukur_balita')->result_array();
    $data['last_data'] = $this->db->get('ukur_balita')->last_row();

    $data['saran_b'] = $this->saranberat($data['last_data']->sberat);
    $data['saran_t'] = $this->sarantinggi($data['last_data']->stinggi);
    $data['saran_g'] = $this->sarangizi($data['last_data']->sgizi);

    $this->db->select('ukur_balita.*, balita.nama');
    $this->db->from('ukur_balita');
    $this->db->join('balita', 'ukur_balita.id_balita = balita.id', 'left');
    $this->db->where('id_ukur', 60);
    $data['balitaa'] = $this->db->get()->row_array();
    $this->View_m->halamanUtama($data, $page);
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
    } else if ($sg == 'Gizi normal') {
      return '<p>Lanjutkan memberikan makanan yang seimbang dan bergizi kepada balita. Pastikan dia mendapatkan asupan nutrisi yang cukup dari berbagai kelompok makanan seperti sayuran, buah-buahan, biji-bijian, protein, dan produk susu. Variasikan jenis makanan yang diberikan agar balita mendapatkan berbagai nutrisi penting.</p>';
    } else if ($sg == 'Berisiko gizi lebih ') {
      return '<p>Lakukan pemantauan teratur terhadap berat badan, tinggi badan, dan pertumbuhan balita. Diskusikan hasil pemantauan dengan dokter atau petugas kesehatan untuk mendapatkan panduan yang tepat.</p>';
    } else if ($sg == 'Gizi lebih') {
      return '<p>Perhatikan ukuran porsi makanan yang diberikan kepada balita. Jangan memaksa balita untuk makan lebih dari yang dibutuhkan. Berikan porsi yang sesuai dengan usia dan kebutuhan balita. </p>';
    } else if ($sg == 'Obesitas') {
      return '<p>Segera berkonsultasi dengan dokter atau ahli gizi untuk mengevaluasi dan memantau status gizi balita secara teratur. Mereka akan memberikan panduan yang tepat berdasarkan kondisi dan kebutuhan balita.</p>';
    }
  }
}

/* End of file Member.php */
