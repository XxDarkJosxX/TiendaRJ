<?php
headerprincipal($data);
?>
<main class="page catalog-page">
    <section class="clean-block clean-catalog dark">
        <div class=" container ">
            <div class="row justify-content-center ">
                <div class="bg-white col-lg-6 col-12">
                    <div class="block-heading">
                        <h2 class="text-info">Registro de Datos</h2>
                        <p>Para tener un mayor conocimiento sobre tus preferencias,no olvides registrarte!.</p>
                    </div>
                    <form autocomplete="off" class="form-horizontal" id="formclientes" name="formclientes" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="txtnombre" id="txtnombre" placeholder="Ej. Juan Perez" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input class="form-control" name="txtapellido" id="txtapellido" placeholder="Ej. Perez Gonzales" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Numero de celular</label>
                            <input class="form-control" id="txttelefono" name="txttelefono" type="number" placeholder="Ej.75825623" required="">
                        </div>
                        <div class="form-group">
                            <label>Numero de Carnet</label>
                            <input class="form-control" id="txtci" name="txtci" type="number" placeholder="Ej.10935818" required="">
                        </div>
                        <div class="form-group">
                            <label>Direccion</label>
                            <input class="form-control" name="txtdireccion" id="txtdireccion" placeholder="Ej.av 6 de agosto" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="txtcorreo" id="txtcorreo" placeholder="JuanPerez@gmail.com" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Contraceña</label>
                            <input class="form-control" name="txtcontrasenia" id="txtcontrasenia" placeholder="Contraseña" type="password" required>
                        </div>
                        <div class="form-group">
                            <button id="btnactionform" class="btn btn-primary" type="submit">
                                <span id="btntext">Guardar</span>
                            </button>&nbsp;&nbsp;&nbsp;
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
footerprincipal($data);
?>