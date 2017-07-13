<?php if (!defined('BASEPATH')) die();

class Po extends CI_Controller {

	private $site_id="";
	private $menu_titel="po";

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now	= date('Y-m-d H:i:s');
		// $this->load->model('M_po','mm');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}


	public function index()
	{
		$data['menu_titel']		= $this->menu_titel;
		$data['page_titel']		= "PO";
		$data['smenu_titel']	= "PO";
		$data['authen'] 		= $this->authenty->sess();

		$sql = "SELECT t2.op_titel as item, t1.description, t1.qty,t1.unit, t1.unit_price
				FROM tb_purchase_request t1 INNER JOIN tb_options t2 ON t1.op_id=t2.op_id WHERE status=0";
		$data['po'] = $this->db->query($sql)->result_array();

		$sql = "SELECT 	T1.id, T1.purchase_number,
						T4.vendor_code, T2.vendor_name, T4.vendor_address, T4.vendor_email,
						T1.create_by, T1.create_date, T1.attachment
				FROM tb_selection T1 inner join tb_quotation_respon T2 on T1.quotation_respon_id=T2.id
				INNER JOIN tb_quotation_recipient T3 ON T3.id=T2.id_quotation_recipient
				LEFT JOIN tb_vendor T4 on T4.vendor_email=T3.email
				WHERE T1.purchase_number NOT IN (SELECT DISTINCT pur_number FROM tb_purchases) ";
		$data['memo']	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT T1.*,T2.project_name FROM tb_project_location T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id ORDER by project_name ASC";
		$data['location'] 	= $this->db->query($sql)->result_array();

		$sql 			= "SELECT * FROM tb_purchases ORDER by pur_date DESC";
		$data['po'] 	= $this->db->query($sql)->result_array();

		// PO
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_po.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	function getPO($id=0){
		$sql = "SELECT T1.id, T1.purchase_number,T4.vendor_code, T2.vendor_name, T4.vendor_address, T4.vendor_email,T4.vendor_phone, T2.price, T2.id detail_id,'001' po_number
				FROM tb_selection T1
				INNER JOIN tb_quotation_respon T2 ON T1.quotation_respon_id=T2.id
				INNER JOIN tb_quotation_recipient T3 ON T3.id=T2.id_quotation_recipient
				LEFT JOIN tb_vendor T4 ON T4.vendor_email=T3.email
				WHERE T1.id='$id' ";
		$data 	= $this->db->query($sql)->row();

		$sql = "SELECT T3.*
				from tb_purchase_header T2 
				inner join tb_purchase_request T3 on T3.purchase_id=T2.id
				WHERE T2.purchase_number='".$data->purchase_number."'";
		$data->details = $this->db->query($sql)->result_array();

		echo json_encode($data);
	}

	public function po_do_add()
	{
		$pur_number=$this->input->post('txt_po_number');
		$pur_idr=$this->input->post('txt_price');
		$pur_idr=str_replace(".", "", $pur_idr);
		// $pur_usd=$this->input->post('txt_po_usd');
		// $pur_usd=str_replace(",", "", $pur_usd);

		$pur_effective=$this->input->post('txt_po_date');//=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_date')));
		$pur_delivery1=$this->input->post('txt_po_delivery1');//=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_delivery1')));
		$pur_delivery2=$this->input->post('txt_po_delivery2');//=='' ? '0000-00-00' : date('Y-m-d', strtotime($this->input->post('txt_po_delivery2')));

		$pur_vendor=$this->input->post('txt_po_vendor_name');
		$pur_vendor_code=$this->input->post('txt_po_vendor_code');
		$pur_vendor_address=$this->input->post('txt_po_vendor_address');
		$pur_vendor_phone=$this->input->post('txt_po_vendor_phone');
		$pur_vendor_fax=$this->input->post('txt_po_vendor_fax');
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

		$query = $this->db->query("SELECT pur_number FROM tb_purchases WHERE pur_number='".$pur_number."' ");
		if( $query->num_rows()> 0 ){
			echo "The value was entered. All PO Number must be uniqe.";
		}else{

			$data_insert = array(
					'pur_number' => $pur_number,
					'pur_idr' => $pur_idr,
					'pur_usd' => '',
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

					'pur_status' => 'Delivered',
					'create_by' => $create_by,
					'create_date' => $create_date,
					'modify_by' => $modify_by,
					'modify_date' => $modify_date
			);
			$this->db->insert('tb_purchases', $data_insert);

			$po_id = $this->db->insert_id();
			$this->word($pur_id);

			echo 'ok';
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

	
	private function word($id){
		
		include APPPATH.'libraries\PhpWord\Autoloader.php';

		$auto = new Autoloader();
		$auto->register();

		$phpWord = new PhpOffice\PhpWord\PhpWord();

		// $pur_number = '001/XXX.3/05/2017';

		$sql = "SELECT T3.*
				from tb_purchases T1 inner join tb_purchase_header T2 on T1.pur_number=T2.purchase_number
				inner join tb_purchase_request T3 on T3.purchase_id=T2.id
				WHERE T1.pur_id='".$id."'";
		$detil = $this->db->query($sql);

		$document = "";
		$sisa = 0;

		$row = $detil->num_rows();
		if ($row > 5){
			$document = new \PhpOffice\PhpWord\TemplateProcessor('source-template/po-10.docx');	
			$existingRow = 10;	
			if ($row > 10)	{ // jika jumlah data detil > 10 . maka tampilkan 10 data saja
				$sisa = 0;
			} else {
				$sisa = 10 - $row;
			}
		} else {
			$document = new \PhpOffice\PhpWord\TemplateProcessor('source-template/po-5.docx');	
			$existingRow = 5;
			$sisa = 5 - $row;
		}


		$sql = "SELECT * FROM tb_purchases where pur_id='".$id."' ";
		$data = $this->db->query($sql)->row_array();

		$document->setValue('order_no', $data['pur_number']);
		$document->setValue('price', $data['pur_idr']);
		$document->setValue('effective_date', $data['pur_effective']);
		$document->setValue('start',$data['pur_delivery1']);
		$document->setValue('end',$data['pur_delivery2']);

		$document->setValue('vendor_name',$data['pur_vendor_code'].' - '.$data['pur_vendor']);
		$document->setValue('vendor_phone',$data['pur_vendor_phone']);
		$document->setValue('vendor_fax',$data['pur_vendor_fax']);
		$document->setValue('vendor_ident',$data['pur_vendor_ident']);


		$document->setValue('delivery',$data['pur_place']);
		$document->setValue('place_mark',$data['pur_place_mark']);
		$document->setValue('place_phone',$data['pur_place_phone']);

		$document->setValue('charge',$data['pur_charge_code']);
		if ($data['pur_vat_exemption']=='yes'){
			$document->setValue('vat_yes','X');
			$document->setValue('vat_no','');
		} else {
			$document->setValue('vat_yes','');
			$document->setValue('vat_no','X');
		}
		$document->setValue('contract',$data['pur_client_contract']);

		$document->setValue('agent',$data['pur_agent']);
		$document->setValue('agent_phone',$data['pur_agent_phone']);
		$document->setValue('agent_email',$data['pur_agent_email']);

		if ($data['pur_type_business_nonus']=='on'){
			$document->setValue('non_us','X');
		} else {
			$document->setValue('non_us','');			
		}
		if ($data['pur_type_business_nongov']=='on'){
			$document->setValue('non_gov','X');
		} else {
			$document->setValue('non_gov','');	
		}

		$total = 0;
		$cursor = 0;
		$detil = $detil->result_array();
		for ($i=1; $i <= $row; $i++){
			$total += (intval($detil[($i-1)]['unit_price']) * intval($detil[($i-1)]['qty']));
			$document->setValue('desc_'.$i, $detil[($i-1)]['description']);
			$document->setValue('qty_'.$i, $detil[($i-1)]['qty']);
			$document->setValue('price_'.$i, number_format($detil[($i-1)]['unit_price']));
			$document->setValue('total_'.$i, number_format($detil[($i-1)]['unit_price'] * $detil[($i-1)]['qty']));	
			$cursor++;		
		}

		$batas = $cursor+$sisa;
		for ($i=$cursor; $i <= $batas; $i++) { 
			$document->setValue('desc_'.$i, '');
			$document->setValue('qty_'.$i, '');
			$document->setValue('price_'.$i,'');
			$document->setValue('total_'.$i,'');
		}

		$document->setValue('totals', number_format($total));

		$filename = $id.'-po-'.date('YmdHis').'.docx';
		$document->saveAs('documents/po/'.$filename);

		// update data attachment for selection memo
		$data_update = array(
			'pur_documents' => $filename
		);
		$where_update = array(
			'pur_id' => $id
		);
		$status_update = $this->db->update('tb_purchases', $data_update, $where_update);
	}


}


/* End of file po.php */
/* Location: ./application/modules/po/controllers/po.php */
