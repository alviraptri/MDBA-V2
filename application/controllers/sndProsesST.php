<?php
class sndProsesST extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model('mSndProsesST');
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function filter()
    {
        $jenis = $this->input->post('jenis');
        $tglAwal = $this->input->post('tglAwal');
        $tglAkhir = $this->input->post('tglAkhir');

        $result = $this->mSndProsesST->filterData($jenis, $tglAwal, $tglAkhir);

        echo json_encode($result);
    }

    function detail($doc)
    {
        $data['result'] = $this->mSndProsesST->detail($doc);
        $this->load->view('vSndProsesDet', $data);
    }
}

?>