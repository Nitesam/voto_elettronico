<!DOCTYPE html>
<?php
session_start();
?>
<html lang="zxx">
<head>
	<title>Pagina Principale</title>
	<meta charset="UTF-8">
	<meta name="description" content="Pagina Principale">
	<meta name="keywords" content="endGam,gGaming, magazine, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
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
                } 
				else{
                    $_SESSION["utente_usn"] = $record["username"];
					$_SESSION["tipologia"] = $record["tipologia"];
                    $_SESSION["users"] = true;
                    $_SESSION["admin"] = false;
                    $_SESSION["stato_auth"] = true;
                }
            } else{

                echo "
				Username Errato<br>
				<a href=\"login_registra/primo.php\">Torna alla Pagina di Login</a><br>";
            }
        } else{

            echo "
				Username Errato<br><br><br>
				<a href=\"login_registra/primo.php\">Torna alla Pagina di Login</a><br>
            ";

        }
    }
    ?>

	<div class="main-warp">
		<!-- header section -->
		<header class="header-section">
			<div class="header-close">
				<i class="fa fa-times"></i>
			</div>
			<div class="header-warp">
				<a href="" class="site-logo">
					<img src="./img/logo.png" alt="">
				</a>
				<img src="img/menu-icon.png" alt="" class="menu-icon">
				<ul class="main-menu">
                    <?php
					
					
					
					
                        if ($_SESSION["users"] == true){

                        $_SESSION["username"] = "guest";
                        $_SESSION["password"] = "ArchimedeHash1!";


                        if ($_SESSION["stato_auth"] == false){
                        echo "<script type='text/javascript'> alert('Connessione avvenuta con Successo!'); </script>";}
						
						
                        if($_SESSION["tipologia"] == 'Docente'){
                        echo "
						    <li><a href=\"../utente/votazioni_aperte.php\">Votazioni Disponibili</a></li>
							<li><a href=\"../docente/selezionaClasse.php\">Elenco Classi</a></li>
                            <li><a href=\"../chiudi.php\">Chiudi Sessione</a></li>
                        ";
						}
						else{
							echo "
                            <li><a href=\"../utente/votazioni_aperte.php\">Votazioni Disponibili</a></li>
                            <li><a href=\"../chiudi.php\">Chiudi Sessione</a></li>
                        ";
							
							
						}
                            $_SESSION["stato_auth"]=true;
                        } 
						
						
						elseif ($_SESSION["admin"] == true) {

                        $_SESSION["username"] = "root";
                        $_SESSION["password"] = "";


                        if ($_SESSION["stato_auth"] == false){
                        echo "<script type='text/javascript'> alert('Connessione avvenuta con Successo!'); </script>";}

                        echo "
                            <li><a href=\"../amministratore/lista.php\">Gestione Utenti</a></li>
                            <li><a href=\"../amministratore/classi.php\">Gestione Classi</a></li>
                            <li><a href=\"../amministratore/tipologia.php\">Gestione Tipologie Utenti</a></li>
                            <li><a href=\"../amministratore/liste.php\">Gestione Liste</a></li>
                            <li><a href=\"../amministratore/elezioni.php\">Gestione Elezioni</a></li>
                            <li><a href=\"../amministratore/candidato.php\">Gestione Candidato</a></li>
							<li><a href=\"../amministratore/stampa.php\">Genera PDF Elezioni</a></li>
                            <li><a href=\"../chiudi.php\">Chiudi la connessione</a></li>
                        ";
                            $_SESSION["stato_auth"]=true;
                        }
                        else {
                        echo "
                            <script>window.location.replace(\"../login_registra/primo.php\");</script>
                        ";
                        session_unset();
                        session_destroy();
                        }

                        $conn->close();
                    ?>
				</ul>
			</div>
		</header>
		<!-- header section end -->

		<!-- Page section -->
		<div class="page-section home-page">
			<div class="hero-slider owl-carousel">
				<div class="slider-item d-flex align-items-center set-bg" data-setbg="img/slider-bg-1.jpg" data-hash="slide-1">
				</div>
			</div>
		</div>
		<!-- Page section end-->
	</div>


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/isotope.pkgd.min.js"></script>
	<script src="js/imagesloaded.pkgd.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
