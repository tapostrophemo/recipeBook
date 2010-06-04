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
}

