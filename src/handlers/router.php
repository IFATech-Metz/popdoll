<?php  /// ROUTER

  $context = [
    'site' => 'PopDolls !'
  ];

  require_once('../lib/error.php');
  require_once('../lib/parseRequests.php');

  switch (count($req['parsedURI'])) {
    case 1:

      if ($req['parsedURI'][0] === '/') {
        // index
        $req['parsedURI'] = ['dolls'];
      }

      if ($req['parsedURI'][0] === 'dolls') {
        require_once('./collection.php');
      } else {
        error(404, 1);
      }
      break;

    case 2:
      if ($req['parsedURI'][0] === 'dolls') {
        require_once('./resource.php');
      } else {
        error(404, 2);
      }
      break;

    default:
      error(404);
  }
