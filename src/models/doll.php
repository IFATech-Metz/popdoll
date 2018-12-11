<?php

class Doll {

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
