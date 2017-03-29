<?php 

abstract class cpDatabaseBase {
}

class Database extends cpDatabaseBase {
	
	//db info
	protected $dbType;
	protected $dbCharset;
	protected $dbName;
	
	//server specific info
	//MySQL, Postgre, MariaDb, Oracle etc.
	protected $dbServer;
	protected $dbUsername;
	protected $dbPassword;
	// For SQLite
	protected $dbDatabaseFile;
	// For MySQL or MariaDB with unix_dbSocket
	protected $dbSocket;
	
	// Optional
	protected $dbPort;
	protected $option = array();

	// Variable
	protected $logs = array();

	public function __construct( $dbType = 'mysql', $dbInfo = null ) {
		try {
				$commands = array();
				
				if ( !is_string( $dbType ) || empty( $dbType ) )
					throw new Exception( 'Not a valid database type!' );
				else
					$this->dbType = $dbType;
				
				if ( is_string( $dbInfo ) && !empty( $dbInfo ) ) {
					//all configs except DB name set. Consider deprecating
					if ( strtolower( $this->dbType ) == 'sqlite' ) {
							$this->dbDatabaseFile = $options;
						}
					else {
							$this->dbName = $options;
						}
				}
				elseif (is_array( $dbInfo )) {
					//assign all parameters
					foreach ( $dbInfo as $option => $value ) {
						$this->$option = $value;
					}
				}
				
				//set dbPort
				if ( isset($this->dbPort) && is_int($this->dbPort * 1) ) {
					$dbPort = $this->dbPort;
				}
				
				$type = strtolower( $this->dbType );
				$setPort = isset( $dbPort );

				switch ( $type ) {
					case 'mariadb':
						$type = 'mysql';

					case 'mysql':
						if ($this->dbSocket) {
							$dsn = $type . ':unix_dbSocket=' . $this->dbSocket . ';dbname=' . $this->dbName;
						}
						else {
							$dsn = $type . ':host=' . $this->dbServer . ( $setPort ? ';dbPort=' . $dbPort : '' ) . ';dbname=' . $this->dbName;
						}

						// Make MySQL using standard quoted identifier
						$commands[] = 'SET SQL_MODE=ANSI_QUOTES';
						break;

					case 'pgsql':
						$dsn = $type . ':host=' . $this->dbServer . ( $setPort ? ';dbPort=' . $dbPort : '' ) . ';dbname=' . $this->dbName;
						break;

					case 'sybase':
						$dsn = 'dblib:host=' . $this->dbServer . ( $setPort ? ':' . $dbPort : '' ) . ';dbname=' . $this->dbName;
						break;

					case 'oracle':
						$dbname = $this->dbServer ?
							'//' . $this->dbServer . ( $setPort ? ':' . $dbPort : ':1521' ) . '/' . $this->dbName :
							$this->dbName;

						$dsn = 'oci:dbname=' . $dbname . ( $this->dbCharset ? ';charset=' . $this->dbCharset : '' );
						break;

					case 'mssql':
						$dsn = strstr(PHP_OS, 'WIN') ?
							'sqlsrv:server=' . $this->dbServer . ($setPort ? ',' . $dbPort : '') . ';database=' . $this->dbName :
							'dblib:host=' . $this->dbServer . ($setPort ? ':' . $dbPort : '') . ';dbname=' . $this->dbName;

						// Keep MSSQL QUOTED_IDENTIFIER is ON for standard quoting
						$commands[] = 'SET QUOTED_IDENTIFIER ON';
						break;

					case 'sqlite':
						$dsn = $type . ':' . $this->database_file;
						$this->dbUsername = null;
						$this->dbPassword = null;
						break;
				}

				if ( in_array($type, explode(' ', 'mariadb mysql pgsql sybase mssql')) &&
					  $this->dbCharset ) {
						$commands[] = "SET NAMES '" . $this->dbCharset . "'";
				}
				
				//create PDO object
				$this->pdo = new PDO(
					$dsn,
					$this->dbUsername,
					$this->dbPassword,
					$this->option
				);

				foreach ($commands as $value) {
					$this->pdo->exec($value);
				}
			}
		catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}
	
	
}

$database = new Database('mysql', [
	// required
	'database_name' => 'name',
	'server' => 'localhost',
	'username' => 'your_username',
	'password' => 'your_password',
	'charset' => 'utf8',
 
	// optional
	'port' => 3306,
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);