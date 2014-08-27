<?php

 /*echo "
        <script type=\"text/javascript\">
		$(function(){
			$(\"[name='idestado']\").change(function(){
				if( $(this).val() ) {
					$(\"[name='idcidade']\").hide();
					$('.carregando').show();
					$.getJSON('../../mundo/cidades.php?idestado=',{idestado: $(this).val(), ajax: 'true'}, function(j){
						if(j.length == 'undefined') {
                                                    options = '<option value=\"\">Não há cidades cadastradas</option>';
						}
                                                else {
                                                    options = '<option value=\"\">-- Escolha a cidade --</option>';	
                                                    for (var i = 0; i < j.length; i++) {
                                                            options += '<option value=\"' + j[i].idcidade + '\">' + j[i].nomecidade + '</option>';
                                                    }
                                                }
                                                $(\"[name='idcidade']\").html(options).show();
						$('.carregando').hide();
					});
				} else {
					$(\"[name='idcidade']\").html('<option value=\"\"> Escolha um estado </option>');
				}
			});
		});
		</script>
                ";*/
                echo <<<END
            <script type="text/javascript">
                            $(function(){
                                    $("[name='idestado']").change(function(){
                                            if( $(this).val() ) {
                                                    $("[name='idcidade']").hide();
                                                    $('.carregando').show();
                                                    $.getJSON('../../mundo/cidades.php?idestado=',{idestado: $(this).val(), ajax: 'true'}, function(j){
                                                             options = '<option value="">-- Escolha a cidade --</option>';	
                                                             for (var i = 0; i < j.length; i++) {
                                                                        options += '<option value="' + j[i].idcidade + '">' + j[i].nomecidade + '</option>';
                                                             }
                                                            $("[name='idcidade']").html(options).show();
                                                            $('.carregando').hide();
                                                    });
                                            } else {
                                                    $("[name='idcidade']").html('<option value="">-- Escolha um estado --</option>');
                                            }
                                    });
                            });
                            </script>
END;

?>
