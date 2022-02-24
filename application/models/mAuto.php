<?php
class mAuto extends CI_Model
{
	function simpanData($result, $table)
	{
		$this->db->insert($table, $result);
	}

    function getStaggingData()
	{
		$query = $this->db->query("SELECT * FROM mdba.`mdbaautostagging` a WHERE a.`staggingDate` >= CURDATE() AND a.`staggingDate` < CURDATE() + INTERVAL 1 DAY ORDER BY a.`staggingTx` ASC");
		return $query->result();
	}

    function getGunneboData($id_unik3)
	{
        $this->db2 = $this->load->database('kasir', true);
		if ($id_unik3 != '') {
			$query = $this->db2->query("SELECT right(e.data_, 10) as nik, c.posid_ AS operator, b.name_ AS location, a.sploc_ AS idLoc,a.when_, a.external_id AS txid, a.value_ AS amount, concat(b.name_, c.posid_, a.sploc_,a.external_id) as id
				FROM gunnebo.dbo.sp_cash_flow_log a
				LEFT JOIN gunnebo.dbo.sp_location b ON a.sploc_ = b.sploc_
				LEFT JOIN gunnebo.dbo.sp_pos_oper c ON a.oper_ = c.oper_
				LEFT JOIN gunnebo.dbo.sp_cash_flow_custom d ON d.key_='Txid' and a.sploc_ = d.sploc_ and d.value_=a.external_id AND d.when_ = a.when_
				LEFT JOIN GUNNEBO.dbo.sp_exception_log e on e.sploc_ = a.sploc_ and e.when_ = a.when_ and e.oper_ = a.oper_ and e.data_ like '%remark%'
				WHERE a.when_ >= CAST(GETDATE() - 1 AS DATE) AND a.when_ < CAST(GETDATE() + 1 AS DATE) AND a.value_ <> 0 AND concat(b.name_, c.posid_, a.sploc_,a.external_id) NOT IN (".$id_unik3.") ORDER BY a.when_ ASC");
			if ($query->num_rows() > 0) {
				return $query->result();
			}
			else{
				return 0;
			}
		}
		else{
			$query = $this->db2->query("SELECT right(e.data_, 10) as nik, c.posid_ AS operator, b.name_ AS location, a.sploc_ AS idLoc, a.when_, a.external_id AS txid, a.value_ AS amount, concat(b.name_, c.posid_, a.sploc_,a.external_id) as id
			FROM gunnebo.dbo.sp_cash_flow_log a
			LEFT JOIN gunnebo.dbo.sp_location b ON a.sploc_ = b.sploc_
			LEFT JOIN gunnebo.dbo.sp_pos_oper c ON a.oper_ = c.oper_
			LEFT JOIN gunnebo.dbo.sp_cash_flow_custom d ON d.key_='Txid' and a.sploc_ = d.sploc_ and d.value_=a.external_id AND d.when_ = a.when_
			LEFT JOIN GUNNEBO.dbo.sp_exception_log e on e.sploc_ = a.sploc_ and e.when_ = a.when_ and e.oper_ = a.oper_ and e.data_ like '%remark%'
			WHERE a.when_ >= CAST(GETDATE() - 1 AS DATE) AND a.when_ < CAST(GETDATE() + 1 AS DATE) AND a.value_ <> 0 ORDER BY a.when_ ASC");
			if ($query->num_rows() > 0) {
				return $query->result();
			}
			else{
				return 0;
			}
		}
        $this->db2->close();
	}
}

?>