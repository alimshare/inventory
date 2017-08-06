<?php ob_start(); if (!defined('BASEPATH')) die();
class Inventories extends CI_Controller {
	private $limit=40;
	private $site_id="";
	private $menu_titel='Inventories';


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$this->load->model('M_inventories');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']= $this->menu_titel;
		$data['page_titel']="Inventory Input Form";
		$data['smenu_titel']='Inventory Input Form';
		$data['authen'] = $this->authenty->sess();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_inventories_input.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function lists()
	{
		$data['menu_titel']= $this->menu_titel;
		$data['page_titel']="Inventory Lists";
		$data['smenu_titel']='Inventory Lists';
		$data['authen'] = $this->authenty->sess();
		
		$data['list_items'] = $this->M_inventories->get_options_item_lists();
		
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_inventories_lists.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function print_barcode($str='')
	{
		if($str!==''){
			$str = base64_decode($str);
			$str=" AND list_inv_no='".$str."' ";
		}
		$data['data_all']=$this->M_inventories->get_data_invent_no($str);
		$this->load->view('v_inventory_barcode_print.php', $data);
	}
	
	public function print_barcode2($str='')
	{
		if($str!==''){
			$str = base64_decode($str);
			$str=" AND list_inv_no='".$str."' ";
		}
		$data['data_all']=$this->M_inventories->get_data_invent_no($str);
		$this->load->view('v_inventory_barcode_print2.php', $data);
	}

	public function data_barcode($get="")
	{
		$str='';
		parse_str($get);	

		if(isset($item)){
			$str.= " AND lis.list_item='".$item."' ";
		}
		
		if(isset($brand)){
			$str.= " AND lis.list_brand='".$brand."' ";
		}
		$data['data_all']=$this->M_inventories->get_data_invent_no($str);
		$this->load->view('v_inventory_barcode_print.php', $data);
	}
	
	function data_json($get=""){
		$str='';
		parse_str($get);	

		if(isset($item)){
			$str.= " AND lis.list_item='".$item."' ";
		}
		
		if(isset($brand)){
			$str.= " AND lis.list_brand='".$brand."' ";
		}
		
		$draw=$_REQUEST['draw'];
		$length=$_REQUEST['length'];
		$start=$_REQUEST['start'];
		$search=$_REQUEST['search']["value"];

		if($search!=""){
			$data_all=$this->M_inventories->get_data($str, $start, $length, $search);
			$count_all=$this->M_inventories->get_data_count($str, $search);
		}else{
			$data_all=$this->M_inventories->get_data($str, $start, $length);
			$count_all=$this->M_inventories->get_data_count($str);
		}

		$output=array();
		$output['draw']=$draw;
		$output['recordsTotal']=$output['recordsFiltered']=$count_all;
		$output['data']=array();
		$output['data']=$data_all;
		echo json_encode($output);
		
	}
	
	public function data_excel($get=""){
		$str='';
		parse_str($get);	

		if(isset($item)){
			$str.= " AND lis.list_item='".$item."' ";
		}
		
		if(isset($brand)){
			$str.= " AND lis.list_brand='".$brand."' ";
		}

		$titel_sheet = "Barcode";
		$titel_file = "Barcode";

		$this->load->library("PHPExcel/Classes/PHPExcel");
            $objPHPExcel = new PHPExcel();
			
			$data_excel = $this->M_inventories->get_data_excel($str);

			for($qry_row=0; $qry_row<count($data_excel); $qry_row++){
				$xls_row=$qry_row+1;
				for($qry_col=0; $qry_col<count($data_excel[$qry_row]); $qry_col++){
					$isi = $data_excel[$qry_row][$qry_col];
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValueExplicitByColumnAndRow($qry_col, $xls_row, $isi, PHPExcel_Cell_DataType::TYPE_STRING);
				}
			}


			$objPHPExcel->getActiveSheet()->setTitle($titel_sheet);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$titel_file.'.xlsx');
            $objWriter->save("php://output");
			
	}

	public function addnew()
	{
		$data['menu_titel']= $this->menu_titel;
		$data['page_titel']="Inventory Input Form";
		$data['smenu_titel']='Inventory Input Form';
		$data['authen'] = $this->authenty->sess();

		$data['list_items'] = $this->M_inventories->get_options_all(" AND op_tipe='Items' ");
		$data['list_brands'] = $this->M_inventories->get_options_all(" AND op_tipe='Brands' ");
		$data['list_vendors'] = $this->M_inventories->get_vendor_all();

		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1";
		$data['user'] 		= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_inventories_input.php');
		$this->load->view('intranet_includes/v_footer.php');

	}

	// [ITEMS] Add New Classification Items
	public function item_do_add()
	{
		$name = $this->input->post('txt_item_name');
		$code = $this->input->post('txt_item_code');
		$category = $this->input->post('txt_item_category');

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");
		$modify_by = trim($this->authenty->session_user());
		$modify_date = date("Y-m-d H:i:s");
		if($this->is_unique_option($tipe='Items', $code)===TRUE){
			echo "The value was entered. All items Id/Code must be uniqe.";
		}else{
			$data_insert = array(
					'op_kode' => $code,
					'op_titel' => $name,
					'op_tipe' => "Items",
					'op_description' => $category,
					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
			);
			$this->db->insert('tb_options', $data_insert);
			//$data_insert_id = $this->M_inventories->item_do_insert($data_insert);
			echo "ok";
		}
	}

	// [ITEMS] Get Increment Item Code
	public function get_new_item_code(){
		$data="01";
		$sql =  "SELECT op_kode FROM tb_options WHERE op_tipe='Items' ORDER BY op_kode DESC LIMIT 1 ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->op_kode;
			$data = intval($data); $data = $data+1;
			$data = $data<10 ? "0".$data : $data;
		}
		echo $data;
	}

	public function is_unique_option($tipe='', $code='')
	{
		if(trim($code)==""){
			return FALSE;
		}else{
			$data_duplicate=$this->db->get_where("tb_options", array('op_tipe' => $tipe, 'op_kode' => $code));
			if(count($data_duplicate)>0){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function get_option($str, $paren='')
	{
		$sql = "SELECT op_kode, op_titel FROM tb_options WHERE op_tipe='".$str."' ";
		if($paren!=''){
			$sql.=" AND op_paren='".$paren."' ";
		}
		$sql.=" ORDER BY op_kode ";
		$result=$this->db->query($sql);
		$data ="<option value=''>Select...</option>";
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row){
				$data .="<option value='".$row->op_kode."' title='".$row->op_kode." - ".$row->op_titel."'>".$row->op_kode." - ".$row->op_titel."</option>";
			}
		}
		echo $data;
	}
	
	public function get_option_forlists($str, $paren='')
	{
		$sql = "SELECT DISTINCT bra.* FROM tb_lists AS lis
		INNER JOIN tb_options AS bra ON lis.list_brand=bra.op_kode WHERE  op_tipe='".$str."' ";
		
		
		if($paren!=''){
			$sql.=" AND op_paren='".$paren."' ";
		}
		
		$sql.=" ORDER BY op_kode ";
		$result=$this->db->query($sql);
		$data ="<option value=''>Filter by mark/brand...</option>";
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row){
				$data .="<option value='".$row->op_kode."' title='".$row->op_kode." - ".$row->op_titel."'>".$row->op_kode." - ".$row->op_titel."</option>";
			}
		}
		echo $data;
	}

	// [BRAND] Get Increment Code
	public function get_new_brand_code($str=''){
		$data="01";
		$sql =  "SELECT op_kode FROM tb_options WHERE op_tipe='Brands' AND op_paren='".$str."' ORDER BY op_kode DESC LIMIT 1 ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->op_kode;
			$data = intval($data); $data = $data+1;
			$data = $data<10 ? "0".$data : $data;
		}
		echo $data;
	}

	// [BRAND] Add New BRAND
	public function brand_do_add()
	{
		$name = $this->input->post('txt_brand_name');
		$code = $this->input->post('txt_brand_code');
		$paren = $this->input->post('txt_brand_id');

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");
		$modify_by = trim($this->authenty->session_user());
		$modify_date = date("Y-m-d H:i:s");
		if($this->is_unique_option($tipe='Brands', $code)===TRUE){
			echo "The value was entered. All brand Id/Code must be uniqe.";
		}else{
			$data_insert = array(
					'op_kode' => $code,
					'op_titel' => $name,
					'op_tipe' => "Brands",
					'op_paren' => $paren,
					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
			);
			$this->db->insert('tb_options', $data_insert);
			//$data_insert_id = $this->M_inventories->item_do_insert($data_insert);
			echo "ok";
		}
	}

	// [PO] Add New Purchase Order
	public function is_unique_po($code='')
	{
		if(trim($code)==""){
			return FALSE;
		}else{
			$query = $this->db->query("SELECT pur_number FROM tb_purchases WHERE pur_number='".$code."' ");
			if($query->num_rows()> 0) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function po_do_add()
	{
		$pur_number=$this->input->post('txt_po_number');
		$pur_idr=$this->input->post('txt_po_idr');
		$pur_idr=str_replace(".", "", $pur_idr);
		$pur_usd=$this->input->post('txt_po_usd');
		$pur_usd=str_replace(",", "", $pur_usd);
		$pur_effective=$this->input->post('txt_po_date')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_date')));
		$pur_delivery1=$this->input->post('txt_po_delivery1')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_delivery1')));
		$pur_delivery2=$this->input->post('txt_po_delivery2')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_delivery2')));
		$pur_vendor=$this->input->post('txt_po_vendor');
		$pur_vendor_address=$this->input->post('txt_po_vendor_address');
		$pur_vendor_fax=$this->input->post('txt_po_vendor_fax');
		$pur_vendor_phone=$this->input->post('txt_po_vendor_phone');
		$pur_vendor_ident=$this->input->post('txt_po_vendor_ident');
		$pur_place=$this->input->post('txt_place');
		$pur_place_mark=$this->input->post('txt_place_mark');
		$pur_place_phone=$this->input->post('txt_po_place_phone');
		$pur_charge_code=$this->input->post('txt_po_charge');

		$pur_vat_exemption=$pur_type_business_nonus=$this->input->post('txt_po_vat')=='' ? '' : $this->input->post('txt_po_vat');

		$pur_client_contract=$this->input->post('txt_po_contract');
		$pur_agent=$this->input->post('txt_po_agent');
		$pur_agent_phone=$this->input->post('txt_po_agent_phone');
		$pur_agent_email=$this->input->post('txt_po_agent_email');

		$pur_type_business_nonus=$this->input->post('txt_po_nonus')=='' ? '' : $this->input->post('txt_po_nonus');
		$pur_type_business_nongov=$this->input->post('txt_po_nongov')=='' ? '' : $this->input->post('txt_po_nongov');

		$pur_sign1_by=$this->input->post('txt_po_signatured1');
		$pur_sign1_date=$this->input->post('txt_po_signatured_date1')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_signatured_date1')));
		$pur_sign2_by=$this->input->post('txt_po_signatured2');
		$pur_sign2_date=$this->input->post('txt_po_signatured_date2')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_signatured_date2')));;

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");
		$modify_by = trim($this->authenty->session_user());
		$modify_date = date("Y-m-d H:i:s");

		if($this->is_unique_po($pur_number)===FALSE){
			echo "The value was entered. All PO Number must be uniqe.";
		}else{
			if(isset($_POST['txt_po_vendor_id'])){
				$pur_vendor_code=$this->input->post('txt_po_vendor_id');
				$data_insert = array(
					'vendor_name' => $pur_vendor,
					'vendor_code' => $pur_vendor_code,
					'vendor_address' => $pur_vendor_address,
					'vendor_fax' => $pur_vendor_fax,
					'vendor_phone' => $pur_vendor_phone,
					'vendor_ident' => $pur_vendor_ident,

					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
				);
				$this->db->insert('tb_vendor', $data_insert);

			}else{
				$pur_vendor_code=$this->input->post('txt_po_vendor_select');
			}
			$data_insert = array(
					'pur_number' => $pur_number,
					'pur_idr' => $pur_idr,
					'pur_usd' => $pur_usd,
					'pur_date' => $pur_effective,
					'pur_effective' => $pur_effective,
					'pur_delivery1' => $pur_delivery1,
					'pur_delivery2' => $pur_delivery2,

					'pur_vendor' => $pur_vendor,
					'pur_vendor_code' => $pur_vendor_code,
					'pur_vendor_address' => $pur_vendor_address,
					'pur_vendor_fax' => $pur_vendor_fax,
					'pur_vendor_phone' => $pur_vendor_phone,
					'pur_vendor_ident' => $pur_vendor_ident,

					'pur_place' => $pur_place,
					'pur_place_mark' => $pur_place_mark,
					'pur_place_phone' => $pur_place_phone,

					'pur_charge_code' => $pur_charge_code,
					'pur_vat_exemption' => $pur_vat_exemption,
					'pur_client_contract' => $pur_client_contract,


					'pur_agent' => $pur_agent,
					'pur_agent_phone' => $pur_agent_phone,
					'pur_agent_email' => $pur_agent_email,

					'pur_type_business_nonus' => $pur_type_business_nonus,
					'pur_type_business_nongov' => $pur_type_business_nongov,

					'pur_sign1_by' => $pur_sign1_by,
					'pur_sign1_date' => $pur_sign1_date,
					'pur_sign2_by' => $pur_sign2_by,
					'pur_sign2_date' => $pur_sign2_date,
					'pur_status' => 'Delivered',

					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
			);
			$this->db->insert('tb_purchases', $data_insert);
			echo 'ok';
		}
	}

	public function get_po_number()
	{
		$result=$this->db->query("SELECT pur_number FROM tb_purchases WHERE trash!=1 ");
		$data ="<option value=''>Select...</option>";
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row){
				$data .="<option value='".$row->pur_number."' >".$row->pur_number."</option>";
			}
		}
		echo $data;
	}

	public function do_upload()
    {
        $status = "";
		$msg = "";
		$file = "";

		$path_home='images';
		if(!is_dir($path_home))
		{
			mkdir($path_home);
		}

		$path_dir='images/items';
		if(!is_dir($path_dir))
		{
			mkdir($path_dir);
		}

		$config['upload_path']          = $path_dir.'/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

		if (isset($_FILES['txt_item_image']['name'])) {
            if (0 < $_FILES['txt_item_image']['error']) {
				$data = array('msg' => 'Error during file upload' . $_FILES['file']['error']);
                //echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists($path_dir.'/'. $_FILES['txt_item_image']['name'])) {
					$data = array('msg' => 'File already exists : ' . $_FILES['txt_item_image']['name'], 'filename' => $_FILES['txt_item_image']['name']);
                    //echo 'File already exists : ' . $_FILES['txt_item_image']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('txt_item_image')) {
                        echo $this->upload->display_errors();
                    } else {
                        //echo 'success';
						$data = array('msg' => 'success', 'filename' => $_FILES['txt_item_image']['name']);
                    }
                }
            }
        }else {
			$data = array('msg' => 'Please choose a file');
            //echo 'Please choose a file';
        }
		echo json_encode($data);

    }

	public function do_remove_file()
    {
		$path = $_POST['path'];
		$path = str_replace(base_url(), '', $path);
		if(file_exists($path) ){
			unlink($path);
			echo 'success';
		}
	}

	public function get_items_category(){
		$query = $this->db->query("SELECT DISTINCT op_description FROM tb_options WHERE op_tipe='Items' ");
		$data = array();
		if ($query->num_rows() > 0) { //jika ada maka jalankan
            foreach ($query->result() as $row) {
				$data[]     = $row->op_description;
			}
		}
		echo json_encode($data);
	}

	public function get_vendor_lists(){
		$query = $this->db->query("SELECT DISTINCT * FROM tb_vendor WHERE trash!=1 ");
		$data ="<option value=''>Select...</option>";
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row){
				$data .="<option value='".$row->vendor_code."' >".$row->vendor_code." - ".$row->vendor_name."</option>";
			}
		}
		echo $data;
	}

	public function get_new_vendor_code(){

		$data="001";
		$sql =  "SELECT vendor_code FROM tb_vendor ORDER BY  vendor_code DESC LIMIT 1";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->vendor_code;
			$data = intval($data); $data = $data+1;
			$data = sprintf("%03d", $data);
		}
		echo $data;
	}

	public function get_vendor($str){
		$query = $this->db->query("SELECT * FROM tb_vendor WHERE trash!=1 AND vendor_code='".$str."' ");
		$data=array();

		if($query->num_rows() > 0)
		{
			$data=$query->row();
			/*
			foreach($query->result() as $row)
			{
				$data[]=$row;
			}
			*/
		}
		echo json_encode($data);
	}

	public function get_new_location_code(){

		$data="001";
		$sql =  "SELECT loca_code FROM tb_locations ORDER BY  loca_code DESC LIMIT 1";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->loca_code;
			$data = intval($data); $data = $data+1;
			$data = sprintf("%03d", $data);
		}
		echo $data;
	}

	public function get_new_serial($item='', $brand=''){

		$data="001";
		$sql =  "SELECT list_serial FROM tb_lists WHERE list_item='".$item."' AND list_brand='".$brand."' ORDER BY  list_serial DESC LIMIT 1";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->list_serial;
			$data = intval($data); $data = $data+1;
			$data = sprintf("%03d", $data);
		}
		echo $data;
	}

	public function get_purchase_date(){
		$po_number = $this->input->post('po_number');
		$roman_array = array('01'=>'I', '02'=>'II', '03'=>'III',
							 '04'=>'IV', '05'=>'V', '06'=>'VI',
							 '07'=>'VI', '08'=>'VII', '09'=>'IX',
							 '10'=>'X', '11'=>'XI', '12'=>'XII');
		$data="XX/0000";
		$sql =  "SELECT pur_date FROM tb_purchases WHERE pur_number='".$po_number."' ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->pur_date;
			if(trim($data)!='0000-00-00'){
				$data = $roman_array[date_format_id($data, 21)].'/'.date_format_id($data, 20);
			}else{
				$data="XX/0000";
			}
		}

		echo $data;
	}

	public function get_location($str){
		$query = $this->db->query("SELECT * FROM tb_locations WHERE trash!=1 AND loca_code='".$str."' ");
		$data=array();

		if($query->num_rows() > 0)
		{
			$data=$query->row();
		}
		echo json_encode($data);
	}

	public function get_location_lists(){
		$query = $this->db->query("SELECT DISTINCT * FROM tb_locations WHERE trash!=1 ");
		$data ="<option value=''>Select...</option>";
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row){
				$data .="<option value='".$row->loca_code."' >".$row->loca_name."</option>";
			}
		}
		echo $data;
	}

	public function do_add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_item', 'Item Classification', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_brand', 'Brand', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_model', 'Model', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_sn', 'SN', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_usd', 'USD Cost', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_idr', 'IDR Cost', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_rate', 'Exchange Rate', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_exchange_date', 'Exchange Date', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_title', 'Name/Title', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');

		$this->form_validation->set_rules('txt_po', 'PO No.', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_project', 'Project Title', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_status', 'Status', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_consumable', 'Consumable Life', 'trim|xss_clean');

		$this->form_validation->set_rules('txt_location', 'Location/Department', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_district', 'District', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_province', 'Province', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_country', 'Country', 'trim|xss_clean');

		$this->form_validation->set_rules('txt_user', 'User/PiC', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_condition', 'Condition', 'trim|xss_clean');


		$this->form_validation->set_rules('txt_inventory_number', 'Inven. No.', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_quotes', 'Quotes', 'trim|xss_clean');

		$item = $this->input->post('txt_item');
		$brand = $this->input->post('txt_brand');
		$serial = $this->input->post('txt_serial');
		$model = $this->input->post('txt_model');
		$sn = $this->input->post('txt_sn');
		$idr = $this->input->post('txt_idr');
		$idr=str_replace(".", "", $idr);
		$usd = $this->input->post('txt_usd');
		$usd=str_replace(",", "", $usd);
		$rate = $this->input->post('txt_rate');
		$rate=str_replace(".", "", $rate);
		$exchange_date=$this->input->post('txt_exchange_date')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_exchange_date')));

		$name = $this->input->post('txt_title');
		$detail = $this->input->post('txt_detail');
		$image = $_FILES['txt_item_image']['name'];

		$po = $this->input->post('txt_po');
		$project = $this->input->post('txt_project');
		$status = $this->input->post('txt_status');
		$consumable = $this->input->post('txt_consumable')=='' ? '0000-00-00' : $this->input->post('txt_consumable').'-12-31';

		$location = $this->input->post('txt_location');
		$district = $this->input->post('txt_district');
		$province = $this->input->post('txt_province');
		$country = $this->input->post('txt_country');

		$user = $this->input->post('txt_user');
		$hand_date=$this->input->post('txt_hand_date')=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_hand_date')));

		$condition = $this->input->post('txt_condition');

		$inv_no = $this->input->post('txt_inventory_number');
		$quotes = $this->input->post('txt_quotes');

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");
		$modify_by = trim($this->authenty->session_user());
		$modify_date = date("Y-m-d H:i:s");


		if($this->is_unique_inventory($inv_no)===FALSE){
			echo "The inventory number ".$inv_no." already exists.";
		}else{
			if(isset($_POST['txt_location_id'])){
				$location_code=$this->input->post('txt_location_id');
				$data_insert = array(
					'loca_name' => $location,
					'loca_code' => $location_code,
					'loca_district' => $district,
					'loca_province' => $province,
					'loca_country' => $country,

					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
				);
				$this->db->insert('tb_locations', $data_insert);
				//print_r($data_insert);

			}else{
				$location_code=$this->input->post('txt_location_select');
			}


			$data_insert = array(
				'list_item' => $item,
				'list_brand' => $brand,
				'list_serial' => $serial,
				'list_model' => $model,
				'list_sn' => $sn,
				'list_idr' => $idr,
				'list_usd' => $usd,
				'list_rate' => $rate,
				'list_rate_date' => $exchange_date,

				'list_name' => $name,
				'list_detail' => $detail,
				'list_image' => $image,

				'list_po' => $po,
				'list_project' => $project,
				'list_status' => $status,
				'list_life' => $consumable,

				'list_location_code' => $location_code,
				'list_location' => $location,
				'list_district' => $district,
				'list_province' => $province,
				'list_country' => $country,

				'list_user' => $user,
				'list_condition' => $condition,
				'list_inv_no' => $inv_no,

				'list_quotes' => $quotes,
				'create_by' => $create_by,
				'create_date' => $create_date,
				'modify_by' => $modify_by,
				'modify_date' => $modify_date
			);
			$this->db->insert('tb_lists', $data_insert);

			$data_insert = array(
				'hand_list' => $inv_no,
				'hand_location' => $location_code,
				'hand_date' => $hand_date,
				'hand_user' => $user,
				'create_by' => $create_by,
				'create_date' => $create_date,
				'modify_by' => $modify_by,
				'modify_date' => $modify_date
			);
			$this->db->insert('tb_handover', $data_insert);

			echo 'ok';

		}
	}

	public function is_unique_inventory($str)
	{
		if(trim($str)==""){
			return TRUE;
		}else{
			$query = $this->db->query("SELECT list_inv_no FROM tb_lists WHERE list_inv_no='".$str."' ");
			if($query->num_rows() > 0){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}



	function get_barcode($code="ABCD12345")
	{
		$code = base64_decode($code);
		$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '100';
		$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1';
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$barcodeOPT = array(
			'text' => $code,
			'barHeight'=> $height,
			'barThickWidth'=>3,
			'barThinWidth'=>1,
			'factor'=>$width,
			'stretchText'=>true
		);

		$renderOPT = array();
		$render = Zend_Barcode::factory(
			'code128', 'image', $barcodeOPT, $renderOPT
		)->render();
	}
	
	function get_barcode2($code="ABCD12345")
	{
		$code = base64_decode($code);
		$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '280';
		$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1';
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$barcodeOPT = array(
			'text' => $code,
			'barHeight'=> $height,
			'barThickWidth'=>3,
			'barThinWidth'=>1,
			'factor'=>$width,
			'stretchText'=>true
		);

		$renderOPT = array();
		$render = Zend_Barcode::factory(
			'code128', 'image', $barcodeOPT, $renderOPT
		)->render();
	}
	
	//code128, code39
	function get_form_urlencode()
	{
		$code = $this->input->post('txt_inventory_number');
		$code = base64_encode($code);
		echo $code;
	}

	public function get_list_model(){
		$sql="SELECT list_model FROM tb_lists ";
		if(isset($_POST[''])){
			$sql.="  WHERE list_model LIKE '%".$str."%'  ";
		}
		$query = $this->db->query($sql);
		$data=array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$data[] = $row->list_model;
			}
		}
		echo json_encode($data);
	}



}



/* End of file inventories.php */
/* Location: ./application/modules/purchase/controllers/inventories/inventories.php */
