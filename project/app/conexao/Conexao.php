<?php
namespace app\conexao;
use PDO; 
class Conexao{
	private $pdo;
	public function __construct(){
		$this->pdo = new PDO("mysql:host=localhost;dbname=project01", "root","");
	}
	public function getPdo(){
		$this->pdo = new PDO("mysql:host=localhost;dbname=project01", "root","");
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $this->pdo;
	}
	public function setPdo($pdo){
		$this->pdo = $pdo;
		return $this;
	}
}
?>