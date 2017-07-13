<?php 

	// class PDF extends FPDF
	// {

	// 	function __construct(){
	// 		parent::__construct();
	// 	}

	// 	//Page header
	// 	function Header()
	// 	{	                
	//         // $this->Ln(12);
	//         // $this->setFont('Arial','',12);
	//         // $this->setFillColor(255,255,255);
	//         // $this->setFont('Arial','',10);	
	//         // $this->cell(100,6,"Tanggal Cetak : ".date('d M Y'),0,1,'L',1); 
	        
	        
	//         // $this->Ln(5);
	//         // $this->setFont('Arial','',10);
	//         // $this->setFillColor(230,230,200);	                
	// 	}
	 
	// 	function Content()
	// 	{
	//         // Content PDF          
	//         $this->setFont('Arial','BU',14);
	//         $this->cell(0,10,"TANDA TERIMA",0,0,'C',0); 
	// 		$this->Ln(5);	
	//         $this->setFont('Arial','',10);
	//         $this->cell(0,10,"001/".date('m')."/".date('y'),0,0,'C',0); 

	// 		$this->Ln(20);	
	// 		$this->cell(35,5,'Sudah terima dari',0,0,'L',0);
	// 		$this->cell(5,5,' : ',0,0,'C',0);
	// 			$this->cell(100,5,'FHI 360 CO Jakarta',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'Received From',0,0,'L',0);
	// 		$this->Ln();	

	// 		$this->Ln();	
	// 		$this->cell(35,5,'Diberikan kepada',0,0,'L',0);
	// 		$this->cell(5,5,' : ',0,0,'C',0);
	// 			$this->cell(100,5,'Mega Lisna',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'Give To',0,0,'L',0);
	// 		$this->Ln();	

	// 		$this->Ln();	
	// 		$this->cell(35,5,'Tanggal Penerimaan',0,0,'L',0);
	// 		$this->cell(5,5,' : ',0,0,'C',0);
	// 			$this->cell(100,5,'20 January 2016',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'Date Received',0,0,'L',0);
	// 		$this->Ln();	

	// 		$this->Ln();	
	// 		$this->cell(35,5,'Bentuk Penerimaan',0,0,'L',0);
	// 		$this->cell(5,5,' : ',0,0,'C',0);
	//         	$this->setFont('Arial','B',10);
	// 			$this->cell(100,5,'1(satu) Unit Laptop',0,0,'L',0);
	//         	$this->setFont('Arial','',10);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'Type Received',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	// 			$this->cell(15,5,'Merk',0,0,'L',0);
	// 			$this->cell(5,5,':',0,0,'L',0);
	// 			$this->cell(5,5,'LENOVO',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	// 			$this->cell(15,5,'Type',0,0,'L',0);
	// 			$this->cell(5,5,':',0,0,'L',0);
	// 			$this->cell(5,5,'20BU-001BID',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	// 			$this->cell(15,5,'Serial No',0,0,'L',0);
	// 			$this->cell(5,5,':',0,0,'L',0);
	// 			$this->cell(5,5,'PC-07MRU-6',0,0,'L',0);
	// 		$this->Ln();

	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	//         	$this->setFont('Arial','B',10);
	// 			$this->cell(100,5,'1(satu) Unit Adaptor',0,0,'L',0);
	//         	$this->setFont('Arial','',10);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	// 			$this->cell(15,5,'Merk',0,0,'L',0);
	// 			$this->cell(5,5,':',0,0,'L',0);
	// 			$this->cell(5,5,'LENOVO',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	// 			$this->cell(15,5,'Type',0,0,'L',0);
	// 			$this->cell(5,5,':',0,0,'L',0);
	// 			$this->cell(5,5,'11545N0257ZX175765M6',0,0,'L',0);
	// 		$this->Ln();	

	// 		$this->Ln();	
	// 		$this->cell(35,5,'',0,0,'L',0);
	// 		$this->cell(5,5,'',0,0,'C',0);
	//         	$this->setFont('Arial','B',10);
	// 			$this->cell(100,5,'1(satu) Unit Back Pack Lenovo',0,0,'L',0);
	//         	$this->setFont('Arial','',10);

	// 		$this->Ln();

	// 		$this->Ln(35);	
	// 		$this->cell(35,5,'Yang Menyerahkan',0,0,'L',0);
	// 		$this->cell(100,5,'',0,0,'L',0);
	// 		$this->cell(35,5,'Yang Menerima',0,0,'L',0);
	// 		$this->Ln();	
	// 		$this->cell(35,5,'Received From',0,0,'L',0);
	// 		$this->cell(100,5,'',0,0,'L',0);
	// 		$this->cell(35,5,'Received By',0,0,'L',0);
	// 		$this->Ln(24);	
	//         $this->setFont('Arial','U',10);
	// 		$this->cell(35,5,'Dieny Roswany',0,0,'L',0);
	// 		$this->cell(100,5,'',0,0,'L',0);
	// 		$this->cell(35,5,'Mega Lisna',0,0,'L',0);
	// 	}

	// 	function Footer()
	// 	{
	// 		// //atur posisi 1.5 cm dari bawah
	// 		// $this->SetY(-15);
	// 		// //buat garis horizontal
	// 		// $this->Line(10,$this->GetY(),285,$this->GetY());
	// 		// //Arial italic 9
	// 		// $this->SetFont('Arial','I',9);
	//   		// $this->Cell(0,10,'2016 ',0,0,'L');
	// 		// //nomor halaman
	// 		// $this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	// 	}

	// 	function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='C',$fill=0)
	// 	{
	// 	    // Store reset values for (x,y) positions
	// 	    $x = $this->GetX() + $w;
	// 	    $y = $this->GetY();

	// 	    // Make a call to FPDF's MultiCell
	// 	    $this->MultiCell($w,$h,$text,$border,$align,$fill);

	// 	    // Reset the line position to the right, like in Cell
	// 	    if( $ln==0 )
	// 	    {
	// 	        $this->SetXY($x,$y);
	// 	    }
	// 	}
	// }

	//$pdf = new PDF();

	$pdf->AliasNbPages();
	$pdf->AddPage('P');

    // Content PDF          
    $pdf->setFont('Arial','BU',14);
    $pdf->cell(0,10,"TANDA TERIMA",0,0,'C',0); 
	$pdf->Ln(5);	
    $pdf->setFont('Arial','',10);
    $pdf->cell(0,10,"001/".date('m')."/".date('y'),0,0,'C',0); 

	$pdf->Ln(20);	
	$pdf->cell(35,5,'Sudah terima dari',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5,'FHI 360 CO Jakarta',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Received From',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Diberikan kepada',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5,'Mega Lisna',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Give To',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Tanggal Penerimaan',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
		$pdf->cell(100,5,'20 January 2016',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Date Received',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'Bentuk Penerimaan',0,0,'L',0);
	$pdf->cell(5,5,' : ',0,0,'C',0);
    	$pdf->setFont('Arial','B',10);
		$pdf->cell(100,5,'1(satu) Unit Laptop',0,0,'L',0);
    	$pdf->setFont('Arial','',10);
	$pdf->Ln();	
	$pdf->cell(35,5,'Type Received',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Merk',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,'LENOVO',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Type',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,'20BU-001BID',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Serial No',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,'PC-07MRU-6',0,0,'L',0);
	$pdf->Ln();

	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
    	$pdf->setFont('Arial','B',10);
		$pdf->cell(100,5,'1(satu) Unit Adaptor',0,0,'L',0);
    	$pdf->setFont('Arial','',10);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Merk',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,'LENOVO',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
		$pdf->cell(15,5,'Type',0,0,'L',0);
		$pdf->cell(5,5,':',0,0,'L',0);
		$pdf->cell(5,5,'11545N0257ZX175765M6',0,0,'L',0);
	$pdf->Ln();	

	$pdf->Ln();	
	$pdf->cell(35,5,'',0,0,'L',0);
	$pdf->cell(5,5,'',0,0,'C',0);
    	$pdf->setFont('Arial','B',10);
		$pdf->cell(100,5,'1(satu) Unit Back Pack Lenovo',0,0,'L',0);
    	$pdf->setFont('Arial','',10);

	$pdf->Ln();

	$pdf->Ln(35);	
	$pdf->cell(35,5,'Yang Menyerahkan',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'Yang Menerima',0,0,'L',0);
	$pdf->Ln();	
	$pdf->cell(35,5,'Received From',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'Received By',0,0,'L',0);
	$pdf->Ln(24);	
    $pdf->setFont('Arial','U',10);
	$pdf->cell(35,5,'Dieny Roswany',0,0,'L',0);
	$pdf->cell(100,5,'',0,0,'L',0);
	$pdf->cell(35,5,'Mega Lisna',0,0,'L',0);

	// $pdf->Output();

?>