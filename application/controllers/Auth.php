<?php
defined('BASEPATH') OR exit('No direct script access alloed');

class Auth extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
  }

  public function register()
  {
    $this->form_validation->set_rules('name', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
    if($this->form_validation->run() === FALSE){
      $this->load->view('layouts/header');
      $this->load->view('auth/register');
      $this->load->view('layouts/footer');
    } else {
      $this->user_model->input_user();
      $this->send_verification_email($this->input>post('email'), $this->session->userdata('token'));
    }
  }

  public function verify($email, $token)
  {
    $user = $this->user_model->get_user('email', $email);
    if(!$user){
      die('Email not exist!');
    } else {
      if($this->session->userdata('token') !== $token){
        die('Token not matches');
      } else {
        $this->user_model->update_user($user->id, 1);
        $this->session->set_userdata('id', $user->id);
        $this->session->set_userdata('logged_in', TRUE);
        redirect('profile');
      }
    }
  }

  public function send_verification_email($email, $token)
  {
    $this->email->from('admin@blog.com', 'Admin');
    $this->email->subject('Email verifikasi register');
    $this->email->to($email);
    $this->email->message("
      Klik untuk konfirmasi email
      <a href='http://localhost/blog/verify/$email/$token'>Konfirmasi Email</a>
    ");
    $thhis->email->send();
  }
}
