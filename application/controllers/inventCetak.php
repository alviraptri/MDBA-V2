<?php
class inventCetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mMaster', 'mInventCetak'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function bkbDistribusi($bkb, $font = null)
    {
        //PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBkbDist($bkb);
        $this->MPrint->MPrintBKB($Data, $font);

        // HTML
        //$data['data'] = $this->mInventCetak->getDataBkbDist($bkb);
        //$data['bkb'] = $bkb;
        //$this->load->view('vBkbDistribusiCetak', $data);
    }

    function bkbDepot($bkb, $font = null)
    {
        // PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBkbDepot($bkb);
        $this->MPrint->MPrintBKBDepot($Data, $font);

        // HTML
        // $data['data'] = $this->mInventCetak->getDataBkbDepot($bkb);
        // $data['bkb'] = $bkb;
        // $this->load->view('vBkbDepotCetak', $data);
    }

    function btbDistribusi($btb, $font = null)
    {
        //PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBtbDist($btb);
        $this->MPrint->MPrintBTB($Data, $font);

        // HTML
        //$data['data'] = $this->mInventCetak->getDataBtbDist($btb);
        //$data['btb'] = $btb;
        //$this->load->view('vBtbDistribusiCetak', $data);
    }

    function btbDepot($btb, $font = null)
    {
        //PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBtbDepot($btb);
        $this->MPrint->MPrintBTBDepot($Data, $font);

        // HTML
        // $data['data'] = $this->mInventCetak->getDataBtbDepot($btb);
        // $data['btb'] = $btb;
        // $this->load->view('vBtbDepotCetak', $data);
    }

    function bkbSupplier($bkb, $font = null)
    {
        // PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBkbSupp($bkb);
        $this->MPrint->MPrintBKBSupplier($Data, $font);

        // HTML
        // $data['data'] = $this->mInventCetak->getDataBkbSupp($bkb);
        // $data['bkb'] = $bkb;
        // $this->load->view('vBkbSupplierCetak', $data);
    }

    function btbSupplier($bkb, $font = null)
    {
        // PDF
        $this->load->model('MPrint');
        $Data   = $this->mInventCetak->getDataBtbSupp($bkb);
        $this->MPrint->MPrintBTBSupplier($Data, $font);

        // HTML
        // $data['data'] = $this->mInventCetak->getDataBtbSupp($bkb);
        // $data['btb'] = $bkb;
        // $this->load->view('vBtbSupplierCetak', $data);
    }
}
