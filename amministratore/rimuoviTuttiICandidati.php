d<?php
session_start();
?>

<html>
<body>
<?php

$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);

$q= "DELETE FROM voto_elettronico.candidato";

if ($conn->query($q) === TRUE) {
    echo "<script type='text/javascript'> alert('Operazione Eseguita!'); </script>";
} else {
    echo "<script type='text/javascript'> alert('Errore: ' . $q . '<br>'. $conn->error'); </script>";
}

   echo "<script type=\"text/javascript\">window.close()</script>";
   echo "<script type=\"text/javascript\">location.href = 'candidato.php';</script>";

$conn->close();
?>
</body>
</html>