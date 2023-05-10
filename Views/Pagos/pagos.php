<?php 
    headerprincipal($data);
?>
<main class="page payment-page">
    <section class="clean-block payment-form dark">
        
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Factura</h2>
                </div>
      
                    <div class="products">
                    <h3 class="title">Carrito de compras</h3>
                        <div class="listproducts">

                        </div>

                        <div class="total"><span>Total</span><span class="price montototalpay"> Bs</span></div>
                        <div class="total"><span>conversión</span><span class="price montototalpayconversion"> $</span></div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Datos de Tarjeta de Credito o Cuenta PayPal</h3><br>
                        
                        <div class="form-row">
                        <script src="https://www.paypal.com/sdk/js?client-id=AUbcdycdd4j_vVaZRUDwI-9l3LiA_UTUVX5927KLwefTiKkFxkXpxAIOMMD4AGtNpD8ihr4tZ2YhLkeP&currency=USD"></script>
    
                        <div class="col-sm-12" style="text-align:center;" id="paypal-btn-container">

                        <!--</div>
                            <div class="col-sm-12">
                                <div class="form-group"><button class="btn btn-primary btn-block btnpago" type="button">Cancelar Pago</button></div>
                            </div>
                        </div>-->
                    </div>
               
            </div>
        </section>
        
    </main>

<?php 
    footerprincipal($data);
?>