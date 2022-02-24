<?php
class mLogin extends CI_Model
{
	function simpanData($data, $table)
	{
		$this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	function updateData($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function userLog($user)
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
		$query = $this->db->query("SELECT a.`userNo` FROM $base.`mdbaUserLog` a
		WHERE a.`userNIK` = '$user'
		ORDER BY a.`userLogin` DESC LIMIT 1");
		return $query->result();
	}

	function getBranch($lokasi)
	{
		if ($lokasi == 'Serang' || $lokasi == 'Balaraja' || $lokasi == 'Pandeglang') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
		$query = $this->db->query("SELECT a.`szId` FROM $base.`dms_sm_branch` a
		WHERE a.`szName` LIKE '%$lokasi%' AND a.`szId` <> '309' ");
		return $query->result();
	}

	function getUser($username, $password)
	{
		if ($username == 'adminBrj' || $username == 'adminSrg' || $username == 'adminPdg') {
			$base = 'mdbaasa';
		}
		else{
			$base = 'mdbatvip';
		}

		$query = $this->db->query("SELECT * FROM mdbaasa.`mdbauser` a
		WHERE a.`userNik` = '$username' AND a.`userPass` = '$password'");
		if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
	}
}

?>