<?php
class inventTbg extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_logged')=='')
		{
			redirect('login');
		}
        $this->load->model(array('mInventSjp', 'mInventTbg'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function manual()
    {
        $depo = $this->session->userdata('user_branch');
        $id = 'TBG' . $depo . 'COU';
        $data['tbg'] = $this->mInventTbg->getId($id);
        $data['warehouse'] = $this->mInventTbg->getWarehouse($depo);
        $this->load->view('vTbgTambah', $data);
    }
}

?>