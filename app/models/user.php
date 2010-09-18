<?php

class User extends Model
{
  function validateLogin($username, $password) {
    $query = $this->db->select('password_salt')->where('username', $username)->get('users');
    if ($query->num_rows != 1) {
      return false;
    }

    $query = $this->db->query('SELECT id FROM users WHERE username = ? AND crypted_password = ?',
      array($username, sha1($password.$query->row()->password_salt)));
    if ($query->num_rows != 1) {
      return null;
    }

    $userid = $query->row()->id;
    $this->db->set('last_login_at', $this->_now())->where('id', $userid)->update('users');
    return $this->getById($userid);
  }

  function create($username, $password, $email) {
    $salt = $this->_salt();
    $data = array(
      'username' => $username,
      'crypted_password' => sha1($password . $salt),
      'password_salt' => $salt,
      'email' => $email,
      'created_at' => $this->_now());
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

  function _now() {
    $this->load->helper('date');
    return mdate('%Y-%m-%d %H:%i:%s', time());
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

  function getById($id) {
    $sql = "
      SELECT u.id, u.username, u.email, b.plan, b.id AS owns_book_id, e.book_id AS edits_book_id, e.status
      FROM users u
        LEFT JOIN books b ON b.owner_id = u.id
        LEFT JOIN editors e ON e.user_id = u.id
      WHERE u.id = ?";
    $query = $this->db->query($sql, array($id));
    return $query->num_rows == 1 ? $query->row() : null;
  }

  function createPerishableToken($userId) {
    $token = $this->_salt();
    $this->db->where('id', $userId)->set('perishable_token', $token)->update('users');
    return $token;
  }

  function resetPerishableToken($token) {
    $query = $this->db->select('id')->where('perishable_token', $token)->get('users');
    if (!$query->num_rows == 1) {
      return null;
    }
    $user = $this->getById($query->row()->id);
    if ($user) {
      $this->db->where('perishable_token', $token)->set('perishable_token', '')->update('users');
    }
    return $user;
  }

  function updatePassword($userid, $password) {
    $salt = $this->_salt();
    $this->db->where('id', $userid)
      ->set('crypted_password', sha1($password.$salt))
      ->set('password_salt', $salt)
      ->update('users');
  }

  function adminReport() {
    $sql = "
      SELECT u.username, u.id AS account_id, u.created_at, u.last_login_at, b.plan, b.id AS plan_id,
             Count(r.id) AS num_recipes, Count(e.user_id) AS num_editors
      FROM users u
        JOIN books b ON b.owner_id = u.id
        LEFT JOIN recipes r ON r.book_id = b.id
        LEFT JOIN editors e ON e.book_id = b.id
        GROUP BY u.username, u.id, u.created_at, u.last_login_at, b.plan, b.id";
    $query = $this->db->query($sql);
    return $query->result();
  }
}

