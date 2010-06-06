<?php

class User extends Model
{
  function validateLogin($username, $password) {
    $query = $this->db->select('password_salt')->where('username', $username)->get('users');
    if ($query->num_rows != 1) {
      return false;
    }

    $salted = sha1($password.$query->row()->password_salt);
    $query = $this->db->select('id, username, is_admin')
      ->where('username', $username)
      ->where('crypted_password', $salted)
      ->get('users');

    return $query->num_rows == 1 ? $query->row() : null;
  }

  function create($username, $password, $email) {
    $salt = $this->_salt();
    $data = array(
      'username' => $username,
      'crypted_password' => sha1($password . $salt),
      'password_salt' => $salt,
      'email' => $email);
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  }

  function _salt() {
    return md5(
      md5(
        microtime() .
        spl_object_hash(new stdClass()) .
        mt_rand() .
        getmypid()));
  }

  function getAll() {
    return $this->db->select('id, username, email')->get('users')->result();
  }
}

