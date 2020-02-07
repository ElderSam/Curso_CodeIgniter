<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends CI_Controller{

    public function index(){
        $this->load->model("users_model"); //carrega o Model, e o nome do model vira uma variável dentro dessa classe
        print_r($this->users_model->get_user_data("elder"));
        //$this->template->show("restrict.php");
    }
}

?>