s<html>
<body>
    <?php
	session_start();
	$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
	
	for($i = 0; $i < $_SESSION["totale"]; $i++){
	   if(isset($_POST[$i])){
	      $q= "DELETE FROM voto_elettronico.candidato WHERE id = ".$_POST[$i];

	      if (!($conn->query($q)===true)) die("<script type='text/javascript'> alert('Errore durante la Cancellazione'); </script>");
		}

    }

    echo "<script type='text/javascript'> alert('Operazione Eseguita!'); </script>";
	$conn->close();
    ?>

</body>
</html>