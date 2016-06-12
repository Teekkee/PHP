<?php 

class Connection {

	public static $user;
	public static $password;
	public static $host;
	public static $port;
	public static $proto;
	public static $defaultPathToDb;
	public static $defaultPathToRootDir;


	private static $connection = null;
	private $dbh = null;

	// parent $this self static
	private function __construct () { }
	private function __clone () { }
	private function __wakeup () { }
	public static function getInstance() {
		if (empty(self::$connection)) {
			echo "Creating new instance of Connection<br>";

			self::$connection = new self();
		}
		return self::$connection;
	}

	public function connect() {
		// switch case

		if (!empty(self::$defaultPathToRootDir)) {
			// sqlite:/data/library.sqlite
			$dsn = self::$proto. ":" . self::$defaultPathToRootDir . self::$defaultPathToDb;
		}
		else
			$dsn = self::$proto.  ":" . self::$defaultPathToDb;

		if (!(self::$connection->dbh instanceof PDO)) {
			try {
				self::$connection->dbh = new PDO($dsn, self::$user, self::$password);
				self::$connection->dbh->exec("SET CHARACTER SET utf8");
				self::$connection->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return self::$connection->dbh;
			}

			catch (PDOException $e) {
				echo '<br>Не удалось установить соединения с базой данных: ' . $e->getMessage(). '<br>';
			}
		}
		else {
			return self::$connection->dbh;
		}

	}
}


?>
