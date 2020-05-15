<html>
<body>
    <?php
	session_start();
	$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
	
	
	for($i = 0; $i < $_SESSION["totale"]; $i++){
	   if(isset($_POST[$i])){
		  
		  $query = mysqli_query($conn, 'SELECT voto_elettronico.votazione.abilitato FROM voto_elettronico.votazione 
	      WHERE voto_elettronico.votazione.id_elezione = "'.$_SESSION["idElezione"].'" AND 
	      voto_elettronico.votazione.id_utente = "'.$_POST[$i].'"');
		  
		  if ($q = mysqli_fetch_array($query)){
			$abilitato = $q['abilitato'];
	      }
		  $abilitato = $abilitato + 1;
		  
		  $sql = 'UPDATE voto_elettronico.votazione SET voto_elettronico.votazione.abilitato = "'.$abilitato.'" 
		  WHERE voto_elettronico.votazione.id_elezione = "'.$_SESSION["idElezione"].'" AND 
	      voto_elettronico.votazione.id_utente = "'.$_POST[$i].'"';
		  
		  if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: <br>" . mysqli_error($conn);
        }
		  
		}
    }
    echo "<script type='text/javascript'> alert('Operazione Eseguita!'); </script>";
	
	$conn->close();

    ?>

</body>
</html>