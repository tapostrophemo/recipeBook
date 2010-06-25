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

  function create($ownerId, $plan) {
    $this->db->insert('books', array('owner_id' => $ownerId, 'plan' => $plan));
    return $this->db->insert_id();
  }

  function addEditorToBook($bookId, $userId) {
    $this->db->insert('editors', array('book_id' => $bookId, 'user_id' => $userId, 'status' => 'invited'));
  }

  function getEditors($bookId) {
    $sql = "
      SELECT u.id, u.username, e.status
      FROM editors e
        JOIN users u ON u.id = e.user_id
      WHERE e.book_id = ?";
    return $this->db->query($sql, array($bookId))->result();
  }
}

