<?php

class Cookbook extends Model
{
  function getNameById($id) {
    $sql = "
      SELECT u.username
      FROM users u
        JOIN books b ON b.owner_id = u.id
      WHERE b.id = ?";
    $query = $this->db->query($sql, array($id));
    return $query->num_rows == 1 ? $query->row(0)->username : '';
  }

  function create($ownerId) {
    $this->db->insert('books', array('owner_id' => $ownerId));
    return $this->db->insert_id();
  }
}

