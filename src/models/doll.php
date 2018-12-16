<?php

// Load lib slug
require_once('./src/lib/slug.php');

class Doll {

  const DATA = './txt/';
  const IMG = './txt/';

  /* --- Static Functions --- */

  public static function list ($order = 'title', $sort = SORT_ASC) {
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

    if ($dir = opendir(self::DATA)) {
      while (false !== ($file = readdir($dir))) {
        if (preg_match('/^(.+)\.txt$/i', $file, $match)) {
          if ($doll = Doll::load($match[1])) {
            $ds[] = $doll->$order;
            $dolls[] = $doll;
          }
        }
      }
      array_multisort($ds, $sort, SORT_NATURAL, $dolls);
      return $dolls;
    }
    return false;
  }

  static function load ($id) {
    if (file_exists(self::DATA . $id . '.txt')) {
      return new Doll(yaml_parse_file(self::DATA . $id . '.txt'));
    } else {
      return false;
    }
  }

  /* --- data --- */

  private $title, $category, $collection, $description, $handle, $funkoData;
  
  /* --- Constructor --- */



  public function __construct ($data) {
    if ($data['ID']) {
      return $this->update($data);
    }
    return false;
  }

  /* --- Object Functions --- */

  public function import () {
    if (!$this->handle) return false;
    $uu = 'https://www.funko.com/ui-api/search/' . $this->handle;
    $this->funkoData = json_decode(file_get_contents($uu))->products[0];
    if (preg_match('/^Pop!?(.*)\:([^-]+)(?:-(.+))?$/i',$this->funkoData->title, $ex)) {
      $this->category = trim($ex[1]);
      if ($ex[3]) {
        $this->title = trim($ex[3]);
        $this->collection = trim($ex[2]);
      } else {
        $this->title = trim($ex[2]);
      }
    } else {
      return false;
    }
    return $this;
  }

  public function render ($full = false) {
    if ($full) require('./src/templates/doll.html');
    else require('./src/templates/doll_list.html');
  }

  public function update ($data) {
    $this->id = $data['ID'];
    $this->title = $data['TITRE'];
    $this->category = $data['CAT'];
    $this->description = $data['DESC'];
    $this->collection = $data['collection'];
    return $this;
  }


}
