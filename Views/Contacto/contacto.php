<?php 
  headerprincipal($data);

?>
   
   <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Contactanos</h2>
                    <p>Si tuviste algun problema o necesitas ayuda, puedes comunicarte con nosotros.</p>
                </div>
                <form id="form">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" name="name" id="name" placeholder="Ej. Juan Perez" type="text" required>
                    </div>
             
                    <div class="form-group">
                        <label>Apellido</label>
                        <input class="form-control" name="lastname" id="lastname" placeholder="Ej. Perez Gonzales" type="text" required>
                    </div>
         
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" id="email" placeholder="JuanPerez@gmail.com" type="text" required>
                    </div>
     
                    <div class="form-group">
                        <button class="log-in btn btn-primary btn-block" id="submit" type="submit"><i class="fab fa-whatsapp"></i>Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
<?php 
  footerprincipal($data);

?>