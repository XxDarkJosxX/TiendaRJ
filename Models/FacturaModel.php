<?php 
	class FacturaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function selectPedido(int $idpedido, $idpersona = NULL){
			$busqueda = "";

			if($idpersona != NULL){
				$busqueda = " AND tv.IdCliente =".$idpersona;
			}

			$request = array();
			
			$sql = "SELECT 	tv.IdVenta,
							tv.IdCliente,
							DATE_FORMAT(tv.Fecha, '%d/%m/%Y') as Fecha,
							tv.Total,
							tv.MetodoPago,
							tv.CantidadTotal
					FROM tventas tv
					WHERE tv.IdVenta =  $idpedido";
					
			$requestPedido = $this->select($sql);
			

			if(!empty($requestPedido)){
				$idpersona = $requestPedido['IdCliente'];
				$sql_cliente = "SELECT  IdUsuario,
										Nombre,
										Apellido,
										Telefono,
										Correo,
										Nit,
										NombreFiscal,
										Direccion 
								FROM tusuarios WHERE IdUsuario = $idpersona ";

			$requestcliente = $this->select($sql_cliente);

			$sql_detalle = "SELECT 			p.IdProducto,
											p.Nombre as Producto,
											d.Precio,
											d.Cantidad,
											d.Descuento
									FROM tdetalleventas d
									INNER JOIN tproductos p ON d.IdProducto = p.IdProducto
									WHERE d.IdVenta = $idpedido";

			$requestProductos = $this->selectall($sql_detalle);


			$request = array('cliente' => $requestcliente,
								'orden' => $requestPedido,
								'detalle' => $requestProductos
								 );
			}
			return $request;
		}
	}
 ?>