<?php

class Marketing extends Model
{
  function __construct() {
    Model::__construct();

    $this->load->helper('cookie');
    $this->load->helper('date');
  }

  function newVisitor($referrer, $landingPage) {
    $sql = "
      INSERT INTO marketing(cookie_id, referring_url, landing_page, activity)
      VALUES (Uuid(), ?, ?, 'new visit')";
    $this->db->query($sql, array($referrer, $landingPage));
    $id = $this->db->insert_id();
    return $this->db->where('id', $id)->get('marketing')->row();
  }

  function markSignup($accountId) {
    $cookie = get_cookie('mkt');
    $data = array(
      'account_id' => $accountId,
      'activity' => 'signup',
      'updated_at' => mdate('%Y-%m-%d %H:%i:%s'));
    $this->db->where('cookie_id', $cookie)->update('marketing', $data);
  }

  function markLogin() {
    $cookie = get_cookie('mkt');
    $data = array(
      'activity' => 'login',
      'updated_at' => mdate('%Y-%m-%d %H:%i:%s'));
    $this->db->where('cookie_id', $cookie)->update('marketing', $data);
  }

  function getReport() {
    $sql = "
      SELECT m.*, u.id AS user_id, u.username, u.email, u.created_at AS registration_date
      FROM marketing m
        LEFT JOIN users u ON u.id = m.account_id";
    return $this->db->query($sql)->result();
  }
}

