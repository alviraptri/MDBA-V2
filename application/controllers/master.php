<?php
class master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mMaster', 'm_inventory'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
        // $this->uuid->v4()
    }

    public function index()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
        } else {
            $dept = 'dms111tvip';
        }
        $data['depo'] = $this->db->get($dept.".dms_sm_branch")->result();
        $data['satuan'] = $this->db->get($dept.".dms_inv_uom")->result();
        $data['provinsi'] = $this->db->query(" SELECT * FROM $dept.dms_gen_geotree  GROUP BY szProvince ")->result();
        $data['kat'] = $this->m_inventory->get_KategoriP();
        $data['produk'] = $this->m_inventory->get_produkAktif();
        $data['tax'] = $this->m_inventory->get_tax();
        $data['order'] = $this->m_inventory->get_ordertype();
        $data['segment'] = $this->input->get('id');
        // echo $data['segment'];
        // die;

        $this->load->view('template/header');
        $this->load->view('inventory/master', $data);
        $this->load->view('template/footer');
    }

    public function satuan()
    {
        $data['tipe'] = $this->m_inventory->get_satuan();
        // var_dump($data);
        // die;

        $this->load->view('template/header');
        $this->load->view('inventory/master_satuan', $data);
        $this->load->view('template/footer');
    }

    public function tipeStock()
    {
        $data['tipe'] = $this->m_inventory->get_tipe_stok();

        $this->load->view('template/header');
        $this->load->view('inventory/master_tipeKategori', $data);
        $this->load->view('template/footer');
    }


    public function kategoriProduk()
    {
        $data['tipe'] = $this->m_inventory->get_kategori();

        // var_dump($data['kat']);
        // die;
        // $data['kat'] = $this->db->query(" SELECT * FROM dms_inv_productcategorytype ")->result();

        $this->load->view('template/header');
        $this->load->view('inventory/master_kategori', $data);
        $this->load->view('template/footer');
    }


    public function TipeKategoriProduk()
    {
        $data['tipe'] = $this->m_inventory->get_tipe_kategori();
        // $data['kat'] = $this->db->query(" SELECT * FROM dms_inv_productcategorytype ")->result();

        $this->load->view('template/header');
        $this->load->view('inventory/master_TpeKategori_new', $data);
        $this->load->view('template/footer');
    }



    public function Gudang()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }
        $data['tipe'] = $this->m_inventory->get_gudang();

        $data['provinsi'] = $this->m_inventory->Province();
        $data['depo'] = $this->db->get($dept.".tbl_depo")->result();

        $this->load->view('template/header');
        $this->load->view('inventory/Master_gudang', $data);
        $this->load->view('template/footer');
    }
    public function Produk()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        $data['produk'] = $this->m_inventory->get_produkAktif();
        $data['tipe'] = $this->m_inventory->get_produk();
        $data['tax'] = $this->m_inventory->get_tax();
        $data['order'] = $this->m_inventory->get_ordertype();
        $data['satuan'] = $this->db->get($dept."dms_inv_uom")->result();
        $data['tipeKategori'] = $this->m_inventory->get_tipe_kategori();




        $this->load->view('template/header');
        $this->load->view('inventory/master_produk', $data);
        $this->load->view('template/footer');
    }
    public function TipeProduk()
    {

        $data['tipe'] = $this->db->query("SELECT a.*, b.*
										 FROM dms_sd_orderitemtype AS a 
										 LEFT JOIN dms_status_tipeKategori AS b ON a.szId=b.`szId`
										 WHERE b.status != 2 
										 ")->result();

        $this->load->view('template/header');
        $this->load->view('inventory/master_kategori', $data);
        $this->load->view('template/footer');
    }

    // satuan

    public function insertSatuan()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("Ksatuan");
        $valid = $this->db->query("SELECT * FROM $dept.dms_inv_uom WHERE szId LIKE '%$id%' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger">Kode produk sudah ada.</div>');
            redirect("master");
        }

        $date = date("Y-m-d H:i:s");
        $data = array(

            'szId' => strtoupper($this->input->post("Ksatuan")),
            'szName' => strtoupper($this->input->post("Nsatuan")),
            'szDescription' => $this->input->post("ketsatuan"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        $data_status = array(

            'szId' => $this->input->post("Ksatuan"),
            'status' => 1


        );

        // var_dump($data);
        // die;
        $this->db2 = $this->load->database($dept, true);
        $this->db2->insert("dmstesting.dms_inv_uom", $data);
        $this->db2->close();
        $this->db->insert($base.".dms_status_satuan", $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/satuan");
    }


    public function updateSatuan()
    {
        $date = date('Y-m-d H:i:s');

        $data = array(

            'status' => strtoupper($this->input->post("status")),


        );


        $data_update = array(

            // 'szId' =>strtoupper($this->input->post("Ksatuan")),
            'szName' => $this->input->post("Nsatuan"),
            'szDescription' => $this->input->post("ketsatuan"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        $id = $this->input->post("id");

        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_uom", $data_update);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_satuan", $data);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/satuan");
    }




    public function get_ajax_satuan()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_satuan($postData);

        // var_dump($postData['status']);
        // die;
        echo json_encode($data);

        // $data['wuh'] = $this->m_user->wuh_user();
        // $this->load->view("admin/wuh_user",$data);
    }


    // Tipe stok

    public function inserttipeStok()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'asa';
            $name = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'tvip';
            $name = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("Ktipe");
        $valid = $this->db->query("SELECT * FROM $name.dms_inv_stocktype WHERE szId LIKE '%$id%' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-success">Kode produk sudah ada.</div>');
            redirect("master");
        }

        $date = date("Y-m-d H:i:s");
        $data = array(

            'szId' => strtoupper($this->input->post("Ktipe")),
            'szName' => strtoupper($this->input->post("Ntipe")),
            'szDescription' => $this->input->post("ketTipe"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        $data_status = array(

            'szId' => strtoupper($this->input->post("Ktipe")),
            'status' => 1


        );

        // var_dump($data);
        // die;
        $this->db2 = $this->load->database($dept, true);
        $this->db2->insert("dmstesting.dms_inv_stockType", $data);
        $this->db2->close();

        $this->db->insert($base.".dms_status_tipestok", $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/tipestock");
    }


    public function updateTipeStok()
    {

        $data = array(

            'status' => $this->input->post("status"),
            'szId' => strtoupper($this->input->post("id")),

        );


        $date = date("Y-m-d H:i:s");
        $data_new = array(

            // 'szId' => strtoupper($this->input->post("Ktipe")),
            'szName' => strtoupper($this->input->post("Ntipe")),
            'szDescription' => $this->input->post("ketTipe"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );

        $id = $this->input->post("id");
        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_tipeStok", $data);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("Dms_inv_stockType", $data_new);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/tipestock");
    }

    public function hapusSatuan()
    {

        $id = $this->input->post("id_szId_satuan");
        // echo $id;
        // die;
        $data = array(

            'status' => 2,


        );


        $this->db->where("szId", $id);
        $this->db->update("dms_status_satuan", $data);
        $this->session->set_flashdata('massage', '<div class="alert alert-danger">Data berhasil di Hapus.</div>');
        redirect("master/satuan");
    }

    public function hapustipe()
    {

        $id = $this->input->post("id_szId_tipe");
        // echo $id;
        // die;
        $data = array(

            'status' => 2,

        );


        $this->db->where("szId", $id);
        $this->db->update("dms_status_tipestok", $data);
        $this->session->set_flashdata('massage', '<div class="alert alert-danger">Data berhasil di Hapus.</div>');
        redirect("master/tipestock");
    }





    public function get_ajax_tipeStok()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_tipe_stock($postData);
        // var_dump($data);
        // die;
        echo json_encode($data);
        // $data['wuh'] = $this->m_user->wuh_user();
        // $this->load->view("admin/wuh_user",$data);
    }


    // gudang


    public function insertGudang()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("Kgudang");
        $valid = $this->db->query("SELECT * FROM $dept.dms_inv_warehouse WHERE szId LIKE '%$id%' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-success">Kode produk sudah ada.</div>');
            redirect("master");
        }



        $date = date("Y-m-d H:i:s");
        $data_info = array(

            'szObjectId' => "DMSWarehouse",
            'szId' => strtoupper($this->input->post("Kgudang")),
            'szaddress' => $this->input->post("szaddress"),
            'iId' => $this->uuid->v4(),
            'szProvince' => $this->input->post("szProvince"),
            'szCity' => $this->input->post("szCity"),
            'szDistrict' => $this->input->post("szDistrict"),
            'szSubDistrict' => $this->input->post("szSubDistrict"),
            'szZipcode' => $this->input->post("szZipCode"),
            'szPhone1' => $this->input->post("szPhone1"),
            'szPhone2' => $this->input->post("szPhone2"),
            'szPhone3' => $this->input->post("szPhone3"),
            'szFaximile' => $this->input->post("szFaxmile"),
            'szContactPerson1' => $this->input->post("szContactPerson1"),
            'szContactPerson2' => $this->input->post("szContactPerson2"),
            'szEmail' => $this->input->post("email"),
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        // $data_status = array(

        // 	'szId' => $this->input->post("Ksatuan"),
        // 	'status' => 1


        // );

        $this->db2 = $this->load->database($name, true);
        $this->db2->insert("dmstesting.dms_sm_addressInfo", $data_info);
        $this->db2->close();
        // $this->db->insert("dms_status_satuan" , $data_status);

        $data = array(

            'szId' => strtoupper($this->input->post("Kgudang")),
            'szName' => strtoupper($this->input->post("Ngudang")),
            'szDescription' => $this->input->post("Ketgudang"),
            'szBranchId' => $this->input->post("depo_gudang"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        $data_status = array(

            'szId' => strtoupper($this->input->post("Kgudang")),
            'status' => 1
        );
        // var_dump($data_info);
        // die;
        $this->db2 = $this->load->database($name, true);
        $this->db2->insert("dmstesting.dms_inv_warehouse", $data);
        $this->db2->close();
        $this->db->insert($base.".dms_status_gudang", $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/gudang");
    }


    public function updateGudang()
    {





        $date = date("Y-m-d H:i:s");
        $data_info = array(

            'szObjectId' => "DMSWarehouse",
            // 'szId' => $this->input->post("Kgudang"),
            'szaddress' => $this->input->post("alamat"),
            'iId' => $this->uuid->v4(),
            'szProvince' => $this->input->post("szProvince"),
            'szCity' => $this->input->post("szCity"),
            'szDistrict' => $this->input->post("szDistrict"),
            'szSubDistrict' => $this->input->post("szSubDistrict"),
            'szZipcode' => $this->input->post("szZipCode"),
            'szPhone1' => $this->input->post("szPhone1"),
            'szPhone2' => $this->input->post("szPhone2"),
            'szPhone3' => $this->input->post("szPhone3"),
            'szFaximile' => $this->input->post("test"),
            'szContactPerson1' => $this->input->post("szContactPerson1"),
            'szContactPerson2' => $this->input->post("szContactPerson2"),
            'szEmail' => $this->input->post("szEmail"),
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );




        $data_inv = array(

            // 'szId' =>strtoupper( $this->input->post("Kgudang")),
            'szName' => strtoupper($this->input->post("Ngudang")),
            'szDescription' => $this->input->post("Ketgudang"),
            'szBranchId' => $this->input->post("depo"),
            'iId' => $this->uuid->v4(),
            'szUserCreatedId' => "-",
            'szUserUpdatedId' => "-",
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        $data = array(

            'status' => $this->input->post("status"),
            'szId' => $this->input->post("id"),


        );

        // var_dump($data_info);
        // die;

        $id = $this->input->post("id");
        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_gudang", $data);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_sm_addressInfo", $data_info);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_warehouse", $data_inv);

        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/gudang");
    }

    public function hapusGudang()
    {

        $id = $this->input->post("id_szId_gudang");
        // echo $id;
        // die;
        $data = array(

            'status' => 2,

        );


        $this->db->where("szId", $id);
        $this->db->update("dms_status_gudang", $data);
        $this->session->set_flashdata('massage', '<div class="alert alert-danger">Data berhasil di Hapus.</div>');
        redirect("master/gudang");
    }


    public function insertProduk()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("Kproduk");
        $valid = $this->db->query("SELECT * FROM $dept.dms_inv_product WHERE szId = '$id' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger">Kode produk sudah ada.</div>');
            redirect("master");
        }
        // echo $this->input->post("bUseComposite");
        // die;
        if ($this->input->post("bUseComposite") == null) {

            $composite = 0;
        } else {
            $composite = 1;
        }

        if ($this->input->post("bKit") == null) {

            $kit = 0;
        } else {

            $kit = 1;
        }


        if ($this->input->post("bUsePriceWTax") == null) {

            $tax = 0;
        } else {
            $tax = 1;
        }
        // echo $kit;
        // die;
        $date = date("Y-m-d H:i:s");
        $data = array(

            'szId' => strtoupper($this->input->post("Kproduk")),
            'szName' => strtoupper($this->input->post("Nproduk")),
            'szDescription' => $this->input->post("ketproduk"),
            'iId' => $this->uuid->v4(),
            'szTrackingType' => $this->input->post("jtProduk"),
            'szProductType' => $this->input->post("jpProduk"),
            'szNickname' => $this->input->post("nick"),
            'dtmStartDate' => $this->input->post("start"),
            'dtmEndDate' => $this->input->post("end"),
            'bKit' => $kit,
            'szQTYFormat' => $this->input->post("szQTYFormat"),
            'szUomId' => $this->input->post("szUomId"),
            'bUseComposite' => $composite


        );

        // var_dump($data);
        // die;

        $data_sales_info = array(

            'szId' => strtoupper($this->input->post("Kproduk")),
            'iId' => $this->uuid->v4(),
            'bUsePriceWTax' => $tax,
            'szOrderItemtypeId' => $this->input->post("szOrderItemtypeId"),
            'szUomId' => $this->input->post("szIdProduk"),
            'decPrice' => $this->input->post("decPrice"),
            'szDefaultUomId' => $this->input->post("szDefaultUomId"),
            'szTaxId' => $this->input->post("szTaxId"),



        );

        $data_tipe = array(

            'szId' => strtoupper($this->input->post("Kproduk")),
            'iId' => $this->uuid->v4(),
            'szCategoryValue' => $this->input->post("szCategoyValue"),
            'szCategoryTypeId' => 'CATEGORY_01',
            'intItemNumber' => '0',

        );

        // var_dump($data_sales_info);
        // die;  

        $data_status = array(

            'szId' => strtoupper($this->input->post("Kproduk")),
            'status' => 1


        );

        $data_categori = array(

            'szId' => strtoupper($this->input->post("Kproduk")),
            'szName' => $this->input->post("KKategori")


        );


        $id_kit = $this->input->post("idKit");
        $produk = $this->input->post("produkKit");
        $kuantiti = $this->input->post("kuantitiKit");
        $satuanKit = $this->input->post("SatuanKit");
        $kit = strtoupper($this->input->post("Kproduk"));


        // var_dump($id_kit);
        // die;
        $idkit = count($id_kit);
        $uud =  $this->uuid->v4();

        $data_kit = array();
        for ($i = 0; $i < $idkit; $i++) {
            array_push($data_kit, array(

                'szId' => $kit,
                'iId' => $uud,
                'szProductId' => $id_kit[$i],
                'decQty' => $kuantiti[$i],
                'szUomId' => $satuanKit[$i],

            ));
        }

        // 	var_dump($data_kit);
        // die;

        if ($id_kit == null) {
        } else {

            $this->db->insert_batch("Dms_inv_productkitinfo", $data_kit);
        }


        // var_dump($data);
        // die;
        $this->db2 = $this->load->database($name, true);
        $this->db2->insert("dmstesting.dms_inv_product", $data);
        $this->db2->insert("dmstesting.dms_inv_productsalesinfo", $data_sales_info);
        $this->db2->insert("dmstesting.dms_inv_productitemcategory", $data_tipe);
        $this->db2->close();

        $this->db->insert($base.".dms_status_produk", $data_status);
        // $this->db->insert("dms_inv_productCategoriType" , $data_categori);
        // $this->db->insert("dms_inv_productcategori" , $data_categori);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/produk");
    }


    public function updateProduk()
    {

        $kit = strtoupper($this->input->post("Kproduk"));

        // echo $kit;
        // die;

        $data = array(

            'status' => $this->input->post("status"),


        );



        if ($this->input->post("bUseComposite") == null) {

            $composite = 0;
        } else {
            $composite = 1;
        }

        echo $this->input->post("bUseComposite");
        // die;

        if ($this->input->post("idKitNew") == null) {

            $kit = 0;
        } else {
            $kit = 1;
        }

        if ($this->input->post("bUsePriceWTax") == null) {

            $tax = 0;
        } else {
            $tax = 1;
        }
        // echo $kit;
        // die;
        $date = date("Y-m-d H:i:s");
        $data_new = array(

            // 'szId' => strtoupper($this->input->post("Kproduk")),
            'szName' => strtoupper($this->input->post("Nproduk")),
            'szDescription' => $this->input->post("keterangan"),
            'iId' => $this->uuid->v4(),
            'szTrackingType' => $this->input->post("jtProduk"),
            'szProductType' => $this->input->post("jpProduk"),
            'szNickname' => $this->input->post("nick"),
            'dtmStartDate' => $this->input->post("start"),
            'dtmEndDate' => $this->input->post("end"),
            'bKit' => $kit,
            'szQTYFormat' => $this->input->post("szQTYFormat"),
            'szUomId' => $this->input->post("szUomId"),
            'bUseComposite' => $composite


        );

        // var_dump($data);
        // die;

        $data_sales_info = array(

            // 'szId' => strtoupper($this->input->post("Kproduk")),
            'iId' => $this->uuid->v4(),
            'bUsePriceWTax' => $tax,
            'szOrderItemtypeId' => $this->input->post("szOrderItemtypeId"),
            'szUomId' => $this->input->post("stproduk"),
            'decPrice' => $this->input->post("hargasatuan"),
            'szDefaultUomId' => $this->input->post("szDefaultUomId"),
            'szTaxId' => $this->input->post("szTaxId"),



        );

        $data_tipe = array(

            // 'szId' => strtoupper($this->input->post("Kproduk")),
            'iId' => $this->uuid->v4(),
            'szCategoryValue' => $this->input->post("kategorisz"),
            'szCategoryTypeId' => 'CATEGORY_01',
            'intItemNumber' => '0',

        );

        // var_dump($data_sales_info);
        // echo "<br>";
        // echo $this->input->post("hargasatuan");
        // die;  

        $data_status = array(

            // 'szId' => $this->input->post("Kproduk"),
            'status' => 1


        );

        $data_categori = array(

            'szId' => $this->input->post("kategorisz"),
            'szName' => $this->input->post("KKategori")


        );

        $id_kit = $this->input->post("idKitNew");
        $produk = $this->input->post("produkKitNew");
        $kuantiti = $this->input->post("kuantitiKitNew");
        $satuanKit = $this->input->post("SatuanKitNew");
        $id_kitold = $this->input->post("idKit");
        $produkold = $this->input->post("produkKit");
        $kuantitiold = $this->input->post("kuantitiKit");
        $satuanKitold = $this->input->post("SatuanKit");
        $kit = strtoupper($this->input->post("Kproduk"));
        $kit_old = $this->input->post("szIdold");

        $idkitold = count($kit_old);
        // echo $idkitold;
        // var_dump($id_kit);
        // die;
        $uud =  $this->uuid->v4();

        if ($id_kit != '') {

            $idkit = count($id_kit);
            $data_kit = array();
            for ($i = 0; $i < $idkit; $i++) {
                array_push($data_kit, array(

                    'szId' => $kit,
                    'iId' => $uud,
                    'szProductId' => $id_kit[$i],
                    'decQty' => $kuantiti[$i],
                    'szUomId' => $satuanKit[$i],

                ));
            }

            $this->db->insert_batch("Dms_inv_productkitinfo", $data_kit);
        }

        if ($kit_old != null) {
            $data_kit_edit = array();
            for ($i = 0; $i < $idkitold; $i++) {
                array_push($data_kit_edit, array(

                    'iInternalId' => $kit_old[$i],
                    'iId' => $uud,
                    'decQty' => $kuantitiold[$i],

                ));
            }


            // var_dump($data_kit_edit);
            // die;

            // $this->db->update_batch("" , $data_kit);
            $this->db->update_batch('dms_inv_productkitinfo', $data_kit_edit, 'iInternalId');
        }

        // die;

        $id = $this->input->post("id");
        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_produk", $data);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_product", $data_new);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_productsalesinfo", $data_sales_info);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_productitemcategory", $data_tipe);


        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/produk");
    }

    public function hapusProduk($x)
    {

        // echo $x;
        // die;
        $data = array(

            'status' => 2,

        );


        $this->db->where("iInternalId", $x);
        $this->db->delete("dms_inv_productkitinfo");
        // die;
        $this->session->set_flashdata('massage', '<div class="alert alert-danger">Data berhasil di Hapus.</div>');
        redirect("master/produk");
    }


    public function get_ajax_gudang()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_gudang($postData);
        // var_dump($data);
        // die;
        echo json_encode($data);
        // $data['wuh'] = $this->m_user->wuh_user();
        // $this->load->view("admin/wuh_user",$data);
    }


    public function get_ajax_KategoriProduk()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_KategoriProduk($postData);
        // var_dump($data);
        // die;
        echo json_encode($data);
        // $data['wuh'] = $this->m_user->wuh_user();
        // $this->load->view("admin/wuh_user",$data);
    }


    public function get_ajax_TipeKategoriProduk()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_TipeKategoriProduk($postData);
        // var_dump($data);
        // die;
        echo json_encode($data);
        // $data['wuh'] = $this->m_user->wuh_user();
        // $this->load->view("admin/wuh_user",$data);
    }


    public function get_ajax_produk()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_data_produk($postData);

        echo json_encode($data);
    }

    public function get_kit()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_kit($postData);

        echo json_encode($data);
    }


    public function insertKategori()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("Kkategori");
        $valid = $this->db->query("SELECT * FROM $dept.dms_inv_productcategory WHERE szId = '%$id%' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger">Kode produk sudah ada.</div>');
            redirect("master");
        }

        $date = date("Y-m-d H:i:s");
        $data = array(

            'szId' => $this->input->post("Kkategori"),
            'szName' => $this->input->post("Nkategori"),
            'szDescription' => $this->input->post("szDescription"),
            'szCategoryTypeId' => $this->input->post("szCategorytipeId"),
            'iId' => $this->uuid->v4()



        );

        // var_dump($data);
        // die;
        $data_status = array(

            'szId' => $this->input->post("Kkategori"),
            'status' => 1


        );

        // var_dump($data);
        // die;
        $this->db2 = $this->load->database($name, true);
        $this->db2->insert("dms_inv_productcategory", $data);
        $this->db2->close();

        $this->db->insert($base.".dms_status_kategori", $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/kategoriproduk");
    }

    public function insertTipeKategori()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }

        $id = $this->input->post("TKkategori");
        $valid = $this->db->query("SELECT * FROM $dept.dms_inv_productcategorytype WHERE szId = '%$id%' ")->result();

        // var_dump($valid);
        // die;
        if ($valid != null) {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger">Kode produk sudah ada.</div>');
            redirect("master");
        }


        // $id = $this->input->post("TKcategori");
        // echo $id;
        // die;
        if ($this->input->post("TKcategori") == 1) {

            $id = 1;
        } else {

            $id = 0;
        }


        $date = date("Y-m-d H:i:s");
        $data = array(

            'szId' => $this->input->post("TKkategori"),
            'szName' => $this->input->post("TKnkategori"),
            'szDescription' => $this->input->post("TKdescription"),
            'bUseForPriceCalc' => $id,
            'iId' => $this->uuid->v4(),
            'dtmCreated' => $date,



        );

        // var_dump($data);
        // die;
        $data_status = array(

            'szId' => $this->input->post("TKkategori"),
            'status' => $id


        );

        // var_dump($data);
        // die;
        $this->db2 = $this->load->database($name, true);
        $this->db2->insert("dmstesting.dms_inv_productcategorytype", $data);
        $this->db2->close();
        
        $this->db->insert($base.".dms_status_tipekategori", $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/TipeKategoriProduk");
    }


    public function updateKategori()
    {

        $data = array(

            'status' => $this->input->post("status"),


        );



        $data_new = array(

            // 'szId' => $this->input->post("Kkategori"),
            // 'szId' => $this->input->post("Kkategori"),
            'szName' => $this->input->post("Nkategori"),
            'szDescription' => $this->input->post("szDescription"),
            'szCategorytypeId' => $this->input->post("tk"),



        );


        $id = $this->input->post("id");
        // var_dump($data_new);
        // var_dump($data);
        // echo $id;
        // die;



        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_Kategori", $data);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_productcategory", $data_new);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/kategoriProduk");
    }

    public function updateTipeKategori()
    {

        if ($this->input->post("TKcategori") == 1) {

            $id_s = 1;
        } else {

            $id_s = 0;
        }


        $data = array(

            'status' => $id_s,


        );



        $data_new = array(

            // 'szId' => $this->input->post("Kkategori"),
            // 'szId' => $this->input->post("Kkategori"),
            'szName' => $this->input->post("TKnkategori"),
            'szDescription' => $this->input->post("TKdescription"),
            'bUseForPriceCalc' => $id_s,
            'iId' => $this->uuid->v4()



        );


        $id = $this->input->post("id");
        // var_dump($d/ata_new);
        // var_dump($data);
        // echo $id;
        // die;



        // echo $id;
        // die;
        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_status_TipeKategori", $data);

        $this->db->where("szId", $this->input->post("id"));
        $this->db->update("dms_inv_productcategorytype", $data_new);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil di update.</div>');
        redirect("master/TipekategoriProduk");
    }

    public function hapusTipeKategori()
    {

        $id = $this->input->post("id_szId_gudang");
        // echo $id;
        // die;
        $data = array(

            'status' => 2,

        );


        $this->db->where("szId", $id);
        $this->db->update("dms_status_produk", $data);

        $this->session->set_flashdata('massage', '<div class="alert alert-danger">Data berhasil di Hapus.</div>');
        redirect("master/Tipekategori");
    }



    public function insertAlamatGudang()
    {

        // $id = $this->input->post("Ksatuan");
        // $valid = $this->db->query("SELECT * FROM dms_inv_uom WHERE szId LIKE '%$id%' ")->result();

        // var_dump($valid);
        // die;
        // if($valid != null ){

        // $this->session->set_flashdata('massage','<div class="alert alert-danger">Kode produk sudah ada.</div>');
        // redirect("master");

        // }

        $date = date("Y-m-d H:i:s");
        $data = array(

            'szObjectId' => "DMSWarehouse",
            'szId' => $this->input->post("szId"),
            'szaddress' => $this->input->post("szaddress"),
            'iId' => $this->uuid->v4(),
            'szProvince' => $this->input->post("szProvince"),
            'szCity' => $this->input->post("szCity"),
            'szDistrict' => $this->input->post("szDistrict"),
            'szSubDistrict' => $this->input->post("szSubDistrict"),
            'szZipcode' => $this->input->post("szZipCode"),
            'szPhone1' => $this->input->post("szPhone1"),
            'szPhone2' => $this->input->post("szPhone2"),
            'szPhone3' => $this->input->post("szPhone3"),
            'szFaximile' => $this->input->post("szFaxmile"),
            'szContactPerson1' => $this->input->post("szContactPerson1"),
            'szContactPerson2' => $this->input->post("szContactPerson2"),
            'szEmail' => $this->input->post("email"),
            'DtmCreated' => $date,
            'dtmLastUpdated' => $date

        );


        // $data_status = array(

        // 	'szId' => $this->input->post("Ksatuan"),
        // 	'status' => 1


        // );

        $this->db->insert("dms_sm_addressInfo", $data);
        // $this->db->insert("dms_status_satuan" , $data_status);
        $this->session->set_flashdata('massage', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        redirect("master/satuan");
    }


    public function get_produk_satuan()
    {


        $postData = $this->input->post();
        // var_dump($postData);
        // die; 
        $data = $this->m_inventory->get_produksatuan($postData);

        echo json_encode($data);
    }


    public function get_satuan_valid()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_satuan_valid($postData);

        echo json_encode($data);
    }

    public function get_tipestok_valid()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_tipestok_valid($postData);

        echo json_encode($data);
    }
    public function get_gudang_valid()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_gudang_valid($postData);

        echo json_encode($data);
    }
    public function get_kategori_valid()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_kategori_valid($postData);

        echo json_encode($data);
    }


    public function get_tipekategori_valid()
    {



        $postData = $this->input->post();
        $data = $this->m_inventory->get_tipekategori_valid($postData);

        echo json_encode($data);
    }

    public function get_produk_valid()
    {

        $postData = $this->input->post();
        $data = $this->m_inventory->get_produk_valid($postData);

        echo json_encode($data);
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
        $depo = "'" . $asal . "', '" . $asli . "'";
        $data = $this->mHome->getDriverDistribusi($depo);
        echo json_encode($data);
    }

    function getVehicleDistribusi()
    {
        $asal = $this->input->post('asalDepo');
        $asli = $this->session->userdata('user_branch');
        $depo = "'" . $asal . "', '" . $asli . "'";
        $data = $this->mHome->getVehicleDistribusi($depo);
        echo json_encode($data);
    }
}
