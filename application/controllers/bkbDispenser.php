<?php
class bkbDispenser extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mMaster', 'mBkbDispenser', 'mInventSupp'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function filterBkb()
    {
    }

    function manualBkb()
    {
        $depo = $this->session->userdata('user_branch');
        $data['warehouse'] = $this->mBkbDispenser->getGudang($depo);
        $data['type'] = $this->mBkbDispenser->getStockType();
        $data['employee'] = $this->mBkbDispenser->getEmployee($depo);
        $data['vehicle'] = $this->mBkbDispenser->getVehicle($depo);
        $data['product'] = $this->mBkbDispenser->getProduct();
        $data['branch'] = $this->mBkbDispenser->getBranch($depo);

        $id = 'BKBDIST' . $depo . 'COU';
        $data['id'] = $this->mBkbDispenser->getId($id);
        $data['status'] = 'Draft';
        $this->load->view('vDispenserBkbTambah', $data);
    }

    function getSerialNumber()
    {
        $produk = $this->input->post('id');
        $data = $this->mBkbDispenser->getSerialNumber($produk);
        echo json_encode($data);
    }

    function getDetProduk()
    {
        $produk = $this->input->post('produk');
        $data = $this->mBkbDispenser->getDetProduk($produk);
        echo json_encode($data);
    }

    function getCounterDisp()
    {
        $depo = $this->session->userdata('user_branch');
        $jenis = $this->input->post('jenis');
        if ($jenis == 'AntarDepo') {
            $id = 'BKBDEPO' . $depo . 'COU';
            $data = $this->mBkbDispenser->getId($id);
        } else {
            $id = 'BKBDIST' . $depo . 'COU';
            $data = $this->mBkbDispenser->getId($id);
        }
        echo json_encode($data);
    }

    function manualBtb()
    {
        $depo = $this->session->userdata('user_branch');

        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mBkbDispenser->getGudang($depo);
        $data['type'] = $this->mBkbDispenser->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mBkbDispenser->getProduct();

        $data['status'] = 'Draft';
        $id = 'BTBSUPP' . $depo . 'COU';
        $data['id'] = $this->mBkbDispenser->getId($id);
        $this->load->view('vDispenserBtbTambah', $data);
    }
}
