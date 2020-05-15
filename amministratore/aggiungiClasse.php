<?php
    session_start();

    $conn= mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);

    $classe=$_POST["year"]." ".$_POST["indirizzo"];

    $sql="INSERT INTO voto_elettronico.classe (classe) VALUES ('".$classe."');";

    $conn->query($sql);

    echo "<script type=\"text/javascript\">location.href = 'classi.php';</script>";

    $conn->close();

?>