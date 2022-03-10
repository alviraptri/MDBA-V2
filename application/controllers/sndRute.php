<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class sndRute extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model('mSndRute');
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
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

    function uploadExcel()
    {
        $data = array();
        if (isset($_POST['Preview'])) {
            if ($_FILES['file']['name'] != '') {

                $tanggal = date('Y-m-d');
                $explodeFileName = explode(".", $_FILES['file']['name']);
                $fileName = $explodeFileName[0];
                $nama_file_baru = $fileName . '-' . $tanggal . '.xls';
                if (is_file('tmp/' . $nama_file_baru)) {
                    unlink('tmp/' . $nama_file_baru);
                }

                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $tmp_file = $_FILES['file']['tmp_name'];

                if ($ext == "xls") {
                    move_uploaded_file($tmp_file, 'tmp/' . $nama_file_baru);

                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    $spreadsheet = $reader->load('tmp/' . $nama_file_baru);

                    $data['sheet'] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                }
            }
        } else {
            $data['upload_error'] = 'File Belum Di Upload';
        }
        $this->load->view('vSndRuteUpload', $data);
    }

    function importExcel()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $route = $this->input->post('route');
        $type = $this->input->post('routeType');
        $description = $this->input->post('description');
        $routeName = $this->input->post('routeName');

        $date = date('Y-m-d');
        $nama_file_baru = $route . '-' . $date . '.xls';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load('tmp/' . $nama_file_baru);

        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $checkRoute = $this->mSndRute->checkRoute($route, $type);
        if (sizeOf($checkRoute) == '0') {
            $headRoute = array(
                'iId' => $this->uuid->v4(),
                'szId' => $route,
                'szName' => $routeName,
                'szDescription' => $description,
                'szRouteType' => $type,
                'szEmployeeId' => $route,
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $simpanHeadRoute = $this->mSndRute->simpanData($headRoute, $base . '.dms_sd_route');
            // $simpanDmsHeadRoute = $this->mSndRute->simpanDms($headRoute, 'dmstesting.dms_sd_route');
        } else {
            $customer = '';
            for ($index = 1; $index <= sizeof($sheet); $index++) {
                if ($index != 1) {
                    $customer .= "'" . $sheet[$index]['F'] . "',";
                }
            }
            $lenCust = strlen($customer);
            $refCust = substr($customer, 0, $lenCust - 1);

            $checkCust = $this->mSndRute->checkCust($route, $refCust);

            $customerID = [];
            foreach ($checkCust as $row) {
                $customerID[] = $row->szCustomerId;
            }

            $intCust = $this->mSndRute->intCust($route);
            if (sizeOf($intCust) != '0') {
                foreach ($intCust as $key) {
                    $custInt = (int)$key->intItemNumber;
                }
            }
            else{
                $custInt = 0;
            }

            if (sizeOf($checkCust) != '0') {
                $updRouteHead = array(
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                // echo "<pre> HEADER UPDATE: " . var_export($updRouteHead, true) . "</pre>";
                $whereRouteHead = array(
                    'szId' => $route
                );
                // echo "<pre> HEADER UPDATE WHERE: " . var_export($whereRouteHead, true) . "</pre>";
                $routeHeadUpdate = $this->mSndRute->updateData($whereRouteHead, $updRouteHead, $base . '.dms_sd_route');
                // $routeHeadUpdateDms = $this->mSndRute->updateDms($whereRouteHead, $updateHead, 'dmstesting.dms_sd_route');

                $no = 0;
                $intItem = $custInt + 1;
                for ($index = 1; $index <= sizeof($sheet); $index++) {
                    if ($index == 1) {
                        continue;
                    }
                    if (in_array($sheet[$index]['F'], $customerID)) {
                        // echo "FOUND " . $no . ". " . $sheet[$index]['F'] . " == " . $sheet[$index]['F'] . "<br>";
                        $updRouteCust = array(
                            'intDay1' => (int)$sheet[$index]['H'],
                            'intDay2' => (int)$sheet[$index]['I'],
                            'intDay3' => (int)$sheet[$index]['J'],
                            'intDay4' => (int)$sheet[$index]['K'],
                            'intDay5' => (int)$sheet[$index]['L'],
                            'intDay6' => (int)$sheet[$index]['M'],
                            'intDay7' => (int)$sheet[$index]['N'],
                            'intWeek1' => (int)$sheet[$index]['O'],
                            'intWeek2' => (int)$sheet[$index]['P'],
                            'intWeek3' => (int)$sheet[$index]['Q'],
                            'intWeek4' => (int)$sheet[$index]['R']
                        );
                        // echo "<pre> CUST UPDATE: " . var_export($updRouteCust, true) . "</pre>";
                        $whereRouteCust = array(
                            'szId' => $route,
                            'szCustomerId' => $sheet[$index]['F']
                        );
                        // echo "<pre> CUST UPDATE WHERE : " . var_export($whereRouteCust, true) . "</pre>";
                        $routeCustUpdate = $this->mSndRute->updateData($whereRouteCust, $updRouteCust, $base . '.dms_sd_routeitem');
                        // $routeCustUpdateDms = $this->mSndRute->updateDms($whereRouteCust, $updateCount, 'dmstesting.dms_sd_routeitem');
                    } else {
                        // echo "NOT FOUND " . $no . ". " . $sheet[$index]['F'] . " != " . $sheet[$index]['F'] . "<br>";
                        $routeCust = array(
                            'iId' => $this->uuid->v4(),
                            'szId' => $route,
                            'intItemNumber' => $intItem,
                            'szCustomerId' => $sheet[$index]['F'],
                            'intDay1' => (int)$sheet[$index]['H'],
                            'intDay2' => (int)$sheet[$index]['I'],
                            'intDay3' => (int)$sheet[$index]['J'],
                            'intDay4' => (int)$sheet[$index]['K'],
                            'intDay5' => (int)$sheet[$index]['L'],
                            'intDay6' => (int)$sheet[$index]['M'],
                            'intDay7' => (int)$sheet[$index]['N'],
                            'intWeek1' => (int)$sheet[$index]['O'],
                            'intWeek2' => (int)$sheet[$index]['P'],
                            'intWeek3' => (int)$sheet[$index]['Q'],
                            'intWeek4' => (int)$sheet[$index]['R']
                        );
                        // echo "<pre> CUST INSERT : " . var_export($routeCust, true) . "</pre>";
                        $simpanRouteCust = $this->mSndRute->simpanData($routeCust, $base . '.dms_sd_routeitem');
                        // $simpanDmsRouteCust = $this->mSndRute->simpanDms($routeCust, 'dmstesting.dms_sd_routeitem');
                        $intItem++;
                    }
                    $no++;
                }
            } else {
                if ($custInt == 0) {
                    $intItem = $custInt;
                    for ($index = 1; $index <= sizeof($sheet); $index++) {
                        $detRoute = array(
                            'iId' => $this->uuid->v4(),
                            'szId' => $route,
                            'intItemNumber' => $custInt,
                            'szCustomerId' => $sheet[$index]['F'],
                            'intDay1' => (int)$sheet[$index]['H'],
                            'intDay2' => (int)$sheet[$index]['I'],
                            'intDay3' => (int)$sheet[$index]['J'],
                            'intDay4' => (int)$sheet[$index]['K'],
                            'intDay5' => (int)$sheet[$index]['L'],
                            'intDay6' => (int)$sheet[$index]['M'],
                            'intDay7' => (int)$sheet[$index]['N'],
                            'intWeek1' => (int)$sheet[$index]['O'],
                            'intWeek2' => (int)$sheet[$index]['P'],
                            'intWeek3' => (int)$sheet[$index]['Q'],
                            'intWeek4' => (int)$sheet[$index]['R']
                        );
                        $simpanDetRoute = $this->mSndRute->simpanData($detRoute, $base . '.dms_sd_routeitem');
                        // $simpanDmsDetRoute = $this->mSndRute->simpanDms($detRoute, 'dmstesting.dms_sd_routeitem');

                        $intItem++;
                    }
                }
                else{
                    $intItem = $custInt + 1;
                    for ($index = 1; $index <= sizeof($sheet); $index++) {
                        $detRoute = array(
                            'iId' => $this->uuid->v4(),
                            'szId' => $route,
                            'intItemNumber' => $custInt,
                            'szCustomerId' => $sheet[$index]['F'],
                            'intDay1' => (int)$sheet[$index]['H'],
                            'intDay2' => (int)$sheet[$index]['I'],
                            'intDay3' => (int)$sheet[$index]['J'],
                            'intDay4' => (int)$sheet[$index]['K'],
                            'intDay5' => (int)$sheet[$index]['L'],
                            'intDay6' => (int)$sheet[$index]['M'],
                            'intDay7' => (int)$sheet[$index]['N'],
                            'intWeek1' => (int)$sheet[$index]['O'],
                            'intWeek2' => (int)$sheet[$index]['P'],
                            'intWeek3' => (int)$sheet[$index]['Q'],
                            'intWeek4' => (int)$sheet[$index]['R']
                        );
                        $simpanDetRoute = $this->mSndRute->simpanData($detRoute, $base . '.dms_sd_routeitem');
                        // $simpanDmsDetRoute = $this->mSndRute->simpanDms($detRoute, 'dmstesting.dms_sd_routeitem');

                        $intItem++;
                    }
                }
            }
        }

        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
        header('Location: ' . base_url('home/rute'));
        exit;
    }
}
