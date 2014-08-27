<html>
	<head>
		<title>Exemplo: Populando selects de cidades e estados com AJAX (PHP e jQuery) | DaviFerreira blog!</title>
		<style type="text/css">
			*, html {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				margin: 0px;
				padding: 0px;
				font-size: 12px;
			}

			a {
				color: #0099CC;
			}

			body {
				margin: 10px;
			}
			.carregando{
				color:#666;
				display:none;
			}
		</style>
	</head>
	<body>
		<?php
			$con = mysql_connect( 'localhost', 'root', '1' ) ;
			mysql_select_db( 'vendasteste', $con );
		?>
		<label for="idestado">Estado:</label>
		<select name="idestado" id="idestado">
			<option value=""></option>
			<?php
				$sql = "SELECT DISTINCT idestado, nomeestado
						FROM cidade
						ORDER BY nomeestado";
				$res = mysql_query( $sql );
				while ( $row = mysql_fetch_assoc( $res ) ) {
					echo '<option value="'.$row['idestado'].'">'.$row['nomeestado'].'</option>';
				}
			?>
		</select>

		<label for="idcidade">Cidade:</label>
		<span class="carregando">Aguarde, carregando...</span>
		<select name="idcidade" id="idcidade">
			<option value="">-- Escolha um estado --</option>
		</select>

		<script src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load('jquery', '1.3');
		</script>		

		<script type="text/javascript">
		$(function(){
			$('#idestado').change(function(){
				if( $(this).val() ) {
					$('#idcidade').hide();
					$('.carregando').show();
					$.getJSON('../mundo/cidades.php?idestado=',{idestado: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">vazio</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idcidade + '">' + j[i].nomecidade + '</option>';
						}	
						$('#idcidade').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#idcidade').html('<option value=""> Escolha um estado </option>');
				}
			});
		});
		</script>
	</body>
