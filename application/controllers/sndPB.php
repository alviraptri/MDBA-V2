
<?php
class sndPB extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mMaster', 'mSnDPB'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    //master
    function vehicle()
    {
        $id = $this->input->post('id');
        $depo = $this->session->userdata('user_branch');
        $vehicle = $this->mSnDPB->vehicle($id);
        $kendaraan = $this->mSnDPB->getVehicle($depo);
        $data = array(
            'vehicle' => $vehicle,
            'kendaraan' => $kendaraan
        );
        echo json_encode($data);
    }
    //end master

    function filterPb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mHome->getPB($tanggal);
        $this->load->view('vPBList', $data);
    }

    function getDetPB()
    {
        $id = $this->input->post('id');
        $data = $this->mSnDPB->getDetPB($id);
        echo json_encode($data);
    }

    function manualPB()
    {
        $depo = $this->session->userdata('user_branch');
        $data['warehouse'] = $this->mSnDPB->getGudang($depo);
        $data['type'] = $this->mSnDPB->getStockType();
        $data['employee'] = $this->mSnDPB->getEmployee($depo);
        $data['vehicle'] = $this->mSnDPB->getVehicle($depo);
        $data['product'] = $this->mSnDPB->getProduct();
        $id = 'PB' . $depo . 'COU';
        $data['id'] = $this->mSnDPB->getId($id);
        $data['status'] = 'Draft';
        $this->load->view('vPBTambah', $data);
    }

    function getPengemudi()
    {
        $pengemudi = $this->input->post('pengemudi');
        $data = $this->mSnDPB->getPengemudi($pengemudi);
        echo json_encode($data);
    }

    function getKendaraan()
    {
        $kendaraan = $this->input->post('kendaraan');
        $data = $this->mSnDPB->getKendaraan($kendaraan);
        echo json_encode($data);
    }

    function getProduk()
    {
        $produk = $this->input->post('produk');
        $stok = $this->input->post('stok');
        $gudang = $this->input->post('gudang');
        $data = $this->mSnDPB->getProduk($produk, $stok, $gudang);
        echo json_encode($data);
    }

    function simpanPB()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }

        $depo = $this->session->userdata('user_branch');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $pengemudi == '' || $kendaraan == '' || $kode == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('sndPb/manualPb'));
            exit;
        } else {
            $array_new = array_count_values($kode);
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('sndPb/manualPb'));
                exit;
            } else {
                $id = 'PB' . $depo . 'COU';
                $dokumen = $this->mSnDPB->getId($id);
                //update counter
                $counter = $this->mSnDPB->getCounter($id);
                $updateCount = array('intLastCounter' => $counter);
                $whereCount = array('szId' => $id);
                $counterUpdate = $this->mSnDPB->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
                $counterUpdateDms = $this->mSnDPB->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

                $headPB = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $dokumen,
                    'dtmDoc' => $tgl,
                    'szEmployeeId' => $pengemudi,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'intPrintedCount' => '0',
                    'szBranchId' => $depo,
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s'),
                    'szVehicleId' => $kendaraan,
                    'bFullFilled' => '1'
                );
                $pbHeader = $this->mSnDPB->simpanData($headPB, $base . '.dms_sd_docproductrequest');
                $pbHeaderDms = $this->mSnDPB->simpanDms($headPB, 'dms.dms_sd_docproductrequest');

                $statusPb = array(
                    'pbDoc' => $dokumen,
                    'Status' => '1',
                    'pbTanggal' => date('Y-m-d H:i:s')
                );
                $pbStatus = $this->mSnDPB->simpanData($statusPb, $base . '.mdbapbstatus');

                for ($i = 0; $i < count($kode); $i++) {
                    if ($kode[$i] != '') {
                        $detPb = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $dokumen,
                            'intItemNumber' => $i,
                            'szProductId' => $kode[$i],
                            'decQty' => $qty[$i],
                            'szUomId' => $satuan[$i]
                        );
                        $pbDetail = $this->mSnDPB->simpanData($detPb, $base . '.dms_sd_docproductrequestitem');
                        $pbDetailDms = $this->mSnDPB->simpanDms($detPb, 'dms.dms_sd_docproductrequestitem');
                    }
                    
                    if ($kode[$i] == '') {
                        $detPb = array(
                            'iId' => '',
                            'szDocId' => '',
                            'intItemNumber' => '',
                            'szProductId' => '',
                            'decQty' => '',
                            'szUomId' => ''
                        );
                    }
                }

                if ($counterUpdate == 'true' && $pbHeader == 'true' && $pbStatus == 'true' && $pbDetail == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventDist/tambahBKB/' . $dokumen));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('sndPB/manualPB'));
                    exit;
                }
            }
        }
    }

    public function data_produk(){
        $key_kode = $this->input->get('key_kode');
        $qty_kode = $this->input->get('qty_kode');
        $PecahStr = explode(",", $key_kode);

        $gudang = $this->input->get('gudang');
        $stok = $this->input->get('stok');
             
        $kode = $PecahStr;
        $data = $this->mSnDPB->select_row_data_all($kode, null, $qty_kode, $gudang, $stok)->result();
        // $data = $this->mSnDPB->select_row_data_count($kode, null, $qty_kode)->result();
        echo json_encode($data);
    }

    public function nama_kit(){
        $key_kode = $this->input->get('key_kode');
             
        $data = $this->mSnDPB->select_row_data('*', 'dms_inv_product', array('szId'=>$key_kode))->result();
        echo json_encode($data);
    }
}
