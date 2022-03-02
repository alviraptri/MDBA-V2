<?php
class sndRute extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model('mSndRute');
    }

    function detailRute()
    {
        $employee = $this->input->post('employee');
        $route = $this->input->post('route');
        $data = $this->mSndRute->detailRute($employee, $route);
        echo json_encode($data);
    }

    function uploadRute()
    {
        $this->load->view('vSndRuteUpload');
    }
}

?>