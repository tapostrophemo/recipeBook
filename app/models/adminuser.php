<?php

class AdminUser extends Model
{
  function validateLogin($username, $password) {
    $query = $this->db->select('password_salt')->where('username', $username)->get('admin_users');
    if ($query->num_rows != 1) {
      return false;
    }
    $salt = $query->row()->password_salt;

    $query = $this->db
      ->select('Count(*) AS `count`')
      ->where('username', $username)
      ->where('crypted_password', sha1($password.$salt))
      ->get('admin_users');
    return $query->row()->count == 1;
  }
}

