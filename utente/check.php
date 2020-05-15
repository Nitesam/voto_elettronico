<?php
    session_start();
?>
<html>
<body>
    <?php
    $conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
	$valida = 0;
	$bianca = 1;
	$nulla = 0;
	$contListe = 0;
	$contCandidato = 0;
	$idCandidati['0'] = 0;
	$idLista = 0;
	$cont_liste = 0;
	$liste['0'] = 0;
	
	
	
 
	for($i = 0; $i<$_SESSION['totaleListe']; $i++){
	   $a = $i.'l';
	   if(isset($_POST[$a])){
	       $bianca = 0;
	       $contListe++;
		   $idLista = $_POST[$a];
		   for($j = 0; $j<$_SESSION['totaleCandidati']; $j++){
		        if(isset($_POST[$j])){
				    $massimo = mysqli_query($conn, 'SELECT voto_elettronico.candidato.id_lista FROM voto_elettronico.candidato 
		            WHERE voto_elettronico.candidato.id = "'.$_POST[$j].'"');
				    if ($query = mysqli_fetch_array($massimo)){
			            if ($query['id_lista'] == $_POST[$a]){
						    $idCandidati[$contCandidato] = $_POST[$j];
							$idLista = $_POST[$a];
							$contCandidato++;
							
						
						} else{
						   $nulla = 1;
						
						
						}
						
		            }
				    
				    
				}
		   
		   
		   }
		   
	       
	   }
	   else{
	
	   
	   }
	}
	
	if($bianca == 1){
        
		for($j = 0; $j<$_SESSION['totaleCandidati']; $j++){
		        if(isset($_POST[$j])){
				    $massimo = mysqli_query($conn, 'SELECT voto_elettronico.candidato.id_lista FROM voto_elettronico.candidato 
		            WHERE voto_elettronico.candidato.id = "'.$_POST[$j].'"');
				    if ($query = mysqli_fetch_array($massimo)){
			            $liste[$cont_liste] = $query['id_lista'];
						$cont_liste++;
						
						$idCandidati[$contCandidato] = $_POST[$j];
						$contCandidato++;
		            }
				    
				    
				}
		   
		   
		   }
		
		   if($cont_liste > 0){
		        $bianca = 0;
		        for($j = 0; $j < $cont_liste-1; $j++){
				    if($liste[$j] != $liste[$j+1]){
					    $nulla = 1;
						$bianca = 0;
					}
					
				
					
				}
			
				
			}
			
			if($nulla == 0 && $bianca == 0){
			   
				$idLista = $liste[0];
				
				
			}
		
		
		
	}
			
		
	if($contListe > 1){
	    $nulla = 1;
	}
	
	if($nulla == 1){
		echo "<script type='text/javascript'> alert('Voto non valido, riprovare!'); </script>";
		echo "<script type=\"text/javascript\">location.href = 'scheda.php';</script>";
		return;
	}
	
		
	if(isset($_POST['nulla'])){
		$nulla = 1;
		$bianca = 0;
		$valida = 0;
	}
	
	
	
	
	//scheda
	$massimo = mysqli_query($conn, 'SELECT voto_elettronico.votazione.votato FROM voto_elettronico.votazione 
	WHERE voto_elettronico.votazione.id_elezione = "'.$_SESSION["idElezione"].'" AND 
	voto_elettronico.votazione.id_utente = "'.$_SESSION["idUtente"].'"');
	if ($query = mysqli_fetch_array($massimo)){
			$votato = $query['votato'];
	}
	$votato = $votato + 1;
	
	$sql = 'UPDATE voto_elettronico.votazione SET voto_elettronico.votazione.votato = "'.$votato.'" 
		WHERE voto_elettronico.votazione.id_elezione = "'.$_SESSION["idElezione"].'" AND 
	voto_elettronico.votazione.id_utente = "'.$_SESSION["idUtente"].'"';
		
		if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: <br>" . mysqli_error($conn);
        }
	
	
	if($nulla == 1){
		
		//votanti
		$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.votanti FROM voto_elettronico.elezione 
	WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
	
	if ($query = mysqli_fetch_array($massimo)){
			$votanti = $query['votanti'];
	}
	$votanti = $votanti + 1;
	
	$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.votanti = "'.$votanti.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
		
		if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: <br>" . mysqli_error($conn);
        }
	

		//scheda nulla
		$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.schede_nulle FROM voto_elettronico.elezione 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
					
		if ($query = mysqli_fetch_array($massimo)){
			$schede_nulle = $query['schede_nulle'];
		}
		$schede_nulle = $schede_nulle + 1;
	
		
		$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.schede_nulle = "'.$schede_nulle.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
		
		if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            //echo "Error updating record: <br>" . mysqli_error($conn);
        }
	
	}
	else if($bianca == 1){	
	
	   //votanti
		$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.votanti FROM voto_elettronico.elezione 
	WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
	
	if ($query = mysqli_fetch_array($massimo)){
			$votanti = $query['votanti'];
	}
	$votanti = $votanti + 1;
	
	$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.votanti = "'.$votanti.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
		
		if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: <br>" . mysqli_error($conn);
        }
	   
	   $massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.schede_bianche FROM voto_elettronico.elezione 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
					
		if ($query = mysqli_fetch_array($massimo)){
			$schede_bianche = $query['schede_bianche'];
		}
		$schede_bianche = $schede_bianche + 1;
		
		$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.schede_bianche = "'.$schede_bianche.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
	   
	   if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            //echo "Error updating record: <br>" . mysqli_error($conn);
        }
	     
	   
	}
	else {	
	    
		if($contCandidato > $_SESSION['maxCandidati']){
		echo "<script type='text/javascript'> alert('Voto non valido, riprovare!'); </script>";
		echo "<script type=\"text/javascript\">location.href = 'scheda.php';</script>";
		return;
	    }
		
		
		
		
		
		//votanti
		$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.votanti FROM voto_elettronico.elezione 
	WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
	
	if ($query = mysqli_fetch_array($massimo)){
			$votanti = $query['votanti'];
	}
	$votanti = $votanti + 1;
	
	$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.votanti = "'.$votanti.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
		
		if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: <br>" . mysqli_error($conn);
        }
	
	
	
	
	
	
	
	
	
	
	
		
		$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.schede_valide FROM voto_elettronico.elezione 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION["idElezione"].'"');
		
		if ($query = mysqli_fetch_array($massimo)){
			$schede_valide = $query['schede_valide'];
		}
		$schede_valide = $schede_valide + 1;
		
		$sql = 'UPDATE voto_elettronico.elezione SET voto_elettronico.elezione.schede_valide = "'.$schede_valide.'" 
		WHERE voto_elettronico.elezione.id = "'.$_SESSION['idElezione'].'"';
	   
	   if (mysqli_query($conn, $sql)) {
           // echo "Record updated successfully<br>";
        } else {
           // echo "Error updating record: <br>" . mysqli_error($conn);
        }
		
		
		   $massimo = mysqli_query($conn, 'SELECT voto_elettronico.lista.totale_voti FROM voto_elettronico.lista 
		   WHERE voto_elettronico.lista.id = "'.$idLista.'"');
		   
		   if ($query = mysqli_fetch_array($massimo)){
			   $totale_voti = $query['totale_voti'];
			}
			
			$totale_voti = $totale_voti + 1;
			
			$sql = 'UPDATE voto_elettronico.lista SET voto_elettronico.lista.totale_voti = "'.$totale_voti.'" 
		    WHERE voto_elettronico.lista.id = "'.$idLista.'"';
	   
	       if (mysqli_query($conn, $sql)) {
             // echo "Record updated successfully<br>";
           } else {
            //echo "Error updating record: <br>" . mysqli_error($conn);
           }
		
		
		
		if($contCandidato > 0 && $contCandidato <= $_SESSION['maxCandidati']){
		    for($i = 0; $i<$contCandidato; $i++){
			    $massimo = mysqli_query($conn, 'SELECT voto_elettronico.candidato.totale_voti FROM voto_elettronico.candidato 
		        WHERE voto_elettronico.candidato.id = "'.$idCandidati[$i].'"');
				
				if ($query = mysqli_fetch_array($massimo)){
			        $totale_voti = $query['totale_voti'];
			    }
			    $totale_voti = $totale_voti + 1;
				
				$sql = 'UPDATE voto_elettronico.candidato SET voto_elettronico.candidato.totale_voti = "'.$totale_voti.'" 
		        WHERE voto_elettronico.candidato.id = "'.$idCandidati[$i].'"';
				
				if (mysqli_query($conn, $sql)) {
                    //echo "Record updated successfully<br>";
                } else {
                   // echo "Error updating record: <br>" . mysqli_error($conn);
                }
			   
			}
		   
		   
		  
		
		}
		
		
		
		
		
	}
	
      
       echo "<script type=\"text/javascript\">location.href = 'votazioni_aperte.php';</script>";

    $conn->close();
    ?>
</body>
</html>