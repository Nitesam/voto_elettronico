<!DOCTYPE html>

<?php
    session_start();
	$_SESSION["totaleElezioni"] = 0;
	$_SESSION["nomeTipologia"] = 0;
?>

<html lang="it">
<head>
    <title>Lista Elezioni</title>
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
                        <th class="column100 column3" data-column="column3">Data Apertura</th>
                        <th class="column100 column4" data-column="column4">Data Chiusura</th>
						<th class="column100 column4" data-column="column4">Max candidati</th>
                        <th class="column100 column5" data-column="column5">Iscritti</th>
                        <th class="column100 column6" data-column="column6">Votanti</th>
						<th class="column100 column7" data-column="column7">Schede Valide</th>
						<th class="column100 column8" data-column="column8">Schede Bianche</th>
						<th class="column100 column9" data-column="column9">Schede Nulle</th>
						<th class="column100 column10" data-column="column10">Tipologia Utenti</th>
						<th class="column100 column10" data-column="column10">Seleziona Elezioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
                    $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );

                    if ($conn->connect_error) {
                        die("Lettura Fallita: " . $conn->connect_error);
                    } else{
                        echo "Lettura avvenuta con successo.<br> Di seguito la lista delle elezioni: <br> <br>";
                    }

                    $results = mysqli_query($conn,"SELECT voto_elettronico.elezione.id, voto_elettronico.elezione.nome, voto_elettronico.elezione.data_apertura, voto_elettronico.elezione.ora_apertura, voto_elettronico.elezione.data_chiusura, voto_elettronico.elezione.ora_chiusura, voto_elettronico.elezione.max_candidati, voto_elettronico.elezione.iscritti, voto_elettronico.elezione.votanti, voto_elettronico.elezione.schede_valide, voto_elettronico.elezione.schede_bianche, voto_elettronico.elezione.schede_nulle, voto_elettronico.tipologia_utente.tipologia FROM voto_elettronico.elezione LEFT JOIN voto_elettronico.tipologia_utente ON voto_elettronico.elezione.id_tipologia_utente = voto_elettronico.tipologia_utente.id");

                    while($row = mysqli_fetch_array($results)) {
                        ?>
												
						<form name="utenti" action="eliminaElezioniSelezionate.php" method="POST" target="suca">
                        <tr class="row100">
                            <td class="column100 column1" data-column="column1"><?php echo $row['id']?></td>
                            <td class="column100 column2" data-column="column2"><?php echo $row['nome']?></td>
                            <td class="column100 column3" data-column="column3"><?php 

							$dataApertura = implode("/", array_reverse(explode("-", $row['data_apertura']))); echo $dataApertura." ".$row['ora_apertura']?></td>
							
							<td class="column100 column4" data-column="column4"><?php 
							$dataChiusura = implode("/", array_reverse(explode("-", $row['data_chiusura']))); echo $dataChiusura." ".$row['ora_chiusura']?></td>
							
							<td class="column100 column5" data-column="column5"><?php echo $row['max_candidati']?></td>
                            <td class="column100 column5" data-column="column5"><?php echo $row['iscritti']?></td>						
                            <td class="column100 column6" data-column="column6"><?php echo $row['votanti']?></td>
							<td class="column100 column7" data-column="column7"><?php echo $row['schede_valide']?></td>
							<td class="column100 column8" data-column="column8"><?php echo $row['schede_bianche']?></td>
							<td class="column100 column9" data-column="column9"><?php echo $row['schede_nulle']?></td>
							<td class="column100 column10" data-column="column10"><?php echo $row['tipologia']?></td>
							<td class="column100 column11" data-column="column11"><?php echo '<input type="checkbox" value="'.$row["id"].'" name="'.$_SESSION["totaleElezioni"].'">'?></td>
                        </tr>
					
                        <?php
						$_SESSION["totaleElezioni"]++;
                    }
                    ?>
                     

                    </tbody>
                </table>
                <br>
                <br>
                <table data-vertable="ver1">
                    <tbody>
                    <tr class="row100">
                        <td class="column100 column1" data-column="column1"><a href="aggiungiElezioneH.php">Aggiungi elezione<a/></td>
                        <td class="column100 column2" data-column="column2"><a href="rimuoviTutteLeElezioni.php" onclick="window_reload();" target="suca">Rimuovi tutte le elezioni<a/></td>
                        <td class="column100 column3" data-column="column3"><a href="chiudi.php">Chiudi la Connessione<a/></td>
						<td class="column100 column4" data-column="column4"><input type="submit" Value="Elimina elezioni selezionate" onclick="window_reload()" ></td>
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
<?php
	$conn->close();
?>
<script type="text/javascript">

    function window_reload(){
        setTimeout(reload, 300);
    }

    function reload(){
        document.location.reload(true);
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