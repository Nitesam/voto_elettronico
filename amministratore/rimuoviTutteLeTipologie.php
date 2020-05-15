<?php
session_start();
?>

<html>
<body>
<?php

$conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);

$q= "DELETE FROM voto_elettronico.tipologia_utente";

if ($conn->query($q) === TRUE) {
    echo "<script type='text/javascript'> alert('Operazione Eseguita!'); </script>";
} else {
    echo "<script type='text/javascript'> alert('Errore: ' . $q . '<br>'. $conn->error'); </script>";
}

$conn->close();
?>
</body>
</html>