<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends CI_Controller{

    public function index(){
        
        //informações dos arquivos que a view precisará carregar
        $data = array(
            "styles" => array(
                "login-register.css", 
                "plugins/fontawesome-free/css/fontawesome.css"
            ),
            "scripts" => array(
                "util.js",
                "login.js",
                "login-register.js"
            )

        );

        $this->template->show("login.php", $data);
    }
}

?>