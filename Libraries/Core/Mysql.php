<?php 

    class Mysql extends Conexion{

        private $conexion;
        private $strquery;
        private $arrvalue;

        function __construct()
		{
			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->conect();
		}

        public function insert(string $query, array $arrvalues)
		{
			$this->strquery = $query;
            $this->arrvalue = $arrvalues;
            $insert= $this->conexion->prepare($this->strquery);
            $resinsert= $insert->execute($this->arrvalue);
            if($resinsert){
                $lastinsert=$this->conexion->lastInsertId();
            }else{
                $lastinsert=0;
            }
            return $lastinsert;
		}

        public function select (string $query){
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function selectall (string $query){
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
            $data = $result->fetchall(PDO::FETCH_ASSOC);
            return $data;
        }

        public function update(string $query, array $arrvalues)
		{
			$this->strquery = $query;
            $this->arrvalue = $arrvalues;
            $update= $this->conexion->prepare($this->strquery);
            $resupdate= $update->execute($this->arrvalue);
            return $resupdate;
		}

        public function delete(string $query)
		{
			$this->strquery = $query;
  
            $delete= $this->conexion->prepare($this->strquery);
            $delete->execute();
            return $delete;
		}

    }

?>