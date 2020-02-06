<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
    public function index(){
        
        $this->template->show('cliente'); //carrega a VIEW cliente.php
    }
}

?>