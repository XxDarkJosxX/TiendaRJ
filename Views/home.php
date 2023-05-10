<?php 
  headerprincipal($data);

?>
   
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url(&quot;Assets/img/fondo.jpg&quot;);color:rgba(181, 181, 181, 0);">
            <div class="text">
                <h1 class="TituloP">Romeo & Julieta</h1>
                <p style="color: black;">Dile adiós al “no tengo que ponerme”.</p><button class="btn btn-outline-light btn-lg" type="button">Ver mas</button></div>
        </section>
        <section class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Nosotros</h2>
                    <p>No podras comprar la felicidad, pero si el oufit perfecto para esa ocasion especial. No notaras la diferencia!</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-4"><img class="img-thumbnail" src="Assets/img/logo.png"></div>
                    <div class="col-md-6">
                        
                        <div class="getting-started-info">
                            <h3>Mision</h3>
                            <p>Somos una tienda de ropa, idealizandonos como una de las mejores tiendas bolivianas, planeamos y consideramos...</p>
                        </div><button class="btn btn-outline-primary btn-lg" type="button">Ver mas</button></div>
                </div>
            </div>
        </section>
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Beneficios</h2>
                    <p>Nuestra tienda de ropa no es una tienda mas, te proponemos los siguientes beneficios.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-star icon"></i>
                        <h4>Calidad</h4>
                        <p>Una de nuestras principales caracteristicas es promover productos de calidad, asociandonos con las mejores marcas, logrando asi obtener los mejores elementos para nuestros clientes.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-shield icon"></i>
                        <h4>Seguridad</h4>
                        <p>Dentro de nuestra tienda puedes sentirte seguro, no solo contamos con productos de marca; sino tambien contamos con personal capacitado.</p>
                    </div>
                    
                    <div class="col-md-5 feature-box"><i class="icon-screen-smartphone icon"></i>
                        <h4>Ultima moda</h4>
                        <p>Nos esmeramos por mantenermos al tanto sobre las ultimas modas, deseamos vestir al cliente con las mejores prendas.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-heart icon"></i>
                        <h4>Confiabilidad</h4>
                        <p>En abse a los anteriores puntos, podemos asegurar seguridad, calidad y modernizo, tratando de lograr confianza del cliente hacia nosotros.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block slider">
            <div class="container">
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="w-100 w-100img d-block d-blockimg" src="Assets/img/Marcas/zara.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 w-100img d-block d-blockimg" src="Assets/img/Marcas/bershka.jpg"  alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 w-100img d-block d-blockimg" src="Assets/img/Marcas/shein.jpg"  alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                            data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </section>
    </main>

<?php 
  footerprincipal($data);

?>