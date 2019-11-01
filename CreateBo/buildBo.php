<?php

class BuildBo
{
    private $json;

    public function __construct($json) {
        $json_file = file_get_contents($json);
        $json_file = json_decode($json_file, true);
        $this->json = $json_file;
    }

    public function createBoObjects()
    {
        $str = '';
       
            $str =  '<?php'."\n".
                    'require_once "IDAO.php";'."\n".
                    'class BoController implements IDAO{'."\n".
                    "\t".'private $type;'."\n".
                    "\t".'public function __construct($type){'."\n".
                    "\t"."\t".'$this->type = $type;'."\n".
                    "\t".'}'."\n".
                    "\t".'public function post($object){'."\n".
                    "\t"."\t".'return $this->type->post($object);'."\n".
                    "\t".'}'."\n".
                    "\t".'public function get($object){'."\n".
                    "\t"."\t".'return $this->type->get($object);'."\n".
                    "\t".'}'."\n".
                    "\t".'public function put($object){'."\n".
                    "\t"."\t".'return $this->type->put($object);'."\n".
                    "\t".'}'."\n".
                    "\t".'public function delete($object){'."\n".
                    "\t"."\t".'return $this->type->delete($object);'."\n".
                    "\t".'}'."\n".
                    '}'."\n".
                    '?>';
            $file = fopen('boController.php', 'w');
            fwrite($file, $str);
            fclose($file);
        
    }
}


?>