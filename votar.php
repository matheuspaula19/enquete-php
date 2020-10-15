<?php
	include "config.php";
	$_con = @mysql_connect($host,$login_db,$senha_db);
	if($_con===FALSE)
	{
		ECHO "<div id='error_alert2'>N&#227;o foi poss&#237;vel conectar ao servidor!</div>".
		mysql_error();
		exit;
	}

	mysql_select_db($bd_enquete,$_con);
	if ($_con===FALSE)
	{
		echo "<div id='error_alert2'>N&#227;o foi poss&#237;vel selecionar o banco de dados!</div>".
		mysql_error();
		exit;
	}
	
	if(isset($_GET['id']))
	{
		$idenquete = $_GET['id'];
	}
	else
	{
		$idenquete = 'Id da enquete não informado!';
	}
	
	$_sql = "select num_opcoes from enquetes where idenquete=".$idenquete;
	$_res = mysql_query($_sql,$_con);
	while($_row=mysql_fetch_assoc($_res))
	{
		foreach($_row as $_vlr)
		{
			$n_opc = $_vlr;
		}	
	}
	
	$_sql = "select tipo_resposta from enquetes where idenquete=".$idenquete;
	$_res = mysql_query($_sql,$_con);
	while($_row=mysql_fetch_assoc($_res))
	{
		foreach($_row as $_vlr)
		{
			$tipo_resp = $_vlr;
		}	
	}
	mysql_close($_con);
	
	
	
	
	$_con = new mysqli($host,$login_db,$senha_db,$bd_enquete);
	if(!$_con)
	{
		echo "<div id='error_alert2'>N&#227;o foi poss&#237;vel conectar ao Banco de Dados. Erro #" .
		mysqli_connect_errno() . " : " . mysql_connect_error();
		echo "</div>";
		exit;
	}
	
	if($tipo_resp == 'multipla')
	{
		$_sql = "update enquetes set n_votos=n_votos+1 where idenquete=".$idenquete.";";
		$_res = $_con->query($_sql);
		
		if(isset($_POST['opc1']) == 1)
		{
			$_sql = "update enquetes set opc1= opc1 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
		if(isset($_POST['opc2']) == 1)
		{
			$_sql = "update enquetes set opc2= opc2 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
		if(isset($_POST['opc3']) == 1)
		{
			$_sql = "update enquetes set opc3= opc3 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
		if(isset($_POST['opc4']) == 1)
		{
			$_sql = "update enquetes set opc4= opc4 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
		if(isset($_POST['opc5']) == 1)
		{
			$_sql = "update enquetes set opc5= opc5 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
		if(isset($_POST['opc6']) == 1)
		{
			$_sql = "update enquetes set opc6= opc6 + 1 where idenquete=".$idenquete.";";
			$_res = $_con->query($_sql);
		}
	}
	if($tipo_resp == 'unica')
	{
		$_sql = "update enquetes set opc".$_POST['opc']."=opc".$_POST['opc']."+1, n_votos=n_votos+1 where idenquete=".$idenquete;
		$_res = $_con->query($_sql);
	}
	
	if($_res === FALSE)
	{		
		echo "<div id='error_alert2'>Erro na computação do voto!</div>";
	}
	else
	{
		echo "<script type='text/javascript'>
				location.href='resultados/?id=".$idenquete."&voto=sim';
			</script>";
	}
	
?>