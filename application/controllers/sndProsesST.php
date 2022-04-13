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
        $this->load->view('vSndProsesSTDet', $data);
    }

    function proses()
    {
        $this->load->view('vSndProsesSTTambah');
    }

    function getEmployee()
    {
        $jenis = $this->input->post('jenis');

        $result = $this->mSndProsesST->getEmployee($jenis);

        echo json_encode($result);
    }

    function simpanProses()
    {
        $tanggal = $this->input->post('date');
        $jenis = $this->input->post('jenisRute');
        $check = $this->input->post('checkData');
        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'TVIP';
            $base = 'dummymdbatvip';
        }

        //get counter surat tugas
        $st = 'ST' . $depo . 'COU';
        $docSt = $this->mSndProsesST->getId($st);

        $so = 'SO' . $depo . 'COU';
        $docSo = $this->mSndProsesST->getId($so);

        for ($i = 0; $i < sizeof($check); $i++) {
            // echo $check[$i];
            // echo ' -> ';
            // echo $docSt;
            // echo '<br>';

            // update counter
            $countSt = $this->mSndProsesST->getCounter($st);
            $updateCountSt = array(
                'intLastCounter' => $countSt,
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereCountSt = array('szId' => $st);
            $counterStUpdate = $this->mSndProsesST->updateData($whereCountSt, $updateCountSt, $base . '.dms_sm_counter');
            // $counterStUpdateDms = $this->mSndProsesST->updateDms($whereCountSt, $updateCountSt, 'dmstesting.dms_sm_counter');

            $headerSt = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $docSt,
                'dtmDoc' => $tanggal,
                'szEmployeeId' => $check[$i],
                'szRouteType' => $jenis,
                'dtmStart' => date('Y-m-d H:i:s'),
                'dtmFinish' => date('Y-m-d H:i:s'),
                'bStarted' => '0',
                'bFinished' => '0',
                'decKMStart' => '0',
                'decKMFinish' => '0',
                'szVehicleId' => '',
                'szHelper1' => '',
                'szHelper2' => '',
                'intPrintedCount' => '',
                'szBranchId' => $this->session->userdata('user_branch'),
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s'),
                'bFullFilled' => '0'
            );
            $stHeader = $this->mSndProsesST->simpanData($headerSt, $base . '.dms_sd_doccall');
            $stHeaderMdba = $this->mSndProsesST->simpanData($headerSt, $base . '.mdbapstheader');
            // $stHeaderDms = $this->mSndProsesST->simpanDms($headerSt, 'dmstesting.dms_sd_doccall');
            // echo "<pre> HEADER PST " . $i . " : " . var_export($headerSt, true) . "</pre>";

            $dataCustomer = $this->mSndProsesST->getSTCustomer($tanggal, $jenis, $check[$i]);
            $no = 0;
            foreach ($dataCustomer as $value) {
                // update counter
                $countSo = $this->mSndProsesST->getCounter($so);
                $updateCountSo = array(
                    'intLastCounter' => $countSo,
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                $whereCountSo = array('szId' => $so);
                $counterSoUpdate = $this->mSndProsesST->updateData($whereCountSo, $updateCountSo, $base . '.dms_sm_counter');
                // $counterSoUpdateDms = $this->mSndProsesST->updateDms($whereCountSo, $updateCountSo, 'dmstesting.dms_sm_counter');

                $detailSt = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $docSt,
                    'intItemNumber' => $no,
                    'szCustomerId' => $value->szCustomerId,
                    'dtmStart' => date('Y-m-d H:i:s'),
                    'dtmFinish' => date('Y-m-d H:i:s'),
                    'bStarted' => '0',
                    'bFinisihed' => '0',
                    'bVisited' => '0',
                    'bSuccess' => '0',
                    'szFailReason' => '',
                    'bPostPone' => '0',
                    'szLangitude' => '',
                    'szLongitude' => '',
                    'bOutOfRoute' => '0',
                    'szRefDocId' => '',
                    'bNewCustomer' => '0',
                    'szCallType' => '',
                    'bScanBarcode' => '0',
                    'dtmLastCheckin' => date('Y-m-d H:i:s'),
                    'decDuration' => '0',
                    'szDocSO' => $docSo,
                    'szDocDO' => '',
                    'szDocInvoice' => '',
                    'szDocCallIdRef' => '',
                    'szReasonIdCheckin' => '',
                    'szReasonFailedScan' => ''
                );
                $stDetail = $this->mSndProsesST->simpanData($detailSt, $base . '.dms_sd_doccallitem');
                $stDetailMdba = $this->mSndProsesST->simpanData($detailSt, $base . '.mdbapstdetail');
                // $stDetailDms = $this->mSndProsesST->simpanDms($detailSt, 'dmstesting.dms_sd_doccallitem');
                // echo "<pre> DETAIL PST " . $i . " : " . var_export($detailSt, true) . "</pre>";

                // echo $no .'. ';
                // echo $value->szId;
                // echo ' -> ';
                // echo $docSt;
                // echo ' -> ';
                // echo $value->szCustomerId;
                // echo ' -> ';
                // echo $docSo;
                // echo '<br>';

                $docSo++;
                $countSo++;
                $no++;
            }
            $countSt++;
            $docSt++;
        }
        // print_r($check);

        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
        header('Location: ' . base_url('home/prosesSuratTugas'));
        exit;
    }
}
