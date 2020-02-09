<?php

class Courses_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function show_courses() {
		$this->db->from("courses");
		return $this->db->get()->result_array();
	}

	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("courses");
		$this->db->where("course_id", $id);
		return $this->db->get();
	}

	public function insert($data) {
		$this->db->insert("courses", $data);
	}

	public function update($id, $data) {
		$this->db->where("course_id", $id);
		$this->db->update("courses", $data);
	}

	public function delete($id) {
		$this->db->where("course_id", $id);
		$this->db->delete("courses");
	}

	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("course_id <>", $id);
		}
		$this->db->from("courses");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}

	/* CAMPOS VIA POST (Para trabalhar como DataTables)

		$_POST['search']['value'] = Campo para busca
		$_POST['order'] = [['0, 'asc']]
			$_POST['order'][0]['column'] = index da coluna
			$_POST['order'][0]['dir'] = tipo de ordenação (asc, desc)
		$_POST['length'] = Quantos campos mostrar
		$_POST['length'] = Qual posição começar
	*/
	var $column_search = array("course_name", "course_description"); //colunas pesquisáveis pelo datatables
	var $column_order = array("course_name", "", "course_duration"); //ordem que vai aparecer (o nome primeiro)

	private function _get_datatable() { //faz a pesquisa no banco de dados

		$search = NULL;
		if ($this->input->post("search")) { //se foi pesquisado algo na caixa de search
			$search = $this->input->post("search")["value"]; // pega o texto pesquisado
		}
		$order_column = NULL;
		$order_dir = NULL;
		$order = $this->input->post("order");
		if (isset($order)) {
			$order_column = $order[0]["column"];
			$order_dir = $order[0]["dir"];
		}

		$this->db->from("courses");
		if (isset($search)) {
			$first = TRUE;
			foreach ($this->column_search as $field) {
				if ($first) {
					$this->db->group_start(); //cria um grupo de pesquisa (WHERE ou LIKE). É uma função do CodeIgniter
					$this->db->like($field, $search); //primeiro caso
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
			$this->db->order_by($this->column_order[$order_column], $order_dir); //Para ordenar os resultados da pesquisa
		}
	}

	public function get_datatable() { //retorna resposta da pesquisa

		$length = $this->input->post("length"); //se o length for -1, quer dizer que está retornando todos os registros
		$start = $this->input->post("start");
		$this->_get_datatable();
		if (isset($length) && $length != -1) {
			$this->db->limit($length, $start);
		}
		return $this->db->get()->result();
	}

	public function records_filtered() { //para mostrar a qtd de registros que a pesquisa retornou

		$this->_get_datatable();
		return $this->db->get()->num_rows(); //retorna linhas filtradas

	}

	public function records_total() {

		$this->db->from("courses");
		return $this->db->count_all_results(); //retorna qtd total existente (função do CodeIgniter)

	}

}