<?php
if(isset($_POST['perg']) && ($_POST['senha'] == "granturismo4") && ($_POST['usr'] == "root"))
{
	include "../config.php";
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
	
	$pergunta = $_POST['perg'];
	$tipo_resp = $_POST['tipo_resposta'];
	$term_dia = $_POST['term_dia'];
	$term_mes = $_POST['term_mes'];
	$term_ano = $_POST['term_ano'];
	
	$termino = $term_ano."-".$term_mes."-".$term_dia;
	
	if($_POST['opc1'] == null){$opc1 = '';}else{$opc1 = $_POST['opc1'];}
	if($_POST['opc2'] == null){$opc2 = '';}else{$opc2 = $_POST['opc2'];}
	if($_POST['opc3'] == null){$opc3 = '';}else{$opc3 = $_POST['opc3'];}
	if($_POST['opc4'] == null){$opc4 = '';}else{$opc4 = $_POST['opc4'];}
	if($_POST['opc5'] == null){$opc5 = '';}else{$opc5 = $_POST['opc5'];}
	if($_POST['opc6'] == null){$opc6 = '';}else{$opc6 = $_POST['opc6'];}
	
	//conta quantas respostas foram adicionadas
	$num_opc = 0;
	if($opc1 != ''){$num_opc++;}	
	if($opc2 != ''){$num_opc++;}	
	if($opc3 != ''){$num_opc++;}	
	if($opc4 != ''){$num_opc++;}	
	if($opc5 != ''){$num_opc++;}
	if($opc6 != ''){$num_opc++;}		
	
	//retorna o id da nova enquete
	$sql = "SHOW TABLE STATUS LIKE 'enquetes'";
	$resultado = mysql_query($sql);
	$linha = mysql_fetch_array($resultado);
	$prox_id = $linha['Auto_increment'];
	
	$val = "select pergunta from enquetes where pergunta like'%".$pergunta."%';";
	$resp = mysql_query($val,$_con);
	
	if(mysql_num_rows($resp) != 0)
	{
		echo "<script type='text/javascript'>
				location.href='http://matheusproducoes.hol.es/enquete/criar/';
			</script>";
	}
	else
	{
		$_con = new mysqli($host,$login_db,$senha_db,$bd_enquete);
		if(!$_con)
		{
			echo "<div id='error_alert2'>N&#227;o foi poss&#237;vel conectar ao Banco de Dados. Erro #" .
			mysqli_connect_errno() . " : " . mysql_connect_error();
			echo "</div>";
			exit;
		}
		$_sql = "insert into enquetes values(null, '$pergunta', 0, 0, 0, 0, 0, 0, '$opc1', '$opc2', '$opc3', '$opc4', '$opc5', '$opc6', '$termino', $num_opc, '$tipo_resp', 0);";
		$_res = $_con->query($_sql);
		
		if($_res === FALSE)
		{		
			echo "<div id='error_alert2'>Erro na criação da enquete!</div><style type='text/css'>#relatorio_enquete{display:none;}</style>";
		}
	}
	
}
else
{
	echo "<script type='text/javascript'>
				location.href='/enquete/criar';
		</script>";
}

?>
<html>
	<head>
		<title>Enquete Criada</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
		<style type="text/css" media="all">
		#relatorio_enquete{font-family: 'Open Sans',Arial,Helvetica;color:#666;font-size:14px;}
		#relatorio_enquete td{padding-bottom: 20px;}
		#lista_alternativas li{list-style-type: decimal;}
		#url_box{
			width: 240px;
			height: 27px;
			border: 1px solid #ccc;
			padding-left: 4px;
			outline:none;
			-webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
		}
		#url_box:focus{
			-webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
		}
		.btn_padrao{
			outline:none;
			cursor:pointer;
			color:#777;
			text-decoration:none;
			background-color: rgb(240, 240, 240);
			border: 1px solid #ccc;
			padding: 4px 8px 4px 8px;
			-webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
			font-family: 'Open Sans',Arial,Helvetica;color:#666;
			font-size:12px;
		}
		.btn_padrao:hover{
			border: 1px solid #bbb;
			color:#555;
			-webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
		}
		.btn_padrao:active{
			border: 1px solid #aaa;
		}
		</style>
	</head>
	<body>
		<div style="font-family: 'Open Sans',Arial,Helvetica;color:#00A200;font-size:16px;border-bottom:1px solid #00A200;width:400px;">Enquete Criada</div>
		<br/>
		<table id="relatorio_enquete">
			<tr>
				<td>ID da enquete:</td><td><b><?php echo $prox_id; ?></b></td>
			</tr>
			<tr>
				<td>Pergunta:</td><td><b><?php echo $pergunta;?></b></td>
			</tr>
			<tr>
				<td>Modo de respostas: </td><td><b><?php if($tipo_resp == 'multipla'){echo"M&#250;ltiplas alternativas";}else{echo"Alternativa &#250;nica";} ?></b></td>
			</tr>
			<tr>
				<td>Encerra em: </td><td><b><?php echo $term_dia."/".$term_mes."/".$term_ano; ?></b></td>
			</tr>
			<tr>
				<td colspan="2">Respostas poss&#237;veis:</td>
			</tr>
			<tr>
				<td colspan="2">
					<ul id="lista_alternativas">
						<?php 
							if($opc1 != null){echo "<li>".$opc1;"</li>";}
							if($opc2 != null){echo "<li>".$opc2;"</li>";}
							if($opc3 != null){echo "<li>".$opc3;"</li>";}
							if($opc4 != null){echo "<li>".$opc4;"</li>";}
							if($opc5 != null){echo "<li>".$opc5;"</li>";}
							if($opc6 != null){echo "<li>".$opc6;"</li>";}
						?>
					</ul>
				</td>	
			</tr>
			<tr>
				<td colspan="2">URL:&nbsp;<input type="text" value="<?php echo $_SERVER['SERVER_NAME']."/enquete/?id=".$prox_id ?>" id="url_box"/>&nbsp;<a href="<?php echo "../?id=".$prox_id ?>" class="btn_padrao" target="_blank">Abrir</a></td>
			</tr>
		</table>	
	</body>
</html>	