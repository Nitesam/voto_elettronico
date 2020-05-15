<?php
    session_start();

    $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);

		
		
		$sql="INSERT INTO voto_elettronico.lista (nome, id_elezione) VALUES ('".$_POST["lista"]."','".$_POST["elezione"]."')";

        $conn->query($sql);
		
		

    

    echo "<script type=\"text/javascript\">location.href = 'liste.php';</script>";

    $conn->close();

?>