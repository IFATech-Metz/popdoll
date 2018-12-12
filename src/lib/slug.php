<?php

  function slug ($string) {
    $slug = iconv('UTF-8', 'ASCII/TRANSLIT', $string);
    $slug = preg_replace('/[^A-z0-9\/_|+ -]/', '', $slug);
    $slug = strtolower($slug);
    $slug = preg_replace('/[\/_|+ -]+/', '-', $slug);
    return trim($slug, '-');
  }
