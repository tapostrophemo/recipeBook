<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function nocache_response() {
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Expires: 0');
  header('Pragma: no-cache');
}

