<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="it">
<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
<head>
    <meta charset="UTF-8">
    <title>Classe</title>
</head>
<body>
<div>
    <form action="classe.php" method="POST">
        
        <label for="elezione">Seleziona Elezione</label>
        <select id="elezione" name="elezione">
		<?php
					
            $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );

            if ($conn->connect_error) {
                die("Lettura Fallita: " . $conn->connect_error);
            } else{
                echo "Lettura avvenuta con successo.<br> Di seguito la lista delle elezioni: <br> <br>";
            }
			
			$results = mysqli_query($conn,"SELECT voto_elettronico.tipologia_utente.id 
			 FROM voto_elettronico.tipologia_utente 
			 WHERE voto_elettronico.tipologia_utente.tipologia = 'Studente'");
			 if($row = mysqli_fetch_array($results))
				$idTipologia = $row['id'];
			
			 $results = mysqli_query($conn,"SELECT voto_elettronico.elezione.id, voto_elettronico.elezione.nome 
			 FROM voto_elettronico.elezione 
			 WHERE voto_elettronico.elezione.id_tipologia_utente = '".$idTipologia."'");

			while($row = mysqli_fetch_array($results)) {	
                echo '<option value="'.$row["id"].'">'.$row["nome"].'</option>'	;

			}			
		?>
        </select>
		
		<label for="classe">Seleziona Classe</label>
        <select id="classe" name="classe">
		<?php
					

            if ($conn->connect_error) {
                die("Lettura Fallita: " . $conn->connect_error);
            } else{
                echo "Lettura avvenuta con successo.<br> Di seguito la lista delle elezioni: <br> <br>";
            }
			 $results = mysqli_query($conn,"SELECT voto_elettronico.classe.id, voto_elettronico.classe.classe 
			 FROM voto_elettronico.classe");

			while($row = mysqli_fetch_array($results)) {	
                echo '<option value="'.$row["id"].'">'.$row["classe"].'</option>'	;

			}

	        $conn->close();
		
		?>
        </select>
		
        <input type="submit" value="Invia" onclick="location.href='classi.php';">
    </form>
</div>

</body>
</html>