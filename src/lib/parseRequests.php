<?php

  require_once('../lib/recurrentSorting.php');

$req = [
  'method' => $_SERVER['REQUEST_METHOD'],
  'scheme' => $_SERVER['REQUEST_SCHEME'],
];

if ($_SERVER['SERVER_NAME']) $req['hostname'] = $_SERVER['SERVER_NAME'];
else if ($_SERVER['HTTP_HOST']) $req['hostname'] = $_SERVER['HTTP_HOST'];

/// Resource
if (preg_match('@^[^\?]*@S',$_SERVER['REQUEST_URI'],$e)) {
  $req['parsedURI'] = [ '/' ];
  $req['resource'] = $e[0];
  $ce = explode('/',trim($e[0],'/'));
  if (!empty($ce[0])) $req['parsedURI'] = $ce;
}

/// Query String
switch ($req['method']) {
  case 'GET':
    $req['query'] = $_GET;
    break;
  case 'POST':
  case 'PUT':
  case 'PATCH':
    $query = json_decode(file_get_contents("php://input"));
    foreach ($query as $key => $value) {
      $req['query'][$key] = $value;
    }
    break;
}

if ($req['query']) recur_ksort($req['query']);

/// Accept
if ($c = explode(',',$_SERVER['HTTP_ACCEPT'])) {
  foreach ($c as $f) {
    $fi = explode(';',$f);
    $req['accept'][(isset($fi[1])) ? str_replace('q=','',$fi[1]) : 1][] = $fi[0];
  }
  krsort($req['accept']);
}

$req['self'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$req['resource'];

if (isset($req['query'])) {
  $v = $req['query'];
  unset($v['timestamp'],$v['key'],$v['signature']);
  $req['self'] .= '?'.http_build_query($v,null,'&',PHP_QUERY_RFC3986);
}
