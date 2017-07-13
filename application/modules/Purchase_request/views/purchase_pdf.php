<?php 

	class PDF extends FPDF_Custom
	{
		private $data;
		private $header;

		function __construct($header,$data){
			parent::__construct();
			$this->header 	= $header;
			$this->data 	= $data;
		}

		function Header(){
		    
		    $this->setFillColor(255,255,255);

			$this->Ln(0);	
		    $this->setFont('Arial','',12);
			$this->cell(0,5,'FAMILY HEALTH INTERNATIONAL (FHI 360)',0,0,'C',1);
			$this->Ln(6);	
			$this->cell(0,5,'INDONESIA COUNTRY OFFICE',0,0,'C',1);
			
			$this->Ln(13);	
		    

		    $this->setFont('Arial','',11);
			$this->cell(0,10,'PURCHASE REQUEST FORM',0,0,'C',1);
			
			$this->Image('images/logos/FHI_360.png',5,8,35,15);
		}
	 
		function Content()
		{
			/*Header Document*/
	        // Content PDF          
	        $this->setFont('Arial','',10);

			$this->Ln(20);	
			$this->cell(35,5,'TO',0,0,'L',0);
			$this->cell(5,5,' : ',0,0,'C',0);
				$this->cell(50,5,'Finance',0,0,'L',0);	
			$this->cell(15,5,'',0,0,'L',0);
			$this->cell(20,5,'GFAS No.',0,0,'L',0);
			$this->cell(5,5,' : ',0,0,'C',0);
				$this->cell(50,5,$this->header['gfas'],0,0,'L',0);	

			$this->Ln();	
			$this->cell(35,5,'DATE',0,0,'L',0);
			$this->cell(5,5,' : ',0,0,'C',0);
				$this->cell(50,5,$this->header['tanggal'],0,0,'L',0);
			$this->cell(15,5,'',0,0,'L',0);
			$this->cell(20,5,'PR No.',0,0,'L',0);
			$this->cell(5,5,' : ',0,0,'C',0);
				$this->cell(50,5,$this->header['purchase_number'],0,0,'L',0);	

			$this->Ln();	
			$this->cell(35,5,'REQUESTED BY',0,0,'L',0);
			$this->cell(5,5,' : ',0,0,'C',0);
				$this->cell(100,5,$this->header['username'],0,0,'L',0);
			$this->Ln(10);	

			/*Detail Document*/
	        $this->setFont('Arial','B',8);

	        if ($this->header['purchase_type']=='SERVICES'){ // untuk Service Request

				$this->MultiAlignCell(45,16,'ITEM',1,0,'C',0);
				$this->MultiAlignCell(100,16,'DESCRIPTION',1,0,'C',0);
			    $this->MultiAlignCell(15,16,'QTY',1,0,'C',0);
			    $this->MultiAlignCell(20,16,'UNIT',1,0,'C',0);
				// $this->Ln();
		        $this->setFont('Arial','',8);
		        $this->setFillColor(255,255,255);
				
				$rowHeight = 5;
				$total = 0;
				$no = 1;
				foreach ($this->data as $key => $value) {
					$description = $value['description'];
					$rowHeight = intval(((strlen($description)/80)) * 5); 
					if (intval($rowHeight) == 0){
						$rowHeight = 5;
					}

					$this->Ln();
					$this->cell(45,$rowHeight,$value['item'],1,0,'L',1);
					$this->MultiAlignCell(100,5,$value['description'],1,0,'L',1);
				    $this->cell(15,$rowHeight,$value['qty'],1,0,'L',1);
				    $this->cell(20,$rowHeight,$value['unit'],1,0,'L',1);
				    // $this->cell(30,$rowHeight,number_format($value['unit_price']),1,0,'R',1);
				    // $this->cell(30,$rowHeight,number_format($value['qty'] * $value['unit_price']),1,0,'R',1);

				}

				$this->Ln();
				$this->cell(45,$rowHeight,'',1,0,'L',1);
				$this->MultiAlignCell(100,5,'Grand Total',1,0,'R',1);
			    $this->cell(15,$rowHeight,'',1,0,'L',1);
			    $this->cell(20,$rowHeight,'',1,0,'L',1);
			    // $this->cell(30,$rowHeight,'',1,0,'L',1);
			    // $this->cell(30,$rowHeight,number_format($total),1,0,'R',1);
				$this->Ln();

	        } else if ($this->header['purchase_type']=='STUFF') { // untuk Consumable Stuff

				$this->MultiAlignCell(30,16,'CATEGORY',1,0,'C',0);
				$this->MultiAlignCell(55,16,'ITEM',1,0,'C',0);
			    $this->MultiAlignCell(15,16,'QTY',1,0,'C',0);
			    $this->MultiAlignCell(20,16,'UNIT',1,0,'C',0);
			    $this->MultiAlignCell(30,16,'UNIT PRICE',1,0,'C',0);
			    $this->MultiAlignCell(30,8,'TOTAL ESTIMATED COST',1,0,'C',0);
				$this->Ln();
		        $this->setFont('Arial','',8);
		        $this->setFillColor(255,255,255);
				
				$rowHeight = 5;
				$total = 0;
				$no = 1;
				foreach ($this->data as $key => $value) {
					$description = $value['description'];
				    $total += ($value['qty'] * $value['unit_price']);
					$rowHeight = intval(((strlen($description)/50)) * 5); 
					if (intval($rowHeight) == 0){
						$rowHeight = 5;
					}

					$this->Ln();
					$this->cell(30,$rowHeight,$value['stuff_category'],1,0,'L',1);
					$this->MultiAlignCell(55,5,$value['item'],1,0,'L',1);
				    $this->cell(15,$rowHeight,$value['qty'],1,0,'L',1);
				    $this->cell(20,$rowHeight,$value['unit'],1,0,'L',1);
				    $this->cell(30,$rowHeight,number_format($value['unit_price']),1,0,'R',1);
				    $this->cell(30,$rowHeight,number_format($value['qty'] * $value['unit_price']),1,0,'R',1);

				}

				$this->Ln();
				$this->cell(30,$rowHeight,'',1,0,'L',1);
				$this->MultiAlignCell(55,5,'Grand Total',1,0,'R',1);
			    $this->cell(15,$rowHeight,'',1,0,'L',1);
			    $this->cell(20,$rowHeight,'',1,0,'L',1);
			    $this->cell(30,$rowHeight,'',1,0,'L',1);
			    $this->cell(30,$rowHeight,number_format($total),1,0,'R',1);
				$this->Ln();

	        } else { // untuk Purchase Request

				$this->MultiAlignCell(15,16,'ITEM',1,0,'C',0);
				$this->MultiAlignCell(70,16,'DESCRIPTION',1,0,'C',0);
			    $this->MultiAlignCell(15,16,'QTY',1,0,'C',0);
			    $this->MultiAlignCell(20,16,'UNIT',1,0,'C',0);
			    $this->MultiAlignCell(30,16,'UNIT PRICE',1,0,'C',0);
			    $this->MultiAlignCell(30,8,'TOTAL ESTIMATED COST',1,0,'C',0);
				$this->Ln();
		        $this->setFont('Arial','',8);
		        $this->setFillColor(255,255,255);
				
				$rowHeight = 5;
				$total = 0;
				$no = 1;
				foreach ($this->data as $key => $value) {
					$description = $value['description'];
				    $total += ($value['qty'] * $value['unit_price']);
					$rowHeight = intval(((strlen($description)/70)) * 5); 
					if (intval($rowHeight) == 0){
						$rowHeight = 5;
					}

					$this->Ln();
					$this->cell(15,$rowHeight,$no++,1,0,'L',1);
					$this->MultiAlignCell(70,5,$value['description'],1,0,'L',1);
				    $this->cell(15,$rowHeight,$value['qty'],1,0,'L',1);
				    $this->cell(20,$rowHeight,$value['unit'],1,0,'L',1);
				    $this->cell(30,$rowHeight,number_format($value['unit_price']),1,0,'R',1);
				    $this->cell(30,$rowHeight,number_format($value['qty'] * $value['unit_price']),1,0,'R',1);

				}

				$this->Ln();
				$this->cell(15,$rowHeight,'',1,0,'L',1);
				$this->MultiAlignCell(70,5,'Grand Total',1,0,'R',1);
			    $this->cell(15,$rowHeight,'',1,0,'L',1);
			    $this->cell(20,$rowHeight,'',1,0,'L',1);
			    $this->cell(30,$rowHeight,'',1,0,'L',1);
			    $this->cell(30,$rowHeight,number_format($total),1,0,'R',1);
				$this->Ln();
	        }

	        $this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(35,5,"Requestor's justification & selection me",0,0,'L',0);
			$this->Ln();
		    $this->cell(180,15,$this->header['justification'],1,0,'L',1);
			$this->Ln();

			$this->Ln();	
			$this->cell(40,5,'Requested by',0,0,'L',0);

				$pos_x = $this->getX();
				$pos_y = $this->getY();
				if ($this->header['signature'] <> ""){
					$file = $this->header['path'].$this->header['signature'];
					if (file_exists($file)){
						$this->Image($file,$pos_x,$pos_y-8,40,15);  		
					}		
				}

				$this->cell(70,5,'',0,0,'L',0);
			$this->cell(15,5,'DATE',0,0,'L',0);
				$this->cell(50,5,$this->header['tanggal'],0,0,'L',0);
			$this->Ln(2);
			$this->cell(40,5,'',0,0,'L',0);
				$this->cell(70,5,'____________________________',0,0,'L',0);
			$this->cell(15,5,'',0,0,'L',0);
				$this->cell(100,5,'____________________________',0,0,'L',0);

			$this->Ln();
				$this->cell(40,5,'',0,0,'L',0);
				$this->cell(85,5,$this->header['username'],0,0,'L',0);
	        	$this->setFont('Arial','',6);
				$this->cell(100,5,'MONTH/DAY/YEAR',0,0,'L',0);
	        	$this->setFont('Arial','',8);
			$this->Ln();	

			// $this->Ln(10);
			// $this->setFont('Arial','',10);
			// $this->cell(40,5,'Finance Reviewed by',0,0,'L',0);
			// 	$this->cell(70,5,'____________________________',0,0,'L',0);
			// $this->cell(15,5,'',0,0,'L',0);
			// 	$this->cell(100,5,'____________________________',0,0,'L',0);
			// $this->Ln();
	  		// 	$this->setFont('Arial','',6);
			// 	$this->cell(125,5,'Sabrina Savage/Finance and Operations Manager',0,0,'L',0);
			// 	$this->cell(100,5,'MONTH/DAY/YEAR',0,0,'L',0);
	  		//	$this->setFont('Arial','',8);
			// $this->Ln();	


			$this->Ln(10);	
			$this->setFont('Arial','',10);
			$this->cell(40,5,'FCO Monitor & Approval',0,0,'L',0);
				$this->cell(70,5,'____________________________',0,0,'L',0);
			$this->cell(15,5,'',0,0,'L',0);
				$this->cell(100,5,'____________________________',0,0,'L',0);
			$this->Ln();
	        	$this->setFont('Arial','',6);
				$this->cell(125,5,'Caroline Francis/ Chief Representative LINKAGES',0,0,'L',0);
				$this->cell(100,5,'MONTH/DAY/YEAR',0,0,'L',0);
	        	$this->setFont('Arial','',8);
			$this->Ln();	
			
			$this->Ln(10);

			
		}

		function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='C',$fill=0)
		{
		    // Store reset values for (x,y) positions
		    $x = $this->GetX() + $w;
		    $y = $this->GetY();

		    // Make a call to FPDF's MultiCell
		    $this->MultiCell($w,$h,$text,$border,$align,$fill);

		    // Reset the line position to the right, like in Cell
		    if( $ln==0 )
		    {
		        $this->SetXY($x,$y);
		    }
		}
	}

	$pdf = new PDF($header, $data);

	$pdf->AliasNbPages();
	$pdf->AddPage('P');

	$pdf->Content();
	
	// create local pdf file
	$path 		= $this->config->item('purchase_path');
	$filename 	= "purchase".$header['number']."-".date('m')."-".date('Y').".pdf";
	if (!file_exists($path.$filename)) {
		$pdf->Output($path.$filename,'F');
	}
	
	// $pdf->Output();
?>