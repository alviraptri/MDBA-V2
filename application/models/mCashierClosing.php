<?php
class mCashierClosing extends CI_Model
{
    public function getLastClosing(){
      if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
        $base = 'mdbaasa';
    }
    else{
        $base = 'mdbatvip';
    }
        $query = $this->db->query("SELECT dtmLastClosing from $base.dms_gen_closing WHERE szClosingType = 'CAS' AND szBranchId = '$_SESSION[szBranchId]'");
        foreach ($query->result() as $a){
          $temp = ($a->dtmLastClosing);
        }
        return $temp;
      }

      public function getNomorClosingOri(){
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
          $base = 'mdbaasa';
      }
      else{
          $base = 'mdbatvip';
      }
          $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'CLOSING".$depo."COU'");
        foreach ($query->result() as $a){
          $temp = ($a->intLastCounter+1);
        }
        return $temp;
      }

      public function getNomorClosing(){
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
          $base = 'mdbaasa';
      }
      else{
          $base = 'mdbatvip';
      }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'CLOSING".$depo."COU'");
        foreach ($query->result() as $a){
          $temp = ($a->intLastCounter+1);
          $auto_num = sprintf("%07s", $temp);
        }
        return $_SESSION['szBranchId'].'-'.$auto_num;
      }

      public function getDataCashOutForClosing($tanggalNol){
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
          $base = 'mdbaasa';
      }
      else{
          $base = 'mdbatvip';
      }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT
        b.iId AS Voucher_Code
        , a.szDocId AS Id_VB
        , (CASE WHEN a.szbranchid='991' THEN '003' ELSE '002' END) AS ID_Depo
        , a.szAccountId AS Id_Tipe_Saldo
        , DATE(a.dtmDoc) AS TGL_VB
        , a.szEmployeeId AS UNTUK
        , '' AS KEBUTUHAN
        , C.total AS TOTAL
        , b.intItemNumber + 1 AS ID_VB_Item
        , CONCAT (b.szSubAccountId, '-', b.szAccountId) AS Tipe_Transaksi
        , b.decAmount AS Nilai
        , b.szDescription AS Notes
        FROM
            $base.dms_cas_docCashOut AS A
        LEFT JOIN 
            $base.dms_cas_docCashOutItem AS B ON B.szDocId = a.szDocId
        INNER JOIN 
            (SELECT szDocId,SUM(decAmount) AS Total FROM $base.dms_cas_docCashOutItem GROUP BY szDocId) AS C
        ON a.szDocId=c.szDocId
        WHERE a.dtmDoc = '$tanggalNol' AND szBranchId = '$depo'
        ");
        return $query->result();
      }

      public function getDataCashInForClosing($tanggalNol){
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
          $base = 'mdbaasa';
      }
      else{
          $base = 'mdbatvip';
      }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT
        b.iId AS Voucher_Code
        , a.szDocId AS Id_VT
        , (CASE WHEN a.szbranchid='991' THEN '003' ELSE '002' END) AS ID_Depo
        , a.szAccountId AS Id_Tipe_Saldo
        , dtmDoc AS TGL_VT
        , a.szEmployeeId AS DARI
        , '' AS KEBUTUHAN
        , C.total AS TOTAL_VT
        , CONCAT (b.szSubAccountId, '-', b.szAccountId) AS Tipe_Transaksi
        , b.decAmount AS Nilai_VT
        , b.szDescription AS Notes
        , b.intItemNumber+1 AS ID_VT_Item
        FROM
            ($base.dms_cas_docCashIn AS A
        LEFT JOIN 
            $base.dms_cas_docCashInItem AS B ON B.szDocId = a.szDocId
        INNER JOIN 
            (SELECT szDocId,SUM(decAmount) AS Total FROM $base.dms_cas_docCashInItem  GROUP BY szDocId) AS C
        ON A.szDocId=C.szDocId)
        WHERE a.dtmDoc = '$tanggalNol' AND szBranchId = '$depo'
        ");
        return $query->result();
      }
}
