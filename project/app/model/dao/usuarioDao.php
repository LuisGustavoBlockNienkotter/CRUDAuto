<?php
namespace app\model\dao; 
use app\model\dto\Usuario;
use app\conexao\Conexao;
use app\interfaces\IDAO;
use PDO;

class UsuarioDao extends Conexao implements IDAO{
	public function post($object){
		$stmt = $this->getPdo()->prepare("INSERT INTO usuario
										(id, nome, login, senha)
										VALUES (:id, :nome, :login, :senha)");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
		$stmt->bindParam(":login", $login, PDO::PARAM_STR);
		$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);

		$id = $object->getId();
		$nome = $object->getNome();
		$login = $object->getLogin();
		$senha = $object->getSenha();

		$stmt->execute();
	}
	public function get($object){
		try{
			$query = $this->getPdo()->query("SELECT * FROM usuario;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$usuario = new Usuario($result["id"],$result["nome"],$result["login"],$result["senha"]);
				array_push($array, $usuario);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function put($object){
		try{
			$stmt = $this->getPdo()->prepare("UPDATE usuario SET nome = :nome, login = :login, senha = :senha
						 WHERE id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);

			$id = $object->getId();
			$nome = $object->getNome();
			$login = $object->getLogin();
			$senha = $object->getSenha();

			$stmt->execute();
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function delete($objeto){
		try{
			if ($objeto instanceof usuario) {
				$stmt = $this->getPdo()->prepare("DELETE FROM usuario WHERE id = :id");
				$stmt->bindParam(":id", $id, PDO::PARAM_STR);

				$id = $object->getId();

				$stmt->execute();
			}
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
?>