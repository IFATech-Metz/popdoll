<?php

class Doll {

  const DATA = './txt/';
  const IMG = './txt/';

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
