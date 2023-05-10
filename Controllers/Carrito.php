<?php 
    class Carrito extends Controllers{


        protected $cart_contents = array();

        public function __construct() {
            parent::__construct();
            session_start();
            $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
            if ($this->cart_contents === NULL){
      
                $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
            }
        }


        public function carrito(){

     
            $data['page_tag'] = "Carrito";
            $data['page_title']= "Carrito";
            $data['page_name'] = "carrito";
            $data['page_js'] = "functioncarrito.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit.";
            if(!empty($_SESSION['login'])){
      
                $data['logincontentdata'] = "Bienvenido ".$_SESSION['userdata']['Nombre'];
            }else{
                $data['logincontentdata'] = "Iniciar sesion";
            }
            $this->views->getview($this,"carrito",$data);
        }

        public function addcarrito($idproducto){

            $idproductoprecio= explode(",", $idproducto);
            

            $intidproducto=intval(strclean($idproductoprecio[0]));
            $intidpreciotalla=intval(strclean($idproductoprecio[1]));

            if ($intidproducto>0){
                $arrdata = $this->model->selectproducto($intidproducto,$intidpreciotalla);
                $precio = $arrdata['Precio'];
                $preciofinal = $precio;
                $porcentaje = 0;
                if($arrdata['Porcentaje'] != null){
                    $porcentaje = $arrdata['Porcentaje'];
                    $porcentajefinal = (100 - $porcentaje)/100;
                    $preciofinal =  round(($precio * $porcentajefinal),2);
                    
                }
                
                $rowpreciotalla = $arrdata['IdPrecioTalla'];
                $rowid = $rowpreciotalla;
          
                $itemData = array(
                    'id' => $arrdata['IdProducto'],
                    'key' => $rowid,
                    'idpreciotalla' => $arrdata['IdPrecioTalla'],
                    'name' => $arrdata['Nombre'],
                    'namefoto' => $arrdata['foto'],
                    'price' => $preciofinal,
                    'porcentaje' => $porcentaje,
                    'size' => $arrdata['NombreT'],
                    'qty' => 1
                );
                $insertItem = $this->insertcarrito($itemData);
                

                if($insertItem){
                    $arrresponse= array('status'=>true,'msg'=>'Producto añadido al carrito');
                }else{
                    $arrresponse= array('status'=>false,'msg'=>'No se envio los datos');
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        public function insertcarrito($item = array()){

            if(!is_array($item) OR count($item) === 0){
                return FALSE;

            }else{

                if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
                    return FALSE;
                }else{
                
                    $item['qty'] = (float) $item['qty'];
                    if($item['qty'] == 0){
                        return FALSE;
                    }
                 
                    $item['price'] = (float) $item['price'];
              
                    $rowpreciotalla = $item['idpreciotalla'];

                    $rowid = $rowpreciotalla;
               
              
                    $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
          
                    $item['rowid'] = $rowid;
                    $item['qty'] += $old_qty;
                    $this->cart_contents[$rowid] = $item;
                    
         
                    if($this->save_cart()){
                        return isset($rowid) ? $rowid : TRUE;
                    }else{
                        return FALSE;
                    }
                }
            }
        }

        protected function save_cart(){
            $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
            foreach ($this->cart_contents as $key => $val){
        
                if(!is_array($val) OR !isset($val['price'], $val['qty'])){
                    continue;
                }
         
                $this->cart_contents['cart_total'] +=  round(((round($val['price'],2) * $val['qty'])),2);
                $this->cart_contents['total_items'] += $val['qty'];
                $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
                
            }
            
         
            if(count($this->cart_contents) <= 2){
                unset($_SESSION['cart_contents']);
                return FALSE;
            }else{
                $_SESSION['cart_contents'] = $this->cart_contents;
                return TRUE;
            }
        }

        public function total_items(){
            
            return $this->cart_contents['total_items'];
        }

        
        public function total(){
            echo json_encode($this->cart_contents['cart_total'],JSON_UNESCAPED_UNICODE);
         
        }
        
        public function contents(){
            
            if($this->total_items() > 0){
                $cart = array_reverse($this->cart_contents);
          
                unset($cart['total_items']);
                unset($cart['cart_total']);
                
           
                $i=0;
                foreach ($cart as $value) {
                   
                    $itemData[$i] = array(
                        'id' => $value['id'],
                        'key' => $value['key'],
                        'name' => $value['name'],
                        'price' => $value['price'],
                        'size' => $value['size'],
                        'qty' => $value['qty'],
                        'namefoto' => $value['namefoto']
                    );
                    $i++;
                }
                echo json_encode($itemData,JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode("",JSON_UNESCAPED_UNICODE);
            }
        
        }

        public function contentsadmin(){
            
            if($this->total_items() > 0){
                $cart = array_reverse($this->cart_contents);
          
                unset($cart['total_items']);
                unset($cart['cart_total']);
                
                $htmlscript='';
                $finalfo=count($cart)-1;
                $i=0;
                foreach ($cart as $value) {
                    if($finalfo == $i){
                        $htmlscript='<script type="text/javascript"> fntdelcarrito(); fntupdateqty();</script>';
                    };
                    $itemData[$i] = array(
                        'id' => $value['id'],
                        'key' => $value['key'],
                        'name' => $value['name'],
                        'price' => $value['price'],
                        'size' => $value['size'],
                        'qty' => ' <input type="number"  value="'.$value['qty'].'" rl="'.$value['key'].'" id="numberqty" name="numberqty" class="form-control quantity-input btnupdatecarrito text-center ">',
                        'options' => '<button class="btn btn-danger btn-sm btndelstyle btndelproducto" rl="'.$value['key'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>
                        '.$htmlscript.'
                        '
                    );

                    $i++;
                }
                echo json_encode($itemData,JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode("",JSON_UNESCAPED_UNICODE);
            }
        
        }

        public function remove($row_id){
            // unset & save
            unset($this->cart_contents[$row_id]);
            $this->save_cart();
            return TRUE;
         }


        public function updatecantidad($values){
            $valuesobj= explode(",", $values);
     

            $intidproducto=intval(strclean($valuesobj[0]));
            $catidad=intval(strclean($valuesobj[1]));
            
            $itemData = array(
                'rowid' => $intidproducto,
                'qty' => $catidad
            );

            $updateItem = $this->updateqty($itemData);
            echo $updateItem ?'ok':'err';
            die;
        }


        public function updateqty($item = array()){
            if (!is_array($item) OR count($item) === 0){
                return FALSE;
            }else{
                if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
                    return FALSE;
                }else{
                    // prep the quantity
                    if(isset($item['qty'])){
                        $item['qty'] = (float) $item['qty'];
                        // remove the item from the cart, if quantity is zero
                        if ($item['qty'] == 0){
                            unset($this->cart_contents[$item['rowid']]);
                            return TRUE;
                        }
                    }
                    
                    // find updatable keys
                    $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
                    // prep the price
                    if(isset($item['price'])){
                        $item['price'] = (float) $item['price'];
                    }
                    // product id & name shouldn't be changed
                    foreach(array_diff($keys, array('id', 'name')) as $key){
                        $this->cart_contents[$item['rowid']][$key] = $item[$key];
                    }
                    // save cart data
                    $this->save_cart();
                    return TRUE;
                }
            }
        }

    }
?>