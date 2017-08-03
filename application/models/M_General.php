<?php
class M_General extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getGFAS($project_id){        
        $sql    = "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
        $result = $this->db->query($sql)->row_array()['gfas'];

        return $result;
    }

	function get_purchase_number(){		
		$year 	= date("Y");
		$month 	= date("m");
		$sql = "SELECT number FROM tb_purchase_header WHERE 1=1 AND YEAR(create_date)='$year' AND MONTH(create_date)='$month' ORDER BY number DESC ";
		$result = $this->db->query($sql);		
		$data = "001";
		if($result->num_rows() > 0)
		{
			$data = $result->row_array()['number'];
			$data = intval($data); 
			$data = $data+1;
			
			if ($data < 10){
				$data = "00".$data;
			} else if ($data < 99){
				$data = "0".$data;
			}
		}
		return $data;
	}

	function getItems($category, $format=''){

		$sql 	= "SELECT * FROM tb_items WHERE item_category='$category' ORDER BY item_name";
		$result = $this->db->query($sql)->result_array();	

		if ($format == "option") {
			$option_item = "";
			foreach ($result as $key => $value) {
				$option_item .= "<option value='".$value['item_name']."'>".$value['item_name']."</option>";
			}

			return $option_item;
		} else {
			return $result;
		}

	}

}

?>
