<?php 

namespace App;

interface IDatabasePersistable {
	/**
	 * Gives array of insert bindings for specific Class
	 */
	public function getDBInsertBindings() : array;

	/**
	 * Gives array of update bindings for specific Class
	 */
	public function getDBUpdateBindings() : array;
}
