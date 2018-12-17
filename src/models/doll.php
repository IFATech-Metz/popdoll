<?php

// Load lib slug
require_once('../lib/slug.php');

class Doll {

  const DATA = '../../data/';

  /* --- Static Functions --- */

  public static function find ($query) {
    $url = 'https://www.funko.com/ui-api/search?text=' . $query;
    return json_decode(file_get_contents($url))->products;
  }

  public static function list ($order = 'title', $sort = SORT_ASC) {
    if (
      !file_exists(self::DATA)
      OR false === ($dir = opendir(self::DATA))
    ) return false;

    $ds = [];
    $dolls = [];

    // Sanitize
    switch ($order) {
      case 'category':
      case 'description':
        break;
      default:
        $order = 'title';
    }
    switch ($sort) {
      case 'desc':
      case -1:
        $sort = SORT_DESC;
        break;
      case 'asc':
      case 1:
      default:
        $sort = SORT_ASC;
    }

    while (false !== ($file = readdir($dir))) {
      if (preg_match('/^(.+)\.yml$/i', $file, $match)) {
        if ($doll = Doll::load($match[1])) {
          $ds[] = $doll->$order;
          $dolls[] = $doll;
        }
      }
    }
    array_multisort($ds, $sort, SORT_NATURAL, $dolls);
    return $dolls;
  }

  static function load ($handle) {
    if (!file_exists(self::DATA . $handle . '.yml')) return false;
    return new Doll(yaml_parse_file(self::DATA . $handle . '.yml'));
  }

  /* --- data --- */

  private $title, $category, $collection, $description, $handle, $funkoData;

  /* --- Constructor --- */

  private function __construct ($data) {
    if (!$data['handle']) return false;
    return $this->update($data)->import();
  }

  /* --- Object Functions --- */

  public function import () {
    if (!$this->handle) return false;
    $this->funkoData = json_decode(file_get_contents('https://www.funko.com/ui-api/search/' . $this->handle))->products[0];
    if (preg_match('/^Pop!?(.*)\:([^-]+)(?:-(.+))?$/i',$this->funkoData->title, $ex)) {
      $this->category = trim($ex[1]);
      if ($ex[3]) {
        $this->title = trim($ex[3]);
        $this->collection = trim($ex[2]);
      } else {
        $this->title = trim($ex[2]);
      }
    }
    else return false;
    return $this;
  }

  public function render ($full = false) {
    if ($full) require('../templates/doll.html');
    else require('../templates/doll_list.html');
  }

  public function update ($data) {
    $this->description = $data['description'];
    $this->handle = $data['handle'];
    return $this;
  }

}
