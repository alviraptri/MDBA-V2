<?php
class auto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mAuto');
    }

    function autoTransfer()
    {
        $gun = $this->mAuto->getStaggingData();
        $idGun = '';
        if (count($gun) != 0) {
            foreach ($gun as $value) {
                $idGun .= "'".$value->staggingId."',";
            } 
            $lenGun = strlen($idGun);
            $gunId = substr($idGun, 0, $lenGun-1);
        }
        else{
            $gunId = 0;
        }
        
        $dataGunnebo = $this->mAuto->getGunneboData($gunId);
        if ($dataGunnebo == 0) {
            echo "No Data";
        }
        else{
            foreach ($dataGunnebo as $value) {
                $resData = array(
                    'staggingId' => $value->id, 
                    'driverNik' => $value->nik,
                    'driverMesinId' => $value->operator,
                    'staggingDate' => $value->when_,
                    'staggingTx' => $value->txid,
                    'staggingAmount' => $value->amount,
                    'staggingLoc' => $value->idLoc,
                    'staggingStatus' => '0'
                );
                // echo "Kasir : <pre>".var_export($dataGunnebo, true)."</pre><br>";
                $this->mAuto->simpanData($resData, 'mdba.mdbaautostagging');
            }
        }
    }
}

?>