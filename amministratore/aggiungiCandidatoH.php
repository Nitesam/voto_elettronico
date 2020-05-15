<!DOCTYPE html>
<?php
    session_start();

    $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
	if ($conn->connect_error) {
                die("Lettura Fallita: " . $conn->connect_error);
            } else{
               // echo "Lettura avvenuta con successo.<br> Di seguito la lista delle elezioni: <br> <br>";
            }
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
    <form action="aggiungiCandidato.php" method="POST">
        <label for="year">Candidato</label>
        <input type="text" id="nome" name="nome" placeholder="Nome candidato (ES: Silvio)" required>
		<input type="text" id="cognome" name="cognome" placeholder="Cognome candidato (ES: Berlusconi)" required>
</select>
		
		<label for="elezione">Seleziona Elezione</label>
        <select id="elezione" name="elezione" required>
		<?php
		     $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
			 
			 
			
			 $results = mysqli_query($conn,"SELECT voto_elettronico.elezione.id, voto_elettronico.elezione.nome 
			 FROM voto_elettronico.elezione");

			while($row = mysqli_fetch_array($results)) {	
                echo '<option value="'.$row["id"].'">'.$row["nome"].'</option>'	;

			}			
		?>
        </select>
		
		<label for="lista">Seleziona Lista</label>
        <select id="lista" name="lista" required>
		<?php
		     $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
			 
			 
			
			 $results = mysqli_query($conn,"SELECT voto_elettronico.lista.id, voto_elettronico.lista.nome 
			 FROM voto_elettronico.lista");

			while($row = mysqli_fetch_array($results)) {	
                echo '<option value="'.$row["id"].'">'.$row["nome"].'</option>'	;

			}			
		?>
        </select>
		


        <input type="submit" value="Invia">
    </form>
</div>
<?php
	$conn->close();
?>
</body>
</html>