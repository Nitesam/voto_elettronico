<html>
<body>
    <?php
	session_start();
	$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
	
	for($i = 0; $i < $_SESSION["totaleClassi"]; $i++){
	   if(isset($_POST[$i])){
	      $q= "DELETE FROM voto_elettronico.classe WHERE id = ".$_POST[$i];
		  if (!($conn->query($q) === TRUE)) {
              die ("Errore: " . $q . "<br>" . $conn->error);
           }
		}
    }
    echo "<script type='text/javascript' src=\"alertify/alertify.min.js\"> alert('Cancellazione delle Righe Selezionate Riuscita con Successo!'); </script>";
	
	$conn->close();

    ?>

</body>
</html>