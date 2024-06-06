<?php 

interface IDatabasePersistable {
  /**
   * Gives array of bindings for specific Class
   */
  public function getDBQueryBindings() : array;
}
