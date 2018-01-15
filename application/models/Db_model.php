<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {

	public function login($table, $data)
	{
		$query = $this->db->where($data)->get($table);
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}	

	public function check($table, $data)
	{
		$query = $this->db->where($data)->get($table);
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}	

	public function getrow($table)
	{
		$query = $this->db->get($table);
		if ($query) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function getall($table)
	{
		$query = $this->db->get($table);
		if ($query) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function getwhere($table, $data)
	{
		$query = $this->db->where($data)->get($table);
		if ($query) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function sumall($table, $sum)
	{
		$query = $this->db->query("SELECT $sum AS total FROM $table");
		if ($query == NULL) {
			return "0";
		} elseif ($query) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function getquery($query)
	{
		$query = $this->db->query($query);
		if ($query !== NULL) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function custom($query)
	{
		$query = $this->db->query($query);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function insertdt($table, $data)
	{
		$this->db->insert($table, $data);
		if ($this->db->affected_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function deletewhere($table, $data)
	{
		$query = $this->db->where($data)->delete($table);
		if ($query == true) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Db_model.php */
/* Location: ./application/models/Db_model.php */