<?php
    session_start();
?>
<html>
<link rel="stylesheet" href="alertify/css/alertify.min.css" />
<!-- include a theme -->
<link rel="stylesheet" href="alertify/css/themes/default.min.css" />
<body>
    <?php
    $conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);


        $sql = "INSERT INTO voto_elettronico.utente (nome, cognome, email, username, password)
SELECT firstname, lastname, email, username, password FROM moodle.mdl_user";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript' src=\"alertify/alertify.min.js\"> alertify.success('Importazione Riuscita con Successo!'); </script>";
    } else {
        "<script type='text/javascript' src=\"alertify/alertify.min.js\"> alertify.success('Errore: ' . $q . '<br>'. $conn->error'); </script>";
    }

    $conn->close();
    ?>
</body>
</html>
