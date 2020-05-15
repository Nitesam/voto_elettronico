<?php
	session_start();

	$conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
	
			
		
	
		$sql = "INSERT INTO voto_elettronico.elezione (nome, data_apertura, ora_apertura, data_chiusura, ora_chiusura, max_candidati, iscritti, id_tipologia_utente)
			VALUES ('". $_POST["nome"] . "', '". $_POST["dataApertura"] . "', '" . $_POST["timeApertura"] . "' , '". $_POST["dataChiusura"] . 
			"' , '". $_POST["timeChiusura"] . "' , '". $_POST["candidati"] . "' , '". $_POST["iscritti"] . "' , '". $_POST["tipologia"] . "')";
	   
		$conn->query($sql);
	
		$results = mysqli_query($conn,'SELECT voto_elettronico.elezione.id 
		FROM voto_elettronico.elezione                  
		WHERE voto_elettronico.elezione.nome = "'.$_POST["nome"].'"');
					
		if($row = mysqli_fetch_array($results)) {
			$idElezione = $row['id'];   
		}
		
		$results = mysqli_query($conn,'SELECT voto_elettronico.utente.id 
		FROM voto_elettronico.utente                    
		WHERE voto_elettronico.utente.id_tipologia_utente = "'.$_POST["tipologia"].'"');
		
		if($_POST["tipologia"] == 'Studente'){

			while($row = mysqli_fetch_array($results)) {

				$sql = "INSERT INTO voto_elettronico.votazione (abilitato, votato, id_utente, id_elezione)
				VALUES ('0', '0', '" . $row['id'] . "' , '". $idElezione . "')";

				if($conn->query($sql) === TRUE) 
					echo "New record created succefully";
				else
					echo "Error: ". $conn->error;


			}

		}
		else{

			while($row = mysqli_fetch_array($results)) {

				$sql = "INSERT INTO voto_elettronico.votazione (abilitato, votato, id_utente, id_elezione)
				VALUES ('1', '0', '" . $row['id'] . "' , '". $idElezione . "')";

				if($conn->query($sql) === TRUE) 
					echo "New record created succefully";
				else
					echo "Error: ". $conn->error;


			}



		}
		
		
		


	echo "<script type=\"text/javascript\">location.href = 'elezioni.php';</script>";

	$conn->close();

?>