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
    <form action="aggiungiElezione.php" method="POST">
        <label for="year">Elezione</label>
        <input type="text" id="nome" name="nome" placeholder="Nome elezione (ES: Consulta)" required>
		Data di apertura: <input type="date" id="dataApertura" name="dataApertura" required> <input type="time" id="timeApertura" name="timeApertura" required><br>
		Data di chiusura: <input type="date" id="dataChiusura" name="dataChiusura" required> <input type="time" id="timeChiusura" name="timeChiusura" required><br>
		Numero massimo di candidati <input type="number" id="candidati" name="candidati" required><br>
		Elettori iscritti: <input type="number" id="iscritti" name="iscritti" required><br>
		
		<label for="tipologia">Seleziona Tipologia</label>
        <select id="tipologia" name="tipologia" required>
		<?php
		     $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
			 
			 
			
			 $results = mysqli_query($conn,"SELECT voto_elettronico.tipologia_utente.id, voto_elettronico.tipologia_utente.tipologia 
			 FROM voto_elettronico.tipologia_utente");

			while($row = mysqli_fetch_array($results)) {	
                echo '<option value="'.$row["id"].'">'.$row["tipologia"].'</option>'	;

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