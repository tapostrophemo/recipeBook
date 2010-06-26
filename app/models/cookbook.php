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

  function isEditorOrOwnerOf($bookId, $userId) {
    $sql = "
      SELECT * FROM (
        SELECT owner_id AS user_id FROM books WHERE id = ?
        UNION ALL
        SELECT user_id FROM editors WHERE book_id = ?
      ) x
      WHERE user_id = ?";
    $query = $this->db->query($sql, array($bookId, $bookId, $userId));
    return $query->num_rows == 1;
  }

  function suspendEditor($bookId, $userId) {
    $this->db
      ->where('book_id', $bookId)
      ->where('user_id', $userId)
      ->update('editors', array('status' => 'suspended'));
  }

  function reactivateEditor($bookId, $userId) {
    $this->db
      ->where('book_id', $bookId)
      ->where('user_id', $userId)
      ->update('editors', array('status' => 'active'));
  }
}

