    
<?php 
  headerprincipal($data);

?>

<main class="page catalog-page">
        <?php 
     
        getmodal('modaldetalles',$data);
        ?>
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Catalogo</h2>
                </div>
                <!--<nav>
                    <ul class="pagination">
                        <li class="page-item active"><a class="page-link">Hombre</a></li>
                        <li class="page-item"><a class="page-link">Mujer</a></li>
                        <li class="page-item"><a class="page-link">Juvenil</a></li>
                    </ul>
                </nav>-->
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" d-md-block">
                                <div class="filters">
                                <h3>Categories</h3>
                                    <div class="filter-item categoriaslist">
                                    
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row no-gutters catalogolist">

                                   
   
                                </div> 
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
