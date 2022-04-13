<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_inventory extends CI_model
{
    public function get_satuan()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        return $this->db->query("SELECT a.*,b.* FROM $dept.dms_inv_uom AS a 
        LEFT JOIN $base.dms_status_satuan AS b ON a.szId = b.szId")->result();
    }

    public function get_KategoriP()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
        } else {
            $dept = 'dms111tvip';
        }
        return $this->db->query(" SELECT * FROM $dept.dms_inv_productcategorytype where bUseForPriceCalc = 1 ")->result();
    }




    public function get_data_satuan($postData)
    {




        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];



        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }


        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_uom as a');
        $this->db->join('Dms_status_satuan as b', ' a.szId = b.szId');
        $this->db->where('b.status != 2');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }


        $this->db->from('Dms_inv_uom as a');
        $this->db->join('Dms_status_satuan as b', ' a.szId = b.szId');
        $this->db->where('b.status != 2');

        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('*');
        $this->db->from('Dms_inv_uom as a');
        $this->db->join('Dms_status_satuan as b', ' a.szId = b.szId');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {
            $row = array();

            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }
            $row['action']     = ' <button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
            data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }

    public function get_tipe_stok()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }
        return $this->db->query("SELECT a.*, b.* FROM $dept.dms_inv_stockType AS a
        LEFT JOIN $base.dms_status_tipestok AS b ON a.szId=b.`szId`
        WHERE b.status != 2")->result();
    }


    public function get_data_tipe_stock($postData)
    {




        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter = $postData['statusTipe'];


        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter != "") {

            $search_filter[] = "b.status = '" . $filter . "'";
        }



        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_stockType as a');
        $this->db->join('Dms_status_tipestok as b', ' a.szId = b.szId');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }



        $this->db->from('Dms_inv_stockType as a');
        $this->db->join('Dms_status_tipeStok as b', ' a.szId = b.szId');


        if ($filter == null) {

            $this->db->where('b.status = 1');
        }



        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('Dms_inv_stockType as a ');
        $this->db->join('Dms_status_tipeStok as b', ' a.szId = b.szId');


        if ($filter == null) {

            $this->db->where('b.status = 1');
        }

        if ($search_query != '') {
            $this->db->where($search_query);
        }


        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }
            $row['action']     = '<button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary btn-sm mb-1 mt-1 updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['iInternalId'] . '"> Update</button><br><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary btn-sm editSatuan" data-bs-toggle="modal"
                data-bs-target="#large' . $field['iInternalId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }






    public function get_gudang()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        return $this->db->query(" SELECT a.*,b.*,c.*,d.* FROM $dept.dms_inv_warehouse AS a
        LEFT JOIN $base.dms_status_gudang AS b ON a.szId=b.`szId`
        LEFT JOIN $base.dms_sm_branch AS c ON a.szBranchId = c.szId
        LEFT JOIN $base.dms_sm_addressInfo AS d ON a.szId = d.szId")->result();
    }

    public function Province()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }
        return  $this->db->query(" SELECT * FROM $dept.dms_gen_geotree  GROUP BY szProvince ")->result();
    }


    public function get_data_gudang($postData)
    {


        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter = $postData['statusGudang'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter != "") {

            $search_filter[] = "b.status = '" . $filter . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_warehouse as a');
        $this->db->join('Dms_status_gudang as b', ' a.szId = b.szId');
        $this->db->join('tbl_depo as c', ' a.szBranchId = c.kode_dms');
        if ($filter == null) {

            $this->db->where('b.status = 1');
        }

        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }
        if ($filter == null) {

            $this->db->where('b.status = 1');
        }




        $this->db->from('Dms_inv_warehouse as a');
        $this->db->join('Dms_status_gudang as b', ' a.szId = b.szId');
        $this->db->join('tbl_depo as c', ' a.szBranchId = c.kode_dms');


        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*,c.*');
        $this->db->from('Dms_inv_warehouse as a ');
        $this->db->join('Dms_status_gudang as b', ' a.szId = b.szId');
        $this->db->join('tbl_depo as c', ' a.szBranchId = c.kode_dms');

        if ($filter == null) {

            $this->db->where('b.status = 1');
        }

        if ($search_query != '') {
            $this->db->where($search_query);
        }


        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];
            $row['depo']       = $field['depo_nama'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }
            $row['action']     = '<button type="button" class="btn btn-outline-primary btn-sm updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button   type="button" class="btn btn-primary btn-sm editSatuan" data-bs-toggle="modal"
                    data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }



    public function get_produk()
    {

        // return $this->db->query("SELECT  
        //                         a.*,
        //                         b.`bUsePriceWTax`,
        //                         b.`decPrice`,
        //                         b.`szDefaultUomId`,
        //                         b.`szUomId` AS `tipe_sales`,
        //                         b.`szTaxId`,
        //                         b.`szOrderItemtypeId`,
        //                         c.`status`,
        //                         e.`decQty`,
        //                         f.`intItemNumber`,
        //                         f.`szCategoryTypeId`,
        //                         f.`szCategoryValue`,
        //                         DATE(a.`dtmStartDate`) as `tgl_awal`,
        //                         date(a.`dtmEndDate`) as `tgl_akhir`

        //                                 FROM dms_inv_product AS a
        //                                 LEFT JOIN dms_status_produk AS c ON c.`szId`=a.`szId`
        //                                 LEFT JOIN dms_inv_productsalesinfo AS b ON a.`szId` = b.`szId`
        //                                 LEFT JOIN `dms_inv_productitemcategory` AS f ON a.`szId` = f.`szId`
        //                                 LEFT JOIN `dms_inv_productkitinfo` AS e ON a.`szId` = e.`szId`

        //                                 WHERE c.`status`!= 2
        //                                   ")->result();


        return $this->db->query("SELECT  
                                        a.*,
                                        b.`bUsePriceWTax`,
                                        b.`decPrice`,
                                        b.`szDefaultUomId`,
                                        b.`szUomId` AS `tipe_sales`,
                                        b.`szTaxId`,
                                        b.`szOrderItemtypeId`,
                                        c.`status`,
                                        e.`decQty`,
                                        f.`intItemNumber`,
                                        f.`szCategoryTypeId`,
                                        f.`szCategoryValue`,
                                        DATE(a.`dtmStartDate`) AS `tgl_awal`,
                                        DATE(a.`dtmEndDate`) AS `tgl_akhir`,
                                        z.`szName`AS `nama_satuan`,
                                        cat.`szName` AS `nama_kategori`,
                                        z_dua.`szName` AS `satuan_produk`
                            
                                                FROM dms_inv_product AS a
                                                LEFT JOIN dms_status_produk AS c ON c.`szId`=a.`szId`
                                                LEFT JOIN dms_inv_productsalesinfo AS b ON a.`szId` = b.`szId`
                                                LEFT JOIN `dms_inv_productitemcategory` AS f ON a.`szId` = f.`szId`
                                                LEFT JOIN `dms_inv_productkitinfo` AS e ON a.`szId` = e.`szId`
                                                LEFT JOIN `dms_inv_uom` AS z ON b.`szUomId` = z.`szId`
                                                LEFT JOIN `dms_inv_uom` AS z_dua ON a.`szUomId` = z_dua.`szId`
                                                LEFT JOIN `dms_inv_productcategorytype` AS cat ON cat.`szId` = f.`szCategoryValue`


        
                                                WHERE c.`status`!= 2

                                        ")->result();
    }


    public function get_produksatuan($postData)
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

        $id = $postData['id'];

        return $this->db->query("SELECT * FROM $dept.dms_inv_product where szId = '$id' ")->result();
    }









    public function get_data_produk($postData)
    {

        // return $this->db->query("SELECT a.*
        //                                 ,b.star_date
        //                                 ,b.end_date
        //                                 , c.id_jawaban
        //                                 ,c.jawaban_user
        //                                 , e.`depo_nama`

        //                                 FROM USER AS a 
        //                                 LEFT JOIN kwartal AS b ON a.kwartal = b.kwartal AND a.tahun=b.tahun
        //                                 LEFT JOIN jawaban AS c ON a.nik = c.`nik`
        //                                 LEFT JOIN AREA AS e ON a.`area`=e.`kode_dms`
        //                                 WHERE (a.jabatan = 305 OR a.jabatan = 427)  AND  star_date <= CURDATE() AND `end_date` >= CURDATE() AND a.tahun = CURDATE() AND c.`id_jawaban`  IS NULL  
        //                                 group by a.nik
        //                                 ")->result();




        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }

        // $this->db->join('kbkmmasterdriver',' kbkmmasterdriver.driverKodeDriver = kbkmpembelian.pembelianDriver');
        // $this->db->join('kbkmmasterarmada',' kbkmmasterarmada.armadaId = kbkmpembelian.pembelianNopol');
        // $this->db->join('kbkmmastertrader',' kbkmmastertrader.traderId = kbkmpembelian.pembelianSupplier');
        // $this->db->join('kbkmmasterlokasistock','kbkmmasterlokasistock.lokasiId = kbkmpembelian.pembelianLokasiStock');
        // $this->db->where('pembelianStatus', 'Eksternal');
        // if($this->session->userdata('lokasi_struktur') != 'Pusat'){
        // $this->db->like('pembelianId', 'KBKM/'.$filter_singkatan.'', 'after');
        // }

        // $records = $this->db->get('soal')->result();



        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');

        // $this->db->join('area as b ',' a.area = b.kode_dms');
        // $this->db->join('kwartal as c ',' a.kwartal = c.kwartal and a.tahun=c.tahun');
        // $this->db->where('jabatan',305);
        // $this->db->where('star_date <= CURDATE()');

        // $this->db->where('star_date <= CURDATE()' );

        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('Dms_inv_product as a ');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        // $this->db->join('kbkmmasterarmada',' kbkmmasterarmada.armadaId = kbkmpembelian.pembelianNopol');
        // $this->db->join('kbkmmastertrader',' kbkmmastertrader.traderId = kbkmpembelian.pembelianSupplier');
        // $this->db->join('kbkmmasterlokasistock','kbkmmasterlokasistock.lokasiId = kbkmpembelian.pembelianLokasiStock');

        if ($search_query != '') {
            $this->db->where($search_query);
        }
        // $this->db->where('a.kode_soal','1');
        // $this->db->where('jabatan',417);

        // $this->db->where('pembelianStatus', 'Eksternal');
        // if($this->session->userdata('lokasi_struktur') != 'Pusat'){
        // $this->db->like('pembelianId', 'KBKM/'.$filter_singkatan.'', 'after');
        // }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = '<button  onclick="edit' . $field['szId'] . '(' . "'" . $field['szId'] . "'" . ')" szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                        data-bs-target="#large' . $field['szId'] . '"  onclick="detail' . $field['szId'] . '(' . "'" . $field['szId'] . "'" . ')"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }





    public function get_data_cari($postData)
    {





        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        // if ($filter_tgl != "") {

        //     $search_filter[] = "b.status = '".$filter_tgl."'";

        // }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        // if ($filter == null) {

        //     $this->db->where('b.status = 1');
        // }

        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }




        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        // if ($filter == null) {

        //     $this->db->where('b.status = 1');
        // }


        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('Dms_inv_product as a ');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        // $this->db->join('kbkmmasterarmada',' kbkmmasterarmada.armadaId = kbkmpembelian.pembelianNopol');
        // $this->db->join('kbkmmastertrader',' kbkmmastertrader.traderId = kbkmpembelian.pembelianSupplier');
        // $this->db->join('kbkmmasterlokasistock','kbkmmasterlokasistock.lokasiId = kbkmpembelian.pembelianLokasiStock');

        if ($search_query != '') {
            $this->db->where($search_query);
        }
        // $this->db->where('a.kode_soal','1');
        // $this->db->where('jabatan',417);

        // $this->db->where('pembelianStatus', 'Eksternal');
        // if($this->session->userdata('lokasi_struktur') != 'Pusat'){
        // $this->db->like('pembelianId', 'KBKM/'.$filter_singkatan.'', 'after');
        // }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = '<button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                        data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }




    public function get_data_TipeKategori($postData)
    {






        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        // if ($filter_tgl != "") {

        //     $search_filter[] = "b.status = '".$filter_tgl."'";

        // }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }

        // $this->db->join('kbkmmasterdriver',' kbkmmasterdriver.driverKodeDriver = kbkmpembelian.pembelianDriver');
        // $this->db->join('kbkmmasterarmada',' kbkmmasterarmada.armadaId = kbkmpembelian.pembelianNopol');
        // $this->db->join('kbkmmastertrader',' kbkmmastertrader.traderId = kbkmpembelian.pembelianSupplier');
        // $this->db->join('kbkmmasterlokasistock','kbkmmasterlokasistock.lokasiId = kbkmpembelian.pembelianLokasiStock');
        // $this->db->where('pembelianStatus', 'Eksternal');
        // if($this->session->userdata('lokasi_struktur') != 'Pusat'){
        // $this->db->like('pembelianId', 'KBKM/'.$filter_singkatan.'', 'after');
        // }

        // $records = $this->db->get('soal')->result();



        $this->db->from('Dms_inv_product as a');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');

        // $this->db->join('area as b ',' a.area = b.kode_dms');
        // $this->db->join('kwartal as c ',' a.kwartal = c.kwartal and a.tahun=c.tahun');
        // $this->db->where('jabatan',305);
        // $this->db->where('star_date <= CURDATE()');

        // $this->db->where('star_date <= CURDATE()' );

        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('Dms_inv_product as a ');
        $this->db->join('Dms_status_produk as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        // $this->db->join('kbkmmasterarmada',' kbkmmasterarmada.armadaId = kbkmpembelian.pembelianNopol');
        // $this->db->join('kbkmmastertrader',' kbkmmastertrader.traderId = kbkmpembelian.pembelianSupplier');
        // $this->db->join('kbkmmasterlokasistock','kbkmmasterlokasistock.lokasiId = kbkmpembelian.pembelianLokasiStock');

        if ($search_query != '') {
            $this->db->where($search_query);
        }
        // $this->db->where('a.kode_soal','1');
        // $this->db->where('jabatan',417);

        // $this->db->where('pembelianStatus', 'Eksternal');
        // if($this->session->userdata('lokasi_struktur') != 'Pusat'){
        // $this->db->like('pembelianId', 'KBKM/'.$filter_singkatan.'', 'after');
        // }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = ' <button szId_hapus="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary hapusSatuan" data-bs-toggle="modal" data-bs-target="#hapus' . $field['szId'] . '"> Hapus</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                            data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }



    public function get_data_kendaraan($postData)
    {






        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_vehicle as a');
        $this->db->join('Dms_status_kendaraan as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');


        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }





        $this->db->from('dms_inv_vehicle as a');
        $this->db->join('Dms_status_kendaraan as b', ' a.szId = b.szId');
        $this->db->join('tbl_depo as c', ' a.szBranchId = c.kode_dms');


        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('Dms_inv_vehicle as a ');
        $this->db->join('Dms_status_kendaraan as b', ' a.szId = b.szId');
        $this->db->join('tbl_depo as c', ' a.szBranchId = c.kode_dms');

        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = '<button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['iInternalId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                                data-bs-target="#large' . $field['iInternalId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }






    public function get_data_Tipekendaraan($postData)
    {






        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('Dms_inv_vehicletype as a');
        $this->db->join('Dms_status_Tipekendaraan as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }





        $this->db->from('dms_inv_vehicletype as a');
        $this->db->join('Dms_status_tipekendaraan as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status != 2');



        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('dms_inv_vehicletype as a');
        $this->db->join('Dms_status_tipekendaraan as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');

        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = ' <button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                                    data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }

    public function get_kategori()
    {

        return $this->db->query('SELECT 
                                                        a.*,b.* FROM dms_inv_productcategory as a
                                                        left join dms_status_kategori as b on a.szId=b.szId
                                                        ')->result();
    }
    public function get_tipe_kategori()
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

        return $this->db->query("SELECT a.*,b.* FROM $dept.dms_inv_productcategorytype as a
        left join $base.dms_status_tipekategori as b on a.szId=b.szId")->result();
    }

    public function get_data_KategoriProduk($postData)
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

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from($dept.'.dms_inv_productcategory as a');
        $this->db->join($base.'.dms_status_Kategori as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        $this->db->where('b.status = 1');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }





        $this->db->from($dept.'.dms_inv_productcategory as a');
        $this->db->join($base.'.dms_status_Kategori as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        // $this->db->where('b.status = 1');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }


        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from($dept.'.dms_inv_productcategory as a');
        $this->db->join($base.'.dms_status_Kategori as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');

        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = '<button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan btn-sm" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary btn-sm editSatuan" data-bs-toggle="modal"
                                    data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }



    public function get_data_ekspedisi($postData)
    {






        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('dms_inv_carrier as a');
        $this->db->join('dms_status_ekspedisi as b', ' a.szId = b.szId');
        $this->db->where('b.status = 1');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }





        $this->db->from('dms_inv_carrier as a');
        $this->db->join('Dms_status_ekspedisi as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        // $this->db->where('b.status = 1');



        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('dms_inv_carrier as a');
        $this->db->join('Dms_status_ekspedisi as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = ' <button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                                    data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }

    public function get_data_TipeKategoriProduk($postData)
    {






        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order']; // Column index
        // $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $data = array();
        $search_filter = array();
        $search_query = "";
        $search = $postData['search']['value'];
        $filter_tgl = $postData['status'];
        // $filter_tgl2 = $postData['filterTgl2'];
        // $filter_singkatan = $postData['filterSingkatan'];

        if ($search != '') {
            $search_filter[] = " (a.szId like '%" . $search . "%'  or a.szName like '%" . $search . "%' ) ";
        }

        if ($filter_tgl != "") {

            $search_filter[] = "b.status = '" . $filter_tgl . "'";
        }

        // if ($filter_tgl2 != "") {
        //     $search_filter[] = "pembelianTanggal <='".$filter_tgl2."'";
        // }

        if (count($search_filter) > 0) {
            $search_query = implode(" and ", $search_filter);
        }



        ## Total number of records without filtering

        $this->db->select('count(*) as allcount');

        $this->db->from('dms_inv_productcategorytype as a');
        $this->db->join('dms_status_tipeKategori as b', ' a.szId = b.szId');
        $this->db->where('b.status = 1');


        // $this->db->where('jabatan',417);

        $records = $this->db->get()->result();

        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($search_query != '') {

            $this->db->where($search_query);
        }





        $this->db->from('dms_inv_productcategorytype as a');
        $this->db->join('dms_status_tipeKategori as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        // $this->db->where('b.status = 1');



        $records = $this->db->get()->result();



        $totalRecordwithFilter = $records[0]->allcount;

        // Get data
        $this->db->select('a.*,b.*');
        $this->db->from('dms_inv_productcategorytype as a');
        $this->db->join('dms_status_tipeKategori as b', ' a.szId = b.szId');
        // $this->db->join('tbl_depo as c',' a.szBranchId = c.kode_dms');
        if ($filter_tgl == null) {

            $this->db->where('b.status = 1');
        }



        if ($search_query != '') {
            $this->db->where($search_query);
        }

        foreach ($columnIndex as $key) {
            $this->db->order_by($columnName[$key['column']]['data'], $key['dir']);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $no = 1;
        foreach ($records as $field) {

            $row = array();
            // $row ['id_soal']	= $field['no_soal'];
            // $row ['no']	= $no++;
            $row['iInternalId']    = $no++;
            $row['iId']       = $field["szId"];
            $row['Szname']       = $field['szName'];

            if ($field['status'] == 1) {
                $row['Szid']       = "Aktif";
            } else {
                $row['Szid']       = "Tidak Aktif";
            }

            $row['action']     = ' <button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-outline-primary updateSatuan" data-bs-toggle="modal" data-bs-target="#update' . $field['szId'] . '"> Update</button><button szId="' . $field['szId'] . '" szName="' . $field['szName'] . '" aktif="' . $field['status'] . '" deskripsi="' . $field['szDescription'] . '"  type="button" class="btn btn-primary editSatuan" data-bs-toggle="modal"
                                            data-bs-target="#large' . $field['szId'] . '"> Detail</button>';
            $data[] = $row;
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "apa" => $postData
        );

        return $response;
    }


    public function get_kota($post)
    {

        $status = $post['status'];

        return $this->db->query("SELECT * FROM dms_gen_geotree WHERE szProvince = '$status' GROUP BY szCity")->result();
    }

    public function get_kecamatan($post)
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

        $status = $post['status'];

        return $this->db->query("SELECT * FROM $dept.dms_gen_geotree WHERE szCity = '$status' GROUP BY szDistrict")->result();
    }

    public function get_kelurahan($post)
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

        $status = $post['status'];

        return $this->db->query("SELECT * FROM $dept.dms_gen_geotree WHERE szDistrict = '$status' ")->result();
    }
    public function get_kode($post)
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

        $status_dua = $post['status'];
        $status = $post['status_dua'];

        return $this->db->query("SELECT * FROM $dept.dms_gen_geotree WHERE szDistrict = '$status' AND szSubDistrict = '$status_dua' GROUP BY szZipCode")->result();
    }

    public function get_kota_edit($id)
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

        $status = $id['status'];

        return $this->db->query("SELECT * FROM $dept.dms_gen_geotree WHERE szProvince = '$status' GROUP BY szCity")->result();
    }

    public function get_kelurahan_edit($id)
    {

        $status = $id['status'];

        return $this->db->query("SELECT * FROM dms_gen_geotree WHERE szDistrict = '$status'")->result();
    }

    public function get_kit($id)
    {

        $status = $id['id'];

        return $this->db->query("SELECT a.*,b.szName 
                                        FROM `dms_inv_productkitinfo` AS a 
                                        LEFT JOIN dms_inv_product AS b ON A.`szProductId` = b.szId
                                        WHERE a.`szId` ='$status'")->result();
    }

    public function get_produkAktif()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }
        return $this->db->query("SELECT a.*,b.*
        FROM $dept.`dms_inv_product` AS a
        LEFT JOIN $base.dms_status_produk AS b ON a.szid = b.`szId`
        WHERE b.status = 1")->result();
    }

    public function get_tax()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
        } else {
            $dept = 'dms111tvip';
        }
        return $this->db->query("SELECT a.`szId`, a.`szName` FROM $dept.`dms_gen_taxtype` AS a")->result();
    }

    public function get_ordertype()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
        } else {
            $dept = 'dms111tvip';
        }
        return $this->db->query("SELECT a.`szId`, a.`szName` FROM $dept.`dms_sd_orderitemtype` AS a ")->result();
    }

    public function get_produk_satuan()
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

        return $this->db->query("SELECT a.*,b.* FROM $dept.`dms_inv_product` AS a 
        LEFT JOIN $base.dms_status_produk AS b ON a.szid = b.`szId` 
        WHERE b.status = 1")->result();
    }

    public function get_kendaraan_valid($post)
    {

        $id = $post['kendaraan'];
        return $this->db->query("SELECT * FROM Dms_inv_vehicle WHERE szId = '$id' ")->result();
    }

    public function get_tipekendaraan_valid($post)
    {

        $id = $post['kendaraan'];
        return $this->db->query("SELECT * FROM Dms_inv_vehicletype WHERE szId = '$id' ")->result();
    }
    public function get_ekspedisi_valid($post)
    {

        $id = $post['kendaraan'];
        return $this->db->query("SELECT * FROM dms_inv_carrier WHERE szId = '$id' ")->result();
    }

    public function get_satuan_valid($post)
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
        $id = $post['inv'];
        return $this->db->query("SELECT * FROM $dept.dms_inv_uom WHERE szId = '$id' ")->result();
    }
    public function get_tipestok_valid($post)
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
        $id = $post['inv'];
        return $this->db->query("SELECT * FROM $dept.dms_inv_stocktype WHERE szId = '$id' ")->result();
    }
    public function get_gudang_valid($post)
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
        $id = $post['inv'];
        return $this->db->query("SELECT * FROM $dept.dms_inv_warehouse WHERE szId = '$id' ")->result();
    }
    public function get_kategori_valid($post)
    {

        $id = $post['inv'];
        return $this->db->query("SELECT * FROM dms_inv_productcategory WHERE szId = '$id' ")->result();
    }
    public function get_tipekategori_valid($post)
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
        $id = $post['inv'];
        return $this->db->query("SELECT * FROM $dept.dms_inv_productcategorytype WHERE szId = '$id' ")->result();
    }
    public function get_produk_valid($post)
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
        $id = $post['inv'];
        return $this->db->query("SELECT * FROM $dept.dms_inv_product WHERE szId = '$id' ")->result();
    }

    public function get_jenis_kendaraan()
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

        return $this->db->query("SELECT a.szName,b.szid FROM $dept.dms_inv_vehicletype as a 
                                            left join $base.dms_status_tipekendaraan as b on a.szId=b.szId
                                            where b.status = 1
                                            ")->result();
    }


    public function get_kendaraan_edit()
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

        return  $this->db->query("SELECT a.*,DATE(a.dtmVehicleLicense) AS tgl, b.*,c.depo_nama
										 FROM $dept.dms_inv_vehicle AS a 
										 LEFT JOIN $base.dms_status_kendaraan AS b ON a.szId=b.`szId`
										 left join $dept.dms_sm_branch as c on a.szBranchId=c.szId
										 WHERE b.status != 2 
										 ")->result();
    }
}
