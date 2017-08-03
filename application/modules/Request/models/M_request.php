<?php
class M_request extends CI_Model {
    private $primary_id='list_id';
    private $duplicate1='list_inv_no';
    private $duplicate2='list_inv_no';
    private $table_name='tb_lists';
    private $table_order='list_item';
    private $site_id='';

    function __construct()
    {
        parent::__construct();
        $this->site_id='1';
    }

    function get_options_all($str='')
    {
		$sql =   "SELECT * FROM tb_options WHERE trash!=1 ".$str;
	    $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]=$row;
			}
		}
        return $data;
    }
	
	function get_options_item_lists($str='')
    {
		$sql = "SELECT DISTINCT ite.* FROM tb_lists AS lis
		INNER JOIN tb_options AS ite ON lis.list_item=ite.op_kode AND ite.op_tipe='Items'
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND bra.op_paren=lis.list_item ".$str;
	    $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]=$row;
			}
		}
        return $data;
    }

	function get_vendor_all($str='')
    {
		$sql =   "SELECT * FROM tb_vendor WHERE trash!=1 ".$str;
	    $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]=$row;
			}
		}
        return $data;
    }

	

	function get_data_invent_no($str='')
    {
		$sql  =	"SELECT lis.list_inv_no FROM tb_lists AS lis 
		INNER JOIN tb_purchases AS pur ON lis.list_po=pur.pur_number 
		INNER JOIN tb_options AS opt ON lis.list_item=opt.op_kode AND opt.op_tipe='Items' 
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND lis.list_item=bra.op_paren 
		LEFT JOIN tb_vendor AS ven ON ven.vendor_code=pur.pur_vendor_code   ";

		$sql.= "WHERE lis.trash<>'1' ".$str;
		$sql .= " ORDER BY pur.pur_date";

        $data=array();
		$i=0;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
			$data[] = $row;
        }
        return $data;
    }
	
	function get_data_excel($str='')
    {
		$sql  =	"SELECT lis.list_id, pur.pur_date, lis.list_name, lis.list_detail, 
		lis.list_po, lis.list_inv_no, lis.list_idr, lis.list_item,
		opt.op_titel AS item_name, lis.list_brand, bra.op_titel AS brand_name,
		ven.vendor_name, ven.vendor_phone, lis.list_user, 
	
			(SELECT loc.loca_name  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_name, 
			
			(SELECT loc.loca_province  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_province, 
			
			(SELECT loc.loca_country  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_country
			
			
		FROM tb_lists AS lis 
		INNER JOIN tb_purchases AS pur ON lis.list_po=pur.pur_number 
		INNER JOIN tb_options AS opt ON lis.list_item=opt.op_kode AND opt.op_tipe='Items' 
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND lis.list_item=bra.op_paren 
		LEFT JOIN tb_vendor AS ven ON ven.vendor_code=pur.pur_vendor_code ";

		$sql.= "WHERE lis.trash<>'1' ".$str;
		$sql .= " ORDER BY pur.pur_date ";

        $data=array();
		$result=$this->db->query($sql);
		$data[] = array(
				"NO.", "PO DATE", "PO NO.", "ITEM/BRAND", "VENDOR", "USER",
				"LOCATION", "INVENTORY NO."
			);
		$no=1;
        foreach($result->result() as $row)
        {
			$data[] = array(
				$no,
				date_format_id($row->pur_date,7),
				$row->list_po,
				$row->item_name.", ".$row->brand_name,
				$row->vendor_name.", ".$row->vendor_phone,
				$row->list_user,
				$row->loca_name.", ".$row->loca_province.", ".$row->loca_country,
				$row->list_inv_no
			
			);
			$no++;
        }
        return $data;
	

    }

	function get_data($str='', $offset=0, $limit='50', $key='')
    {
		$sql  =	"SELECT lis.list_id, pur.pur_date, lis.list_name, lis.list_detail, 
		lis.list_po, lis.list_inv_no, lis.list_idr, lis.list_item,
		opt.op_titel AS item_name, lis.list_brand, bra.op_titel AS brand_name,
		ven.vendor_name, ven.vendor_phone, lis.list_user, 
	
			(SELECT loc.loca_name  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_name, 
			
			(SELECT loc.loca_province  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_province, 
			
			(SELECT loc.loca_country  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_country
			
			
		FROM tb_lists AS lis 
		INNER JOIN tb_purchases AS pur ON lis.list_po=pur.pur_number 
		INNER JOIN tb_options AS opt ON lis.list_item=opt.op_kode AND opt.op_tipe='Items' 
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND lis.list_item=bra.op_paren 
		LEFT JOIN tb_vendor AS ven ON ven.vendor_code=pur.pur_vendor_code ";

		$sql.= "WHERE lis.trash<>'1' ".$str;
		if(!empty($key))
        {
            $sql.=" AND ";
            $key=trim($key);
            $arr_key=explode("+",$key);
            $count_key=(integer)count($arr_key);
            $i=1;
            foreach($arr_key as $value)
            {
                $sql.="CONCAT_WS(' ', lis.list_inv_no, lis.list_name, lis.list_detail) LIKE '%$value%' ";
                if($i<$count_key)
                {
                    $sql.="AND ";
                }
                $i++;
            }
        }

		$sql .= " ORDER BY pur.pur_date LIMIT $offset, $limit";

        $data=array();
		$i=0;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
			$data[] = array(
			"<input type='checkbox' class='checkbox' id='txt_check".$i."'  name='txt_check".$i."'>",
            "<i data-toggle class='fa fa-plus-square-o text-primary h5 m-none' style='cursor: pointer; width:18px;'></i>",
			date_format_id($row->pur_date,7),
			$row->list_po,
			number_format($row->list_idr, 0 , '' , '.' ),
			$row->item_name."<br/>".$row->brand_name,
			$row->vendor_name."<br/>".$row->vendor_phone,
			$row->list_user,
			$row->loca_name."<br/>".$row->loca_province.", ".$row->loca_country,
			$row->list_inv_no,
			""
            );
			$i++;
        }
        return $data;
    }

	function get_data_request($str='', $offset=0, $limit='50', $key='')
    {
		$sql  =	"SELECT lis.list_id, pur.pur_date, lis.list_name, lis.list_detail, 
		lis.list_po, lis.list_inv_no, lis.list_idr, lis.list_item,
		opt.op_titel AS item_name, lis.list_brand, bra.op_titel AS brand_name,
		ven.vendor_name, ven.vendor_phone, lis.list_user, 
	
			(SELECT loc.loca_name  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_name, 
			
			(SELECT loc.loca_province  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_province, 
			
			(SELECT loc.loca_country  
			FROM tb_handover AS han 
			INNER JOIN (SELECT DISTINCT loca_code, loca_name, loca_address, loca_district loca_province, loca_country FROM tb_locations WHERE 1) AS loc 
			ON han.hand_location=loc.loca_code  WHERE han.hand_list=lis.list_inv_no 
			ORDER BY han.hand_date DESC LIMIT 1) AS loca_country
			
			
		FROM tb_lists AS lis 
		INNER JOIN tb_purchases AS pur ON lis.list_po=pur.pur_number 
		INNER JOIN tb_options AS opt ON lis.list_item=opt.op_kode AND opt.op_tipe='Items' 
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND lis.list_item=bra.op_paren 
		LEFT JOIN tb_vendor AS ven ON ven.vendor_code=pur.pur_vendor_code ";

		$sql.= "WHERE lis.trash<>'1' AND lis.list_user='Storage' ".$str;

		$sql = "SELECT * FROM (".$sql.") T1 ";

		if(!empty($key))
        {
            $sql.="WHERE ";
            $key=trim($key);
            $arr_key=explode("+",$key);
            $count_key=(integer)count($arr_key);
            $i=1;
            foreach($arr_key as $value)
            {
                $sql.="CONCAT_WS(' ', T1.item_name, T1.brand_name, T1.list_user, T1.loca_name, T1.loca_province, T1.loca_country) LIKE '%$value%' ";
                if($i<$count_key)
                {
                    $sql.="AND ";
                }
                $i++;
            }
        }

		$sql .= " ORDER BY T1.pur_date LIMIT $offset, $limit";
		// die($sql);
        $data=array();
		$i=0;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
        	if (strtolower($row->list_user) == "storage"){
				$data[] = array(
					$row->item_name."<br/>".$row->brand_name,
					$row->list_user,
					$row->loca_name."<br/>".$row->loca_province.", ".$row->loca_country,
					"<a  href='".base_url()."Request/form/".$row->list_id."' class='btn btn-default btn-sm' title='Request'>Request</a>"
	            );
        	} else {
				$data[] = array(
					$row->item_name."<br/>".$row->brand_name,
					$row->list_user,
					$row->loca_name."<br/>".$row->loca_province.", ".$row->loca_country,
					""
	            );        		
        	}
			$i++;
        }
        return $data;
    }

	function get_data_count($str='', $key='')
    {
		$sql  =	"SELECT lis.list_inv_no FROM tb_lists AS lis 
		INNER JOIN tb_purchases AS pur ON lis.list_po=pur.pur_number 
		INNER JOIN tb_options AS opt ON lis.list_item=opt.op_kode AND opt.op_tipe='Items' 
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode AND lis.list_item=bra.op_paren 
		LEFT JOIN tb_vendor AS ven ON ven.vendor_code=pur.pur_vendor_code ";

		$sql.= "WHERE lis.trash<>'1' ".$str;
		if(!empty($key))
        {
            $sql.=" AND ";
            $key=trim($key);
            $arr_key=explode("+",$key);
            $count_key=(integer)count($arr_key);
            $i=1;
            foreach($arr_key as $value)
            {
                $sql.="CONCAT_WS(' ', lis.list_inv_no, lis.list_name, lis.list_detail) LIKE '%$value%' ";
                if($i<$count_key)
                {
                    $sql.="AND ";
                }
                $i++;
            }
        }

        $result=$this->db->query($sql);
        $data=$result->num_rows();
		return $data;
    }






























	function get_data_json_all($str='')
    {
		$sql = "SELECT * FROM ".$this->table_name."
		WHERE trash!='1' ".$str;

		$data=array();
		$i=1;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
            $data[] = array(
			$i,
            $row->item_code,
			$row->item_name,
			"By: ".$row->create_by.", on date: ".date_format_id($row->create_date,2),
			"<a  href='#modalForm' link-href='".base_url()."settings/items/edit/".$row->item_id."' class='modal-with-zoom-anim on-default link-edit' title='Edit Row'><i class='fa fa-pencil'></i></a>
			<a  href='#modalConfirm' link-href='".base_url()."settings/items/do_del/".$row->item_id."' class='modal-with-zoom-anim on-default link-del' data-del='".$row->item_name."'title='Delete Row'><i class='fa fa-trash-o'></i></a>"
			);
			$i++;
        }
        return $data;
    }

	public function get_data_duplicate_name($arg)
	{
        $sql="SELECT * FROM ".$this->table_name."
			WHERE ".$this->duplicate1."='".$arg."'  ";

        $data = array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();
        }
        return $data;
    }

	public function get_data_duplicate_code($arg)
	{
        $sql="SELECT * FROM ".$this->table_name."
			WHERE ".$this->duplicate2."='".$arg."'  ";

        $data = array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();
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

    function getItemAsOption($condition="")
    {
    	$sql 	= "SELECT * FROM tb_items ";
    	if ($condition != "") $sql .= " WHERE $condition ";

		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['item_name']."'>".$value['item_name']."</option>";
		}
		
		return $option_item;
    }


























	public function get_data_single($str=''){
        $sql="SELECT * FROM ".$this->table_name."
		WHERE site_id='".$this->site_id."'  ".$str;

        $data = "";
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row()->pkm_titel;
        }
        return $data;
    }

	function get_data_all($str='')
    {
		$sql =   "SELECT * FROM ".$this->table_name." ";
	    $prov = $this->m_daerah->get_daerah_kode($_SESSION['us_wilayah'], "Provinsi");
		if($_SESSION['us_level_instansi']=="Root"){
			$sql.=" WHERE site_id='".$this->site_id."' ".$str;
		}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Implementor"){
			$sql.=" WHERE site_id='".$this->site_id."' ".$str;
		}else if($_SESSION['us_level']=="Administrator" || $_SESSION['us_level']=="Editor"){
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Instansi"){
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}else{
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}

        $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]=$row;
			}
		}
        return $data;
    }





	function get_data_fasyankes_group($str='')
    {
		$sql =   "SELECT DISTINCT dae.daerah_paren FROM tb_epi_pkm AS pkm
				LEFT JOIN tb_daerah AS dae ON pkm.pkm_wilayah=dae.daerah_kode ";
				$prov = $this->m_daerah->get_daerah_kode($_SESSION['us_wilayah'], "Provinsi");
			if($_SESSION['us_level_instansi']=="Root"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' ".$str;
			}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Implementor"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' ".$str;
			}else if($_SESSION['us_level']=="Administrator" || $_SESSION['us_level']=="Editor"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Instansi"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}else{
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}

        $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]= array(
					'daerah_paren'	       	=>$row->daerah_paren,
					'daerah_titel'	       	=>$this->m_daerah->get_daerah_titel($row->daerah_paren),
					'pkm'	       	=>$this->get_data_all(" AND pkm_wilayah LIKE '".$row->daerah_paren.".%' ")
				);
			}
		}
        return $data;
    }

    function getSendEmailData($id){
		$sql 	= "	SELECT 	T1.*,date(T1.create_date) dateCreate,
							T2.username submittoUsername, T3.username submitfromUsername
 					FROM 	tb_mini_proposal T1 
 							LEFT JOIN tb_userapp T2 ON T2.email=T1.submitto
 							LEFT JOIN tb_userapp T3 ON T3.email=T1.submitfrom
					WHERE 	1=1 AND T1.id='".$id."'";
		
		return $this->db->query($sql)->row();
    }

}

?>
