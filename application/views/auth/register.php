<h2>Register</h2>
<?php
  echo form_open('auth/register');

  echo form_label('Nama','name');
  echo form_error('name');
  $name = array(
    'name'  =>  'name',
    'type'  =>  'text',
    'value' =>  set_value('name')
  );
  echo form_input($name);

  echo form_label('Email','email');
  echo form_error('email');
  $email = array(
    'name'  =>  'email',
    'type'  =>  'email',
    'value' =>  set_value('email')
  );
  echo form_input($email);

  echo form_label('Password','password');
  echo form_error('password');
  $password = array(
    'name'  =>  'password'
  );
  echo form_password($password);

  echo form_label('Konfirmasi Password','password2');
  echo form_error('password2');
  $password2 = array(
    'name'  =>  'password2'
  );
  echo form_password($password2);

  $submit = array(
    'name'  =>  'submit',
    'value' =>  'Register'
  );
  echo form_submit($submit);

  echo form_close();
?>
