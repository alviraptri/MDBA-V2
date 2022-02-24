<?php
defined('BASEPATH') or exit('No direct script access allowed');
class testprint extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MPrint');
	}

	public function index()
	{
		die('TESTPRINT');
	}

	public function testprintbkb()
	{
		$jumlahData = 7;
		if ($this->input->get('jumlah')) {
			$jumlahData	= $this->input->get('jumlah');
		}

		$data  = [];
		for ($i = 0; $i < $jumlahData; $i++) {
			$data[]  = [
				'company'   => 'PT. TIRTA VARIA INTIPRATAMA',
				'warehouse' => 'GUDANG TVIP MANIS',
				'szDocId'  => '318-0170647',
				'dtmDoc'      => '06/01/2022',
				'szEmployeeId'      => '318-DR01',
				'employee'      => 'DRIVER INTERN',
				'szVehicleId'   => 'INTERN',
				'vehicle'   => 'INTERN',
				'szDescription'    => 'TEST PRINT',
				'szDocPRId'        => '318-0157355',

				'szProductId' => '29310',
				'product' => 'VIT.TISSUE',
				'szUomId'        => 'LEMBAR',
				'decQty'       => '7',
				'remark'      => 'TEST PRINT'
			];
		}

		$this->MPrint->MPrintBKB((object)$data);
	}

	/*=========================[ Production ]=========================*/
	public function printbkb()
	{
		$data	= []; //tinggal get data dari DB dengan type array or object

		$this->MPrint->MPrintBKB($data);
	}

	/*=============== [ For Create new font ] ===============
	* Setelah font baru di generate, copy file hasil generate (ext: .php dan .z)
	* Ke dalam folder APPPATH.'/libraries/fpdf/font/'
	=======================================================*/
	public function makefont()
	{
		require(APPPATH . '/libraries/fpdf/makefont/makefont.php');

		//Font path ext: .ttf
		$font = 'C:\\Windows\\Fonts\\Tahoma.ttf';

		MakeFont($font, 'cp1252');
	}
}
