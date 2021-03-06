<?php
//para impedir acesso direto por URL
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends CI_Controller{

	//Construtor
	public function __construct() {
		parent::__construct();
		$this->load->library("session"); //carrega a biblioteca Session
	}

	/* Toda vez que chama Restrict pela URL, executa o index() -----------------------------*/
	public function index(){

		if ($this->session->userdata("user_id")) { //se a variável de sessão está setada (usuário logado)
			
			$data = array(
				"styles" => array(
					"dataTables.bootstrap.min.css",
					"datatables.min.css"
				),
				"scripts" => array(
					"sweetalert2.all.min.js",
					"dataTables.bootstrap.min.js",
					"datatables.min.js",
					"util.js",
					"restrict.js" 
				),
				"user_id" => $this->session->userdata("user_id")
			);
			$this->template->show("restrict.php", $data);
		} else { //se o usuário não estiver logado
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js" 
				)
			);
			$this->template->show("login.php", $data); //chama a View login
		}

	}

	// função sair
	public function logoff() {
		$this->session->sess_destroy(); //destrói todas as variáveis de sessão
		header("Location: " . base_url() . "restrict"); //vai para a view retrict 
	}
	
	/* teste de campos usuário e senha ---------------------------------------------------------*/
	public function ajax_login() {

		if (!$this->input->is_ajax_request()) { //verifica se essa função é do tipo AJAX
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$username = $this->input->post("username");
		$password = $this->input->post("password");

		if (empty($username)) { //se o campo usuário está vazio
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("users_model");
			$result = $this->users_model->get_user_data($username);
			if ($result) { //se existe esse usuário
				$user_id = $result->user_id;
				$password_hash = $result->password_hash; //criptografa a senha
				
				if (password_verify($password, $password_hash)) { //verifica se a senha digitada é equivalente ao hash gerado
					$this->session->set_userdata("user_id", $user_id); //seta a variável de sessão user_id com o id do usuário

				} else {
					$json["status"] = 0; //campo senha incorreto
				}
			} else {
				$json["status"] = 0; //campo usuário incorreto
			}
			if ($json["status"] == 0) { //algum campo incorreto
				$json["error_list"]["#btn_login"] = "Usuário e/ou senha incorretos!";
			}
		}

		echo json_encode($json);

	}

	/* subir imagem ---------------------------------------------------------------------*/
	public function ajax_import_image() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$config["upload_path"] = "./tmp/"; // upload_path é uma biblioteca do CodeIgniter, neste caso está indicadno qual a pasta para armazenar temporareamente a imagem. OBS: a pasta /tmp tem que estar na pasta raíz do projeto 
		$config["allowed_types"] = "gif|png|jpg"; //tipos de arquivos permitidos
		$config["overwrite"] = TRUE; //caso o arquivo já exista, eu posso reescrever

		$this->load->library("upload", $config);

		$json = array();
		$json["status"] = 1;

		if (!$this->upload->do_upload("image_file")) { //Se o upload deu errado. obs: image_file é campo que contém a imagem
			$json["status"] = 0;
			$json["error"] = $this->upload->display_errors("","");

		} else { //se o upload da imagem deu certo
			if ($this->upload->data()["file_size"] <= 1024) { //se o tamanho da imagem for <= 1024
				$file_name = $this->upload->data()["file_name"];
				$json["img_path"] = base_url() . "tmp/" . $file_name; //obs: img_path é o caminho da imagem

			} else {
				$json["status"] = 0;
				$json["error"] = "Arquivo não deve ser maior que 1 MB!";
			}

		}

		echo json_encode($json);
	}

	/* salva curso -------------------------------------------------------------------------*/
	public function ajax_save_course() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("courses_model");

		$data = $this->input->post();

		if (empty($data["course_name"])) {
			$json["error_list"]["#course_name"] = "Nome do curso é obrigatório!";
		} else {
			if ($this->courses_model->is_duplicated("course_name", $data["course_name"], $data["course_id"])) {
				$json["error_list"]["#course_name"] = "Nome de curso já existente!";
			}
		}

		$data["course_duration"] = floatval($data["course_duration"]);
		if (empty($data["course_duration"])) {
			$json["error_list"]["#course_duration"] = "Duração do curso é obrigatório!";
		} else {
			if (!($data["course_duration"] > 0 && $data["course_duration"] < 100)) {
				$json["error_list"]["#course_duration"] = "Duração do curso deve ser maior que 0 (h) e menor que 100 (h)!";
			}
		}

		if (!empty($json["error_list"])) { //se tiver algum erro de input (campo) do formulário
			$json["status"] = 0; //muda o status para 0 (erro)
		} else {

			if (!empty($data["course_img"])) { //se foi subida uma imagem

				$file_name = basename($data["course_img"]); //basename pega somente o nome do arquivo dentro
				$old_path = getcwd() . "/tmp/" . $file_name; //getcw() pega a posição física do meu arquivo
				$new_path = getcwd() . "/public/images/courses/" . $file_name; 
				rename($old_path, $new_path); //move a imagem da pasta temporária para o destino final

				$data["course_img"] = "/public/images/courses/" . $file_name; //pega o caminho da imagem para ir para o BD

			} else {
				unset($data["course_img"]);
			}

			if (empty($data["course_id"])) { //se o id estiver vazio então está fazendo um cadastro
				$this->courses_model->insert($data);
			} else { //se for para dar update
				$course_id = $data["course_id"];
				unset($data["course_id"]); // tira o id do array data, porque o id vai ser passado como parâmetro separado
				$this->courses_model->update($course_id, $data); //chama a função de update
			}
		}

		echo json_encode($json);
	}

	/*salva membro -----------------------------------------------------------------------------*/
	public function ajax_save_member() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("team_model");

		$data = $this->input->post();

		if (empty($data["member_name"])) {
			$json["error_list"]["#member_name"] = "Nome do membro é obrigatório!";
		} 

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {

			if (!empty($data["member_photo"])) {

				$file_name = basename($data["member_photo"]);
				$old_path = getcwd() . "/tmp/" . $file_name;
				$new_path = getcwd() . "/public/images/team/" . $file_name;
				rename($old_path, $new_path);

				$data["member_photo"] = "/public/images/team/" . $file_name;

			} else {
				unset($data["member_photo"]);
			}

			if (empty($data["member_id"])) {
				$this->team_model->insert($data);
			} else {
				$member_id = $data["member_id"];
				unset($data["member_id"]);
				$this->team_model->update($member_id, $data);
			}
		}

		echo json_encode($json);
	}

	/* salva usuário --------------------------------------------------------------*/
	public function ajax_save_user() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");

		$data = $this->input->post();

		if (empty($data["user_login"])) {
			$json["error_list"]["#user_login"] = "Login é obrigatório!";
		} else {
			if ($this->users_model->is_duplicated("user_login", $data["user_login"], $data["user_id"])) {
				$json["error_list"]["#user_login"] = "Login já existente!";
			}
		}

		if (empty($data["user_full_name"])) {
			$json["error_list"]["#user_full_name"] = "Nome Completo é obrigatório!";
		} 

		if (empty($data["user_email"])) {
			$json["error_list"]["#user_email"] = "E-mail é obrigatório!";
		} else {
			if ($this->users_model->is_duplicated("user_email", $data["user_email"], $data["user_id"])) {
				$json["error_list"]["#user_email"] = "E-mail já existente!";
			} else {
				if ($data["user_email"] != $data["user_email_confirm"]) {
					$json["error_list"]["#user_email"] = "";
					$json["error_list"]["#user_email_confirm"] = "E-mails não conferem!";
				}
			}
		}

		if (empty($data["user_password"])) {
			$json["error_list"]["#user_password"] = "Senha é obrigatório!";
		} else {
			if ($data["user_password"] != $data["user_password_confirm"]) {
				$json["error_list"]["#user_password"] = "";
				$json["error_list"]["#user_password_confirm"] = "Senha não conferem!";
			}
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {

			$data["password_hash"] = password_hash($data["user_password"], PASSWORD_DEFAULT);

			//campos que não irão para o banco de dados
			unset($data["user_password"]);
			unset($data["user_password_confirm"]);
			unset($data["user_email_confirm"]);

			if (empty($data["user_id"])) {
				$this->users_model->insert($data);
			} else {
				$user_id = $data["user_id"];
				unset($data["user_id"]);
				$this->users_model->update($user_id, $data);
			}
		}

		echo json_encode($json);
	}

	/* Carrega os dados do curso, para mostrar no Modal Edit --------------------------------*/
	public function ajax_get_course_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("courses_model");

		$course_id = $this->input->post("course_id");
		$data = $this->courses_model->get_data($course_id)->result_array()[0]; // pega dados do curso e recebe a primeira posição do array de resposta
		
		//carrega dados no modal
		$json["input"]["course_id"] = $data["course_id"];
		$json["input"]["course_name"] = $data["course_name"];
		$json["input"]["course_duration"] = $data["course_duration"];
		$json["input"]["course_description"] = $data["course_description"];

		$json["img"]["course_img_path"] = base_url() . $data["course_img"];

		echo json_encode($json);
	}

	/* Carrega os dados do membro, para mostrar no Modal Edit --------------------------------*/
	public function ajax_get_member_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("team_model");

		$member_id = $this->input->post("member_id");
		$data = $this->team_model->get_data($member_id)->result_array()[0];

		//carrega dados no modal
		$json["input"]["member_id"] = $data["member_id"];
		$json["input"]["member_name"] = $data["member_name"];
		$json["input"]["member_description"] = $data["member_description"];

		$json["img"]["member_photo_path"] = base_url() . $data["member_photo"];

		echo json_encode($json);
	}

	/* Carrega os dados do usuário, para mostrar no Modal Edit --------------------------------*/
	public function ajax_get_user_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("users_model");

		$user_id = $this->input->post("user_id");
		$data = $this->users_model->get_data($user_id)->result_array()[0];

		//carrega dados no modal
		$json["input"]["user_id"] = $data["user_id"];
		$json["input"]["user_login"] = $data["user_login"];
		$json["input"]["user_full_name"] = $data["user_full_name"];
		$json["input"]["user_email"] = $data["user_email"];
		$json["input"]["user_email_confirm"] = $data["user_email"];
		$json["input"]["user_password"] = $data["password_hash"];
		$json["input"]["user_password_confirm"] = $data["password_hash"];

		echo json_encode($json);
	}

	/* Deletar curso ----------------------------------------------------------------------*/
	public function ajax_delete_course_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("courses_model");
		$course_id = $this->input->post("course_id");
		$this->courses_model->delete($course_id);

		echo json_encode($json);
	}

	/* Deletar membro ----------------------------------------------------------------------*/
	public function ajax_delete_member_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("team_model");
		$member_id = $this->input->post("member_id");
		$this->team_model->delete($member_id);

		echo json_encode($json);
	}

	/* Deletar usuário ----------------------------------------------------------------------*/
	public function ajax_delete_user_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("users_model");
		$user_id = $this->input->post("user_id");
		$this->users_model->delete($user_id);

		echo json_encode($json);
	}

	public function ajax_list_course() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("courses_model");
		$courses = $this->courses_model->get_datatable(); //retorna pesquisa

		$data = array();
		foreach ($courses as $course) {  //para cada linha (registro)

			$row = array();
			$row[] = $course->course_name;

			if ($course->course_img) { //se tiver imagem
				$row[] = '<img src="'.base_url().$course->course_img.'" style="max-height: 100px; max-width: 100px;">';
			} else {
				$row[] = "";
			}

			$row[] = $course->course_duration;
			$row[] = '<div class="description">'.$course->course_description.'</div>';

			//botões edit e delete
			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-course" 
							course_id="'.$course->course_id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-course" 
							course_id="'.$course->course_id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->courses_model->records_total(),
			"recordsFiltered" => $this->courses_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}

	public function ajax_list_member() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("team_model");
		$team = $this->team_model->get_datatable();

		$data = array();
		foreach ($team as $member) {

			$row = array();
			$row[] = $member->member_name;

			if ($member->member_photo) {
				$row[] = '<img src="'.base_url().$member->member_photo.'" style="max-height: 100px; max-width: 100px;">';
			} else {
				$row[] = "";
			}

			$row[] = '<div class="description">'.$member->member_description.'</div>';

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-member" 
							member_id="'.$member->member_id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-member" 
							member_id="'.$member->member_id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->team_model->records_total(),
			"recordsFiltered" => $this->team_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}

	public function ajax_list_user() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("users_model");
		$users = $this->users_model->get_datatable();

		$data = array();
		foreach ($users as $user) {

			$row = array();
			$row[] = $user->user_login;
			$row[] = $user->user_full_name;
			$row[] = $user->user_email;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-user" 
							user_id="'.$user->user_id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-user" 
							user_id="'.$user->user_id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->users_model->records_total(),
			"recordsFiltered" => $this->users_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}


}