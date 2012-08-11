<?php
//-------------------------------------FJR Webdesign---------------------------------------
// Arquivo: TSystemComponent.php
// Versao: 1.1 - 19/04/2008
// Autor: Francisco Jr
// Descricao: Define a classe TSystemComponent, classe base de todas as classes criadas
// pela FJR Webdesign. Permite tambem configurar os parametros gerais do site, como
// os relativas ao acesso ao banco de dados.
//-----------------------------------------------------------------------------------------
// Log de modificacoes:
// MODELO: vX.Y - DD/MM/AAAA - Autor - Modificacoes
// v1.1 - 19/04/2008 - Francisco Jr. - Retiradas funcoes ou parametros de funcoes que serviam apenas ao antigo FJR System.
//-----------------------------------------------------------------------------------------
// Atencao! O conteudo deste arquivo nao pode ser modificado sem previa autorizacao
// do desenvolvedor.
// Copyright (C) 2008 FJR Webdesign. Todos os direitos reservados
//-----------------------------------------------------------------------------------------

class TSystemComponent
{
    var $settings;

    // function: GetSettings, purpose: Retrieve general config variables
    function GetSettings()
    {
        //System variables
        $settings['path'] = 'http://www.trajettoria.com';

        //Database variables
        $settings['dbname'] = 'traj_rfp';
		
		/*
        $settings['dbusername'] = 'traj_rfp';
        $settings['dbpassword'] = 'tr90PZAS';
		*/
		
        $settings['dbusername'] = 'root';
        $settings['dbpassword'] = 'krieger';
		
        $settings['dbhost'] = 'localhost';
       // $settings['users_table'] = 'users';
        

        return $settings;
    }
    
}

?>
