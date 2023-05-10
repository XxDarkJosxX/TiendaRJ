<?php 
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function cantUsuarios(){
			$sql = "SELECT COUNT(*) as total FROM tusuarios WHERE Estado != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantClientes(){
			$sql = "SELECT COUNT(*) as total FROM tusuarios WHERE Estado != 0 AND IdUsuario = 2";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantProductos(){
			$sql = "SELECT COUNT(*) as total FROM tproductos WHERE Estado != 0 ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

        public function cantPedidos(){
			$rolid = $_SESSION['userdata']['IdRoles'];
			$idUser = $_SESSION['userdata']['IdUsuario'];
			$where = "";

			if($rolid == 2 ){
				$where = " WHERE IdCliente = ".$idUser;
			}

			$sql = "SELECT COUNT(*) as total FROM tventas ".$where;
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}


		public function lastOrders(){
			$rolid = $_SESSION['userdata']['IdRoles'];
			$idUser = $_SESSION['userdata']['IdUsuario'];
			$where = "";

			if($rolid == 2 ){
				$where = " WHERE p.IdCliente = ".$idUser;
			}

			$sql = "SELECT p.IdVenta, CONCAT(pr.Nombre,' ',pr.Apellido) as nombre, p.Total, p.CantidadTotal, CONCAT(pe.Nombre,' ',pe.Apellido) as nombree, p.Estado
					FROM tventas p
					LEFT JOIN  tusuarios pr
					ON p.IdCliente = pr.IdUsuario
					LEFT JOIN  tusuarios pe
					ON pe.IdUsuario = p.IdUsuario
					$where
					ORDER BY p.IdVenta DESC LIMIT 10 ";
			$request = $this->selectall($sql);
			return $request;
		}

		
	}
 ?>