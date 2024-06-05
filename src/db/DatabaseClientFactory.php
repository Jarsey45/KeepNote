<?php 

class DatabaseClientFactory {

	private static $factory;
	private $db;
	protected function __construct() {}

	public static function getFactory() : DatabaseClientFactory {
		if(!self::$factory)
			self::$factory = new DatabaseClientFactory();
		return self::$factory;
	}

	public function getConnection() : PDO {
		if(!$this->db) {
			try {
				$this->db = new PDO(
					'pgsql:host=' . DB_HOST . ';port=' . DB_HOST_PORT . ';dbname=' . DB_NAME,
					DB_USER,
					DB_PASSWORD,
					[
						"sslmode"  => "prefer",
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					]
				);
			} catch (PDOException $e) {
				die("Connection failed: " . $e->getMessage());
			}
		}
		return $this->db;
	}
	
}