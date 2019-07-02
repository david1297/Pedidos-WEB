<?php

require_once("config/db.php");
require_once("classes/Login.php");
require_once ("config/conexion.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {
   header("location: index.php");

} else {
    ?>
<!DOCTYPE html>
  <html>
    <head>
    <?php include("Head.html");?>
    </head>

    <body>
      <div class="section"></div>
      <main>
        <center>
          <img class="responsive-img" style="width: 250px;" src="Img/saiopen.png" />
          <div class="section"></div>
    
         <h5 class="indigo-text">Pedidos Moviles</h5>
          <div class="section"></div>
    
          <div class="container">
            <div class='row'>
              <div class="col m6 offset-m3 s12"> 
                <div class="z-depth-1 grey lighten-4 row" style=" padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
                  <?php
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="red-text" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="green-text" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                    <div class='row'>
                      <div class='col s12'></div>
                    </div>          
                    <div class='row'>
                      <div class='input-field col s12'>
                        <input class='validate' type='text' name='Usuario' id='Usuario' onkeyup="javascript:this.value=this.value.toUpperCase();" value="VENTAS1"/>
                        <label for='Usuario'>Ingrese Su Usuario</label>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='input-field col s12'>
                        <input class='validate' type='password' name='Clave' id='Clave' value="12345" />
                        <label for='Clave'>Ingrese Su Constraseña</label>
                      </div>
                    </div>
                    <br/>
                    <center>
                      <div class='row'>
                        <button type='submit' name="login" class='col s12 btn btn-large waves-effect indigo'>Ingresar</button>
                      </div>
                    </center>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--
          <a href="#!">Create account</a>
          -->
        </center>
    
        <div class="section"></div>
        <div class="section"></div>
      </main>
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="js/materialize.js"></script>
      <script src="js/init.js"></script>
    
    </body>
  </html>
  <?php
}