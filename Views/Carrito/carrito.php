<?php 
    headerprincipal($data);
?>
<main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Carrito de compras</h2>
                </div>
                <div class="content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">

                                <div class="product">
                                    <div class="row justify-content-center align-items-center">
                                     
                                      <h4>Su carrito esta vacío</h4>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>TOTAL</h3>
                     
                                <h4><span class="text">Descuento</span><span class="price txtdescuento">Si</span></h4>
                                <h4><span class="text">Total</span><span class="price txttotal">0 Bs</span></h4>
                                <a href="<?=base_url();?>/pagos"><button class="btn btn-primary btn-block btn-lg" type="button">Comprar en linea</button></a>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php 
    footerprincipal($data);
?>