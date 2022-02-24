<?php
class master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_logged')=='')
		{
			redirect('login');
		}
        $this->load->model(array('mInventori', 'mHome', 'mMaster'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
        // $this->uuid->v4()
    }

    function getNamaDepo()
    {
        $asalDepo = $this->input->post('asalDepo');
        $data = $this->mMaster->getNamaDepo($asalDepo);
        echo json_encode($data);
    }

    function getNamaSo()
    {
        $so = $this->input->post('so');
        $data = $this->mMaster->getNamaSo($so);
        echo json_encode($data);
    }

    function getPengemudi()
    {
        $pengemudi = $this->input->post('pengemudi');
        $data = $this->mMaster->getPengemudi($pengemudi);
        echo json_encode($data);
    }

    function getKendaraan()
    {
        $kendaraan = $this->input->post('kendaraan');
        $data = $this->mMaster->getKendaraan($kendaraan);
        echo json_encode($data);
    }

    function getProduk()
    {
        $produk = $this->input->post('produk');
        $data = $this->mMaster->getProduk($produk);
        echo json_encode($data);
    }

    function getDriverDistribusi()
    {
        $asal = $this->input->post('asalDepo');
        $asli = $this->session->userdata('user_branch');
        $depo = "'".$asal."', '".$asli."'";
        $data = $this->mHome->getDriverDistribusi($depo);
        echo json_encode($data);
    }

    function getVehicleDistribusi()
    {
        $asal = $this->input->post('asalDepo');
        $asli = $this->session->userdata('user_branch');
        $depo = "'".$asal."', '".$asli."'";
        $data = $this->mHome->getVehicleDistribusi($depo);
        echo json_encode($data);
    }
}

?>