<?php 
    class Dashboard extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(1);
        }
        public function dashboard(){

            $data['page_id'] = 2;
            $data['page_tag'] = "Dashboard";
            $data['page_title']= "Dashboard"; 
            $data['page_name'] = "dashboard";
            $data['usuarios'] = $this->model->cantUsuarios();
			$data['clientes'] = $this->model->cantClientes();
			$data['productos'] = $this->model->cantProductos();
			$data['pedidos'] = $this->model->cantPedidos();
			$data['pedidos'] = $this->model->cantPedidos();
            
			$data['lastOrders'] = $this->model->lastOrders();

            if(  $_SESSION['userdata']['IdRoles'] == 2 ){
				$this->views->getView($this,"dashboardCliente",$data);
			}else{
				$this->views->getView($this,"dashboard",$data);
			}
        }


    }
?>