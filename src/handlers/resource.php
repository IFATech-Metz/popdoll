<?php

    $context = [
      'site' => 'PopDolls !',
      'banniere' => 'small'
    ];

    // Load Doll class
    require_once('../models/doll.php');

    if (isset($req['parsedURI'][1])) {

      if (false !== ($doll = Doll::load($req['parsedURI'][1]))) {

        switch ($req['method']) {

          case 'GET':
            // Load Top of Page
            require_once('../templates/html_header.html');
            // Render Resource
            $doll->render(1);
            // Load Bottom of Page
            require_once('../templates/html_footer.html');
            break;

          case 'DELETE':
            if ($doll->delete()) http_response_code(205);
            else http_response_code(503);
            break;

          case 'PUT':
          case 'PATCH':
            if (!$req['query']['description']) http_response_code(400);
            else {
              $doll->setDescription($req['query']['description']);
              http_response_code(204);
            }
            break;

          default:
            http_response_code(405);

        }
      } else {
        error(404, 4);
      }

    } else {
      error(404, 3);
    }
