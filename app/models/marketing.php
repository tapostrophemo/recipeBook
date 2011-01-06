<?php

class Marketing extends Model
{
  function __construct() {
    Model::__construct();

    $this->load->helper('cookie');
    $this->load->helper('date');
  }

  function newVisitor() {
    $sql = "
      INSERT INTO marketing(cookie_id, referring_url, landing_page, activity)
      VALUES (Uuid(), ?, ?, 'new visit')";
    $this->db->query($sql, array($this->input->server('HTTP_REFERER'), current_url()));
    $id = $this->db->insert_id();
    return $this->db->where('id', $id)->get('marketing')->row();
  }

  function markSignup($accountId) {
    $data = array(
      'cookie_id' => get_cookie('mkt'),
      'referring_url' => $this->input->server('HTTP_REFERER'),
      'landing_page' => current_url(),
      'account_id' => $accountId,
      'activity' => 'signup');
    $this->db->insert('marketing', $data);
  }

  function markLogin($accountId) {
    $data = array(
      'cookie_id' => get_cookie('mkt'),
      'referring_url' => $this->input->server('HTTP_REFERER'),
      'landing_page' => current_url(),
      'account_id' => $accountId,
      'activity' => 'login');
    $this->db->insert('marketing', $data);
  }

  function markInvite($accountId, $inviteeAccountId) {
    $data = array(
      'cookie_id' => get_cookie('mkt'),
      'referring_url' => $this->input->server('HTTP_REFERER'),
      'landing_page' => current_url(),
      'account_id' => $accountId,
      'invitee_id' => $inviteeAccountId,
      'activity' => 'invite friend');
    $this->db->insert('marketing', $data);
  }

  function getReport() {
    $sql = "
      SELECT m.*, u.id AS user_id, u.username, u.email, u.created_at AS registration_date
      FROM marketing m
        LEFT JOIN users u ON u.id = m.account_id";
    return $this->db->query($sql)->result();
  }
}

