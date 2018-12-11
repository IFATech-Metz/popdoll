<?php

class Doll {

  const DATA = './txt/';
  const IMG = './txt/';

  public static function list ($orderBy = 'title', $order = SORT_ASC) {
    switch ($orderBy) {
      case 'category':
      case 'description':
        break;
      default:
        $orderBy = 'title';
    }
    switch ($order) {
      case 'desc':
      case -1:
        $order = SORT_DESC;
        break;
      case 'asc':
      case 1:
      default:
        $order = SORT_ASC;
    }

    $ds = [];
    $dolls = [];
    if ($dir = opendir(self::DATA) {
      while (false !== ($file = readdir($dir))) {
        if (preg_match('/^(.+)\.yaml$/i', $file, $match)) {
          if ($doll = Doll::load($match[1])) {
            $ds[] = $doll->$orderBy;
            $dolls[] = $doll;
          }
        }
      }
      array_multisort($ds, $order, SORT_NATURAL, $dolls);
      return $dolls;
    }
    return false;
  }

  static function load ($id) {
    if (file_exists(self::DATA . $id . '.yaml')) {
      return new Doll(yaml_parse_file(self::DATA . $id . '.yaml'));
    } else {
      return false;
    }
  }

  private $id, $title, $category, $description;

  public function __construct ($data) {
    if ($data['ID']) {
      $this->id = $data['ID'];
      $this->title = $data['TITRE'];
      $this->category = $data['CAT'];
      $this->description = $data['DESC'];
      return $this;
    }
    return false;
  }

  public function render ($full = false) {
    if ($full) require('./src/templates/doll.html');
    else require('./src/templates/doll_list.html');
  }

}
