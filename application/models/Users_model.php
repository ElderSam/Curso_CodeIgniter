<?php

class Users_model extends CI_Model{

    //Construtor
    public function __construct(){
        parent::__construct(); //chama o construtor da classe pai (CI_Controller)
        $this->load->database(); //carrega da base de dados 
    }

    //Métodos -------------------

    public function get_user_data($user_login){

        //query select ao banco de dados
        $this->db 
            ->select("user_id, password_hash, user_full_name, user_email")
            ->from ("users")
            ->where("user_login", $user_login);
    
        $result = $this->db->get(); //retorna os dados

        //testa se retornou registros
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return NULL;
        }
    }
}