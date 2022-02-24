<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mInventTbg extends CI_Model
{
    //transaksi
    function updateData($where, $data, $tabel)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $this->db->where($where);
        $this->db->update($tabel, $data);

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function simpanData($data, $tabel)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->insert($tabel, $data);

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    //counter
    function getId($id)
    {
        $query = $this->db->query("SELECT intLastCounter FROM mdba.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
    }

    function getCounter($countId)
    {
        $query = $this->db->query("SELECT intLastCounter FROM mdba.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
    }

    //master
    function getWarehouse($depo)
    {
        $query = $this->db->query("SELECT * FROM mdba.`dms_inv_warehouse` a
        WHERE a.`szBranchId` = '$depo'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}

?>