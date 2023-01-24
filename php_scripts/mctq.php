<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head> 

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<?php    
    
	// * ) OBSERVAÇÕES
	
		// Função do Script: Calcular o cronotipo (horário do meio do sono corrigido) do respondente - "Puxar" os dados inseridos no formulário e cria as variáveis para processar o cronotipo do respondente;

		// Nomeação das variáveis: camelCase - variando entre minúsculas e maiúsculas (camelCASEcamelCASEcamel...); todas as variáveis foram nomeadas em inglês; as variáveis começam com o nome ou sigla da seção; as variáveis da seção "mctq" foram padronizadas utilizando o padrão do WEP (Worldwide Experimental Platform) - <https://www.thewep.org/documentations/mctq/item/mctq-variables>.
	
		// Os resultados deste MCTQ se darão em HORAS DECIMAIS (ao contrário de horas:minutos:segundos).

	
	// 1 ) IDENTIFICAÇÃO
	
    $track = utf8_encode($_POST["track"]); // "Escreva o código do pesquisador"; [(string)];

	date_default_timezone_set( 'America/Sao_Paulo' );

	$date = date("y/m/d"); // Data do dia em que o formulário foi coletado; [(data - AAAA/MM/DD)];
	$time = date("H:i:s"); // Hora local (São Paulo) em que o formulário foi coletado [(formato 24h - HH:MM:SS)];
	
	
	// 2 ) DADOS PESSOAIS (Personal Data) (pd)

    $pdNAME = $_POST["pdNAME"]; // "Nome completo"; [(string)];
    $pdEMAIL = $_POST["pdEMAIL"]; // "E-mail"; [(string)];
    $pdBIRTH = $_POST["pdBIRTH"]; // "Data de nascimento"; [(data - AAAA/MM/DD)];
	$pdCOUNTRY = $_POST["pdCOUNTRY"]; // "País em que reside"; [(string)];
    $pdSTATE = $_POST["pdSTATE"]; // "Estado em que reside"; [(string)];
    $pdCITY = $_POST["pdCITY"]; // "Cidade em que reside"; [(string)];
    $pdPOSTAL = $_POST["pdPOSTAL"]; // "CEP ou código postal"; [(string)];
    $pdHEIGHT = $_POST["pdHEIGHT"]; // "Altura (cm)"; [(cadeia de números)];
    $pdWEIGHT = $_POST["pdWEIGHT"]; // "Peso (kg)"; [cadeia de números];
	$pdGENDER = $_POST["pdGENDER"];  // "Sexo biológico"; ["Feminino" (1); "Masculino" (2)];
    $pdGENDERidentity = $_POST["pdGENDERidentity"]; // "Identidade de gênero"; ["Mulher" (1); "Homem" (2); "Não-binário" (3)];
    $pdSEXUALORIENTATION = $_POST["pdSEXUALORIENTATION"]; // "Orientação sexual"; ["Heterossexual" (1); "Homossexual" (2); "Bissexual" (3); "Assexual" (4)];
    
	
	// 3 ) HÁBITOS E SAÚDE (Habits & Health) (hh)
	
	$hhDRUGS = $_POST["hhDRUGS"]; // "Faz uso de alguma droga para dormir?"; ["Sim"(1); "Não"(0)];
    $hhDRUGSwhich = $_POST["hhDRUGSwhich"]; // "Faz uso de alguma droga para dormir?"; ["Qual?"(string)];
    $hhSLEEPDISORDER = $_POST["hhSLEEPDISORDER"]; // "Tem algum distúrbio de sono?"; ["Sim"(1), "Não"(0)];
	$hhSLEEPDISORDERwhich = $_POST["hhSLEEPDISORDERwhich"]; // "Tem algum distúrbio de sono?"; ["Qual?"(string)];
    $hhMEDICATION = $_POST["hhMEDICATION"]; // "Faz uso de alguma medicação diariamente?"; ["Sim"(1), "Não"(0)];
    $hhMEDICATIONwhich = $_POST["hhMEDICATIONwhich"]; // "Faz uso de alguma medicação diariamente?"; ["Qual?"(string)];
    $hhSNORE = utf8_encode($_POST["hhSNORE"]); // "Você ronca ao dormir?"; ["Sim" (1), "Não" (0), "Não Sei" (2)];
    $hhWORK = $_POST["hhWORK"]; // "Trabalha e/ou Estuda?"; ["Trabalho" (1)];
	$hhSTUDY = $_POST["hhSTUDY"]; // "Trabalha e/ou Estuda?"; ["Estudo" (1)];
	$hhNOWORKORSTUDY = $_POST["hhNOWORKORSTUDY"]; // "Trabalha e/ou Estuda?"; ["Não Trabalho nem Estudo" (1)];
    $hhWORKmorning = $_POST["hhWORKmorning"]; // "Períodos em que Trabalha"; ["Manhã" (1)];
    $hhWORKafternoon = $_POST["hhWORKafternoon"]; // "Períodos em que Trabalha?"; ["Tarde" (1)];
    $hhWORKevening = $_POST["hhWORKevening"]; // "Períodos em que Trabalha?"; ["Noite" (1)];
    $hhWORKweehours = $_POST["hhWORKweehours"]; // "Períodos em que Trabalha?"; ["Madrugada" (1)];
    $hhSTUDYmorning = $_POST["hhSTUDYmorning"]; // "Períodos em que Estuda"; ["Manhã" (1)];
    $hhSTUDYafternoon = $_POST["hhSTUDYafternoon"]; // "Períodos em que Estuda"; ["Tarde" (1)];
    $hhSTUDYevening = $_POST["hhSTUDYevening"]; // "Períodos em que Estuda"; ["Noite" (1)];
    $hhSTUDYweehours = $_POST["hhSTUDYweehours"]; // "Períodos em que Estuda"; ["Madrugada" (1)];
	
	
    // 4 ) QUESTIONÁRIO DE CRONOTIPO (MCTQ) (mctq)

	// 4.1 ) "Quantos dias na semana são dias de aula ou trabalho para você?"

    $mctqWD = $_POST["mctqWD"]; // ["1 dia" ... "7 dias" (1 .. 7); WD = Work days;

    $mctqFD = 7 - $mctqWD; // Calcula a quantidade de dias nos quais o respondente não trabalha/estuda ao subtrair a quantidade de dias de trabalho/estudo pela quantidade de dias da semana (7).


	// 4.2 ) Seção 2: "Em dias de trabalho ou estudo:"

	// 4.2.1 ) "Você VAI PARA CAMA às HH:MM horas"

    $mctqBTwHH = $_POST["mctqBTwHH"]; // [em horas (00 .. 23)]; BT = Bed Time; w = Work; HH = Horas;
	
	$mctqBTwMM = $_POST["mctqBTwMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; BT = Bed Time; w = Work; MM = Minutos;
 
    $mctqBTwMMdecimal = $mctqBTwMM / 60; // Transforma os minutos que o sujeito VAI PARA CAMA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); BT = Bed Time; w = Work days; MM = Minutos;
	
    $mctqBTw = $mctqBTwHH + $mctqBTwMMdecimal; // Soma as horas e os minutos em decimal em que o sujeito VAI PARA CAMA; BT = Bed Time; w = Work days;

	// 4.2.2 ) "Depois de ir para a cama, você DECIDE DORMIR às HH:MM horas"

    $mctqSPrepwHH = $_POST["mctqSPrepwHH"]; // [em horas (00 .. 23)]; SPrep = Sleep Preparation; w = Work days; HH = Horas;

    $mctqSPrepwMM = $_POST["mctqSPrepwMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SPrep = Sleep Preparation; w = Work days; MM = Minutos;
   
    $mctqSPrepwMMdecimal = $mctqSPrepwMM / 60; // Transforma os minutos que o sujeito DECIDE DORMIR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SPrep = Sleep Preparation; w = Work days; MM = Minutos;

    $mctqSPrepw = $mctqSPrepwHH + $mctqSPrepwMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito DECIDE DORMIR; SPrep = Sleep Preparation; w = Work days;

	// 4.2.3 ) "Você PRECISA de ___ minutos PARA DORMIR"

    $mctqSLatwMM = $_POST["mctqSLatwMM"]; // [em minutos (00, 05, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60)]; SLat = Sleep Latency; w = Work days; MM = Minutos;
	
    $mctqSLatw = $mctqSLatwMM / 60; // Transforma os minutos que o sujeito PRECISA PARA DORMIR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SLat = Sleep Latency; w = Work days; MM = Minutos;
  
	// 4.2.4 ) "Você ACORDA às HH:MM horas"

    $mctqSEwHH = $_POST["mctqSEwHH"]; // [em horas (00 .. 23)]; SE = Sleep End; w = Work days; HH = Horas;
	
    $mctqSEwMM = $_POST["mctqSEwMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SE = Sleep End; w = Work days; MM = Minutos;
    
    $mctqSEwMMdecimal = $mctqSEwMM / 60; // Transforma os minutos que o sujeito ACORDA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SE = Sleep End; w = Work days; MM = Minutos;
	
    $mctqSEw = $mctqSEwHH + $mctqSEwMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito ACORDA; SE = Sleep End; w = Work days;

	// 4.2.5 ) "Com despertador" ou "Sem despertador"

    $mctqAlarmw = $_POST["mctqAlarmw"]; // ["Com despertador" (1); "Sem despertador" (0)]; Alarm = Alarm clock use; w = Work days; 
    	
	// 4.2.6 ) "Você se LEVANTA ___ minutos depois de despertar"

    $mctqSIwMM = $_POST["mctqSIwMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SI = Sleep Inertia; w = Work days; MM = Minutos;

    $mctqSIw = $mctqSIwMM / 60; // Transforma os minutos que o sujeito PRECISA PARA SE LEVANTAR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SI = Sleep Inertia; w = Work days; MM = Minutos;

	// 4.2.7 ) "Em média, você passa HH:MM ao ar livre à luz do dia (sem um telhado ou cobertura sobre a cabeça)"
	
	$mctqLEwHH = $_POST["mctqLEwHH"]; // [em horas (00 .. 23)]; LE = Light Exposure; w = Work days; HH = Horas;
	
    $mctqLEwMM = $_POST["mctqLEwMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; LE = Light Exposure; w = Work days; MM = Minutos;
    
    $mctqLEwMMdecimal = $mctqLEwMM / 60; // Transforma os minutos que o sujeito PASSA À LUZ DO DIA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); LE = Light Exposure w = Work days; MM = Minutos;
	
    $mctqLEw = $mctqLEwHH + $mctqLEwMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito ACORDA; LE = Light Exposure; w = Work days;
	

	// 4.3 ) Seção 3: "Fora dos dias de trabalho (finais de semana, feriados e folgas)"

	// 4.3.1 ) "Você VAI PARA CAMA às HH:MM horas"

    $mctqBTfHH = $_POST["mctqBTfHH"]; // [em horas (00 .. 23)]; BT = Bed Time; f = Work-free days; HH = Horas;

    $mctqBTfMM = $_POST["mctqBTfMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; BT = Bed Time; f = Work-free days; MM = Minutos;
 
    $mctqBTfMMdecimal = $mctqBTfMM / 60; // Transforma os minutos que o sujeito VAI PARA CAMA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); BT = Bed Time; f = Work-free days; MM = Minutos;

    $mctqBTf = $mctqBTfHH + $mctqBTfMMdecimal; // Soma as horas e os minutos em decimal em que o sujeito VAI PARA CAMA; BT = Bed Time; f = work-free days;

	// 4.3.2 ) "Depois de ir para a cama, você DECIDE DORMIR às HH:MM horas"

    $mctqSPrepfHH = $_POST["mctqSPrepfHH"]; // [em horas (00 .. 23)]; SPrep = Sleep Preparation; f = Work-free days; HH = Horas;

    $mctqSPrepfMM = $_POST["mctqSPrepfMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SPrep = Sleep Preparation; f = Work-free days; MM = Minutos;
   
    $mctqSPrepfMMdecimal = $mctqSPrepfMM / 60; // Transforma os minutos que o sujeito DECIDE DORMIR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SPrep = Sleep Preparation; f = Work-free days; MM = Minutos;

    $mctqSPrepf = $mctqSPrepfHH + $mctqSPrepfMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito DECIDE DORMIR; SPrep = Sleep Preparation; f = Work-free days;
    
	// 4.3.3 ) "Você PRECISA de ___ minutos PARA DORMIR"

    $mctqSLatfMM = $_POST["mctqSLatfMM"]; // [em minutos (00, 05, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60)]; SLat = Sleep Latency; f = Work-free days; MM = Minutos;

    $mctqSLatf = $mctqSLatfMM / 60; // Transforma os minutos que o sujeito PRECISA PARA DORMIR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SLat = Sleep Latency; f = Work-free days; MM = Minutos;
    
	// 4.3.4 ) "Você ACORDA às HH:MM horas"

    $mctqSEfHH = $_POST["mctqSEfHH"]; // [em horas (00 .. 23)]; SE = Sleep End; f = Work-free days; HH = Horas;

    $mctqSEfMM = $_POST["mctqSEfMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SE = Sleep End; f = Work-free days; MM = Minutos;
    
    $mctqSEfMMdecimal = $mctqSEfMM / 60; // Transforma os minutos que o sujeito ACORDA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SE = Sleep End; f = Work-free days; MM = Minutos;

    $mctqSEf = $mctqSEfHH + $mctqSEfMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito ACORDA; SE = Sleep End; f = work-free days;
 
 	// 4.3.5 ) "Com despertador" ou "Sem despertador"
 
    $mctqAlarmf = $_POST["mctqAlarmf"]; // ["Com despertador" (1); "Sem despertador" (0)]; Alarm = Alarm clock use; f = Work-free days; 
	   
	// 4.3.6 ) "Você se LEVANTA ___ minutos depois de despertar"

    $mctqSIfMM = $_POST["mctqSIfMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; SI = Sleep Inertia; f = Work-free days; MM = Minutos;

    $mctqSIf = $mctqSIfMM / 60; // Transforma os minutos que o sujeito PRECISA PARA SE LEVANTAR em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); SI = Sleep Inertia; f = Work-free days; MM = Minutos;

	// 4.3.7 ) "Em média, você passa HH:MM ao ar livre à luz do dia (sem um telhado ou cobertura sobre a cabeça)"
	
	$mctqLEfHH = $_POST["mctqLEfHH"]; // [em horas (00 .. 23)]; LE = Light Exposure; w = Work days; HH = Horas;
	
    $mctqLEfMM = $_POST["mctqLEfMM"]; // [em minutos (00, 10, 20, 30, 40, 50)]; LE = Light Exposure; w = Work days; MM = Minutos;
    
    $mctqLEfMMdecimal = $mctqLEfMM / 60; // Transforma os minutos que o sujeito PASSA À LUZ DO DIA em horas (transformação decimal) ao dividi-los por 1 hora (60 minutos); LE = Light Exposure w = Work days; MM = Minutos;
	
    $mctqLEf = $mctqLEfHH + $mctqLEfMMdecimal; // Soma as horas e os minutos (em decimal) em que o sujeito ACORDA; LE = Light Exposure; w = Work days;


	// 4.4 ) Seção 4: Variáveis computadas

    $mctqSOw = $mctqSPrepw + $mctqSLatw; // Hora em que o sujeito "PEGA NO SONO" nos dias de trabalho; Soma as horas e os minutos (em decimal) em que o sujeito DECIDE DORMIR com os minutos (em decimal) nos quais ele PRECISA PARA DORMIR; SO = Sleep Onset; SPrep = Sleep Preparation; SLat = Sleep Latency; w = Work days; MM = Minutos;

    $mctqSOf = $mctqSPrepf + $mctqSLatf; // Hora em que o sujeito "PEGA NO SONO" fora dos dias de trabalho; Soma as horas e os minutos (em decimal) em que o sujeito DECIDE DORMIR com os minutos (em decimal) nos quais ele PRECISA PARA DORMIR; SO = Sleep Onset; SPrep = Sleep Preparation; SLat = Sleep Latency; f = Work-free days; MM = Minutos;


	// Se a hora em que o sujeito "PEGA NO SONO" for MAIOR OU IGUAL à 24h, subtraí-se o resultado por 24 (quantidade de horas em um dia); Visto que queremos a hora na qual o sujeito "PEGA NO SONO", não podemos considerar uma hora acima das 24h - lembrando que usamos 0:00 para 24 horas;
    if ($mctqSOw >= 24){
        $mctqSOw = $mctqSPrepw + $mctqSLatw - 24;
    }
    
    if ($mctqSOf >= 24){
        $mctqSOf = $mctqSPrepf + $mctqSLatf - 24;
    }

    $mctqGUw = $mctqSEw + $mctqSIw; // Hora em que o sujeito LEVANTA nos dias de trabalho; Soma as horas e os minutos (em decimal) em que o sujeito ACORDA com os minutos (em decimal) nos quais ele PRECISA PARA SE LEVANTAR; GU = Local time of getting out of bed; SE = Sleep End; SI = Sleep Inertia; w = Work days;

    $mctqGUf = $mctqSEf + $mctqSIf; // Hora em que o sujeito LEVANTA fora dos dias de trabalho; Soma as horas e os minutos (em decimal) em que o sujeito ACORDA com os minutos (em decimal) nos quais ele PRECISA PARA SE LEVANTAR; GU = Local time of getting out of bed; SE = Sleep End; SI = Sleep Inertia; w = Work-free days;

	// Se a hora em que o sujeito LEVANTA for MAIOR OU IGUAL à 24h, subtraí-se o resultado por 24 (quantidade de horas em um dia); Visto que queremos a hora na qual o sujeito LEVANTA, não podemos considerar uma hora acima das 24h - lembrando que usamos "0" para 24 horas;
    if ($mctqGUw >= 24){
        $mctqGUw = $mctqSEw + $mctqSIw - 24;
    }
    
    if ($mctqGUf >= 24){
        $mctqGUf = $mctqSEf + $mctqSIf - 24;
    }

    $mctqSDw = $mctqSEw - $mctqSOw; // Duração do sono nos dias de trabalho; As horas e os minutos (em decimal) em que o sujeito ACORDA subtraidas das horas e minutos (em decimal) em que o sujeito "PEGA NO SONO"; SD = Sleep Duration; SE = Sleep End; SO = Sleep Onset; w = Work days;

    $mctqSDf = $mctqSEf - $mctqSOf; // Duração do sono nos FORA dos dias de trabalho; As horas e os minutos (em decimal) em que o sujeito ACORDA subtraidas das horas e minutos (em decimal) em que o sujeito "PEGA NO SONO"; SD = Sleep Duration; SE = Sleep End; SO = Sleep Onset; f = Work-free days;


	// Caso a duração do sono nos dias de trabalho ou FORA dos dias de trabalho seja MENOR do que "0", soma-se a quantidade de horas de um dia (24 horas) com a hora que o sujeito ACORDA menos a hora que o sujeito "PEGA NO SONO"; e.g. O sujeito acorda às 0 horas e "pega no sono" às 18 horas -> 0 -18 = -18; visto que isso representaria a duração acordada (e não do sono), além de que a duração do sono não pode ser negativa, faz-se essa transformação, chegando à 6 horas de duração de sono -> das 18h às 0h.
    if ($mctqSDw < 0){
        $mctqSDw = $mctqSEw - $mctqSOw + 24;
    }
    if ($mctqSDf < 0){
        $mctqSDf = $mctqSEf - $mctqSOf + 24;
    }

	$mctqTBTw = $mctqGUw - $mctqBTw; // Tempo total que o sujeito permaneceu na cama nos dias de trabalho; Hora que o sujeito LEVANTA menos a hora que o sujeito VAI PARA CAMA; TBT = Total Bed Time; GU = Local time of getting out of bed; BT = Bed Time; w = Work days; 

	$mctqTBTf = $mctqGUf - $mctqBTf; // Tempo total que o sujeito permaneceu na cama FORA dos dias de trabalho; Hora que o sujeito LEVANTA menos a hora que o sujeito VAI PARA CAMA; TBT = Total Bed Time; GU = Local time of getting out of bed; BT = Bed Time; f = Work-free days; 

	// Se o tempo total que o sujeito permaneceu na cama for MENOR do que "0", soma-se a ele 24 horas; e.g. o sujeito VAI PARA CAMA às 20h e se LEVANTA às 9h, segundo a equação, 9 - 20 = -11; esse valor (em absoluto) representa as horas em que o sujeiro permaneceu acordado e não na cama; para chegarmos ao valor pretendido soma-mos 24 horas -> -11 +24 = 13 horas, ou seja, o sujeito passou 13 horas em sua cama;
    if ($mctqTBTw < 0){
        $mctqTBTw = $mctqGUw - $mctqBTw + 24;
    }
    if ($mctqTBTf < 0){
        $mctqTBTf = $mctqGUf - $mctqBTf + 24;
    }


    $mctqMSW = $mctqSOw + ($mctqSDw / 2 ); 	// Meio-sono/meia-fase NÃO CORRIGIDA nos dias de trabalho ou ponto médio do sono nos dias de trabalho; Hora em que o sujeito "PEGA NO SONO" mais a metade da duração do sono; MSW = Mid-Sleep in work days; SO = Sleep Onset; SD = Sleep Duration; w = Work days;

    $mctqMSF = $mctqSOf + ($mctqSDf / 2); // Meio-sono/meia-fase NÃO CORRIGIDA FORA dos dias de trabalho ou ponto médio do sono FORA dos dias de trabalho; Hora em que o sujeito "PEGA NO SONO" mais a metade da duração do sono; MSF = Mid-Sleep in work-free days; SO = Sleep Onset; SD = Sleep Duration; f = Work-free days;

	// SE o meio-sono/meia-fase NÃO CORRIGIDA nos dias de trabalho ou FORA dos dias de trabalho seja MAIOR ou IGUAL a 24 horas(lembrando que às 24 horas de um dia é representada por 0 horas), subtrai-se o meio-sono/meia-fase NÃO CORRIGIDA por 24 horas; e.g. o sujeito "PEGA NO SONO" às 20 horas e a duração de seu sono é de 10 horas. 10/2 = 5; 20 + 5 é igual a 25 horas. Como não existe um dia com 25 horas subtrai-se 24 horas -> 25 - 24 = 1 hora da manhã. Resultado: O meio-sono/meia-fase do sujeito se dá à 1 hora da manhã (o ponto médio do sono do sujeito se dá 5 horas depois dele "pegar no sono" (20h depois de 5 horas é 1 hora da manhã);
    if ($mctqMSW >= 24){
        $mctqMSW = ($mctqSOw + ($mctqSDw / 2 )) - 24;
    }
    
    if ($mctqMSF >= 24){
        $mctqMSF = ($mctqSOf + ($mctqSDf / 2)) - 24;
    }


	// 4.5 ) Seção 5: Variáveis computadas combinando dias de trabalho e dias livres (fora dos dias de trabalho)

	$mctqSDweek = (($mctqSDw * $mctqWD) + ($mctqSDf * $mctqFD)) / 7; // Média da duração do sono semanal; a multiplicação da duração do sono em dias de trabalho com a quantidade de dias de trabalho na semana, somado com a multiplicação da duração do sono fora dos dias de trabalho com quantidade de dias livres na semana, com esse montante divido por 7 (quantidade de dias de uma semana); SDweek = Average weekly sleep duration; SDw = Sleep Duration in work days; WD = Work days; SDf = Sleep Duration in work-free days; FD = work-free days;

    $mctqMSFsc = 0; // MSFsc = Meio-sono/meia-fase CORRIGIDA (CRONOTIPO) ou meio-sono/meia-fase Final;
 
 	// Caso a duração do sono fora dos dias de trabalho seja MENOR OU IGUAL à duração do sono nos dias de trabalho, o meio-sono/meia-fase CORRIGIDA (CRONOTIPO) será igual ao meio-sono/meia-fase fora dos dias de trabalho; caso a duração do sono fora dos dias de trabalho seja MAIOR que a duração do sono nos dias de trabalho, o meio-sono/meia-fase CORRIGIDA (CRONOTIPO) será igual ao meio-sono/meia-fase fora dos dias de trabalho menos uma pequena correção - a duração do sono fora dos dias de trabalho menos a média da duração do sono semanal, com o montante divido por 2 (ou seja a média aritmética da duração do sono fora dos dias de trabalho mais a média da duração do sono semanal);
    if ($mctqSDf <= $mctqSDw){
        $mctqMSFsc = $mctqMSF;
    }
    
    if ($mctqSDf > $mctqSDw){
        $mctqMSFsc = $mctqMSF - (($mctqSDf - $mctqSDweek) / 2);
    }
	if ($mctqMSFsc < 0){
        $mctqMSFsc = $mctqMSFsc + 24;
    }

	$mctqSLossweek = 0; // SLossweek = Sleep Loss/Week; Perda Semanal de Sono
	
	// Caso a média da duração do sono semanal seja MAIOR que a duração do sono em dias de trabalho, a perda semanal de sono se dá pela diferença da média da duração do sono semanal com a duração do sono em dias de trabalho, multiplicado pela quantidade de dias de trabalho na semana; caso a média da duração do sono semanal seja MENOR OU IGUAL à duranção do sono em dias de trabalho, a perda semanal de sono se dá pela diferença da média da duração do sono semanal com a duração do sono fora dos dias de trabalho, multiplicado pela quantidade de dias livres na semana;
	if ($mctqSDweek > $mctqSDw){
        $mctqSLossweek = ($mctqSDweek - $mctqSDw) * $mctqWD;
    }
    
    if ($mctqSDweek <= $mctqSDw){
        $mctqSLossweek = ($mctqSDweek - $mctqSDf) * $mctqFD;
    }

    $mctqSJLrel = $mctqMSF - $mctqMSW; // SJLrel = Relative Social Jetlag ou Jetlag Social Relativo; a diferença do meio-sono/meia fase NÂO CORRIGIDA fora dos dias de trabalho com  o meio-sono/meia-fase NÃO CORRIGIDA dos dias de trabalho;

	$mctqSJL = $mctqMSF - $mctqMSW; // SJL = Absolute Social Jetlag ou Jetlag Social Absoluto; o módulo (valor absoluto - função modular) da diferença do meio-sono/meia fase NÂO CORRIGIDA fora dos dias de trabalho com  o meio-sono/meia-fase NÃO CORRIGIDA dos dias de trabalho;

    if($mctqSJL < 0){
        $mctqSJL = ($mctqMSF - $mctqMSW) * (-1);
    }

	$mctqLEweek = (($mctqLEw * $mctqWD) + ($mctqLEf * $mctqFD)) / 7; // Média de exposição à luz semanal; multiplicação da exposição à luz em dias de trabalho pela quantidade de dias de trabalho semanal, somado à multiplicação da exposição à luz fora dos dias de traballho com a quantidade de dias livres semanal, com o montante dividio por 7 (quantidade de dias de uma semana); LEweek = Average weekly light exposure; LE = Light Exposure; WD = Week Days; FD = Work-free days; w = Work days; f = Work-free days;


    // 5 ) CONEXÃO E ARMAZENAMENTO DAS VARIÁVEIS NO BANCO DE DADOS

	include "connect.php"; 

	$sql = "INSERT INTO mctq_20180403 (track, date, time, pdNAME, pdEMAIL, pdBIRTH, pdCOUNTRY, pdSTATE, pdCITY, pdPOSTAL, pdHEIGHT, pdWEIGHT, pdGENDER, pdGENDERidentity, pdSEXUALORIENTATION, hhDRUGS, hhDRUGSwhich, hhSLEEPDISORDER, hhSLEEPDISORDERwhich, hhMEDICATION, hhMEDICATIONwhich, hhSNORE, hhWORK, hhSTUDY, hhNOWORKORSTUDY, hhWORKmorning, hhWORKafternoon, hhWORKevening, hhWORKweehours, hhSTUDYmorning, hhSTUDYafternoon, hhSTUDYevening, hhSTUDYweehours, mctqWD, mctqFD, mctqBTwHH, mctqBTwMM, mctqBTwMMdecimal, mctqBTw, mctqSPrepwHH, mctqSPrepwMM, mctqSPrepwMMdecimal, mctqSPrepw, mctqSLatwMM, mctqSLatw, mctqSEwHH, mctqSEwMM, mctqSEwMMdecimal, mctqSEw, mctqAlarmw, mctqSIwMM, mctqSIw, mctqLEwHH, mctqLEwMM, mctqLEwMMdecimal, mctqLEw, mctqBTfHH, mctqBTfMM, mctqBTfMMdecimal, mctqBTf, mctqSPrepfHH, mctqSPrepfMM, mctqSPrepfMMdecimal, mctqSPrepf, mctqSLatfMM, mctqSLatf, mctqSEfHH, mctqSEfMM, mctqSEfMMdecimal, mctqSEf, mctqAlarmf, mctqSIfMM, mctqSIf, mctqLEfHH, mctqLEfMM, mctqLEfMMdecimal, mctqLEf, mctqSOw, mctqSOf, mctqGUw, mctqGUf, mctqSDw, mctqSDf, mctqTBTw, mctqTBTf, mctqMSW, mctqMSF, mctqSDweek, mctqMSFsc, mctqSLossweek, mctqSJLrel, mctqSJL, mctqLEweek)

	VALUES ('$track', '$date', '$time', '$pdNAME', '$pdEMAIL', '$pdBIRTH', '$pdCOUNTRY', '$pdSTATE', '$pdCITY', '$pdPOSTAL', '$pdHEIGHT', '$pdWEIGHT', '$pdGENDER', '$pdGENDERidentity', '$pdSEXUALORIENTATION', '$hhDRUGS', '$hhDRUGSwhich', '$hhSLEEPDISORDER', '$hhSLEEPDISORDERwhich', '$hhMEDICATION', '$hhMEDICATIONwhich', '$hhSNORE', '$hhWORK', '$hhSTUDY', '$hhNOWORKORSTUDY', '$hhWORKmorning', '$hhWORKafternoon', '$hhWORKevening', '$hhWORKweehours', '$hhSTUDYmorning', '$hhSTUDYafternoon', '$hhSTUDYevening', '$hhSTUDYweehours', '$mctqWD', '$mctqFD', '$mctqBTwHH', '$mctqBTwMM', '$mctqBTwMMdecimal', '$mctqBTw', '$mctqSPrepwHH', '$mctqSPrepwMM', '$mctqSPrepwMMdecimal', '$mctqSPrepw', '$mctqSLatwMM', '$mctqSLatw', '$mctqSEwHH', '$mctqSEwMM', '$mctqSEwMMdecimal', '$mctqSEw', '$mctqAlarmw', '$mctqSIwMM', '$mctqSIw', '$mctqLEwHH', '$mctqLEwMM', '$mctqLEwMMdecimal', '$mctqLEw', '$mctqBTfHH', '$mctqBTfMM', '$mctqBTfMMdecimal', '$mctqBTf', '$mctqSPrepfHH', '$mctqSPrepfMM', '$mctqSPrepfMMdecimal', '$mctqSPrepf', '$mctqSLatfMM', '$mctqSLatf', '$mctqSEfHH', '$mctqSEfMM', '$mctqSEfMMdecimal', '$mctqSEf', '$mctqAlarmf', '$mctqSIfMM', '$mctqSIf', '$mctqLEfHH', '$mctqLEfMM', '$mctqLEfMMdecimal', '$mctqLEf', '$mctqSOw', '$mctqSOf', '$mctqGUw', '$mctqGUf', '$mctqSDw', '$mctqSDf', '$mctqTBTw', '$mctqTBTf', '$mctqMSW', '$mctqMSF', '$mctqSDweek', '$mctqMSFsc', '$mctqSLossweek', '$mctqSJLrel', '$mctqSJL', '$mctqLEweek')";

	// Caso o respondente selecione que ele acorda COM DESPERTADOR fora dos dias de trabalho, o script NÃO IRÁ ARMAZENAR os dados dele no banco de dados e o redirecionará para uma página específica;
	if($mctqAlarmf == 1){
	    header("Location:../invalid.php"); 
		exit;         
	    }

	$resultado = mysqli_query($conn, $sql);


    // 6 ) REDIRECIONAMENTO A PARTIR DOS RESULTADOS DE CRONOTIPO

	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "3,2123", o script direcionará para a página com o resultado "Extremamente Matutino";
	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "3,8237", o script direcionará para a página com o resultado "Moderadamente Matutino";
	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "4,4351", o script direcionará para a página com o resultado "Levemente Matutino";
	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "5,0465", o script direcionará para a página com o resultado "Intermediário";
	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "6,8807", o script direcionará para a página com o resultado "Moderadamente Vespertino";
	// Caso o resultado do CRONOTIPO do sujeito seja MENOR que "11,7718", o script direcionará para a página com o resultado "Extremamente Vespertino";
	// Caso o resultado do CRONOTIPO do sujeito seja MAIOR que "11,7718", o script também direcionará para a página com o resultado "Extremamente Vespertino" - Casos Raros, mas que ainda não há nenhuma categoria diferente de EV para descrevê-los;

	// Caso o resultado do CRONOTIPO não atenda nenhum dos critérios acima, o script retornará uma mensagem de erro;
	
	if($resultado){
		if($mctqMSFsc < 3.2123){
	    	header("Location:../em.php");          
		    }
	    else{
		    if($mctqMSFsc < 3.8237){
			    header("Location:../mm.php");    
				    }
			    else{
				    if($mctqMSFsc < 4.4351){
					    header("Location:../lm.php");
					    }
				    else{
					    if($mctqMSFsc < 5.0465){
						    header("Location:../int.php");  
						    }
					    else{
						    if($mctqMSFsc < 5.6578){
							    header("Location:../lv.php");    
							    }
						    else{
							    if($mctqMSFsc < 6.8807){
								    header("Location:../mv.php");    
								    }
							    else{
								    if($mctqMSFsc < 11.7718){
									    header("Location:../ev.php");     
									    }
									else{
										if($mctqMSFsc > 11.7718){
										header("Location:../ev.php");     
									    }
										else{
									    	echo "Erro: Contate o Administrador";
											}
	} } } } } } } }

?>

<body>   
</body>

</html>