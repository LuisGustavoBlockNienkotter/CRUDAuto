<?php
namespace app\model\dao; 
use app\model\dto\Fornecedor;
use app\conexao\Conexao;
use app\interfaces\IDAO;
use PDO;

class FornecedorDAO extends Conexao implements IDAO{
	public function insert($object){
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
	public function findAll(){
		try{
			$query = $this->getPdo()->query("SELECT * FROM fornecedor;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$fornecedor = (new Fornecedor())->setId($result['id'])
->setNome($result['nome'])
->setCpf($result['cpf']);
				array_push($array, $fornecedor);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function update($object){
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

				$id = $objeto->getId();

				$stmt->execute();
			}
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function findById($objeto){
		$stmt = $this->getPdo()->prepare("SELECT * FROM fornecedor WHERE id = :id;");
		$stmt->bindParam(':id', $id);
		$id = $objeto->getId(); 
		$stmt->execute();
		while ($obj = $stmt->fetch(PDO::FETCH_ASSOC)){
			$r[] = (new Fornecedor())->
			setId($obj['id'])
			->setNome($obj['nome'])
			->setCpf($obj['cpf']);
		}
		return $r;
	}
	}
?>