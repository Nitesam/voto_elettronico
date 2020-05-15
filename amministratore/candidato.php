<!DOCTYPE html>

<?php
    session_start();
	$_SESSION["totaleCandidati"] = 0;
	$_SESSION["nomeClasse"] = 0;
	$_SESSION["nomeTipologia"] = 0;
?>

<html lang="it">
<head>
    <title>Lista Candidati</title>
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
    <!--===============================================================================================-->
	
	

		
		
</head>
<body>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <table data-vertable="ver1">
                    <thead>
                    <tr class="row100 head">
                        <th class="column100 column1" data-column="column1">ID</th>
                        <th class="column100 column2" data-column="column2">Nome</th>
                        <th class="column100 column3" data-column="column3">Cognome</th>
                        <th class="column100 column4" data-column="column4">Voti</th>
                        <th class="column100 column5" data-column="column5">Elezione</th>
                        <th class="column100 column6" data-column="column6">Lista</th>
						<th class="column100 column6" data-column="column6">Data</th>
						<th class="column100 column7" data-column="column7">Seleziona Utenti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
                    $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );

                    if ($conn->connect_error) {
                        die("Lettura Fallita: " . $conn->connect_error);
                    } else{
                        echo "Lettura avvenuta con successo.<br> Di seguito la lista dei candidati: <br> <br>";
                    }

                    $results = mysqli_query($conn,"SELECT voto_elettronico.candidato.id, voto_elettronico.candidato.nome AS nomeCandidato, voto_elettronico.candidato.cognome, 
					
					voto_elettronico.candidato.totale_voti, voto_elettronico.elezione.nome AS nomeElezione, voto_elettronico.lista.nome AS nomeLista, voto_elettronico.elezione.data_apertura 
					
					FROM voto_elettronico.candidato LEFT JOIN voto_elettronico.elezione ON voto_elettronico.candidato.id_elezione = voto_elettronico.elezione.id 
					
					LEFT JOIN voto_elettronico.lista ON voto_elettronico.candidato.id_lista = voto_elettronico.lista.id");


                    while($row = mysqli_fetch_array($results)) {
                        ?>
												
						<form name="utenti" action="eliminaCandidatiSelezionati.php" method="POST" target="suca">
                        <tr class="row100">
                            <td class="column100 column1" data-column="column1"><?php echo $row['id']?></td>
                            <td class="column100 column2" data-column="column2"><?php echo $row['nomeCandidato']?></td>
                            <td class="column100 column3" data-column="column3"><?php echo $row['cognome']?></td>
                            <td class="column100 column4" data-column="column4"><?php echo $row['totale_voti']?></td>
                            <td class="column100 column5" data-column="column5"><?php echo $row['nomeElezione']?></td>
                            <td class="column100 column6" data-column="column6"><?php echo $row['nomeLista']?></td>
							<td class="column100 column6" data-column="column6"><?php 

							$dataApertura = implode("/", array_reverse(explode("-", $row['data_apertura']))); echo $dataApertura?></td>
							<td class="column100 column7" data-column="column7"><?php echo '<input type="checkbox" value="'.$row["id"].'" name="'.$_SESSION["totaleCandidati"].'">'?></td>
                        </tr>
					
                        <?php
						$_SESSION["totaleCandidati"]++;
                    }
                        $conn->close();
                    ?>
                     

                    </tbody>
                </table>
                <br>
                <br>
                <table data-vertable="ver1">
                    <tbody>
                    <tr class="row100">
                        <td class="column100 column1" data-column="column1"><a href="aggiungiCandidatoH.php">Aggiungi candiato<a/></td>
                        <td class="column100 column2" data-column="column2"><button onclick="cancella();">Cancella tutto</button></td>
                        <td class="column100 column3" data-column="column3"><a href="../chiudi.php">Chiudi la Connessione<a/></td>
						<td class="column100 column4" data-column="column4"><input type="submit" Value="Elimina candidati selezionati" onclick="window_reload()" ></td>
                    </tr>
					</form>
                    </tbody>
                </table>
                <br>
                <br>
                <a href="../pagina_principale/home.php" style="text-align:center;display:block;" >Torna alla Pagina Principale</a>
                <iframe name="suca" style="display:none;"></iframe>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function window_reload(){
        setTimeout(reload(), 800);
    }

    function reload(){
        document.location.reload(true);
    }

    function cancella(){
        var r = window.confirm("Sei sicuro di voler cancellare tutti i candidati ?");
        if (r === true){
            window.open("rimuoviTuttiICandidati.php");
            window_reload();
        }
    }

</script>
<?php
	$conn->close();
?>
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