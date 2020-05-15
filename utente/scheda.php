<!DOCTYPE html>

<?php
    session_start();
	$_SESSION["totaleListe"] = 0;
	$_SESSION["totaleCandidati"] = 0;
	if(!isset($_POST['radio']) && $_SESSION["radio"] == -1){
		echo 'Non scelto nessuna votazione<br>';
		echo '<a href="votazioni_aperte.php">Torna indietro</a><br>';
		return;
	}
	else if(isset($_POST['radio']))
	    $_SESSION["radio"] = $_POST['radio'];
	$conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );
	
?>

<html lang="it">
<head>
    <title>SCHEDA ELETTORALE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/stylebtn.css">
    <!--===============================================================================================-->
	

<style>

.container {
    max-width: 640px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 13px;
}

ul.ks-cboxtags {
    list-style: none;
    padding: 20px;
}
ul.ks-cboxtags li{
  display: inline;
}
ul.ks-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ks-cboxtags li label {
    padding: 10px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 1000;
    font-size: 15px;
    padding: 2px 6px 2px 2px;
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {
 
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ks-cboxtags li input[type="checkbox"] {
  display: relative;
}
ul.ks-cboxtags li input[type="checkbox"] {
  position: relative;
  opacity: 0;
}
ul.ks-cboxtags li input[type="checkbox"]:focus + label {
  border: 2px solid #e9a1ff;
}
</style>	
		
</head>
<body>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <table>
                    <thead>
                    <tr class="row100 head">
                        <th class="column100 column2" data-column="column2">Liste</th>
                        <th class="column100 column3" data-column="column3">Candidato1</th>
						<th class="column100 column3" data-column="column3">Candidato2</th>
						<th class="column100 column3" data-column="column3">Candidato3</th>
						<th class="column100 column3" data-column="column3">Candidato4</th>
						<th class="column100 column3" data-column="column3">Candidato5</th>
						
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
                    $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"]);
					
					

                    if ($conn->connect_error) {
                        die("Lettura Fallita: " . $conn->connect_error);
                    } else{
                        echo "<div align='center'><img src='logo.png' alt=''></div><br>";
                    }
					$massimo = mysqli_query($conn, 'SELECT voto_elettronico.elezione.max_candidati FROM voto_elettronico.elezione 
					WHERE voto_elettronico.elezione.id = "'.$_SESSION["radio"].'"');
					
					if ($query = mysqli_fetch_array($massimo)){
						$_SESSION['maxCandidati'] = $query['max_candidati'];
						echo 'Selezionare una lista e massimo '.$_SESSION['maxCandidati'].' candidati appartenenti alla stessa lista';
					}
					
				
					$results = mysqli_query($conn,'SELECT voto_elettronico.lista.id, voto_elettronico.lista.nome 
					
					FROM voto_elettronico.lista WHERE voto_elettronico.lista.id_elezione = "'.$_SESSION["radio"].'"');
					
					$_SESSION['idElezione'] = $_SESSION["radio"];
					?>
					<form name="utenti" action="check.php" method="POST" >
                    <?php
                    while($row = mysqli_fetch_array($results)) {
                        
						?>						
						
                        <tr >                          
							<td class="column100 column2" data-column="column2">
								<ul class="ks-cboxtags">
								<li><?php echo '<input type="checkbox" id="'.$_SESSION["totaleListe"].'l'.'" value="'.$row["id"].'" name="'.$_SESSION["totaleListe"].'l'.'"><label for="'.$_SESSION["totaleListe"].'l'.'">'.$row["nome"].'</label>';?></li>
								</ul>
								</td>
							
							
					<?php
							$query = mysqli_query($conn,'SELECT voto_elettronico.candidato.id, voto_elettronico.candidato.nome, voto_elettronico.candidato.cognome
					
					        FROM voto_elettronico.candidato WHERE voto_elettronico.candidato.id_lista = "'.$row["id"].'"');
							while($riga = mysqli_fetch_array($query)){
					?>
								
								<td class="column100 column2" data-column="column2">
								<ul class="ks-cboxtags">
								<li><?php echo '<input type="checkbox" id="'.$_SESSION["totaleCandidati"].'" value="'.$riga["id"].'" name="'.$_SESSION["totaleCandidati"].'"><label for="'.$_SESSION["totaleCandidati"].'">'.$riga["nome"].' '.$riga["cognome"].'</label>';?></li>
								</ul>
								</td>
								<?php
								$_SESSION["totaleCandidati"]++;
								
							}
							
							?>
						
                        </tr>
					
                        <?php
						$_SESSION["totaleListe"]++;
                    }
                    ?>
                     

                    </tbody>
                </table>
                <br>
                <br>
                <table data-vertable="ver1">
                    <tbody>
                    <tr class="row100"><td class="column100 column2" data-column="column2">
								<ul class="ks-cboxtags">
								<li><?php echo '<input type="checkbox" id="nulla" value="nulla" name="nulla"><label for="nulla">Scheda Nulla</label>';?></li>
								</ul>
								</td>
						<td class="column100 column4" data-column="column4"><input type="submit" value="CHECK"></td>
						</form>
						
                    </tr>
					
					
                    </tbody>
                </table>
                <br>
                <br>
                <a href="../pagina_principale/home.php" style="text-align:center;display:block;" >Torna alla Pagina Principale</a>
                <iframe name="hide" style="display:none;"></iframe>
            </div>
        </div>
    </div>
</div>
<?php
	$conn->close();
?>

<script type="text/javascript">

    function nulla(){
		
		
		
		
	}

    function window_reload(){
        setTimeout(reload, 300);
    }

    function reload(){
        document.location.reload(true);
    }
	function cancella(){
        var r = window.confirm("Sei sicuro del voto?");
        if (r === true){
            window.open("check.php");
            window_reload();
        }
    }

</script>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>