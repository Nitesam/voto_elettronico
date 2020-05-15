<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="it">
<style>
    
</style>
<head>
    <meta charset="UTF-8">
  
</head>
<body>
    <?php
			require('../library/fpdf.php');
			
            $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );

            if ($conn->connect_error) {
                die("Lettura Fallita: " . $conn->connect_error);
            }
            
			
			//$pdf->Cell(40,10,$row['nome'].' apertura: '.$dataApertura.' '.$row['ora_chiusura'].' chiusura: '.$dataChiusura.' '.$row['ora_chiusura'], 0, 0, 'C');
				
 			
			ob_start();
			$pdf = new FPDF('p', 'mm', 'A4');
			$pdf->AddPage();
			
			$results = mysqli_query($conn,"SELECT * FROM voto_elettronico.elezione 
			WHERE voto_elettronico.elezione.id = '".$_POST['elezione']."'");
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->Cell(75, 10, '',0, 0, 'C');
			$pdf->Cell(35, 10, 'IT ARCHIMEDE',0, 1, 'C');
			$pdf->Cell(25, 10, '',0, 1, 'C');
			
			if($row = mysqli_fetch_array($results)){
				$dataApertura = implode("/", array_reverse(explode("-", $row['data_apertura'])));
				$dataChiusura = implode("/", array_reverse(explode("-", $row['data_chiusura'])));
				$dataApertura = $dataApertura." ".$row['ora_apertura'];
				$dataChiusura = $dataChiusura." ".$row['ora_chiusura'];
				
				$pdf->Cell(20, 10, $row['nome'],0, 1, 'C');
				
			    $pdf->Cell(35, 10, 'Data apertura',1, 0, 'C');
			    $pdf->Cell(35, 10, 'Data chiusura',1, 0, 'C');
			    $pdf->Cell(14, 10, 'Iscritti',1, 0, 'C');
			    $pdf->Cell(14, 10, 'Votanti',1, 0, 'C');
			    $pdf->Cell(25, 10, 'Schede Valide',1, 0, 'C');
			    $pdf->Cell(29, 10, 'Schede Bianche',1, 0, 'C');
			    $pdf->Cell(25, 10, 'Schede Nulle',1, 1, 'C');
				
				
				
				
			    $pdf->SetFont('Arial', '', 10);
			    $pdf->Cell(35, 10, $dataApertura,1, 0, 'C');
				$pdf->Cell(35, 10, $dataChiusura,1, 0, 'C');
			    $pdf->Cell(14, 10, $row['iscritti'],1, 0, 'C');
			    $pdf->Cell(14, 10, $row['votanti'],1, 0, 'C');
			    $pdf->Cell(25, 10, $row['schede_valide'],1, 0, 'C');
			    $pdf->Cell(29, 10, $row['schede_bianche'],1, 0, 'C');
			    $pdf->Cell(25, 10, $row['schede_nulle'],1, 1, 'C');
				$pdf->Cell(25, 10, '',0, 1, 'C');
				
			}
			
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->Cell(20, 10, 'Risultati:',0, 1, 'C');
			
			$results = mysqli_query($conn,"SELECT * FROM voto_elettronico.lista 
			WHERE voto_elettronico.lista.id_elezione = '".$_POST['elezione']."'");
			
			$pdf->Cell(89, 10, 'Liste',1, 0, 'C');
			$pdf->Cell(89, 10, 'Voti',1, 1, 'C');
			$pdf->SetFont('Arial', '', 10);
			while($row = mysqli_fetch_array($results)){
				
				$pdf->Cell(89, 10, $row['nome'],1, 0, 'C');
				$pdf->Cell(89, 10, $row['totale_voti'],1, 1, 'C');
			
			}
			$pdf->Cell(25, 10, '',0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->Cell(59.5, 10, 'Candidati',1, 0, 'C');
			$pdf->Cell(59.5, 10, 'Lista',1, 0, 'C');
			$pdf->Cell(59.5, 10, 'Voti',1, 1, 'C');
			
			$results = mysqli_query($conn,"SELECT voto_elettronico.candidato.nome, voto_elettronico.candidato.cognome, 
			voto_elettronico.candidato.totale_voti, voto_elettronico.lista.nome AS nomeLista 
			FROM voto_elettronico.candidato INNER JOIN voto_elettronico.lista ON 
			voto_elettronico.candidato.id_lista = voto_elettronico.lista.id 
			WHERE voto_elettronico.candidato.id_elezione = '".$_POST['elezione']."'");
			
			$pdf->SetFont('Arial', '', 10);
			
			while($row = mysqli_fetch_array($results)){
				
				$pdf->Cell(59.5, 10, $row['nome'].' '.$row['cognome'],1, 0, 'C');
				$pdf->Cell(59.5, 10, $row['nomeLista'],1, 0, 'C');
				$pdf->Cell(59.5, 10, $row['totale_voti'],1, 1, 'C');
			
			}
			
			$pdf->OutPut();
			ob_end_flush();
		
	        $conn->close();

	?>



</body>
</html>