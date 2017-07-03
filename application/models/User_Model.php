<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{
  public function __construct()
  {
    parent::__construct();
  }

  public function input_user()
  {
    $this->session->set_userdata('token', random_string('alnum',20));
    $data = array(
      'name'          =>  $this->input->post('name'),
      'email'         =>  $this->input->post('email'),
      'password'      =>  $this->input->post('password'),
      'rememberToken' =>  $this->session->userdata('token')
    );
    return $this->db->insert('users', $data);
  }

  public function get_user($key, $value)
  {
    $data = array(
      $key => $value
    );
    $query = $this->db->get_where('users', $data);
    return $query->row();
  }

  public function update_user($id, $role)
  {
    $data = array(
      'role'  =>  $role
    );
    $this->db->where('id', $id);
    return $this->db->update('users', $data);
  }
}
