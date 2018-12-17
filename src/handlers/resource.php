<?php

    $context = [
      'site' => 'PopDolls !',
      'banniere' => 'small'
    ];

    // Load Doll class
    require_once('../models/doll.php');

    if (isset($req['parsedURI'][1])) {

      if (false !== ($doll = Doll::load($req['parsedURI'][1]))) {
        // Load Top of Page
        require_once('../templates/html_header.html');

        // Render Resource
        $doll->render(1);
      } else {
        error(404, 4);
      }

    } else {
      error(404, 3);
    }

    // Load Bottom of Page
    require_once('../templates/html_footer.html');
