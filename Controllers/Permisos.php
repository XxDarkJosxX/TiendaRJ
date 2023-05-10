<?php 
    class Permisos extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function getpermisos(int $idrol){
            $intidrol=intval($idrol);
            if( $intidrol > 0){
                $arrmodulos= $this->model->selectmodulos();
                $arrpermisos= $this->model->selectpermisos($intidrol);
                $arrfitropermiso=array('r'=>0,'w'=>0,'u'=>0,'d'=>0);
                $arrpermiso=array('IdRol'=>$intidrol);
                if(empty($arrpermisos)){
                    for($i=0; $i < count( $arrmodulos);$i++){
                        $arrmodulos[$i]['permisos']=$arrfitropermiso;
                    }
                }else{
                    for($i=0; $i < count( $arrmodulos);$i++){
                        $arrfitropermiso=array('r'=>0,'w'=>0,'u'=>0,'d'=>0);
                        if(isset($arrpermisos[$i])){

                            $arrfitropermiso=array(
                                'r'=>$arrpermisos[$i]['r'],
                                'w'=>$arrpermisos[$i]['w'],
                                'u'=>$arrpermisos[$i]['u'],
                                'd'=>$arrpermisos[$i]['d']
                            );

                        }
                     
                        $arrmodulos[$i]['permisos']=$arrfitropermiso;
                       
                    }
                }

                $arrpermiso['modulos']=$arrmodulos;
                $html=getmodal("modalpermisos",$arrpermiso);
                //dep($arrpermiso);
            }
            die();
        }


        public function setpermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['IdModulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos( $idModulo,$intIdrol, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
    }
?>