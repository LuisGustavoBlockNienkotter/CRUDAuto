<?php
interface IDAO{
	public function post($object);
	public function get($object);
	public function put($object);
	public function delete($object);
}
?>