<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		echo 'testing';
	}

	private function send_email($submitto){	

		$this->load->library('email');

		$text = "<p>Message Body</p>";

		$this->email->from('alim1994@gmail.com', 'Email Sender');
		$this->email->to($submitto);

		$this->email->subject('Testing Send Email');
		$this->email->message($text);

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
			echo $attachment;
			die();
		}

		echo "<br>success send email to : ".$submitto;
		return $status;
	}

	function testSendEmail(){
		$attachment = '';
		$submitto 	= 'alimm.abdullah@gmail.com';
		$this->send_email($submitto);
	}

	public function testPDF(){
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $this->load->library('FPDF_Custom');
		$pdf = new FPDF_Custom();
		$pdf->AddPage('P');
		$pdf->Output();
	}

	public function testGetListEmail(){
		// set_time_limit(3000); 

		/* connect to gmail with your credentials */
		// $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
		// $username = 'test@gmail.com'; 
		// $password = '*****';

		// /* try to connect */
		// $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Email: ' . imap_last_error());

		// $emails = imap_search($inbox, 'UNSEEN');
		// // print_r($emails);

		// /* if any emails found, iterate through each email */
		// if($emails) {

		//     $count = 1;

		//     /* put the newest emails on top */
		//     rsort($emails);

		//     $data = array();
		//     $i = 0;
		//     /* for every email... */
		//     foreach($emails as $email_number) 
		//     {

		//     	$header = imap_header($inbox, $email_number);
		//     	$body 	= imap_body($inbox, $email_number);
		//         echo "<pre>";print_r($header);
		//         // echo $body;

		//         /* get information specific to this email */
		//         // $overview = imap_fetch_overview($inbox,$email_number,0);
		//         // print_r($overview);
		        
		//         $message = imap_fetchbody($inbox,$email_number,2);

		//         /* get mail structure */
		//         $structure = imap_fetchstructure($inbox, $email_number);
		        
		//         $uid = imap_uid($inbox, $email_number);
		//         // print_r($uid);

		//         $attachments = array();

		//         /* if any attachments found... */
		//         if(isset($structure->parts) && count($structure->parts)) 
		//         {

		// 	        $row = array(
		// 	        	'uid'			=>	$uid,
		// 	        	'udate'			=> 	$header->udate,
		// 	        	'subject' 		=> 	$header->subject,
		// 	        	'toAddress'		=>	$header->to[0]->mailbox.'@'.$header->to[0]->host,
		// 	        	'fromAddress'	=>	$header->from[0]->mailbox.'@'.$header->from[0]->host,
		// 	        	'body'			=>	$body
		// 	        );

		//             for($i = 0; $i < count($structure->parts); $i++) 
		//             {
		//                 $attachments[$i] = array(
		//                     'is_attachment' => false,
		//                     'filename' => '',
		//                     'name' => '',
		//                     'attachment' => ''
		//                 );

		//                 if($structure->parts[$i]->ifdparameters) 
		//                 {
		//                     foreach($structure->parts[$i]->dparameters as $object) 
		//                     {
		//                         if(strtolower($object->attribute) == 'filename') 
		//                         {
		//                             $attachments[$i]['is_attachment'] = true;
		//                             $attachments[$i]['filename'] = $object->value;
		//                         }
		//                     }
		//                 }

		//                 if($structure->parts[$i]->ifparameters) 
		//                 {
		//                     foreach($structure->parts[$i]->parameters as $object) 
		//                     {
		//                         if(strtolower($object->attribute) == 'name') 
		//                         {
		//                             $attachments[$i]['is_attachment'] = true;
		//                             $attachments[$i]['name'] = $object->value;
		//                         }
		//                     }
		//                 }

		//                 if($attachments[$i]['is_attachment']) 
		//                 {
		//                     $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

		//                     /* 3 = BASE64 encoding */
		//                     if($structure->parts[$i]->encoding == 3) 
		//                     { 
		//                         $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
		//                     }
		//                     /* 4 = QUOTED-PRINTABLE encoding */
		//                     elseif($structure->parts[$i]->encoding == 4) 
		//                     { 
		//                         $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
		//                     }
		//                 }
		//             }
		//         }

		//         /* iterate through each attachment and save it */
		//         $file = array();
		//         foreach($attachments as $attachment)
		//         {
		//             if($attachment['is_attachment'] == 1)
		//             {
		//                 $filename = $attachment['name'];
		//                 if(empty($filename)) $filename = $attachment['filename'];

		//                 if(empty($filename)) $filename = time() . ".dat";
		//                 $folder = 'inbox';//"attachment";
		//                 if(!is_dir($folder))
		//                 {
		//                      mkdir($folder);
		//                 }
		//                 $fp = fopen("./". $folder ."/". $email_number . "-" . $filename, "w+");
		//                 fwrite($fp, $attachment['attachment']);
		//                 fclose($fp);

		//                 $file[] = $email_number . "-" . $filename;
		//             }
		//         }
		        
		//         $row['attachment'] = implode(",", $file);
		//         $data[] = $row;

		//         $sql = "SELECT 1 FROM tb_inbox WHERE uid='$uid' AND udate='".$header->udate."'";
		//         if ($this->db->query($sql)->num_rows() == 0) {
		// 	        $status = $this->db->insert('tb_inbox', $row);
		// 	        if ($status) {
		// 	        	$i++;
		// 	        }		        	
		//         }
		//     }
		// } 

        // echo "<pre>";
        // print_r($data);

		// /* close the connection */
		// imap_close($inbox);

		// echo "all attachment Downloaded";

	}

	function write_log(){
		 log_message('error', 'Some variable did not contain a value.');
	}


	function testWord(){
		// include APPPATH.'libraries\PhpWord\Autoloader.php';
		// // $this->load->library('PhpWord');//load librerry as usual
		// // include APPPATH.'libraries\PhpWord\Settings.php';

		// $auto = new Autoloader();
		// $auto->register();

		// $phpWord = new PhpOffice\PhpWord\PhpWord();
  // //       $section = $phpWord->addSection();

		// // // Simple text
		// // $section->addTitle('Welcome to PhpWord', 1);
		// // $section->addText('Hello World!');

		// // Read contents
		// // $name = basename(__FILE__, '.php');
		// // $name = 'testingHTML';//basename('testingHTML', '.html');
		// echo $source = realpath(APPPATH. "libraries/PhpWord/resources/testingHTML.html");
		// // $source = base_url('test');
		// // $content = file_get_contents($source);
		// // die();

		// // echo date('H:i:s'), " Reading contents from '{$source}'", PHP_EOL;
		// // $phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');
		
		// $section = $phpWord->addSection();
		// // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $content,false);
		// $phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');
		// // $section->addText($content);

		// // Save file
		// $phpWord->save('readHTML.docx','Word2007',true);
		// print_r($phpword);
	}	

	function testWordTemplate(){
		include APPPATH.'libraries\PhpWord\Autoloader.php';

		$auto = new Autoloader();
		$auto->register();

		$phpWord = new PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
		$header  = array('size' => 14, 'bold' => true, 'alignment'=> 'center');

		// // // Simple text
		// $section->addTitle('PURCHASE ORDER', 1);
		// // $section->addText('Hello World!');

		// $rows = 10;
		// $cols = 2;
		$section->addText('SELECTION MEMO', $header);
		// $html = '<h1>Adding element via HTML</h1>';
		// $html .= '<p>Some well formed HTML snippet needs to be used</p>';
		// $html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
		// $html .= '<p>Unordered (bulleted) list:</p>';
		// $html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
		// $html .= '<p>Ordered (numbered) list:</p>';
		// $html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';

		// \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

		$table1Style = array(
			'borderSize' => 6, 
			'borderColor' => '006699', 
			'cellMargin' => 80, 
			'alignment' => 'center'
		);
		$phpWord->addTableStyle('tableVendor', $table1Style, '');
		$table = $section->addTable('tableVendor');
		// // for ($r = 1; $r <= $rows; $r++) {
		// //     $table->addRow();
		// //     for ($c = 1; $c <= $cols; $c++) {
		// //         $table->addCell(1750)->addText("Row {$r}, Cell {$c}");
		// //     }
		// // }
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



  //       $table->addCell(1750)->addText("1. ORDER NO : ");
  //       $table->addCell(1750)->addText("2. PRICE : ");
  //       $table->addCell(1750)->addText("3. EFECTIVE DATE : ");

		// $table->addRow();
  //       $table->addCell(1750)->addText("4. DELIVERY DATE/PERIOD OF PERFORMANCE: indicate exact start and end date");

		// $table->addRow();
  //       $table->addCell(1750)->addText("5. VENDOR NAME & ADDRESS");
  //       $table->addCell(1750)->addText("6. PLACE OF DELIVERY/ACCEPTANCE");

		// $table->addRow();
  //       $table->addCell(1750)->addText("7.  FHI 360 CHARGE CODE: ");
  //       $table->addCell(1750)->addText("10. FHI 360 PURCHASE AGENT: ");

		// $table->addRow();
  //       $table->addCell(1750)->addText("11. TYPE OF ORDER");

		// $table->addRow();
  //       $table->addCell(1750)->addText("12. TYPE OF BUSINESS");

		// $table->addRow();
  //       $table->addCell(1750)->addText("13. SPECIFICATIONS");

		// $table->addRow();
  //       $table->addCell(1750)->addText("AGREEMENT OF THE PARTIES");

		// $table->addRow();
  //       $table->addCell(1750)->addText("");
  //       $table->addCell(1750)->addText("");
		
		// $section->addPageBreak();


		// // Save file
		$phpWord->save('memo.docx','Word2007',true);
	}

	function exportWord(){
		echo "<h1>Hello World</h1>";
		header("Content-Type: application/vnd.ms-word"); 
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("content-disposition: attachment;filename=Hawala.doc");
	}
 

	function testMemo(){
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
		$textbox = $cell->addTextBox(array('width' => 200, 'height'=>35, 'borderSize' => 1, 'borderColor' => '#00FF00'));

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
			'borderSize' => 6, 
			'borderColor' => '006699', 
			'cellMargin' => 20, 
			'alignment' => 'center'
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

        $path = 'documents/memo/';

		// // Save file
		$phpWord->save($path.'memo.docx','Word2007',false);
	}

	public function testX(){
		
		include APPPATH.'libraries\PhpWord\Autoloader.php';

		$auto = new Autoloader();
		$auto->register();

		$phpWord = new PhpOffice\PhpWord\PhpWord();

		$pur_number = '001/XXX.3/05/2017';
		$pur_id=47;

		$sql = "SELECT T3.*
				from tb_purchases T1 inner join tb_purchase_header T2 on T1.pur_number=T2.purchase_number
				inner join tb_purchase_request T3 on T3.purchase_id=T2.id
				WHERE T1.pur_id='".$pur_id."'";
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


		$sql = "SELECT * FROM tb_purchases where pur_id='".$pur_id."' ";
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


		$document->saveAs('documents/po/po-'.date('YmdHis').'.docx');
	}

}
