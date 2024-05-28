<?php

interface Controller {
  public function render(string $template, array $variables);
  
}