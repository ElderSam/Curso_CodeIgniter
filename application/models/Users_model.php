<?php

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_user_data($user_login) { //pega dados de usuário

		$this->db
			->select("user_id, password_hash, user_full_name, user_email") //selecione os campos
			->from("users") //da tabela users
			->where("user_login", $user_login); //onde o login for igual ao informado

		$result = $this->db->get(); //pega o resultado

		if ($result->num_rows() > 0) { //se retornar registros
			return $result->row(); //retorne as linhas
		} else {
			return NULL; 
		}
	}

	//procurar dados
	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("users");
		$this->db->where("user_id", $id);
		return $this->db->get(); //retorna os dados
	}

	//cadastrar
	public function insert($data) {
		$this->db->insert("users", $data);
	}

	//atualizar
	public function update($id, $data) {
		$this->db->where("user_id", $id);
		$this->db->update("users", $data);
	}

	//excluir
	public function delete($id) {
		$this->db->where("user_id", $id);
		$this->db->delete("users");
	}

	public function is_duplicated($field, $value, $id = NULL) { //verifica se o login já existe
		if (!empty($id)) { //se o id não estiver vazio, ou seja, se for passado. Em caso de update
			$this->db->where("user_id <>", $id); //para não verificar duplicação quando eu atualizo dados quando algum campo que permanece o mesmo
		}
		$this->db->from("users");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0; //se tem algum registro, então retorna true
	}

	var $column_search = array("user_login", "user_full_name", "user_email");
	var $column_order = array("user_login", "user_full_name", "user_email");

	private function _get_datatable() {

		$search = NULL;
		if ($this->input->post("search")) {
			$search = $this->input->post("search")["value"];
		}
		$order_column = NULL;
		$order_dir = NULL;
		$order = $this->input->post("order");
		if (isset($order)) {
			$order_column = $order[0]["column"];
			$order_dir = $order[0]["dir"];
		}

		$this->db->from("users");
		if (isset($search)) {
			$first = TRUE;
			foreach ($this->column_search as $field) {
				if ($first) {
					$this->db->group_start();
					$this->db->like($field, $search);
					$first = FALSE;
				} else {
					$this->db->or_like($field, $search);
				}
			}
			if (!$first) {
				$this->db->group_end();
			}
		}

		if (isset($order)) {
			$this->db->order_by($this->column_order[$order_column], $order_dir);
		}
	}

	public function get_datatable() {

		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$this->_get_datatable();
		if (isset($length) && $length != -1) {
			$this->db->limit($length, $start);
		}
		return $this->db->get()->result();
	}

	public function records_filtered() {

		$this->_get_datatable();
		return $this->db->get()->num_rows();

	}

	public function records_total() {

		$this->db->from("users");
		return $this->db->count_all_results();

	}
}