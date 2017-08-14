<?php
class M_memo extends CI_Model {
    
    private $primary_id='vendor_id';
    private $duplicate1='vendor_code';
    private $duplicate2='vendor_name';
    private $table_order='vendor_name';
    private $table_name='tb_vendor';
    private $site_id='';

    function __construct()
    {
        parent::__construct();
        $this->site_id='1';
    }

	function get_data_json_all($str='')
    {
        $sql = "SELECT T1.purchase_number, T4.vendor_code, T2.vendor_name, T4.vendor_address, T4.vendor_email, T1.create_by, T1.create_date, T1.attachment
                from tb_selection T1 inner join tb_quotation_respon T2 on T1.quotation_respon_id=T2.id
                inner join tb_quotation_recipient T3 ON T3.id=T2.id_quotation_recipient
                left join tb_vendor T4 on T4.vendor_email=T3.email";

		$data=array();
		$i=1;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
            $data[] = array(
			$i,
            $row->purchase_number,
            $row->vendor_code,
            $row->vendor_name,
			$row->vendor_address."<br>".$row->vendor_email,
            "<a href='".base_url()."documents/memo/".$row->attachment."' target='_blank'>Memo</a>",
			"By: ".$row->create_by.", on date: ".date_format_id($row->create_date,2),
			"<a href='".base_url('Po')."' class='btn btn-success' title='PO'>Process</a>"
			);
			$i++;
        }
        return $data;
    }

	function get_data_update($id)
    {
        $data=array();
        $sql = "SELECT * FROM ".$this->table_name."
		WHERE trash!='1'
        AND  ".$this->primary_id."='$id'";

        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();

        }
        return $data;
    }
    
}

?>
