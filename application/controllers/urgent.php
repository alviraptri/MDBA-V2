//UPDATE INI SALAH//
function bkbUpdate()
{
if ($this->input->post('gudang') == '' || $this->input->post('gudang') == '-' || $this->input->post('stok') == '' || $this->input->post('stok') == '-' || $this->input->post('pengemudi') == '' || $this->input->post('pengemudi') == '-' || $this->input->post('kendaraan') == '' || $this->input->post('kendaraan') == '-') {
$this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
exit;
} else {
$array_new = array_count_values($this->input->post('produk'));
$array2 = array();
foreach ($array_new as $key => $val) {
if ($val > 1) { //or do $val >2 based on your desire
$array2[] = $key;
}
}

if (count($array2) != '0') {
$this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
exit;
} else {
$depo = $this->session->userdata('user_branch');
if ($depo == '321' || $depo == '336' || $depo == '324') {
$dept = 'ASA';
$base = 'dummymdbaasa';
} else {
$dept = 'TVIP';
$base = 'dummymdbatvip';
}

// BKB ADJUSTMENT MINUS (LAWAN YANG BENER)
$id = 'BKBDIST' . $depo . 'COU';
$bkbCancel = $this->mInventDist->getId($id);
// update counter
$counter = $this->mInventDist->getCounter($id);
$updateCount = array(
'intLastCounter' => $counter,
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$whereCount = array('szId' => $id);
$counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
// $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

$bkbData = $this->mInventDist->editBkb($this->input->post('bkbOld'));
foreach ($bkbData as $value) {
$warehouseId = $value->szWarehouseId;
$tipeId = $value->szStockType;
$vehicleId = $value->szVehicleId;
$driverId = $value->szEmployeeId;
$deskripsi = $value->szDescription;
$pb = $value->refOld;
$tanggal = $value->dtmDoc;
}

$headerCancel = array(
'iId' => $this->uuid->v4(),
'szDocId' => $bkbCancel,
'dtmDoc' => $tanggal,
'szEmployeeId' => $driverId,
'szWarehouseId' => $warehouseId,
'szStockType' => $tipeId,
'szDocPRId' => $pb,
'intPrintedCount' => 1,
'szBranchId' => $depo,
'szCompanyId' => $dept,
'szDocStatus' => 'Applied',
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s'),
'szDescription' => $deskripsi . '/' . $this->input->post('keterangan'),
'szVehicleId' => $vehicleId
);
// echo "
<pre> TEST: " . var_export($headerCancel, true) . "</pre>";
$cancelHeader = $this->mInventDist->simpanData($headerCancel, $base . '.dms_inv_docstockoutdistribution');
// $cancelHeaderDms = $this->mInventDist->simpanDms($headerCancel, 'dms.dms_inv_docstockoutdistribution');

$no = 0;
$prodCancel = '';
foreach ($bkbData as $value) {
$detailCancel = array(
'iId' => $this->uuid->v4(),
'szDocId' => $bkbCancel,
'intItemNumber' => $no,
'szProductId' => $value->szProductId,
'decQty' => -(int)$value->decQty,
'szUomId' => $value->szUomId,
);
// echo "
<pre> DETAIL CANCEL : " . var_export($detailCancel, true) . "</pre>";
$cancelDetail = $this->mInventDist->simpanData($detailCancel, $base . '.dms_inv_docstockoutdistributionitem');
// $cancelDetailDms = $this->mInventDist->simpanDms($detailCancel, 'dms.dms_inv_docstockoutdistributionitem');

$historyCancelGdg = array(
'iId' => $this->uuid->v4(),
'szProductId' => $value->szProductId,
'szLocationType' => 'WAREHOUSE',
'szLocationId' => $value->szWarehouseId,
'szStockTypeId' => $value->szStockType,
'szReportedAsId' => $this->session->userdata('user_branch'),
'decQtyOnHand' => (int)$value->decQty,
'szUomId' => $value->szUomId,
'dtmTransaction' => $value->dtmDoc,
'szTrnId' => 'DMSDocStockOutDistribution',
'szDocId' => $bkbCancel,
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
// echo "
<pre> TEST: " . var_export($historyCancelGdg, true) . "</pre>";
$cancelHistoryGdg = $this->mInventDist->simpanData($historyCancelGdg, $base . '.dms_inv_stockhistory');
// $cancelHistoryGdgDms = $this->mInventDist->simpanDms($historyCancelGdg, 'dms.dms_inv_stockhistory');

$historyCancelEmp = array(
'iId' => $this->uuid->v4(),
'szProductId' => $value->szProductId,
'szLocationType' => 'EMPLOYEE',
'szLocationId' => $value->szEmployeeId,
'szStockTypeId' => 'IN TRANSIT',
'szReportedAsId' => $this->session->userdata('user_branch'),
'decQtyOnHand' => -(int)$value->decQty,
'szUomId' => $value->szUomId,
'dtmTransaction' => $value->dtmDoc,
'szTrnId' => 'DMSDocStockOutDistribution',
'szDocId' => $bkbCancel,
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
// echo "
<pre> TEST: " . var_export($historyCancelEmp, true) . "</pre>";
$cancelHistoryEmp = $this->mInventDist->simpanData($historyCancelEmp, $base . '.dms_inv_stockhistory');
// $cancelHistoryEmpDms = $this->mInventDist->simpanDms($historyCancelEmp, 'dms.dms_inv_stockhistory');

$prodCancel .= "'" . $value->szProductId . "',";
$no++;
}
$cekProdCancel = strlen($prodCancel);
$cancelProd = substr($prodCancel, 0, $cekProdCancel - 1);

$cancelOnHandG = $this->mInventDist->stockOnHand($cancelProd, $warehouseId, $tipeId);
// echo "
<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
if ($cancelOnHandG != '0') {
foreach ($cancelOnHandG as $value) {
foreach ($bkbData as $row) {
if ($value->szProductId == $row->szProductId) {
$cancelUpdOnHandG = array(
'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$row->decQty,
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$cancelWhereOnHandG = array(
'szProductId' => $row->szProductId,
'szStockTypeId' => $row->szStockType,
'szReportedAsId' => $this->session->userdata('user_branch'),
'szLocationId' => $row->szWarehouseId
);
}
}
// echo "
<pre> updOnHandG: ".var_export($cancelUpdOnHandG, true)."</pre>";
// echo "
<pre> whereOnHandG:".var_export($cancelWhereOnHandG, true)."</pre>";
$cancelOnHandUpdateG = $this->mInventDist->updateData($cancelWhereOnHandG, $cancelUpdOnHandG, $base . '.dms_inv_stockonhand');
// $cancelOnHandUpdateGDms = $this->mInventDist->updateDms($cancelWhereOnHandG, $cancelUpdOnHandG, 'dms.dms_inv_stockonhand');
}
} else {
foreach ($bkbData as $row) {
$cancelOnHandGInsert = array(
'iId' => $this->uuid->v4(),
'szProductId' => $row->szProductId,
'szLocationType' => 'WAREHOUSE',
'szLocationId' => $row->szWarehouseId,
'szStockTypeId' => $row->szStockType,
'szReportedAsId' => $this->session->userdata('user_branch'),
'decQtyOnHand' => '0',
'szUomId' => $row->szUomId,
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$cancelInsertOnHandG = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
}
}

$cancelOnHandE = $this->mInventDist->stockOnHand($cancelProd, $driverId, 'IN TRANSIT');
// echo "
<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
if ($cancelOnHandE != '0') {
foreach ($cancelOnHandE as $value) {
foreach ($bkbData as $row) {
if ($value->szProductId == $row->szProductId) {
$cancelUpdOnHandE = array(
'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$row->decQty,
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$cancelWhereOnHandE = array(
'szProductId' => $row->szProductId,
'szStockTypeId' => 'IN TRANSIT',
'szReportedAsId' => $this->session->userdata('user_branch'),
'szLocationId' => $row->szEmployeeId
);
}
}
// echo "
<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
// echo "
<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
$cancelOnHandUpdateE = $this->mInventDist->updateData($cancelWhereOnHandE, $cancelUpdOnHandE, $base . '.dms_inv_stockonhand');
// $cancelOnHandUpdateEDms = $this->mInventDist->updateDms($cancelWhereOnHandE, $cancelUpdOnHandE, 'dms.dms_inv_stockonhand');
}
} else {
foreach ($bkbData as $row) {
$cancelOnHandEInsert = array(
'iId' => $this->uuid->v4(),
'szProductId' => $row->szProductId,
'szLocationType' => 'EMPLOYEE',
'szLocationId' => $row->szEmployeeId,
'szStockTypeId' => 'IN TRANSIT',
'szReportedAsId' => $this->session->userdata('user_branch'),
'decQtyOnHand' => '0',
'szUomId' => $row->szUomId,
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$cancelInsertOnHandE = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
}
}

// ADJUSTMENT
$idAdj = 'ADJ' . $depo . 'COU';
$adjNo = $this->mInventDist->getId($idAdj);
// update counter
$counterAdj = $this->mInventDist->getCounter($idAdj);
$updateCountAdj = array(
'intLastCounter' => $counterAdj,
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$whereCountAdj = array('szId' => $idAdj);
// $counterAdjUpdate = $this->mInventDist->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');
// $counterAdjUpdateDms = $this->mInventDist->updateDms($whereCountAdj, $updateCountAdj, 'dms.dms_sm_counter');

$adjustmentRefDocument = array(
'iId' => $this->uuid->v4(),
'szDocId' => $adjNo,
'szRefDocId' => $this->input->post('bkbOld'),
'szRefDocTypeId' => 'DMSDocStockOutDistribution',
'szAdjustmentId' => $bkbCancel
);
// echo "
<pre> OnHandG: " . var_export($adjRefDoc, true) . "</pre>";
$adjustmentRefDoc = $this->mInventDist->simpanDms($adjustmentRefDocument, 'dmstesting.dms_inv_stockadjustmentrefdoc');
// $adjustmentRefDocDms = $this->mInventDist->simpanDms($adjRefDoc, 'dmstesting.dms_inv_stockadjustmentrefdoc');

$adjustHeader = array(
'iId' => $this->uuid->v4(),
'szDocId' => $adjNo,
'dtmDoc' => $tanggal,
'szRefTypeDoc' => 'DMSDocStockOutDistribution',
'szRefDocId' => $this->input->post('bkbOld'),
'szDescription' => $deskripsi . '/' . $this->input->post('keterangan'),
'intPrintedCount' => '0',
'szBranchId' => $depo,
'szCompanyId' => $dept,
'szDocStatus' => 'Applied',
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$headerAdj = $this->mInventDist->simpanData($adjustHeader, $base . '.dms_inv_docstockadjustment');
// $headerAdjDms = $this->mInventDist->simpanDms($adjustHeader, 'dms.dms_inv_docstockadjustment');

$int = 0;
foreach ($bkbData as $value) {
$adjustDetail = array(
'iId' => $this->uuid->v4(),
'szDocId' => $adjNo,
'intItemNumber' => $int,
'szProductId' => $value->szProductId,
'decQty' => $value->decQty,
'szUomId' => $value->szUomId
);
$detailAdj = $this->mInventDist->simpanData($adjustDetail, $base . '.dms_inv_docstockadjustmentitem');
// $detailAdjDms = $this->mInventDist->simpanDms($adjustDetail, 'dms.dms_inv_docstockadjustmentitem');

$int++;
}

//NEW BKB
$idNew = 'BKBDIST' . $depo . 'COU';
$bkbNew = $this->mInventDist->getId($idNew);
// update counter
$counterNew = $this->mInventDist->getCounter($idNew);
$updateCountNew = array(
'intLastCounter' => $counterNew,
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmLastUpdated' => date('Y-m-d H:i:s')
);
$whereCountNew = array('szId' => $id);
$counterNewUpdate = $this->mInventDist->updateData($whereCountNew, $updateCountNew, $base . '.dms_sm_counter');
// $counterNewUpdateDms = $this->mInventDist->updateDms($whereCountNew, $updateCountNew, 'dms.dms_sm_counter');

$refDocBkb = array(
'refId' => $bkbNew,
'refOld' => $this->input->post('pbNo'),
'refTanggal' => date('Y-m-d'),
'refDepo' => $this->session->userdata('user_branch'),
'refDocType' => 'DMSDocStockOutDistribution',
'refUserAdd' => $this->session->userdata('user_nik'),
'refUserUpdate' => $this->session->userdata('user_nik'),
'refDateAdd' => date('Y-m-d H:i:s'),
'refDateUpdate' => date('Y-m-d H:i:s')
);
// echo "
<pre> TEST: " . var_export($refDocBkb, true) . "</pre>";
$bkbRefDoc = $this->mInventDist->simpanData($refDocBkb, $base . '.mdbaRefDoc');

$headerNew = array(
'iId' => $this->uuid->v4(),
'szDocId' => $bkbNew,
'dtmDoc' => $this->input->post('tgl'),
'szEmployeeId' => $this->input->post('pengemudi'),
'szWarehouseId' => $this->input->post('gudang'),
'szStockType' => $this->input->post('stok'),
'szDocPRId' => $pb,
'intPrintedCount' => 1,
'szBranchId' => $depo,
'szCompanyId' => $dept,
'szDocStatus' => 'Applied',
'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
'dtmCreated' => date('Y-m-d H:i:s'),
'dtmLastUpdated' => date('Y-m-d H:i:s'),
'szDescription' => $this->input->post('keterangan'),
'szVehicleId' => $this->input->post('kendaraan')
);
// echo "
<pre> TEST: " . var_export($headerNew, true) . "</pre>";
$newHeader = $this->mInventDist->simpanData($headerNew, $base . '.dms_inv_docstockoutdistribution');
// $newHeaderDms = $this->mInventDist->simpanDms($headerNew, 'dms.dms_inv_docstockoutdistribution');

// echo count($this->input->post('num'));
$prodNew = '';
$namaProduk = $this->input->post('produk');
for ($i = 0; $i < count($this->input->post('num')); $i++) {
    foreach ($namaProduk as $index => $produk) {
    if (isset($i)) {
    $detailNew = array(
    'iId' => $this->uuid->v4(),
    'szDocId' => $bkbNew,
    'intItemNumber' => $i,
    'szProductId' => $this->input->post('produk')[$i],
    'decQty' => (int)$this->input->post('qty')[$i],
    'szUomId' => $this->input->post('satuan')[$i],
    );

    $historyNewGdg = array(
    'iId' => $this->uuid->v4(),
    'szProductId' => $this->input->post('produk')[$i],
    'szLocationType' => 'WAREHOUSE',
    'szLocationId' => $this->input->post('gudang'),
    'szStockTypeId' => $this->input->post('stok'),
    'szReportedAsId' => $this->session->userdata('user_branch'),
    'decQtyOnHand' => -(int)$this->input->post('qty')[$i],
    'szUomId' => $this->input->post('satuan')[$i],
    'dtmTransaction' => $this->input->post('tgl'),
    'szTrnId' => 'DMSDocStockOutDistribution',
    'szDocId' => $bkbNew,
    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
    'dtmCreated' => date('Y-m-d H:i:s'),
    'dtmLastUpdated' => date('Y-m-d H:i:s')
    );

    $historyNewEmp = array(
    'iId' => $this->uuid->v4(),
    'szProductId' => $this->input->post('produk')[$i],
    'szLocationType' => 'EMPLOYEE',
    'szLocationId' => $this->input->post('pengemudi'),
    'szStockTypeId' => 'IN TRANSIT',
    'szReportedAsId' => $this->session->userdata('user_branch'),
    'decQtyOnHand' => (int)$this->input->post('qty')[$i],
    'szUomId' => $this->input->post('satuan')[$i],
    'dtmTransaction' => $this->input->post('tgl'),
    'szTrnId' => 'DMSDocStockOutDistribution',
    'szDocId' => $bkbNew,
    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
    'dtmCreated' => date('Y-m-d H:i:s'),
    'dtmLastUpdated' => date('Y-m-d H:i:s')
    );

    $prodNew .= "'" . $this->input->post('produk')[$index] . "',";
    } else {
    continue;
    }
    }
    // echo "
    <pre> DETAIL NEW : " . var_export($detailNew, true) . "</pre>";
    $newDetail = $this->mInventDist->simpanData($detailNew, $base . '.dms_inv_docstockoutdistributionitem');
    // $newDetailDms = $this->mInventDist->simpanDms($detailNew, 'dms.dms_inv_docstockoutdistributionitem');
    // echo "
    <pre> TEST " . $i . ":" . var_export($historyNewGdg, true) . "</pre>";
    $newHistoryGdg = $this->mInventDist->simpanData($historyNewGdg, $base . '.dms_inv_stockhistory');
    // $newHistoryGdgDms = $this->mInventDist->simpanDms($historyNewGdg, 'dms.dms_inv_stockhistory');
    // echo "
    <pre> TEST: " . var_export($historyNewEmp, true) . "</pre>";
    $newHistoryEmp = $this->mInventDist->simpanData($historyNewEmp, $base . '.dms_inv_stockhistory');
    // $newHistoryEmpDms = $this->mInventDist->simpanDms($historyNewEmp, 'dms.dms_inv_stockhistory');
    }
    $cekProdNew = strlen($prodNew);
    $newProd = substr($prodNew, 0, $cekProdNew - 1);

    $newOnHandG = $this->mInventDist->stockOnHand($newProd, $this->input->post('gudang'), $this->input->post('stok'));
    // echo "
    <pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
    if ($newOnHandG != '0') {
    foreach ($newOnHandG as $value) {
    for ($i = 0; $i < count($this->input->post('num')); $i++) {
        foreach ($namaProduk as $index => $produk) {
        if ($value->szProductId == $produk) {
        $newUpdOnHandG = array(
        'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
        'dtmLastUpdated' => date('Y-m-d H:i:s')
        );
        $newWhereOnHandG = array(
        'szProductId' => $this->input->post('produk')[$i],
        'szStockTypeId' => $this->input->post('stok'),
        'szReportedAsId' => $this->session->userdata('user_branch'),
        'szLocationId' => $this->input->post('gudang')
        );
        }
        }
        }
        // echo "
        <pre> updOnHandG: " . var_export($newUpdOnHandG, true) . "</pre>";
        // echo "
        <pre> whereOnHandG:" . var_export($newWhereOnHandG, true) . "</pre>";
        $newOnHandUpdateG = $this->mInventDist->updateData($newWhereOnHandG, $newUpdOnHandG, $base . '.dms_inv_stockonhand');
        // $newOnHandUpdateGDms = $this->mInventDist->updateDms($newWhereOnHandG, $newUpdOnHandG, 'dms.dms_inv_stockonhand');
        }
        } else {
        for ($i = 0; $i < count($this->input->post('num')); $i++) {
            foreach ($namaProduk as $index => $produk) {
            $newOnHandGInsert = array(
            'iId' => $this->uuid->v4(),
            'szProductId' => $this->input->post('produk')[$i],
            'szLocationType' => 'WAREHOUSE',
            'szLocationId' => $this->input->post('gudang'),
            'szStockTypeId' => $this->input->post('stok'),
            'szReportedAsId' => $this->session->userdata('user_branch'),
            'decQtyOnHand' => '0',
            'szUomId' => $this->input->post('satuan')[$i],
            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            }
            $newInsertOnHandG = $this->mInventDist->simpanData($newOnHandGInsert, $base . '.dms_inv_stockonhand');
            }
            }

            $newOnHandE = $this->mInventDist->stockOnHand($newProd, $this->input->post('pengemudi'), 'IN TRANSIT');
            // echo "
            <pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            if ($newOnHandE != '0') {
            foreach ($newOnHandE as $value) {
            for ($i = 0; $i < count($this->input->post('num')); $i++) {
                foreach ($namaProduk as $index => $produk) {
                if ($value->szProductId == $produk) {
                $newUpdOnHandE = array(
                'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                $newWhereOnHandE = array(
                'szProductId' => $this->input->post('produk')[$i],
                'szStockTypeId' => 'IN TRANSIT',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'szLocationId' => $this->input->post('pengemudi')
                );
                }
                }
                }
                // echo "
                <pre> updOnHandG: " . var_export($newUpdOnHandE, true) . "</pre>";
                // echo "
                <pre> whereOnHandG:" . var_export($newWhereOnHandE, true) . "</pre>";
                $newOnHandUpdateE = $this->mInventDist->updateData($newWhereOnHandE, $newUpdOnHandE, $base . '.dms_inv_stockonhand');
                // $newOnHandUpdateEDms = $this->mInventDist->updateDms($newWhereOnHandE, $newUpdOnHandE, 'dms.dms_inv_stockonhand');
                }
                } else {
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    foreach ($namaProduk as $index => $produk) {
                    $newOnHandEInsert = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $this->input->post('produk')[$i],
                    'szLocationType' => 'EMPLOYEE',
                    'szLocationId' => $this->input->post('pengemudi'),
                    'szStockTypeId' => 'IN TRANSIT',
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => $this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    }
                    $newInsertOnHandE = $this->mInventDist->simpanData($newOnHandGInsert, $base . '.dms_inv_stockonhand');
                    }
                    }

                    if ($cancelHeader == 'true' && $cancelDetail == 'true' && $cancelHistoryGdg == 'true' && $cancelHistoryEmp == 'true' && $adjustmentRefDoc == 'true' && $headerAdj == 'true' && $detailAdj == 'true' && $bkbRefDoc == 'true' && $newHeader == 'true' && $newDetail == 'true' && $newHistoryGdg == 'true' && $newHistoryEmp == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventDist/historyBkb'));
                    exit;
                    } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
                    exit;
                    }
                    }
                    }
                    }