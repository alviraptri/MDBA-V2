<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MPrint extends CI_Model
{
	/*====================[Variable Requirement]====================
	* 1.  PRINT BKB DISTRIBUSI :
	*     $Data = [
	*				"warehouse"			=>"GUDANG TVIP MANIS"
	*				"szEmployeeId"	=>"318-D079"
	*				"employee"			=>"HERU HERDIAN"
	*				"szVehicleId"		=>"318-D094"
	*				"vehicle"				=>"B 9075 RI"
	*				"szDescription"	=>"RIT2"
	*				"szDocId"				=>"318-0171076"
	*				"dtmDoc"				=>"2022-01-10 00:00:00"
	*				"szDocPRId"			=>"318-0157801"
	*				"szProductId"		=>"74559G"
	*				"product"				=>"AQ.5GALLON BTL"
	*				"decQty"				=>"192.00"
	*				"szUomId"				=>"BOTOL"
	*				"company"				=>"PT. TIRTA VARIA INTIPRATAMA"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 318-0171146
	*     - 6 rows  : 318-0171088
	*     - 4 rows  : 318-0171097
	* 2.  PRINT BTB DISTRIBUSI :
	*     $Data = [
	*				"company"				=>"PT. TIRTA VARIA INTIPRATAMA"
	*				"branch"				=>"DEPO MANIS"
	*				"warehouse"			=>"GUDANG TVIP MANIS"
	*				"szDocId"				=>"318-0120684"
	*				"szEmployeeId"	=>"318-R150"
	*				"employee"			=>"ZAENAL MUSTOFA"
	*				"dtmDoc"				=>"2022-01-10 00:00:00"
	*				"szVehicleId"		=>"B 9711 TYW"
	*				"vehicle"				=>"B 9711 TYW"
	*				"szStockType"		=>"JUAL"
	*				"szDescription"	=>"RIT1/BSAG/2"
	*				"szProductId"		=>"74559G"
	*				"product"				=>"AQ.5GALLON BTL"
	*				"decQty"				=>"252.00"
	*				"szUomId"				=>"BOTOL"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 
	*     - 5 rows  : 318-0120746
	*     - 4 rows  : 318-0120776
	* 3.  PRINT BKB SUPPLIER :
	*     $Data = [
	*				"szBranchId"		=>"318"
	*				"branchName"		=>"DEPO MANIS"
	*				"szVehicle2"		=>"A 9488 ZM"
	*				"szVehicle"			=>"MANUAL"
	*				"szDriver2"			=>"WAHYU"
	*				"szDriver"			=>"MANUAL"
	*				"szRefDocId"		=>"5043315537"
	*				"szDescription"	=>"22010706630"
	*				"szDocId"				=>"318-0021510"
	*				"dtmDoc"				=>"2022-01-11 00:00:00"
	*				"szStockType"		=>"JUAL"
	*				"szRef1"				=>"22010706630"
	*				"szProductId"		=>"74559G"
	*				"product"				=>"AQ.5GALLON BTL"
	*				"decQty"				=>"1003.00"
	*				"szUomId"				=>"BOTOL"
	*				"szWarehouseId"	=>"318-W01"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 
	*     - 5 rows  : 
	*     - 4 rows  : 
	* 4.  PRINT BTB SUPPLIER :
	*     $Data = [
	*				"szBranchId"		=>"318"
	*				"branchName"		=>"DEPO MANIS"
	*				"szVehicle2"		=>"F 9668 FE"
	*				"szVehicle"			=>"MANUAL"
	*				"szDriver2"			=>"ALDIN"
	*				"szDriver"			=>"MANUAL"
	*				"szRefDocId"		=>"5043281981"
	*				"szDescription"	=>"BSAS/A220/0"
	*				"szDocId"				=>"318-0037369"
	*				"dtmDoc"				=>"2022-01-10 00:00:00"
	*				"szStockType"		=>"JUAL"
	*				"szRef1"				=>"21123005302"
	*				"szProductId"		=>"134578"
	*				"product"				=>"AQ.220ML 1X48"
	*				"decQty"				=>"1536.00"
	*				"szUomId"				=>"BOX"
	*				"szWarehouseId"	=>"318-W01"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 
	*     - 5 rows  : 
	*     - 4 rows  : 318-0037426
	* 5.  PRINT BKB DEPOT :
	*     $Data = [
					"warehouse"=>"GUDANG TVIP KELAPA DUA"
					"szDescription"=>"SA ADMINISTRASI DATA / NO SA 61202"
					"szDocId"=>"320-0002683"
					"dtmDoc"=>"2021-12-31 00:00:00"
					"szProductId"=>"74553"
					"product"=>"AQ.1500ML 1X12"
					"decQty"=>"1000.00"
					"szUomId"=>"BOX"
					"company"=>"PT. TIRTA VARIA INTIPRATAMA"
					"depoTujuan"=>"DEPO BINTARO"
					"depoKirim"=>"DEPO KELAPA DUA"
					"szPartyId"=>"313"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 
	*     - 5 rows  : 
	*     - 1 rows  : 320-0002683
	* 6.  PRINT BTB DEPOT :
	*     $Data = [
					"warehouse"			=>"GUDANG TVIP KELAPA DUA"
					"szDescription"	=>"ARDANTONI / B 9840 NYU / SA 61614 / SA TRANSFER BS "
					"szDocId"				=>"320-0003070"
					"dtmDoc"				=>"2022-01-10 00:00:00"
					"szProductId"		=>"41001"
					"product"				=>"BS - AQ. GALLON ISI"
					"decQty"				=>"250.00"
					"szUomId"				=>"BOTOL"
					"company"				=>"PT. TIRTA VARIA INTIPRATAMA"
					"depoKirim"			=>"DEPO MANIS"
					"depoTerima"		=>"DEPO KELAPA DUA"
					"szPartyId"			=>"318"
	*     ];
	*     TEST PRINT :
	*     - 9 rows  : 
	*     - 5 rows  : 
	*     - 2 rows  : 320-0003070
	==============================================================*/

	/*====================[ Settings Variable ]====================*/
	// Page Setting
	var $_pageWidht				= 254;
	var $_pageHeight			= 93;
	var $_pageOrientation	= 'L';	//L = Landscape; P = Potrait
	var $maxWidth					= 200;	//Max content width

	//Font
	var $fontFamily	= 'calibri';
	var $fontSize		= ['S' => 10, 'R' => 10, 'L' => 14];
	var $p  				= 4; //Line Height Standar Font Size
	var $h  				= 6.5; //Line Height Title Font Size

	//X,Y axis
	var $x1  			= 7; //first X axist
	var $y1  			= 6.5; //first Y axist
	var $x2  			= 0;
	var $y2  			= 0;

	//Box width
	var $w				= [
		0 => 5,
		1 => 10,
		2 => 15,
		3 => 20,
		4 => 25,
		5 => 30,
		6 => 35,
		7 => 40,
		8 => 45,
		9 => 50,
		10 => 55,
		11 => 60,
		12 => 65,
		13 => 70,
		14 => 75,
		15 => 80,
		16 => 85,
		17 => 90,
		18 => 95,
		19 => 100
	];

	// Define variable
	var $addPage  	= false;
	var $maxRow1		= 4; //Max row on one page print
	var $multiple1	= 0; //Next Max row on one page print
	var $maxRow2		= 8; //Max row per page
	var $multiple2	= 0; //Next Max row per page
	var $page				= 1;

	var $pdf;
	var $header;
	/*=============================================================*/

	public function __construct()
	{
		parent::__construct();
		require(APPPATH . '/libraries/fpdf/print_bkb_btb.php');

		//Set ukuran & add page
		$this->pdf  = new print_bkb_btb($this->_pageOrientation, 'mm', array($this->_pageHeight, $this->_pageWidht));
		$this->pdf->AddPage();
		$this->pdf->SetMargins(0, -1, 0);
		$this->pdf->SetAutoPageBreak(false, 0);
		$this->pdf->SetLineWidth(0.05);
		$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off

		//Set Font
		$this->pdf->AddFont('tahoma', '', 'Tahoma.php');
		$this->pdf->AddFont('verdana', '', 'courier.php');
		$this->pdf->AddFont('calibri', '', 'calibri.php');
		$this->pdf->AddFont('consola', '', 'consola.php');
		$this->pdf->AddFont('arialnarrow', '', 'ARIALN.php');
		$this->pdf->AddFont('leddotmatrix', '', 'LED Dot-Matrix.php');
		$this->pdf->AddFont('squaredotmatrix', '', 'Square-Dot-Matrix.php');
		$this->pdf->AddFont('dubailight', '', 'DUBAI-LIGHT.php');
		$this->pdf->AddFont('squaredotdigital', '', 'square_dot_digital-7.php');
		$this->pdf->AddFont('serifdotdigital', '', 'serif_dot_digital-7.php');
		$this->pdf->AddFont('moderndotdigital', '', 'modern_dot_digital-7.php');
		$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
	}

	private function setHeaderDistribusi($type = null)
	{
		//Text baris 1
		$branch	= null;
		if (isset($this->header['branch'])) {
			$branch	= ' - ' . $this->header['branch'];
		}
		$this->x2 = $this->x1;
		$this->y2 = $this->y1;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell(($this->maxWidth * 0.6), $this->p, $this->header['company'] . $branch);
		$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		//Text baris 2
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['L']);
		if (strtoupper($type) == 'BTBD') {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI TERIMA BARANG (FRM.WO.12)', 0, 0, 'C');
		} else {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI KELUAR BARANG (FRM.WO.01)', 0, 0, 'C');
		}
		//Text baris 3
		$this->y2 += $this->h;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['R']);
		$this->pdf->Cell($this->w[5], $this->p, 'NAMA GUDANG');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['warehouse']);
		$this->pdf->Cell($this->w[5], $this->p, 'DOCUMENT ID');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szDocId']);
		//Text baris 4
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'PENGEMUDI');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szEmployeeId'] . ' - ' . $this->header['employee']);
		$this->pdf->Cell($this->w[5], $this->p, 'TANGGAL');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . date('Y/m/d', strtotime($this->header['dtmDoc'])));
		//Text baris 5
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'KENDARAAN');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szVehicleId'] . ' - ' . $this->header['vehicle']);
		if (strtoupper($type) == 'BTBD') {
			$this->pdf->Cell($this->w[5], $this->p, 'TIPE PERSEDIAAN');
			$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szStockType']);
		} else {
			$this->pdf->Cell($this->w[5], $this->p, 'NO. PB');
			$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szDocPRId']);
		}
		//Text baris 6
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'KETERANGAN');
		$this->pdf->Cell($this->maxWidth - $this->w[5], $this->p, ':  ' . $this->header['szDescription']);
	}

	private function setHeaderSupplier($type = null)
	{
		//Text baris 1
		$this->x2 = $this->x1;
		$this->y2 = $this->y1;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['L']);
		if (strtoupper($type) == 'BTBS') {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI TERIMA BARANG', 0, 0, 'L');
		} else {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI KELUAR BARANG', 0, 0, 'L');
		}
		//Text baris 2
		$this->y2 += $this->h;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['R']);
		$this->pdf->Cell(($this->maxWidth * 0.6), $this->p, $this->header['szBranchId'] . ' - ' . $this->header['branchName']);
		$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		//Text baris 3
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'GUDANG');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szWarehouseId']);
		$this->pdf->Cell($this->w[5], $this->p, 'DOCUMENT ID');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szDocId']);
		//Text baris 4
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'PENGEMUDI');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szDriver'] . ' - ' . $this->header['szDriver2']);
		$this->pdf->Cell($this->w[5], $this->p, 'TANGGAL');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . date('Y/m/d', strtotime($this->header['dtmDoc'])));
		//Text baris 5
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'KENDARAAN');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szVehicle'] . ' - ' . $this->header['szVehicle2']);
		$this->pdf->Cell($this->w[5], $this->p, 'TIPE PERSEDIAAN');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szStockType']);
		//Text baris 6
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'SURAT JALAN');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szRefDocId']);
		$this->pdf->Cell($this->w[5], $this->p, 'NO. REF. 1');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szRef1']);
		//Text baris 7
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'KETERANGAN');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['szDescription']);
		$this->pdf->Cell($this->w[5], $this->p, 'FOREIGN BODY');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ');
	}

	private function setHeaderDepot($type = null)
	{
		//Text baris 1
		$this->x2 = $this->x1;
		$this->y2 = $this->y1;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell(($this->maxWidth * 0.6), $this->p, $this->header['company']);
		$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		//Text baris 2
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'NAMA DEPO');
		if ($type == 'BTBDP') {
			$this->pdf->Cell($this->maxWidth - $this->w[5], $this->p, ':  ' . $this->header['depoTerima']);
		} else {
			$this->pdf->Cell($this->maxWidth - $this->w[5], $this->p, ':  ' . $this->header['depoKirim']);
		}
		//Text baris 3
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['L']);
		if (strtoupper($type) == 'BTBDP') {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI TERIMA BARANG DEPO', 0, 0, 'C');
		} else {
			$this->pdf->Cell($this->maxWidth, $this->h, 'BUKTI KELUAR BARANG DEPO', 0, 0, 'C');
		}
		//Text baris 4
		$this->y2 += $this->h;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->SetFontSize($this->fontSize['R']);
		$this->pdf->Cell($this->w[5], $this->p, 'NAMA GUDANG');
		$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['warehouse']);
		$this->pdf->Cell($this->w[5], $this->p, 'DOCUMENT ID');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->header['szDocId']);
		//Text baris 5
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		if ($type == 'BTBDP') {
			$this->pdf->Cell($this->w[5], $this->p, 'TERIMA DARI');
			$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['depoKirim']);
		} else {
			$this->pdf->Cell($this->w[5], $this->p, 'KELUAR KE');
			$this->pdf->Cell(($this->maxWidth * 0.6) - $this->w[5], $this->p, ':  ' . $this->header['depoTujuan']);
		}
		$this->pdf->Cell($this->w[5], $this->p, 'TANGGAL');
		$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . date('Y/m/d', strtotime($this->header['dtmDoc'])));
		//Text baris 6
		$this->y2 += $this->p;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[5], $this->p, 'KETERANGAN');
		$this->pdf->Cell($this->maxWidth - $this->w[5], $this->p, ':  ' . $this->header['szDescription']);
	}

	private function setNewPage($type = null)
	{
		$this->pdf->AddPage();
		$this->pdf->SetMargins(0, -1, 0);
		$this->pdf->SetAutoPageBreak(false, 0);
		$this->pdf->SetLineWidth(0.05);
		$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
		$this->y2 = $this->y1;
		if ($type == 'BKBD' || $type == 'BTBD') {
			$this->setHeaderDistribusi($type);
		} elseif ($type == 'BKBS' || $type == 'BTBS') {
			$this->setHeaderSupplier($type);
		} elseif ($type == 'BKBDP' || $type == 'BTBDP') {
			$this->setHeaderDepot($type);
		}
	}

	private function setFooterDistribusi($type = null)
	{
		//Text baris 10 Approval
		// $this->y    += 2;
		$this->pdf->SetXY($this->x2, $this->y2);
		if ($this->addPage === true) {
			$this->pdf->Cell($this->maxWidth * 0.6, $this->p, '');
			$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
			$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		}
		$this->y2    += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		if ($type == 'BKBD') {
			$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DIINPUT OLEH,', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DISERAHKAN OLEH,', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DITERIMA OLEH,', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DIPERIKSA OLEH,', 0, 0, 'C');
			//Text baris 11 TTD
			$this->y2  += 15;
			$this->pdf->SetXY($this->x2, $this->y2);
			$this->pdf->Cell($this->maxWidth / 4, $this->p, '( WAREHOUSE ADMIN )', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, '( CHECKER (DLM) )', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, '( DRIVER )', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 4, $this->p, '( CHECKER (LR) )', 0, 0, 'C');
		} elseif ($type == 'BTBD') {
			$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIINPUT OLEH,', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIPERIKSA OLEH,', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIKETAHUI OLEH,', 0, 0, 'C');
			//Text baris 11 TTD
			$this->y2  += 15;
			$this->pdf->SetXY($this->x2, $this->y2);
			$this->pdf->Cell($this->maxWidth / 3, $this->p, '( WAREHOUSE ADMIN )', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 3, $this->p, '( CHECKER )', 0, 0, 'C');
			$this->pdf->Cell($this->maxWidth / 3, $this->p, '( DRIVER )', 0, 0, 'C');
		}
		$this->y2  += ($this->p + 1);
		$this->pdf->SetXY($this->x2, $this->y2);

		// $this->pdf->SetFontSize($this->fontSize['S']);
		$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['S']);
		$this->pdf->Cell($this->maxWidth, $this->p, 'TANGGAL PRINT :  ' . date('Y-m-d H:i:s') . ', ' . strtoupper($this->session->userdata('user_nik')) . ' ' . strtoupper($this->session->userdata('user_nama')));
	}

	private function setFooterSupplier()
	{
		//Text baris 10 Approval
		// $this->y    += 2;
		$this->pdf->SetXY($this->x2, $this->y2);
		if ($this->addPage === true) {
			$this->pdf->Cell($this->maxWidth * 0.6, $this->p, '');
			$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
			$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		}
		$this->y2    += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DITERIMA OLEH,', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DIKETAHUI OLEH,', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DISERAHKAN OLEH,', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, 'DIPERIKSA OLEH,', 0, 0, 'C');
		//Text baris 11 TTD
		$this->y2  += 15;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->maxWidth / 4, $this->p, '( CHECKER )', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, '( SPV GUDANG )', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, '( PENGEMUDI )', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 4, $this->p, '( CHECKER/SATPAM )', 0, 0, 'C');
		$this->y2  += ($this->p + 1);
		$this->pdf->SetXY($this->x2, $this->y2);

		// $this->pdf->SetFontSize($this->fontSize['S']);
		$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['S']);
		$this->pdf->Cell($this->maxWidth, $this->p, 'TANGGAL PRINT :  ' . date('Y-m-d H:i:s') . ', ' . strtoupper($this->session->userdata('user_nik')) . ' ' . strtoupper($this->session->userdata('user_nama')));
	}

	private function setFooterDepot()
	{
		//Text baris 10 Approval
		// $this->y    += 2;
		$this->pdf->SetXY($this->x2, $this->y2);
		if ($this->addPage === true) {
			$this->pdf->Cell($this->maxWidth * 0.6, $this->p, '');
			$this->pdf->Cell($this->w[5], $this->p, 'HALAMAN');
			$this->pdf->Cell(($this->maxWidth * 0.4) - $this->w[5], $this->p, ':  ' . $this->page);
		}
		$this->y2    += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIINPUT OLEH,', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIPERIKSA OLEH,', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 3, $this->p, 'DIKETAHUI OLEH,', 0, 0, 'C');
		//Text baris 11 TTD
		$this->y2  += 15;
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->maxWidth / 3, $this->p, '( WAREHOUSE ADMIN )', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 3, $this->p, '( CHECKER )', 0, 0, 'C');
		$this->pdf->Cell($this->maxWidth / 3, $this->p, '( DRIVER )', 0, 0, 'C');
		$this->y2  += ($this->p + 1);
		$this->pdf->SetXY($this->x2, $this->y2);

		// $this->pdf->SetFontSize($this->fontSize['S']);
		$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['S']);
		$this->pdf->Cell($this->maxWidth, $this->p, 'TANGGAL PRINT :  ' . date('Y-m-d H:i:s') . ', ' . strtoupper($this->session->userdata('user_nik')) . ' ' . strtoupper($this->session->userdata('user_nama')));
	}

	public function MPrintBKB($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header = [
			'company'       => $data[0]->company,
			'szDocId'       => $data[0]->szDocId,
			'dtmDoc'        => $data[0]->dtmDoc,
			'szDocPRId'     => $data[0]->szDocPRId,
			'warehouse'     => $data[0]->warehouse,
			'szEmployeeId'  => $data[0]->szEmployeeId,
			'employee'		  => $data[0]->employee,
			'szVehicleId'		=> $data[0]->szVehicleId,
			'vehicle'       => $data[0]->vehicle,
			'szDescription' => $data[0]->szDescription
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderDistribusi();

		//Text baris 7 = Header Table Produk (dibagi 6 kolom)
		$this->y2 += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->setNewPage('BKBD');

				//Header Table Produk (dibagi 6 kolom)
				$this->y2 += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// Add Footer
		$this->setFooterDistribusi('BKBD');

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		$this->pdf->Output('I');
	}

	public function MPrintBTB($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header = [
			'company'       => $data[0]->company,
			'branch'        => $data[0]->branch,
			'szDocId'       => $data[0]->szDocId,
			'dtmDoc'        => $data[0]->dtmDoc,
			'szStockType'   => $data[0]->szStockType,
			'warehouse'     => $data[0]->warehouse,
			'szEmployeeId'  => $data[0]->szEmployeeId,
			'employee'		  => $data[0]->employee,
			'szVehicleId'		=> $data[0]->szVehicleId,
			'vehicle'       => $data[0]->vehicle,
			'szDescription' => $data[0]->szDescription
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderDistribusi('BTBD');

		//Text baris 7 = Header Table Produk (dibagi 6 kolom)
		$this->y2 += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->setNewPage('BTBD');

				//Header Table Produk (dibagi 6 kolom)
				$this->y2 += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// Add Footer
		$this->setFooterDistribusi('BTBD');

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		$this->pdf->Output('I');
	}

	public function MPrintBKBSupplier($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header		= [
			'szBranchId'		=> $data[0]->szBranchId,
			'branchName'		=> $data[0]->branchName,
			'szVehicle'			=> $data[0]->szVehicle,
			'szVehicle2'		=> $data[0]->szVehicle2,
			'szDriver'			=> $data[0]->szDriver,
			'szDriver2'			=> $data[0]->szDriver2,
			'szDescription'	=> $data[0]->szDescription,
			'szDocId'				=> $data[0]->szDocId,
			'dtmDoc'				=> $data[0]->dtmDoc,
			'szStockType'		=> $data[0]->szStockType,
			'szRefDocId'		=> $data[0]->szRefDocId,
			'szRef1'				=> $data[0]->szRef1,
			'szWarehouseId'	=> $data[0]->szWarehouseId
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderSupplier('BKBS');

		//Text baris 8 = Header Table Produk (dibagi 6 kolom)
		$this->y2    += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->pdf->Cell($this->maxWidth - $this->x2, $this->p, 'BERSAMBUNG KE HALAMAN : ' . $this->page, 0, 0, 'C');
				$this->setNewPage('BKBS');

				//Text baris 6 = Header Table Produk (dibagi 6 kolom)
				$this->y2    += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->Cell($this->maxWidth - $this->x2, $this->p, 'BERSAMBUNG KE HALAMAN : ' . $this->page, 0, 0, 'C');
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// // Add Footer
		$this->setFooterSupplier();

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		// OUTPUT
		$this->pdf->Output('I');
	}

	public function MPrintBTBSupplier($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header		= [
			'szBranchId'		=> $data[0]->szBranchId,
			'branchName'		=> $data[0]->branchName,
			'szVehicle'			=> $data[0]->szVehicle,
			'szVehicle2'		=> $data[0]->szVehicle2,
			'szDriver'			=> $data[0]->szDriver,
			'szDriver2'			=> $data[0]->szDriver2,
			'szDescription'	=> $data[0]->szDescription,
			'szDocId'				=> $data[0]->szDocId,
			'dtmDoc'				=> $data[0]->dtmDoc,
			'szStockType'		=> $data[0]->szStockType,
			'szRefDocId'		=> $data[0]->szRefDocId,
			'szRef1'				=> $data[0]->szRef1,
			'szWarehouseId'	=> $data[0]->szWarehouseId
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderSupplier('BTBS');

		//Text baris 8 = Header Table Produk (dibagi 6 kolom)
		$this->y2    += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->pdf->Cell($this->maxWidth - $this->x2, $this->p, 'BERSAMBUNG KE HALAMAN : ' . $this->page, 0, 0, 'C');
				$this->setNewPage('BTBS');

				//Text baris 6 = Header Table Produk (dibagi 6 kolom)
				$this->y2    += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->Cell($this->maxWidth - $this->x2, $this->p, 'BERSAMBUNG KE HALAMAN : ' . $this->page, 0, 0, 'C');
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// // Add Footer
		$this->setFooterSupplier();

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		// OUTPUT
		$this->pdf->Output('I');
	}

	public function MPrintBKBDepot($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header = [
			'company'				=> $data[0]->company,
			'depoKirim'			=> $data[0]->depoKirim,
			'depoTujuan'		=> $data[0]->depoTujuan,
			'warehouse'			=> $data[0]->warehouse,
			'szDocId'				=> $data[0]->szDocId,
			'dtmDoc'				=> $data[0]->dtmDoc,
			'szDescription'	=> $data[0]->szDescription
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderDepot('BKBDP');

		//Text baris 7 = Header Table Produk (dibagi 6 kolom)
		$this->y2 += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->setNewPage('BKBDP');

				//Header Table Produk (dibagi 6 kolom)
				$this->y2 += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// Add Footer
		$this->setFooterDepot();

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		$this->pdf->Output('I');
	}

	public function MPrintBTBDepot($data = null, $font = null)
	{
		if (empty($data) || (!is_object($data) && !is_array($data))) {
			die('Construct Error');
		}
		if (is_object($data)) {
			$data	= (array)$data;
		}

		$this->header = [
			'company'				=> $data[0]->company,
			'depoKirim'			=> $data[0]->depoKirim,
			'depoTerima'		=> $data[0]->depoTerima,
			'warehouse'			=> $data[0]->warehouse,
			'szDocId'				=> $data[0]->szDocId,
			'dtmDoc'				=> $data[0]->dtmDoc,
			'szDescription'	=> $data[0]->szDescription
		];

		if (!empty($font)) {
			$this->fontFamily = strtolower($font);
			$this->pdf->SetFont($this->fontFamily, '', $this->fontSize['R']);
		}

		//Add Header
		$this->setHeaderDepot('BTBDP');

		//Text baris 7 = Header Table Produk (dibagi 6 kolom)
		$this->y2 += ($this->p + 2);
		$this->pdf->SetXY($this->x2, $this->y2);
		$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
		$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
		$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');

		//Text looping produk
		$this->multiple1	= $this->maxRow1;
		$this->multiple2	= $this->maxRow2;
		for ($i = 0; $i < count($data); $i++) {
			if ($i == $this->multiple2) {
				$this->addPage  = false;
				$this->page			+= 1;
				$this->multiple1	+= $this->maxRow2;
				$this->multiple2	+= $this->maxRow2;
				$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
				$this->setNewPage('BTBDP');

				//Header Table Produk (dibagi 6 kolom)
				$this->y2 += ($this->p + 2);
				$this->pdf->SetXY($this->x2, $this->y2);
				$this->pdf->Cell($this->w[1], $this->p + 1, 'NO', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'KODE', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p + 1, 'NAMAPRODUK', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'SATUAN', 'TB', 0, 'C');
				$this->pdf->Cell($this->w[3], $this->p + 1, 'JUMLAH', 'TB', 0, 'C');
				$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p + 1, 'KETERANGAN', 'TB', 0, 'C');
			}
			if ($i == $this->multiple1) {
				$this->addPage  = true;
			}
			$this->y2  += ($this->p + 1);
			$this->pdf->SetXY($this->x2, $this->y2);
			//NO
			$this->pdf->Cell($this->w[1], $this->p, $i + 1, 0, 0, 'C');
			//Kode Produk
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szProductId, 0, 0, 'C');
			//Nama Produk
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[1] + $this->w[3]), $this->p, $data[$i]->product);
			//Satuan
			$this->pdf->Cell($this->w[3], $this->p, $data[$i]->szUomId, 0, 0, 'C');
			//Jumlah
			$this->pdf->Cell($this->w[3], $this->p, number_format($data[$i]->decQty, 0, ',', '.'), 0, 0, 'C');
			//Ketewrangan
			// $this->pdf->Cell(120 - 40 - $this->x, $this->h, $data[$i]['remark']);
			$this->pdf->Cell(($this->maxWidth * 0.5) - ($this->w[3] + $this->w[3]), $this->p, '');
		}
		$this->pdf->Line($this->x2, $this->y2 + $this->p, $this->maxWidth + $this->x2, $this->y2 + $this->p);
		if ($this->addPage === true) {
			$this->page	+= 1;
			$this->pdf->AddPage();
			$this->pdf->SetMargins(0, -1, 0);
			$this->pdf->SetAutoPageBreak(false, 0);
			$this->pdf->SetLineWidth(0.05);
			$this->pdf->SetDash(0.5, 1); //1mm on, 1mm off
			$this->y2 = $this->y1;
		}

		// Add Footer
		$this->setFooterDepot();

		//Auto open printer dialogue
		//Not work with chrome
		$this->pdf->AutoPrint(false);

		$this->pdf->Output('I');
	}

	public function debug($data = null)
	{
		if (!empty($data)) {
			if (is_array($data)) {
				echo '<pre>';
				var_dump($data);
				echo '</pre>';
			} else {
				var_dump($data);
			}
		} else {
			echo "Data Not Found!";
		}
	}
}
