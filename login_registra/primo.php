<!DOCTYPE html>
<html lang="it">
    <head>
    
    <meta charset="UTF-8"/>
    <meta name="viewport" content="ie=edge"/>
        
    <link rel="stylesheet" href="css/style.css"/>
        <title> Login</title>
    
     </head>

<body>
    
    <div class="container" id="container">
	<div class="form-container sign-up-container">
		<form method="post" action="#">
			<h1>Registrati</h1>
			
			
			<input type="text" placeholder="Nome" name="nome"  />
            <input type="text" placeholder="Cognome" name="cognome" />
			<input type="email" placeholder="Email" name="email" />
             <input type="text" placeholder="Username" name="username" />
			<input type="password" placeholder="Password" name="password" />
            <input type="password" placeholder="Conferma password" name="conf_password"/>
            <input type="text" placeholder="Classe" name="classe" />
            <input type="text" placeholder="Tipologia utente" name="tipologia_utente" />
			<button>Registarti</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form method="post" action="../pagina_principale/home.php">
			<h1>Accedi</h1>
			
			<input type="text" placeholder="Username" name="usn"/>
			<input type="password" placeholder="Password" name="psw" />
			
			<button  type="submit" class="login100-form-btn">
                            <?php
                                session_start();
                                $_SESSION["servername"] = "localhost";
                                $_SESSION["stato_auth"]= false;
                                echo "Accedi";
                            ?>  </button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Bentornato!</h1>
				<p>Per effettuare l'accesso inserisci i tuoi dati personali</p>
				<button class="ghost" id="signIn">Accedi</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Registrazione</h1>
				<p>Registrati inserendo i tuoi dati personali </p>
				<button class="ghost" id="signUp">Registrati</button>
			</div>
		</div>
	</div>
</div>

<script src="js/main.js"></script>
    	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
</body>
</html>
