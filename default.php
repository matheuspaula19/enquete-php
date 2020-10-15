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
		$val = "select idenquete from enquetes where idenquete=".$idenquete;
		$resp = mysql_query($val,$_con);
		if(mysql_num_rows($resp) == 0)
		{
			$tipo_resp = "";
			$n_opc = "";
			echo"
			<style>#tbl_enquete, #title{display:none;}</style>
			<script type='text/Javascript'>
			function abreenquete()
			{
				id = document.getElementById('idenquete').value;
				location.href= '?id='+id;
			}
			</script>
			<table>
				<tr>
					<td class='txt_padrao'>O ID de n&#176;".$idenquete.", n&#227;o existe!</td>
				</tr>	
				<tr>
					<td class='txt_padrao'>Informe o ID da enquete: </td><td><input type='text' id='idenquete' style='width:70px;'/></td>
					<td><button type='button' id='send_btn' class='btn_padrao' onclick='javascript: abreenquete();'>OK</button></td>
				</tr>
			</table>	
			";
		}
	}
	else
	{
		$tipo_resp = "";
		$n_opc = "";
		echo"
		<style>#tbl_enquete, #title{display:none;}</style>
		<script type='text/Javascript'>
		function abreenquete()
		{
			id = document.getElementById('idenquete').value;
			location.href= location.href+'?id='+id;
		}
		</script>
		<table>
			<tr>
				<td class='txt_padrao'>Informe o ID da enquete: </td><td><input type='text' id='idenquete' style='width:70px;'/></td>
				<td><button type='button' id='send_btn' class='btn_padrao' onclick='javascript: abreenquete();'>OK</button></td>
			</tr>
		</table>	
		";
	}
	

	
	if(isset($_GET['id']))
	{
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
		
		
		function formatodata($data)
		{
			return substr($data,8,9)."/".substr($data,5,2)."/".substr($data,0,4);
		}
		
		$_sql = "select datediff(termino, curdate()) from enquetes where idenquete=".$idenquete;
		$_res = mysql_query($_sql,$_con);
		while($_row=mysql_fetch_assoc($_res))
		{
			foreach($_row as $_vlr)
			{
				if($_vlr <= 0)
				{
					echo "<script type='text/javascript'>
							location.href='resultados/?id=".$idenquete."';
						</script>";
				}
			}
		}
	}

	
 ?>
<html>
	<head>
		<title>Enquete</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
		<style type="text/css" media="all">
		#tbl_enquete,.txt_padrao{font-family: 'Open Sans',Arial,Helvetica;color:#666;font-size:14px;}
		#aviso_multiescolha{background: #D4FFF0;width: 210px;padding-left: 5px;font-size: 10px;color: #00A200;line-height: 25px;border: 1px solid #00A200;border-radius: 3px;}
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
		<script type='text/Javascript'>
		function vervoto()
		{
			if(document.getElementById('opc1')){var opc1 = document.getElementById('opc1').checked}else{var opc1 = false};
			if(document.getElementById('opc2')){var opc2 = document.getElementById('opc2').checked}else{var opc2 = false};
			if(document.getElementById('opc3')){var opc3 = document.getElementById('opc3').checked}else{var opc3 = false};
			if(document.getElementById('opc4')){var opc4 = document.getElementById('opc4').checked}else{var opc4 = false};
			if(document.getElementById('opc5')){var opc5 = document.getElementById('opc5').checked}else{var opc5 = false};
			if(document.getElementById('opc6')){var opc6 = document.getElementById('opc6').checked}else{var opc6 = false};
			
			if((opc1 || opc2 || opc3 || opc4 || opc5 || opc6) == true)
			{
				document.votar.submit();
			}
			else
			{
				alert("É necessário selecionar pelo menos uma opção para votar!");
			}
		}
		</script>
	</head>
	<body>
		<form method="post" name="votar" id="votar" action="votar.php<?php echo "?id=".$idenquete ?>">
			<table width="290" id="tbl_enquete">
				<tr>
					<td colspan="2"><?php 
					$_sql = "select pergunta from enquetes where idenquete=".$idenquete;
					$_res = mysql_query($_sql,$_con);
					while($_row=mysql_fetch_assoc($_res))
					{
						foreach($_row as $_vlr)
						{
							echo "<b><p style='margin-bottom: 15px;'>".$_vlr."</p></b>";
						}	
					}
					?></td>
				</tr>
					<?php
					$c = 1;
					do
					{
						if($tipo_resp == 'multipla')
						{
							echo "<tr><td width='10' style='height: 30px;'><input type='checkbox' id='opc".$c."' name='opc".$c."' value='1'/></td>";
						}
						else
						{
							echo "<tr><td width='10' style='height: 30px;'><input type='radio' id='opc".$c."' name='opc' value='".$c."'/></td>";
						}
						echo "<td style='font-size:12px;height: 30px;'>";
						$_sql = "select opc".$c."_txt from enquetes where idenquete=".$idenquete;
						$_res = mysql_query($_sql,$_con);
						while($_row=mysql_fetch_assoc($_res))
						{
							foreach($_row as $_vlr)
							{
								echo $_vlr;
							}
						}
						echo "</td></tr>";
					$c++;
					}while($n_opc >= $c);
										
					if($tipo_resp == 'multipla')
					{
						echo "<tr><td colspan='2' style='height:46px;'><p id='aviso_multiescolha'>Voc&#234; pode escolher mais de uma resposta</p></td></tr>";
					}
					?>
					<tr>
						<td colspan="2" align="left"><div style='margin-top:12px;'><a href="#" class="btn_padrao" onclick="javascript: vervoto();">Votar</a>&nbsp;&nbsp;<a href="<?php echo'resultados/?id='.$idenquete; ?>" class="btn_padrao">Exibir Resultados</a></div><br /></td>
					</tr>
					<tr>
						<td colspan="2" style='font-size:12px;'><?php
							
							$_sql = "select datediff(termino, curdate()) from enquetes where idenquete=".$idenquete;
							$_res = mysql_query($_sql,$_con);
							while($_row=mysql_fetch_assoc($_res))
							{
								foreach($_row as $_vlr)
								{
									echo "Dias para votar: ".$_vlr;
								}
							}
						?></td>
					</tr>
					<tr>
						<td colspan="2" style='font-size:12px;'><?php
							$_sql = "select termino from enquetes where idenquete=".$idenquete;
							$_res = mysql_query($_sql,$_con);
							while($_row=mysql_fetch_assoc($_res))
							{
								foreach($_row as $_vlr)
								{
									echo "Encerramento: ".formatodata($_vlr);
								}
							}
							mysql_close($_con);
						?></td>
					</tr>	
			</table>		
		</form>
	</body>
</html>