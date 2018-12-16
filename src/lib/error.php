<?php  /// ERRORS

function error ($code = 500, $sub = null) {
  switch ($code) {
    case 500:
      $err = '';
      break;
    case 404:
      $err = 'Not Found';
      break;
  }
  http_response_code($code);
  require_once('../templates/html_header.html');
  require_once('../templates/error.html');
  require_once('../templates/html_footer.html');
  exit;
}
