<?php
    session_start();

    $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
	
				
	
	
	    $sql = "INSERT INTO voto_elettronico.candidato (nome, cognome, id_elezione, id_lista)
		    VALUES ('". $_POST["nome"] . "', '". $_POST["cognome"] . "', '" . $_POST["elezione"] . "' , '". $_POST["lista"] ."')";
       
	    $conn->query($sql);
	
	
	



    echo "<script type=\"text/javascript\">location.href = 'candidato.php';</script>";

    $conn->close();

?>