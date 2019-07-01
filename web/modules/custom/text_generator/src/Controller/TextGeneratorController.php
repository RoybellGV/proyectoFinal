<?php

namespace Drupal\text_generator\Controller;

class TextGeneratorController{
  public function generate($paragraph, $phrases){
    $output['#title'] = t("Api");
    $output['#theme'] = 'text_generated';
    $output['#text'] = 'SHow this api';
    return $output;
  }
}
