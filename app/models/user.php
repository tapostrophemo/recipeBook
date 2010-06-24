<?php

class User extends Model
{
  function validateLogin($username, $password) {
    $query = $this->db->select('password_salt')->where('username', $username)->get('users');
    if ($query->num_rows != 1) {
      return false;
    }

    $sql = "
      SELECT u.id, u.username, u.email, b.id AS owns_book_id, e.book_id AS edits_book_id
      FROM users u
        LEFT JOIN books b ON b.owner_id = u.id
        LEFT JOIN editors e ON e.user_id = u.id
      WHERE username = ?
      AND crypted_password = ?";
    $query = $this->db->query($sql, array($username, sha1($password.$query->row()->password_salt)));
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

  function createGuest($username, $email) {
    $tempPassword = $this->_salt();
    $id = $this->create($username, $tempPassword, $email); // TODO: fail gracefully on error
    return array('id' => $id, 'temp_password' => $tempPassword);
  }

  function getAll() {
    return $this->db->select('id, username, email')->get('users')->result();
  }

  function getByUsername($username) {
    $query = $this->db->select('id, username, email')->where('username', $username)->get('users');
    return $query->num_rows == 1 ? $query->row() : null;
  }
}

