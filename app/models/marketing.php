<?php

class Marketing extends Model
{
  function newVisitor($referrer, $landingPage) {
    $sql = 'INSERT INTO marketing(cookie_id, referring_url, landing_page) VALUES (Uuid(), ?, ?)';
    $this->db->query($sql, array($referrer, $landingPage));
    $id = $this->db->insert_id();
    return $this->db->where('id', $id)->get('marketing')->row();
  }

  function markSignup($accountId) {
    $this->load->helper('cookie');
    $cookie = get_cookie('mkt');
    $this->db->where('cookie_id', $cookie)->update('marketing', array('account_id' => $accountId));
  }
}

