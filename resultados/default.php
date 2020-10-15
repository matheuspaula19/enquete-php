<?php
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
			<style>#tbl_resultados, #title{display:none;}</style>
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
		$_sql = "select num_opcoes from enquetes where idenquete=".$idenquete;
		$_res = mysql_query($_sql,$_con);
		while($_row=mysql_fetch_assoc($_res))
		{
			foreach($_row as $_vlr)
			{
				$n_opc = $_vlr;
			}	
		}
	}
	else
	{
		echo"
		<style>#tbl_resultados, #title{display:none;}</style>
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
	
	
?>
<html>
	<head>
		<title>Enquete | Resultados</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
		<style type="text/css" media="all">
		#tbl_resultados{font-family: 'Open Sans',Arial,Helvetica;color:#666;font-size:14px;}
		#barra_por{transition: 1s width;}
		.grafico_porcentagem{border:1px solid #ca2900;width: 160px;border-radius:4px;}
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
		<table width="285" id="tbl_resultados">
			<tr>
				<td colspan="3" style='height:40px;'><?php 
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
			if(isset($idenquete))
			{
				$c = 1;
				do
				{
					echo "<tr>";
						$_sql = "select opc".$c."_txt from enquetes where idenquete=".$idenquete;
						$_res = mysql_query($_sql,$_con);
						$borda=0;
						while($_row=mysql_fetch_assoc($_res))
						{
							foreach($_row as $_vlr)
							{
								if(mysql_field_name($_res,0) == 'opc1_txt')
								{
									echo "<td style='font-size:12px;padding-top: 6px;' colspan='3'>".$_vlr."</td>";
									
								}
								else
								{
									echo "<td style='font-size:12px;padding-top: 6px;border-top:1px solid #eee;' colspan='3'>".$_vlr."</td>";
								}
							}	
						}
					echo "</tr><tr>";
					$_sql = "select (opc".$c."/(opc1+opc2+opc3+opc4+opc5+opc6)*100),opc".$c." from enquetes where idenquete=".$idenquete;
					$_res = mysql_query($_sql,$_con);
					$col=0;
					while($_row=mysql_fetch_assoc($_res))
					{
						foreach($_row as $_vlr)
						{
							if($col==0)
							{
								echo "<td style='padding-bottom: 6px;'><div class='grafico_porcentagem'><div style='background:#ca2900;height: 14px;width:".number_format($_vlr,0)."%;'></div></div></td><td valign='top' style='padding-bottom: 6px;'>".number_format($_vlr,0)."%</td>";
							}	
							else
							{
								if($_vlr == 1)
								{
									echo "<td valign='top' style='font-size:12px;padding-bottom: 6px;'>(".number_format($_vlr,0)." voto)</td>";
								}
								else
								{
									if($_vlr == 0)
									{
										echo "<td valign='top' style='font-size:12px;padding-bottom: 6px;white-space: nowrap;'>(Nenhum voto)</td>";
									}
									else
									{
										echo "<td valign='top' style='font-size:12px;padding-bottom: 6px;'>(".number_format($_vlr,0)." votos)</td>";
									}
									
								}
							}
							$col++;							
						}
					}
					echo "</tr>";
				$c++;
				}while($n_opc >= $c);
				
				$_sql = "select datediff(termino, curdate()) from enquetes where idenquete=".$idenquete;
				$_res = mysql_query($_sql,$_con);
				while($_row=mysql_fetch_assoc($_res))
				{
					foreach($_row as $_vlr)
					{
						$dias_res = $_vlr;
					}
				}
				
				if($dias_res > 0)
				{
					echo "<tr><td colspan='1' style='font-size:12px;'>";
					$_sql = "select n_votos from enquetes where idenquete=".$idenquete;
					$_res = mysql_query($_sql,$_con);
					while($_row=mysql_fetch_assoc($_res))
					{
						foreach($_row as $_vlr)
						{
							echo "<br />Pessoas que votaram: ".$_vlr;
						}
					}
					echo "</td>";
					if(isset($_GET['voto']) != "sim")
					{
						echo"<td colspan='2' rowspan='2' align='center' style='height: 45px;'><a href='../?id=".$idenquete."' class='btn_padrao'>Vote Agora</a></td>";
					}
					echo "</tr><tr><td colspan='1' style='font-size:12px;'>";
					echo "Dias restantes para votar: ".$dias_res."</td>";
					echo "</tr>";
				}
				else
				{
					echo"<tr><td style='font-size:12px;COLOR:#CA2900;'><br />ENQUETE ENCERRADA</td></tr>";
				}
				
			}	
				mysql_close($_con);
			?>
		</table>
	</body>
</html>		