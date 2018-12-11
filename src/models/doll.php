<?php

class Doll {

  const DATA = './txt/';
  const IMG = './txt/';

  public static function list ($order = 'title', $sort = SORT_ASC) {
    $ds = [];
    $dolls = [];

    // Sanitize
    switch ($order) {
      case 'category':
        $order = 'CAT';
        break;
      case 'title':
      default:
        $order = 'TITRE';
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

  private $id, $title, $category, $description;

  public function __construct ($data) {
    if ($data['ID']) {
      return $this->update($data);
    }
    return false;
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
    return $this;
  }


}
