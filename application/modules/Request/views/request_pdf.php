<?php 

	$pdf->AliasNbPages();
	$pdf->AddPage('P');

    // Content PDF          
    $pdf->setFont('Arial','BU',14);
    $pdf->cell(0,10,"TANDA TERIMA",0,0,'C',0); 
	$pdf->Ln(5);	
    $pdf->setFont('Arial','',10);
    $pdf->cell(0,10,"Receive No.#".$data->request_number,0,0,'C',0); 

	$pdf->Ln(20);	
	$pdf->cell(35,5,'Sudah terima dari',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5,$data->loca_name.' '.$data->loca_province,0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Received From',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Diberikan kepada',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5, $data->username,0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Give To',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Tanggal Penerimaan',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5,$data->tanggal,0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Date Received',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Bentuk Penerimaan',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
    	$pdf->setFont('Arial','B',10);
		$pdf->cell(100,5,'1(satu) Unit '.$data->item,0,0,'L',0);
    	$pdf->setFont('Arial','',10);
	$pdf->Ln();	
	$pdf->cell(35,5,'Type Received',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Merk',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,$data->brand,0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Type',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,$data->list_model,0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Serial No',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,$data->list_sn,0,0,'L',0);
	$pdf->Ln();

	$pdf->Ln(35);	
	$pdf->cell(35,5,'Yang Menyerahkan',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'Yang Menerima',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Received From',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'Received By',0,0,'L',0);
	$pdf->Ln(12);	

	$pos_y = $pdf->getY();
	if ($data->signatureTo <> ""){
		if (file_exists($data->path.$data->signatureTo)){
			$pdf->Image(@$data->path.$data->signatureTo,10,$pos_y,40,15);  		
		}		
	}
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'',0,0,'L',0);
	if ($data->signatureUser <> ""){
		if (file_exists($data->path.$data->signatureUser)){
			$pdf->Image($data->path.$data->signatureUser,140,$pos_y,40,15); 		
		}
	}

	$pdf->Ln(20);	
    $pdf->setFont('Arial','U',10);
	$pdf->cell(35,5,$data->userTo,0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,$data->username,0,0,'L',0);

	$pdf->Output();

?>