<?php
namespace app\model\dao; 
use app\model\dto\Produto;
use app\conexao\Conexao;
use app\interfaces\IDAO;
use PDO;

class ProdutoDao extends Conexao implements IDAO{
	public function post($object){
		$stmt = $this->getPdo()->prepare("INSERT INTO produto
										(id, desc, ncm, estoque)
										VALUES (:id, :desc, :ncm, :estoque)");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
		$stmt->bindParam(":ncm", $ncm, PDO::PARAM_STR);
		$stmt->bindParam(":estoque", $estoque, PDO::PARAM_STR);

		$id = $object->getId();
		$desc = $object->getDesc();
		$ncm = $object->getNcm();
		$estoque = $object->getEstoque();

		$stmt->execute();
	}
	public function get($object){
		try{
			$query = $this->getPdo()->query("SELECT * FROM produto;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$produto = new Produto($result["id"],$result["desc"],$result["ncm"],$result["estoque"]);
				array_push($array, $produto);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function put($object){
		try{
			$stmt = $this->getPdo()->prepare("UPDATE produto SET desc = :desc, ncm = :ncm, estoque = :estoque
						 WHERE id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
			$stmt->bindParam(":ncm", $ncm, PDO::PARAM_STR);
			$stmt->bindParam(":estoque", $estoque, PDO::PARAM_STR);

			$id = $object->getId();
			$desc = $object->getDesc();
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

				$id = $object->getId();

				$stmt->execute();
			}
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
?>