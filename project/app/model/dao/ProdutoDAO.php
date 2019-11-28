<?php
namespace app\model\dao; 
use app\model\dto\Produto;
use app\conexao\Conexao;
use app\interfaces\IDAO;
use PDO;

class ProdutoDAO extends Conexao implements IDAO{
	public function insert($object){
		$stmt = $this->getPdo()->prepare("INSERT INTO produto
										(id, descricao, ncm, estoque)
										VALUES (:id, :descricao, :ncm, :estoque)");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
		$stmt->bindParam(":ncm", $ncm, PDO::PARAM_STR);
		$stmt->bindParam(":estoque", $estoque, PDO::PARAM_STR);

		$id = $object->getId();
		$descricao = $object->getDescricao();
		$ncm = $object->getNcm();
		$estoque = $object->getEstoque();

		$stmt->execute();
	}
	public function findAll(){
		try{
			$query = $this->getPdo()->query("SELECT * FROM produto;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$produto = (new Produto())->setId($result['id'])
->setDescricao($result['descricao'])
->setNcm($result['ncm'])
->setEstoque($result['estoque']);
				array_push($array, $produto);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function update($object){
		try{
			$stmt = $this->getPdo()->prepare("UPDATE produto SET descricao = :descricao, ncm = :ncm, estoque = :estoque
						 WHERE id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
			$stmt->bindParam(":ncm", $ncm, PDO::PARAM_STR);
			$stmt->bindParam(":estoque", $estoque, PDO::PARAM_STR);

			$id = $object->getId();
			$descricao = $object->getDescricao();
			$ncm = $object->getNcm();
			$estoque = $object->getEstoque();

			$stmt->execute();
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function delete($objeto){
		try{
			if ($objeto instanceof produto) {
				$stmt = $this->getPdo()->prepare("DELETE FROM produto WHERE id = :id");
				$stmt->bindParam(":id", $id, PDO::PARAM_STR);

				$id = $objeto->getId();

				$stmt->execute();
			}
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function findById($objeto){
		$stmt = $this->getPdo()->prepare("SELECT * FROM produto WHERE id = :id;");
		$stmt->bindParam(':id', $id);
		$id = $objeto->getId(); 
		$stmt->execute();
		while ($obj = $stmt->fetch(PDO::FETCH_ASSOC)){
			$r[] = (new Produto())->
			setId($obj['id'])
			->setDescricao($obj['descricao'])
			->setNcm($obj['ncm'])
			->setEstoque($obj['estoque']);
		}
		return $r;
	}
	}
?>