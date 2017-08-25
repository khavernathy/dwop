<?php
if (isset($_POST['go']))
{
	require("fpdf/fpdf.php");
	
	// syntax for Cell() is Y from top, X from left, data, border, line, align
	
	$pdf = new FPDF( );
	
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','B',16);
	
	$pdf->Cell(10,10,'Invoice',0,1,'L');
	
	$pdf->Cell(90,10,$_POST['data'],1,0,'C');
	
	$pdf->Output('test_pdf.pdf','D');
}
else
{
?>

<html>
<head><title>Yo</title>
</head>

<body>
<form action="" method="post">
<input type="text" name="data">
<input type="submit" name="go" value="Give me the pdf" />
</form>
</body>
</html>
<?php } ?>

