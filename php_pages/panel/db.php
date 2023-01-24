<!doctype html>
<html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="pt-br"/>
	<meta name="robots" content="noindex,nofollow"/>

	<title>GIPSO > MCTQ > Acesso à Base de Dados</title>
	<meta name="description" content="" />
	<meta name="subject" content="" />
	<meta name="keywords" content="" />
	<meta name="abstract" content="" />

	<meta name="revisit-after" content="5 Days"/>
	<meta name="city" content="Sao Paulo"/>
	<meta name="state" content="SP"/>
	<meta name="country" content="Brazil"/>
	<meta name="zip code" content="03828-000"/>
	<meta name="distribution" content="Global"/>
	<meta name="author" content="GIPSO-USP - Grupo Interdisciplinar de Pesquisa em Sono"/>
	<meta name="owner" content="gipso@usp.br"/>
	<meta name="reply-to" content="gipso@usp.br"/>
	<meta name="copyright" content="GIPSO-USP"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link href="../images/favicon.png" rel="shortcut icon" type="image/x-icon"/>    
	<link rel="stylesheet" href="../css/w3.css">
	<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

	<style>
	
	.embed-container { 
	position: relative; 
	padding-bottom: 56.25%; 
	height: 0; 
	overflow: hidden; 
	max-width: 100%; 
	height: auto; 
	} 

	.embed-container iframe, .embed-container object, .embed-container embed {
	position: absolute; 
	top: 0; 
	left: 0; 
	width: 100%; 
	height: 100%; 
	}
	
	</style>

</head>

<body style="background-color:#E7E7EB;">

<!-- HEADER -->

	<?php include "../header.php"; ?>

<!-- /HEADER -->

<!-- PAGE CONTENT -->

	<div class="w3-content w3-container" style="padding-top:40px; padding-bottom:80px;" id="container">

<!-- Section 1 -->

		<section id="section1" style="padding-bottom:30px;">

			<div style="padding-bottom:20px;">

				<h2>RESULTADOS</h2>

				<p>
	            Abaixo você pode conferir os resultados resumidos de todas as entradas no MCTQ.
				</p>

				<p>
				Esta página foi criada para prover um acesso rápido aos resultados, sem ter que acessar o servidor da USP. É importante notar que para a manipulação dos dados será necessário acessar o banco de dados do GIPSO. O vídeo abaixo explica como fazê-lo.
	            </p>

			</div>

			<div>
			
				<div class="embed-container">
			
					<iframe src="https://www.youtube.com/embed/xFR2nqYl050?rel=0&amp;showinfo=0?ecver=1" frameborder="0" allowfullscreen></iframe>
			
				</div>

			</div>

		</section>

<!-- /Section 1 -->

		<div style="padding-top:24px; padding-bottom:24px;">
        
			<hr style="border-color:#808080;">

		</div>


<!-- Section 2 -->

		<section>

			<div style="padding-bottom:20px;">

				<h2>DADOS RESUMIDOS</h2>

				<p>
				Os dados abaixo estão listados pela variável ID (identificação única da coleta) e ordenados da primeira à última entrada.
				</p>

				<p>
	            Consulte o <b><a href="/gipso/mctq/panel/source.php" target="_blank" class=" w3-hover-yellow" style="text-decoration:none;">código-fonte</a></b> para saber mais sobre as variáveis e os cálculos envolvidos.
				</p>

			</div>

			<?php        

				include "../php/connect.php"; 

				$sql = "SELECT * FROM mctq";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
						
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "
							
						<p>
							
						<b>ID (<i>ID</i>): </b>" . $row["ID"]. " |
						<b>Código do pesquisador</b> (<i>track</i>): " . $row["track"]. " |
						<b>Data da coleta:</b> (<i>date</i>): " . $row["date"]. " |
						<b>Hora da coleta</b> (<i>time</i>): " . $row["time"]. "
							
							
						<h4>DADOS PESSOAIS</h4>
							
						<b>Nome completo</b> (<i>pdNAME</i>): " . $row["pdNAME"]. " |
						<b>E-mail</b> (<i>pdEMAIL</i>): " . $row["pdEMAIL"]. " |
						<b>Data de nascimento</b> (<i>pdBIRTH</i>): " . $row["pdBIRTH"]. " |
						<b>País em que reside</b> (<i>pdCOUNTRY</i>): " . $row["pdCOUNTRY"]. " |
						<b>Estado em qeu reside</b> (<i>pdSTATE</i>): " . $row["pdSTATE"]. " |
						<b>Cidade em que reside</b> (<i>pdCITY</i>): " . $row["pdCITY"]. " |
						<b>CEP ou código postal</b> (<i>pdPOSTAL</i>): " . $row["pdPOSTAL"]. " |
						<b>Altura (cm)</b> (<i>pdHEIGHT</i>): " . $row["pdHEIGHT"]. " |
						<b>Peso (kg)</b> (<i>pdWEIGHT</i>): " . $row["pdWEIGHT"]. " |
						<b>Sexo biológico (1 = Feminino ; 2 = Masculino)</b> (<i>pdGENDER</i>): " . $row["pdGENDER"]. " |
						<b>Identidade de gênero (1 = Mulher ; 2 = Homem ; 3 = Não-binário)</b> (<i>pdGENDERidentity</i>): " . $row["pdGENDERidentity"]. " |
						<b>Orientação sexual (1 = Heterossexual ; 2 = Homossexual ; 3 = Bissexual ; 4 = Assexual)</b> (<i>pdSEXUALORIENTATION</i>): " . $row["pdSEXUALORIENTATION"]. "
							
							
						<h4>HÁBITOS E SAÚDE</h4>
							
						<b>Faz uso de alguma droga para dormir? (1 = Sim ; 0 = Não)</b> (<i>hhDRUGS</i>): " . $row["hhDRUGS"]. " |
						<b>Faz uso de alguma droga para dormir? Qual?</b> (<i>hhDRUGSwhich</i>): " . $row["hhDRUGSwhich"]. " |
						<b>Tem algum distúrbio de sono? (1 = Sim ; 0 = Não)</b> (<i>hhSLEEPDISORDER</i>): " . $row["hhSLEEPDISORDER"]. " |
						<b>Tem algum distúrbio de sono? Qual?</b> (<i>hhSLEEPDISORDERwhich</i>): " . $row["hhSLEEPDISORDERwhich"]. " |
						<b>Faz uso de alguma medicação diariamente? (1 = Sim ; 0 = Não)</b> (<i>hhMEDICATION </i>): " . $row["hhMEDICATION"]. " |
						<b>Faz uso de alguma medicação diariamente? Qual?</b> (<i>hhMEDICATIONwhich</i>): " . $row["hhMEDICATIONwhich"]. " |
						<b>Você ronca ao dormir? (1 = Sim ; 0 = Não ; 2 = Não sei)</b> (<i>hhSNORE</i>): " . $row["hhSNORE"]. " |
							
						<b>Trabalha e/ou estuda?</b> (1 = Trabalho ; 1 = Estudo ; 1 = Não trabalho nem estudo; em ordem)(<i>hhWORK, hhSTUDY, hhNOWORKORSTUDY</i>): ". $row["hhWORK"]. ", ". $row["hhSTUDY"]. ", ". $row["hhNOWORKORSTUDY"]. " |
						<b>Períodos em que trabalha (1 = Manhã ; 1 = Tarde ; 1 = Noite ; 1 = Madrugada ; em ordem)</b> (<i>hhWORKmorning, hhWORKafternoon, hhWORKevening, hhWORKweehours</i>): " . $row["hhWORKmorning"]. ", ". $row["hhWORKafternoon"]. ", ". $row["hhWORKevening"]. ", ". $row["hhWORKweehours"]. " |
						<b>Períodos em que estuda (1 = Manhã ; 1 = Tarde ; 1 = Noite; 1 = Madrugada ; em ordem)</b> (<i>hhSTUDYmorning, hhSTUDYafternoon, hhSTUDYevening, hhSTUDYweehours</i>): " . $row["hhSTUDYmorning"]. ", ". $row["hhSTUDYafternoon"]. ", ". $row["hhSTUDYevening"]. ", ". $row["hhSTUDYweehours"]. "
							
							
						<h4>QUESTIONÁRIO DE CRONOTIPO</h4>
							
						<b>Dias de trabalho na semana</b> (<i>mctqWD</i>): " . $row["mctqWD"]. " |
						<b>Dias livres na semana</b> (<i>mctqFD</i>): " . $row["mctqFD"]. "
							
						<h5>Em dias de trabalho ou estudo:</h5>
							
						<b>Vai para a cama (HH:MM)</b> (<i>mctqBTwHH, mctqBTwMM</i>): " . $row["mctqBTwHH"].":". $row["mctqBTwMM"]. " |
						<b>Vai para a cama minutos decimais)</b> (<i>mctqBTwMMdecimal</i>): " . $row["mctqBTwMMdecimal"]. " |
						<b>Vai para a cama horas decimais)</b> (<i>mctqBTw</i>): " . $row["mctqBTw"]. " |
							
						<b>Decide dormir (HH:MM)</b> (<i>mctqSPrepwHH, mctqSPrepwMM</i>): " . $row["mctqSPrepwHH"].":". $row["mctqSPrepwMM"]. " |
						<b>Decide dormir (minutos decimais)</b> (<i>mctqSPrepwMMdecimal</i>): " . $row["mctqSPrepwMMdecimal"]. " |
						<b>Decide dormir (horas decimais)</b> (<i>mctqSPrepw</i>): " . $row["mctqSPrepw"]. " |
							
						<b>Precisa para dormir (minutos)</b> (<i>mctqSLatwMM</i>): " . $row["mctqSLatwMM"]. " |
						<b>Precisa para dormir (minutos decimais)</b> (<i>mctqSLatw</i>): " . $row["mctqSLatw"]. " |
						<b>Acorda (HH:MM)</b> (<i>mctqSEwHH, mctqSEwMM</i>): " . $row["mctqSEwHH"].":". $row["mctqSEwMM"]. " |
						<b>Acorda (minutos decimais)</b> (<i>mctqSEwMMdecimal</i>): " . $row["mctqSEwMMdecimal"]. " |
						<b>Acorda (horas decimais)</b> (<i>mctqSEw</i>): " . $row["mctqSEw"]. " |
						
						<b>Despertador (1 = Sim ; 0 = Não)</b> (<i>mctqAlarmw</i>): " . $row["mctqAlarmw "]. " |
						
						<b>Precisa para levantar (minutos)</b> (<i>mctqSIwMM</i>): " . $row["mctqSIwMM"]. " |
						<b>Precisa para levantar (minutos decimais)</b> (<i>mctqSIw</i>): " . $row["mctqSIw"]. " |
							
						<b>Exposição à luz durante o dia (HH:MM)</b> (<i>mctqLEwHH, mctqLEwMM</i>): " . $row["mctqLEwHH"].":". $row["mctqLEwMM"]. " |
						<b>Exposição à luz durante o dia (minutos decimais)</b> (<i>mctqLEwMMdecimal</i>): " . $row["mctqLEwMMdecimal"]. " |
						<b>Exposição à luz durante o dia (horas decimais)</b> (<i>mctqLEw</i>): " . $row["mctqLEw"]. "
							
						<h5>Fora dos dias de trabalho (finais de semana, feriados e folgas):</h5>
						
						<b>Vai para a cama (HH:MM)</b> (<i>mctqBTfHH, mctqBTfMM</i>): " . $row["mctqBTfHH"].":". $row["mctqBTfMM"]. " |
						<b>Vai para a cama (minutos decimais)</b> (<i>mctqBTfMMdecimal</i>): " . $row["mctqBTfMMdecimal"]. " |
						<b>Vai para a cama (horas decimais)</b> (<i>mctqBTf</i>): " . $row["mctqBTf"]. " |
							
						<b>Decide dormir (HH:MM)</b> (<i>mctqSPrepfHH, mctqSPrepfMM</i>): " . $row["mctqSPrepfHH"].":". $row["mctqSPrepfMM"]. " |
						<b>Decide dormir (minutos decimais)</b> (<i>mctqSPrepfMMdecimal</i>): " . $row["mctqSPrepfMMdecimal"]. " |
						<b>Decide dormir (horas decimais)</b> (<i>mctqSPrepf</i>): " . $row["mctqSPrepf"]. " |
							
						<b>Precisa para dormir (minutos)</b> (<i>mctqSLatfMM</i>): " . $row["mctqSLatfMM"]. " |
						<b>Precisa para dormir (minutos decimais)</b> (<i>mctqSLatf</i>): " . $row["mctqSLatf"]. " |
						<b>Acorda (HH:MM)</b> (<i>mctqSEfHH, mctqSEfMM</i>): " . $row["mctqSEfHH"].":". $row["mctqSEfMM"]. " |
						<b>Acorda (minutos decimais)</b> (<i>mctqSEfMMdecimal</i>): " . $row["mctqSEfMMdecimal"]. " |
						<b>Acorda (horas decimais)</b> (<i>mctqSEf</i>): " . $row["mctqSEf"]. " |
						
						<b>Despertador (1 = Sim ; 0 = Não)</b> (<i>mctqAlarmf</i>): " . $row["mctqAlarmf "]. " |
						
						<b>Precisa para levantar (minutos)</b> (<i>mctqSIfMM</i>): " . $row["mctqSIfMM"]. " |
						<b>Precisa para levantar (minutos decimais)</b> (<i>mctqSIf</i>): " . $row["mctqSIf"]. " |
							
						<b>Exposição à luz durante o dia (HH:MM)</b> (<i>mctqLEfHH, mctqLEfMM</i>): " . $row["mctqLEfHH"].":". $row["mctqLEfMM"]. " |
						<b>Exposição à luz durante o dia (minutos decimais)</b> (<i>mctqLEfMMdecimal</i>): " . $row["mctqLEfMMdecimal"]. " |
						<b>Exposição à luz durante o dia (horas decimais)</b> (<i>mctqLEf</i>): " . $row["mctqLEf"]. "
							
							
						<h5>Variáveis computadas</h5>
						
						<h6>Em dias de trabalho ou estudo:</h6>						
						
						<b>Pega no sono (Decide dormir + Precisa para dormir) (horas decimais)</b> (<i>mctqSOw</i>): " . $row["mctqSOw"]. " |
						<b>Levanta da cama (Acorda + Precisa para Levantar) (horas decimais)</b> (<i>mctqGUw</i>): " . $row["mctqGUw"]. " |
						<b>Duração do sono (Acorda - Pega no sono) (quantidade em horas decimais)</b> (<i>mctqSDw</i>): " . $row["mctqSDw"]. " |
						<b>Tempo que permanece na cama (quantidade em horas decimais)</b> (<i>mctqTBTw</i>): " . $row["mctqTBTw"]. " |
						<b>Meio-Sono/Meia-Fase em dias de trabalho (Pega no sono + Duração do sono/2) (horas decimais)</b> (<i>mctqMSW</i>): " . $row["mctqMSW"]. "
						
						<h6>Fora dos dias de trabalho (finais de semana, feriados e folgas):</h6>						
						
						<b>Pega no sono (Decide dormir + Precisa para dormir) (horas decimais)</b> (<i>mctqSOf</i>): " . $row["mctqSOf"]. " |
						<b>Levanta da cama (Acorda + Precisa para Levantar) (horas decimais)</b> (<i>mctqGUf</i>): " . $row["mctqGUf"]. " |
						<b>Duração do sono (Acorda - Pega no sono) (quantidade em horas decimais)</b> (<i>mctqSDf</i>): " . $row["mctqSDf"]. " |
						<b>Tempo que permanece na cama (quantidade em horas decimais)</b> (<i>mctqTBTf</i>): " . $row["mctqTBTf"]. " |
						<b>Meio-Sono/Meia-Fase em dias livres (Pega no sono + Duração do sono/2) (horas decimais)</b> (<i>mctqMSF</i>): " . $row["mctqMSF"]. "

						
						<h5>Variáveis computadas combinando dias de trabalho e dias livres (fora dos dias de trabalho)</h5>

						<b>Duração média do sono semanal (quantidade em horas decimais)</b> (<i>mctqSDweek</i>): " . $row["mctqSDweek"]. " |
						<b>Perda semanal de sono (quantidade em horas decimais)</b> (<i>mctqSLossweek</i>): " . $row["mctqSLossweek"]. " |
						<b>Exposição média à luz semanal</b> (<i>mctqLEweek</i>): " . $row["mctqLEweek"]. " |
						<b>Jetlag social relativo (quantidade em horas decimais)</b> (<i>mctqSJLrel</i>): " . $row["mctqSJLrel"]. " |
						<b>Jetlag social absoluto</b> (<i>mctqSJL</i>): " . $row["mctqSJL"]. " <br><br>
						
						<b>Cronotipo (meio-sono/meia-fase corrigida) (horas decimais)</b> (<i>mctqMSFsc</i>): " . $row["mctqMSFsc"]. "

						</p>
						<br><br>";
					}
					}
				else {
				    echo "0 resultados";
					}

				$conn->close();			

			?> 

		</section>
    
<!-- /Section 2 -->

	</div>

<!-- /PAGE CONTENT -->

<!-- FOOTER -->

<!-- /FOOTER -->

<!-- TRACKING SCRIPTS -->

<!-- /TRACKING SCRIPTS -->

</body>

</html>			