<?php

interface Controller {
  public function render(string $template, array $variables);
  public function handle(string $handler, string &$template, array &$variables);
  
}