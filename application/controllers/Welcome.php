<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property input $input
 * 
 */

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$dl = [
			[29, 350, 'hijau'],
			[51, 430, 'merah'],
			[33, 290, 'hijau'],
			[24, 255, 'hijau'],
			[40, 410, 'merah'],
			[45, 380, 'merah'],
		];

		$input1 = $this->input->post('input1');
		$input2 = $this->input->post('input2');
		$du = [$input1, $input2];

		$k = 3;
		$jater = [];
		$sg = ['hijau' => 0, 'merah' => 0];

		// var_dump($dl[count($dl) - 1]);
		// die;

		foreach ($dl as $data) {
			$vektor = array_slice($data, 0, -1);
			$kelas = $data[count($data) - 1];
			$jarak = $this->hitungJarak($du, $vektor);

			$jater[] = ['jarak' => $jarak, 'warna' => $kelas];
			// var_dump($jarakTerdekat);
			// die;
		}

		usort($jater, function ($a, $b) {
			return $a['jarak'] - $b['jarak'];
		});

		$jater = array_slice($jater, 0, $k);

		foreach ($jater as $tetangga) {
			$kelas = $tetangga['warna'];
			$sg[$kelas]++;
		}

		$kelasTerbanyak = '';
		$jumlahTerbanyak = 0;

		foreach ($sg as $kelas => $jumlah) {
			if ($jumlah > $jumlahTerbanyak) {
				$kelasTerbanyak = $kelas;
				$jumlahTerbanyak = $jumlah;
			}
		}

		$data['hasil'] = $kelasTerbanyak;
		$this->load->view('welcome', $data);
	}

	function hitungJarak($vektor1, $vektor2)
	{
		$jarak = 0;
		$n = count($vektor1);

		for ($i = 0; $i < $n; $i++) {
			$jarak += pow($vektor1[$i] - $vektor2[$i], 2);
		}

		return sqrt($jarak);
	}
}
