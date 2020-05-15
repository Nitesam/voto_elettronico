<?php
    session_start();
?>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="grafica_usata/images/icons/ArchimedeBW.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="grafica_usata/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="grafica_usata/css/util.css">
	<link rel="stylesheet" type="text/css" href="grafica_usata/css/main.css">
	<link rel="stylesheet" type="text/css" href="grafica_usata/css/stylebtn.css">
<!--===============================================================================================-->
</head>
<body>
    <?php
        $conn = new mysqli("localhost", "guest", "ArchimedeHash1!", "voto_elettronico");

    if ($conn->connect_error)
        die("Connessione Fallita: " . $conn->connect_error);

            $options = [
                'cost' => 11
            ];

    if ($_SESSION["stato_auth"] == false){
        $username = $_POST["usn"];
        $password = $_POST["psw"];

        $result = mysqli_query($conn, 'SELECT utente.username, utente.password, tipologia_utente.tipologia FROM utente LEFT JOIN tipologia_utente ON utente.id_tipologia_utente = tipologia_utente.id WHERE utente.username = "'.$username.'"');

        if ($record = mysqli_fetch_array($result)) {
            if (password_verify($password, $record["password"])){
                if ($record["tipologia"] == "Amministratore"){
					$_SESSION["utente_usn"] = $record["username"];
                    $_SESSION["admin"] = true;
                    $_SESSION["users"] = false;
                    $_SESSION["stato_auth"] = true;
                } else{ 
					$_SESSION["utente_usn"] = $record["username"];
                    $_SESSION["users"] = true;
                    $_SESSION["admin"] = false;
                    $_SESSION["stato_auth"] = true;
                }
            } else{

                echo "
				<div class=\"container-login100\">
					<div class=\"wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50\">
						<span class=\"login100-form-title p-b-33\">
							Username Errato<br>
							<a href=\"login_registra/primo.php\">Torna alla Pagina di Login</a><br>
						</span>
					</div>
				</div>";

            }
        } else{

            echo "
			<div class=\"container-login100\">
				<div class=\"wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50\">
					<span class=\"login100-form-title p-b-33\">
						Username Errato<br><br><br>
						<a href=\"login_registra/primo.php\">Torna alla Pagina di Login</a><br>
					</span>
				</div>
			</div>";

        }
    }




        if ($_SESSION["users"] == true){

            $_SESSION["username"] = "guest";
            $_SESSION["password"] = "ArchimedeHash1!";
			
			if ($_SESSION["stato_auth"] == false){
			echo "<script type='text/javascript'> alert('Connessione avvenuta con Successo!'); </script>";}
			
            echo "
			<div class=\"box-1\">
				<button onclick=\"window.location.replace('utente/votazioni_aperte.php')\" class=\"btn mainButton\">
					<span>Votazioni Disponibili</span><br>
				</button>
				<button onclick=\"window.location.replace('chiudi.php')\" class=\"btn mainButton\">
					<span>Chiudi la connessione</span>
				</div>
			</div>";
        } elseif ($_SESSION["admin"] == true) {

            $_SESSION["username"] = "root";
            $_SESSION["password"] = "";
			
			if ($_SESSION["stato_auth"] == false){
            echo "<script type='text/javascript'> alert('Connessione avvenuta con Successo!'); </script>";}
		
            echo "
		<div class=\"box-1\">
			<button onclick=\"window.location.replace('amministratore/lista.php')\" class=\"btn mainButton\">
				<span>Gestione Utenti</span>
			</button><br>
			<button onclick=\"window.location.replace('amministratore/classi.php')\" class=\"btn mainButton\">
				<span>Gestione Classi</span>
			</button><br>
			<button onclick=\"window.location.replace('amministratore/tipologia.php');\" class=\"btn mainButton\">
				<span>Gestione Tipologie Utenti</span>
			</button><br>
			<button onclick=\"window.location.replace('amministratore/liste.php')\" class=\"btn mainButton\">
				<span>Gestione Liste</span>
			</button><br>
			<button onclick=\"window.location.replace('amministratore/elezioni.php')\" class=\"btn mainButton\">
				<span>Gestione Elezioni</span>
			</button><br>
			<button onclick=\"window.location.replace('amministratore/candidato.php')\" class=\"btn mainButton\">
				<span>Gestione Candidato</span>
			</button><br>
			<button onclick=\"window.location.replace('chiudi.php')\" class=\"btn mainButton\">
				<span>Chiudi la connessione</span>
			</button>
		</div>";

        } else {
            echo "
		<div class=\"container-login100\">
			<div class=\"wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50\">
				<span class=\"login100-form-title p-b-33\">
				    Connessione Fallita<br>
					<a href=\"login_registra/primo.php\">Torna alla Pagina di Login</a><br>
				</span>
			</div>
		</div>
		";
            session_unset();
            session_destroy();
        }

        $conn->close();
        ?>
</html>