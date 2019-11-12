<?php
namespace app\model\dao; 
use app\model\dto\Fornecedor;
use app\conexao\Conexao;
use app\interfaces\IDAO;
use PDO;

class FornecedorDao extends Conexao implements IDAO{
	public function post($object){
		$stmt = $this->getPdo()->prepare("INSERT INTO fornecedor
										(id, nome, cpf)
										VALUES (:id, :nome, :cpf)");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
		$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);

		$id = $object->getId();
		$nome = $object->getNome();
		$cpf = $object->getCpf();

		$stmt->execute();
	}
	public function get($object){
		try{
			$query = $this->getPdo()->query("SELECT * FROM fornecedor;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$fornecedor = new Fornecedor($result["id"],$result["nome"],$result["cpf"]);
				array_push($array, $fornecedor);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function put($object){
		try{
			$stmt = $this->getPdo()->prepare("UPDATE fornecedor SET nome = :nome, cpf = :cpf
						 WHERE id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);

			$id = $object->getId();
			$nome = $object->getNome();
			$cpf = $object->getCpf();

			$stmt->execute();
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function delete($objeto){
		try{
			if ($objeto instanceof fornecedor) {
				$stmt = $this->getPdo()->prepare("DELETE FROM fornecedor WHERE id = :id");
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