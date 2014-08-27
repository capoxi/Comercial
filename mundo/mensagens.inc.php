<?php
   
      
      function montaMensagem($tipo, $op = null)
      {
            $mensagem = array(
              "alerta" => "Alerta: NDA",
              "erro" => "Erro ao gravar registro.",
              "sucesso" => "Registro gravado com <b>sucesso</b>!",
              "informacao" => "Informacao: NDA",
              "padrao" => "<b>MENSAGEM N&AATILDE;O CADASTRADA!!!</b>"
              
            );
      
            $extbloco = array(
            
            "alerta"       => "",
            "erro"         => " alert-error",
            "informacao"   => " alert-info",
            "sucesso"      => " alert-success"
            );
            
            $extbloco = $extbloco[$tipo];
            $bloco = array(
              
              "abre" => "<div class=\"alert$extbloco\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>",
              
              "fecha" => "</div>"
            );
            return $bloco['abre'].$mensagem[$tipo].$bloco['fecha'];
         
      } /// -------------

  ?>