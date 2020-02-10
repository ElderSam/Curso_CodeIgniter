<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

		$this->load->model("courses_model"); //carrega o Model
		$courses = $this->courses_model->show_courses(); //lista os cursos na página inicial

		$this->load->model("team_model"); //carrega outro Model
		$team = $this->team_model->show_team(); //lista o time (membros) na página inicial

		//lista de arquivos (estilos e scripts) que deverão ser carregados nesta VIEW específica (home)
		$data = array(
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js" 
			),
			"courses" => $courses,
			"team" => $team
		);
		$this->template->show("home.php", $data); //carrega a View home
	}

}
