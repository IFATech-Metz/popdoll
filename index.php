<?php http_response_code(500); ?>
<!doctype html>
<html lang="en">
  <head><title>Configuration Error</title></head>
  <body>
    <h1 style="color:#600;font-weight:bold;">Configuration Error</h1>
    <p>You need to activate <em>rewriting mod</em> on your to run this web app.</p>
    <p>Try in console:</p>
    <p style="display:inline-block;padding:.25em 1em;margin: 1vh 2vw;background-color:#ffc;"><span style="color:#633;font-family:monospace;">#</span> <code style="color: #111;">a2enmod rewrite</code></p>
  </body>
</html>
