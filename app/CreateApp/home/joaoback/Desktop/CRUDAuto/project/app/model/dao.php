<?php
require_once "Conexao.php";
require_once "IDAO.php";
class RocketDao extends Conexao implements IDAO{
	public function post($object){
		$stmt = $this->getPdo()->prepare("INSERT INTO rocket
										(id, codigo, altura, largura, peso)
										VALUES (:id, :codigo, :altura, :largura, :peso)");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->bindParam(":altura", $altura, PDO::PARAM_STR);
		$stmt->bindParam(":largura", $largura, PDO::PARAM_STR);
		$stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

		$id = $object->getId();
		$codigo = $object->getCodigo();
		$altura = $object->getAltura();
		$largura = $object->getLargura();
		$peso = $object->getPeso();

		$stmt->execute();
	}
	public function get(){
		try{
			$query = $this->getPdo()->query("SELECT * FROM rocket;");
			$array = array();
			while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
				$rocket = new Rocket($result["id"],$result["codigo"],$result["altura"],$result["largura"],$result["peso"]);
				array_push($array, $rocket);
			}
			return $array;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function put($object){
		try{
			$stmt = $this->getPdo()->prepare("UPDATE rocket SET codigo = :codigo, altura = :altura, largura = :largura, peso = :peso
						 WHERE id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
			$stmt->bindParam(":altura", $altura, PDO::PARAM_STR);
			$stmt->bindParam(":largura", $largura, PDO::PARAM_STR);
			$stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

			$id = $object->getId();
			$codigo = $object->getCodigo();
			$altura = $object->getAltura();
			$largura = $object->getLargura();
			$peso = $object->getPeso();

			$stmt->execute();
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function delete($objeto){
		try{
			if ($objeto instanceof rocket) {
				$stmt = $this->getPdo()->prepare("DELETE FROM rocket WHERE id = :id");
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