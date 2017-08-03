<?php if (!defined('BASEPATH')) die();

class Memo extends CI_Controller {

	private $site_id="";
	private $menu_titel="memo";

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now	= date('Y-m-d H:i:s');
		// $this->load->model('M_memo','mm');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}


	public function index()
	{
		$data['menu_titel']		= $this->menu_titel;
		$data['page_titel']		= "Memo";
		$data['smenu_titel']	= "Memo";
		$data['authen'] 		= $this->authenty->sess();

		$sql = "SELECT T4.vendor_code, T2.vendor_name, T4.vendor_address, T4.vendor_email, T1.create_by, T1.create_date, T1.attachment
				from tb_selection T1 inner join tb_quotation_respon T2 on T1.quotation_respon_id=T2.id
				inner join tb_quotation_recipient T3 ON T3.id=T2.id_quotation_recipient
				left join tb_vendor T4 on T4.vendor_email=T3.email ";
		$data['vendor']	= $this->db->query("SELECT * FROM tb_vendor WHERE isPreferred=1 AND trash<>1")->result_array();

		$sql = "SELECT T1.id, T1.vendor_name, T1.quotation attachment, T1.purchase_request_number purchase_number, T1.status, T3.submission_date, T3.id quotation_id
				FROM tb_quotation_respon T1 inner join tb_quotation_recipient T2 on T1.id_quotation_recipient=T2.id inner join tb_quotation T3 on T2.quotation_id=T3.id AND COALESCE(T3.status,'') <> 'CLOSED'";
		$data['memo'] = $this->db->query($sql)->result_array();

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}
		
		// Memo
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_memo.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function saveProcess(){
		echo "<pre>";
		print_r($this->input->post());

		$winner 		 = $this->input->post('txt_winner');
		$justification 	 = $this->input->post('txt_justification');
		$purchase_number = $this->input->post('txt_purchase_number');
		$quotation_id 	 = $this->input->post('txt_quotation_id');

		$header 	= $this->input->post('header');
		$content 	= $this->input->post('content');

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");

		$data_insert = array(
			'quotation_id'		=> $quotation_id,
			'quotation_respon_id' => $winner,
			'purchase_number' 	=> $purchase_number,
			'justification' 	=> $justification,
			'create_by' 		=> $create_by,
			'create_date' 		=> $create_date,
			'status'			=> 'DONE'
		);

		$other = array();
		foreach ($content as $key => $value) {
			$tmp = array();
			for ($i=0; $i < count($header); $i++) { 
				if ($header[$i] <> ""){
					$tmp[$header[$i]] = $content[$key][$i+3];
				}
			}
			// $other[$key] = json_encode($tmp);
			$this->db->update('tb_quotation_respon', array('other'=>json_encode($tmp)), array('id'=>$key));
		}		

		// print_r($other);
		// die();
		$status_insert = $this->db->insert('tb_selection', $data_insert);
		if ($status_insert){
			
			$selection_id = $this->db->insert_id();
			
			$data_update = array(
				'status' => 'WINNER'
			);
			$where_update = array(
				'id' => $winner
			);
			$status_update = $this->db->update('tb_quotation_respon', $data_update, $where_update);
			if ($status_update) {
				$data_update = array(
					'status' => 'CLOSED'
				);
				$where_update = array(
					'id' => $quotation_id
				);
				$status_update = $this->db->update('tb_quotation', $data_update, $where_update); 
				if ($status_update){
					$this->word($selection_id);
					
					$_SESSION['message'] = "success";
					redirect('Memo');
				}
			}
		}

		print_r($data_insert);
	}

	public function data_json_all()
	{
		$str = "";
		$this->load->model('m_memo','mm');
		$data['data_all']=$this->mm->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}

	public function getQuotationVendor($id){
		$sql 	= "	SELECT T1.id, T1.purchase_request_number purchase_number, T1.vendor_name, T3.submission_date
					FROM tb_quotation_respon T1 
						inner join tb_quotation_recipient T2 on T1.id_quotation_recipient=T2.id 
						inner join tb_quotation T3 on T2.quotation_id=T3.id and T2.quotation_id='$id'";
		$data 	= $this->db->query($sql)->result_array();		
		echo json_encode($data);
	}

	public function word($id){

		include APPPATH.'libraries\PhpWord\Autoloader.php';

		$auto = new Autoloader();
		$auto->register();

		$phpWord = new PhpOffice\PhpWord\PhpWord();

		$sql = "SELECT 
				T4.vendor_code, T2.vendor_name, T4.vendor_address, T4.vendor_email, T4.vendor_phone,T2.date_submission,T2.other
				from tb_quotation_respon T2 
				inner join tb_quotation_recipient T3 ON T3.id=T2.id_quotation_recipient
				left join tb_vendor T4 on T4.vendor_email=T3.email
				inner join tb_quotation T5 on T3.quotation_id=T5.id
				where T5.id='".$id."'";
		$detil = $this->db->query($sql);

		$document = "";
		$sisa = 0;

		$row = $detil->num_rows();
		if ($row > 5){
			$document = new \PhpOffice\PhpWord\TemplateProcessor('source-template/memo-10.docx');	
			$existingRow = 10;	
			if ($row > 10)	{ // jika jumlah data detil > 10 . maka tampilkan 10 data saja
				$sisa = 0;
			} else {
				$sisa = 10 - $row;
			}
		} else {
			$document = new \PhpOffice\PhpWord\TemplateProcessor('source-template/memo-5.docx');	
			$existingRow = 5;
			$sisa = 5 - $row;
		}

		$total = 0;
		$cursor = 0;
		$detil = $detil->result_array();
		for ($i=1; $i <= $row; $i++){
			echo "vendor_name".$i .'=>'. $detil[($i-1)]['vendor_name'].'<br>';
			$document->setValue('vendor_name'.$i, $detil[($i-1)]['vendor_name']);
			echo "vendor_addr".$i .'=>'. $detil[($i-1)]['vendor_address'].'<br>';
			$document->setValue('vendor_addr'.$i, $detil[($i-1)]['vendor_address']);
			echo "vendor_date".$i .'=>'. $detil[($i-1)]['date_submission'].'<br>';
			$document->setValue('vendor_date'.$i, $detil[($i-1)]['date_submission']);

			$other = json_decode($detil[($i-1)]['other']);
			$iCol = 1;
			$sisaOther = 3 - count($other);
			foreach ($other as $key => $value) {
				echo 'field'.$iCol.'=>'.$key."<br>";
				echo 'field_val'.$iCol.'_'.($cursor+1).'=>'.$value."<br>";
				
				$document->setValue('field_'.$iCol, $key);
				$document->setValue('field_val'.$iCol.'_'.($cursor+1), $value);
				$iCol++;
			}
			for ($iSisa=$iCol; $iSisa <= 3; $iSisa++) { 
				$document->setValue('field_'.$iSisa, '');
				$document->setValue('field_val'.$iSisa.'_'.($cursor+1),'');	
				echo 'field'.$iSisa.'=>'."<br>";
				echo 'field_val'.$iCol.'_'.($cursor+1).'=>'."<br>";	
			}

			$cursor++;		
		}

		$batas = $cursor+$sisa;
		for ($i=$cursor; $i <= $batas; $i++) { 
			echo "vendor_name".$i .'=>'.'<br>';
			$document->setValue('vendor_name'.$i, '');
			echo "vendor_addr".$i .'=>'.'<br>';
			$document->setValue('vendor_addr'.$i, '');
			echo "vendor_date".$i .'=>'.'<br>';
			$document->setValue('vendor_date'.$i,'');
			echo "vendor_val1_".$i .'=>'.'<br>';
			$document->setValue('field_val1_'.$i,'');			
			echo "vendor_val2_".$i .'=>'.'<br>';
			$document->setValue('field_val2_'.$i,'');			
			echo "vendor_val3_".$i .'=>'.'<br>';
			$document->setValue('field_val3_'.$i,'');			
		}

		$sql = "SELECT * from tb_selection T1 inner join tb_quotation T2 on T1.quotation_id=T2.id";
		$data = $this->db->query($sql)->row_array();
		
		echo "justification".$i .'=>'.$data['justification'].'<br>';
		$document->setValue('justification',$data['justification']);


        $path = $this->config->item('memo_path');//'documents/memo/';
        $filename = $id.'-memo-'.date('YmdHis').'.docx';

		// // Save file
		$document->saveAs($path.$filename);

		// update data attachment for selection memo
		$data_update = array(
			'attachment' => $filename
		);
		$where_update = array(
			'id' => $id
		);
		$status_update = $this->db->update('tb_selection', $data_update, $where_update); 
	}

	private function Oldword($id){
		include APPPATH.'libraries\PhpWord\Autoloader.php';

		$auto = new Autoloader();
		$auto->register();

		$phpWord = new PhpOffice\PhpWord\PhpWord();
		$phpWord->setDefaultFontName('Arial Narrow');
		$phpWord->setDefaultFontSize(12);

		$styleFooter = array('size'=>9);

        $section = $phpWord->addSection();

		// Add first page header
		$header = $section->addHeader();
		// $header->firstPage();
		$table = $header->addTable();
		$table->addRow();
		$cell = $table->addCell(4500);
		$textrun = $cell->addTextRun();
		$textrun->addText('REQ Number');
		$table->addRow();
		$cell = $table->addCell(4500);
		$textbox = $cell->addTextBox(array('width' => 200, 'height'=>35, 'borderSize' => 1, 'borderColor' => '#000000'));

		// Add footer
		$footer = $section->addFooter();
		$footer->addPreserveText('FHI Source Selection Guidance', null, array('alignment' => 'left'));

		// $styleParagraph = new PhpOffice\PhpWord\Style\Paragraph();
		// $styleParagraph::setAlignment('both');
		// $stylDefault = new PhpOffice\PhpWord\Style();
		// $stylDefault->setDefaultParagraphStyle($styleParagraph);
		// $phpWord->setDefaultParagraphStyle($stylDefault);


        // title content
		$section->addText('FHI 360 Source Selection Memorandum', array('size' => 18, 'bold' => true, 'alignment'=> 'center'));
		$section->addText('INDONESIA COUNTRY OFFICE', array('size' => 14, 'bold' => true, 'alignment'=> 'center'));

		// Add text run
		$textrun = $section->addTextRun();
		$textrun->addText('This form serves to document attestations and evaluations used to inform decisions related to final vendor selection and award.  Prior to execution of any agreement, knowledgeable staff will complete and sign this memorandum which will then be appended to the Purchase Requisition.  Falsifying data or sole source information with intent to circumvent fair and competitive practices will result in disciplinary action.  This memorandum is not required for purchases below the federal micro-purchase threshold');		
		$footnote = $textrun->addFootnote();
		$footnote->addText('The micro-purchase threshold for supplies is $3,000; for services $2,500; and for construction $2,000.  See Federal Acquisition 
			Regulations (FAR) 2.101.', $styleFooter);
		$textrun->addText(' or for the purchase of materials bought at verifiable market prices.');


		$section->addText('It is the policy of FHI 360 to select contractors, subcontractors, service providers and mate¬rial suppliers, etc. (“vendors”) utilizing competitive processes.  This policy further conforms to US Government requirements and is consistent with the objectives and requirements of most funders.  In general, at least three (3) bids should be sought to demonstrate competitive efforts.  Purchasing staff are ultimately responsible for determining the exact level of competitive effort required.');

		$section->addText('This template may be used to document reasons for a competitive selection. When used to support a recommended decision for a non-competitive award, this along with a Source Justification Memo, must accompany a formal Purchase Requisition.');
		
		// line
		$section->addLine(
		    array(
		        'width'       => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(16),
		        'height'      => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(0),
		        'positioning' => 'relative',
		    )
		);

		$table = $section->addTable();
		$table->addRow();
        $table->addCell(3500)->addTextRun()->addText('competitive');
        $table->addCell(3500);
        $cell = $table->addCell(3500);

        $textrun = $cell->addTextRun();
        $textrun->addText("Sole/Single Source");
        $textrun->addFootnote()->addText('All non-competitive / sole source contracting must be justified with a Source Justification Memorandum.  See template next page.', $styleFooter);


		$table1Style = array(
			'alignment' 	=> 'center',
			'borderSize' 	=> 6, 
			'borderColor' 	=> '#000000', 
			'cellMargin' 	=> 20, 
		);
		$phpWord->addTableStyle('tableVendor', $table1Style, '');
		$table = $section->addTable('tableVendor');

		$table->addRow();
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("Vendor 1");
        $table->addCell(1750)->addText("Vendor 2");
        $table->addCell(1750)->addText("Vendor 3");
        $table->addCell(1750)->addText("Vendor 4");

		$table->addRow();
        $table->addCell(1750)->addText("Name");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");

		$table->addRow();
        $table->addCell(1750)->addText("Address");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");

		$table->addRow();
        $table->addCell(1750)->addText("Date");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");
        $table->addCell(1750)->addText("");

		$section->addText('Attach a description of the competitive process; include solicitation specifications, bid solicitation, evaluation process and any further rationale justifying recommended award.');

		$section->addText('Justification Memo : ',array('size' => 12,'alignment'=> 'left'));
		$section->addText('XXXXX',array('size' => 12,'alignment'=> 'left'));
		// $section->addTextBreak();

		// table untuk tanda tangan
		$table = $section->addTable();
		$table->addRow(100);
        $table->addCell(2100)->addText("Prepared by:");
        $table->addCell(null);
        $table->addCell(2100)->addText("Endorsed by:");
        $table->addCell(null);

		$table->addRow(600);
        $table->addCell(2100);
        $table->addCell(2100);
        $table->addCell(2100);
        $table->addCell(2100);

		$table->addRow();
        $table->addCell(2100);
        $table->addCell(2100)->addText("Date");
        $table->addCell(2100);
        $table->addCell(2100)->addText("Date");

        $path = $this->config->item('memo_path');//'documents/memo/';
        $filename = $id.'-'.date('YmdHis').'.docx';

		// // Save file
		$phpWord->save($path.$filename,'Word2007',false);


		// update data attachment for selection memo
		$data_update = array(
			'attachment' => $filename
		);
		$where_update = array(
			'id' => $id
		);
		$status_update = $this->db->update('tb_selection', $data_update, $where_update); 
	}

}


/* End of file memo.php */
/* Location: ./application/modules/memo/controllers/memo.php */
