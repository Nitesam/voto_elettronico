<?php
    session_start();

    $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);

    $tipologia=$_POST["tipo"];

    $sql="INSERT INTO voto_elettronico.tipologia_utente (tipologia) VALUES ('".$tipologia."');";

    $conn->query($sql);

    echo "<script type=\"text/javascript\">location.href = 'tipologia.php';</script>";

    $conn->close();

?>