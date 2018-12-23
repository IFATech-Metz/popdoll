<?php http_response_code(500); ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Configuration Error</title>
    <style>
      body {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        text-align: center;
        font-family: sans-serif;
      }
      h1, p {
        margin: 1rem;
        padding: 0;
      }
      h1 {
        color: #600;
        font-weight: bold;
      }
      code {
        color: #111;
      }
      p.code {
        display: inline-block;
        padding: .5em 1em;
        margin: 1vh 2vw calc(1vh + 2em);
        background-color: #ffc;
        font-family:monospace;
      }
      p.code span {
        color:#633;
      }
    </style>
  </head>
  <body>
    <article class="error">
      <h1>Configuration Error</h1>
      <p>You need to activate <em>rewriting mod</em> on your server to run this web app.</p>
      <p>Try in console:</p>
      <p class="code"><span>#</span> <code>a2enmod rewrite</code></p>
    </article>
  </body>
</html>
