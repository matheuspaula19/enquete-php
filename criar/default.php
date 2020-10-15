<html>
	<head>
		<title>Criar Enquete</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
		<style type="text/css" media="all">
		body{font-family: 'Open Sans',Arial,Helvetica;color:#666;}
		#respostas{transition: .3s all;}
		#opc_tbl td{padding-bottom:10px;}
		#adc_link{margin-left: 97px;font-size: 11px;font-family: 'Open Sans',Arial,Helvetica;color: #ca2900;}
		#dropdown select
        {
            cursor:pointer;
            outline: none;
            border: medium none;
            padding:6px 5px 5px 5px;
            -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
            border: 1px solid #ddd;
        }
        #dropdown select:focus
        {
            -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
        }
		.txt_box{
			height: 27px;
			border: 1px solid #ccc;
			padding-left: 4px;
			outline:none;
			-webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
		}
		.txt_box:focus{
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
		.opc_4{height: 155px;overflow:hidden;}
		.opc_6{height: 236px;overflow:hidden;}
		</style>
		<script type='text/Javascript'>
		function expandeOpc(opc) {
			opc = document.getElementById(opc);
			if (opc.className=="opc_4") 
			{
				opc.className="opc_6";
			}
			else 
			{
				opc.className="opc_4";
			}
		}
		function alttexto()
		{
			valor = document.getElementById('adc_link').innerHTML;
			 if(valor == 'Adicionar mais respostas'){
				document.getElementById('adc_link').innerHTML = 'Remover respostas';
			}else{
				document.getElementById('adc_link').innerHTML = 'Adicionar mais respostas';
			}
		}
		
		function verificageral() {
			verificaperg(); 
			verificaopc1(); 
			verificaopc2();
			if(verificaperg() && verificaopc1() && verificaopc2())
			{
				document.criar_enquete.submit();
			}
			if(verificaopc1() == false && verificaopc2() == false)
			{
				document.getElementById('resp_error').style.display= "block";
			}
		}
		
		function verificaperg()
		{
			campo1 = document.getElementById('perg').value;
			if(campo1.length <= 0)
			{
				document.getElementById('perg').style.border = '1px solid #ca2900';
				return false;
			}
			else
			{
				document.getElementById('perg').style.border = '1px solid #ddd';
				return true;
			}
		}
		function verificaopc1()
		{
			campo1 = document.getElementById('opc1').value;
			if(campo1.length <= 0)
			{
				document.getElementById('opc1').style.border = '1px solid #ca2900';
				return false;
			}
			else
			{
				document.getElementById('opc1').style.border = '1px solid #ddd';
				return true;
			}
		}
		function verificaopc2()
		{
			campo1 = document.getElementById('opc2').value;
			if(campo1.length <= 0)
			{
				document.getElementById('opc2').style.border = '1px solid #ca2900';
				return false;
			}
			else
			{
				document.getElementById('opc2').style.border = '1px solid #ddd';
				return true;
			}
		}
		</script>
	</head>
	<body>
		<div style="font-family: 'Open Sans',Arial,Helvetica;color:#00A200;font-size:16px;border-bottom:1px solid #00A200;width:400px;">Criar enquete</div>
		<br/>
		<form method="post" name="criar_enquete" action="enquete_criada.php">
			<table>
				<tr>
					<td style="width:90px;padding-bottom:10px;font-size:14px;">Pergunta</td><td style="padding-bottom:10px;"><input type="text" id="perg" name="perg" maxlength="200" class="txt_box" style="width:220px;" onfocusout="javascript: verificaperg();"/></td>
				</tr>
			</table>
			<div id="respostas" class="opc_4">
			<table id="opc_tbl">	
				<tr>
					<td style="width:90px;font-size:14px;">Respostas</td><td><input type="text" id="opc1" name="opc1" placeholder="1" maxlength="200" class="txt_box" style="width:170px;" onfocusout="javascript: verificaopc1();"/></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="text" id="opc2" name="opc2" placeholder="2" maxlength="200" class="txt_box" style="width:170px;" onfocusout="javascript: verificaopc2();"/></td>
				</tr>	
				<tr>
					<td colspan="2" align="right"><input type="text" name="opc3" placeholder="3" maxlength="200" class="txt_box" style="width:170px;"/></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="text" name="opc4" placeholder="4" maxlength="200" class="txt_box" style="width:170px;"/></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="text" name="opc5" placeholder="5" maxlength="200" class="txt_box" style="width:170px;"/></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="text" name="opc6" placeholder="6" maxlength="200" class="txt_box" style="width:170px;"/></td>
				</tr>			
			</table>
			</div>
			<a href='#' id="adc_link" onclick="javascript:expandeOpc('respostas');alttexto()">Adicionar mais respostas</a>
			<div>
			<br />
				<table id="dropdown">
					<tr>
						<td style="padding-bottom:10px;">
							<span style="font-size:14px;">Modo de Resposta:</span>
							<select name="tipo_resposta" style="width:160px;">
								<option value="multipla" selected>M&#250;ltiplas alternativas</a>
								<option value="unica">Alternativa &#250;nica</option>
							</select>	
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td align="right" style="font-size:14px;">Fechamento da enquete:&nbsp;</td>
									<td>
										<SELECT NAME="term_dia" SIZE="1">
												<?php		
												for ($di=1;$di<=31; $di++) 
												{
													if($di == date("d"))
													{
														$dia = str_pad($di, 2, "0", STR_PAD_LEFT); 
														echo "<option value='$dia' selected>$dia</option>";	
													}
													else
													{
														$dia = str_pad($di, 2, "0", STR_PAD_LEFT);
														echo "<option value='$dia'>$dia</option>";
													}
												}
												?>
										</SELECT>
									</td>
									<td>&nbsp;/&nbsp;</td>
									<td>
										<SELECT NAME="term_mes" SIZE="1">
												<?php
															
												for ($me=1;$me<=12; $me++) 
												{
													if($me-1 == date("m"))
													{
														$mes = str_pad($me, 2, "0", STR_PAD_LEFT); 
														echo "<option value='$mes' selected>$mes</option>";	
													}
													else
													{
														$mes = str_pad($me, 2, "0", STR_PAD_LEFT);
														echo "<option value='$mes'>$mes</option>";
													}
												}
												?>
										</SELECT>
									</td>
									<td>&nbsp;/&nbsp;</td>
									<td>
										<SELECT NAME="term_ano" SIZE="1">
												<?php		
												for ($an=1940; $an<=date("Y")+1; $an++) 
												{
													if(date("m") == 12)
													{
														if($an-1 == date("Y"))
														{
															echo "<option value='$an' selected>$an</option>";
														}
														else
														{
															echo "<option value='$an'>$an</option>";
														}
													}
													else
													{
														if($an == date("Y"))
														{
															echo "<option value='$an' selected>$an</option>";
														}
														else
														{
															echo "<option value='$an'>$an</option>";
														}
													}
												}
												?>
										</SELECT>
									</td>
								</tr>
							</table>	
						</td>
					</tr>	
				</table>		
			
			</div>
			<br/>
			<div style="font-family: 'Open Sans',Arial,Helvetica;color:#00A200;font-size:16px;border-bottom:1px solid #00A200;width:400px;">Permissão de Acesso</div>
			<table>
			    <tr>
					<td style="font-size:14px;height:50px;">Usuário:</td><td><input type="text" name="usr" maxlength="15" class="txt_box" style="width:150px;"/></td>
					<td style="font-size:14px;height:50px;">&nbsp;Senha:</td><td><input type="password" name="senha" maxlength="15" class="txt_box" style="width:120px;"/></td>
				</tr>
				<tr>				
					<td><button type="button" id="send_btn" class="btn_padrao" onclick="javascript: verificageral();">Salvar</button></td>
					<td><input type="reset"class="btn_padrao" name="reset" value="Limpar campos"/></td>
					<td colspan="2"><span id="resp_error" style="display:none;color:#ca2900;font-family: 'Open Sans',Arial,Helvetica;font-size:11px;">&nbsp;*Adicione ao menos duas respostas</span></td>
				</tr>
			</table>
		</form>	
	</body>
</html>	