<html>
<body>
    <?php
	session_start();
	$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
	
	for($i = 0; $i < $_SESSION["totaleListe"]; $i++){
	   if(isset($_POST[$i])){
	      $q= "DELETE FROM voto_elettronico.lista WHERE id = ".$_POST[$i];
		  if (!($conn->query($q) === TRUE)) {
              die ("Errore: " . $q . "<br>" . $conn->error);
           }
		}
    }
    echo "<script type='text/javascript'> alert('Operazione Eseguita!'); </script>";
	
	$conn->close();

    ?>

</body>
</html>