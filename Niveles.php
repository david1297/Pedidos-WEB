<?php  session_start();
if ($_SESSION['user_login_status'] <> 1) {
  header("location: login.php");
} 
require_once ("config/db.php");
require_once ("config/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("Head.html");?>
</head>
<body>
<?php
    include("Menu.php");?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
          
            <div class="row">
                <div class="col s12">
                    <div class="row">
                      <a class="waves-effect waves-light btn green" onclick="NuevoNivel()">
                        <i class="material-icons left">add</i>Nuevo
                      </a>
                      <a href="Niveles_Item.php" id="download-button" class="btn waves-effect waves-light orange">Niveles de Items</a>
                      <ul class="collapsible">
                      <?php
                        $sql1="SELECT * FROM NIVELES";
                        $query1 = mysqli_query($con, $sql1);
                        while($row=mysqli_fetch_array($query1)){
                          ?>
                          <li>
                            <div class="collapsible-header">
                              <i class="material-icons">equalizer</i>
                              Nivel <?php echo $row['Codigo'] ?>
                            </div>
                          <div class="collapsible-body">
                          <form action="#" class='FNiveles' id="Nivel<?php echo $row['Codigo'] ?>" name="Nivel<?php echo $row['Codigo'] ?>" metod="POST">
                          <input type="text" name='Codigo' class='hide' Value ="<?php echo $row['Codigo'] ?>">  
                            <table>
                              <tbody>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">Precio1</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde1" name="Desde1" type="number" class="validate" value="<?php echo $row['Desde1'] ?>">
                                      <label for="Desde1">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Hasta1" name="Hasta1" type="number" class="validate" value="<?php echo $row['Hasta1'] ?>">
                                      <label for="Hasta1">Hasta</label>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">Precio2</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde2" name="Desde2" type="number" class="validate" value="<?php echo $row['Desde2'] ?>">
                                      <label for="Desde2">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Hasta2" name="Hasta2" type="number" class="validate" value="<?php echo $row['Hasta2'] ?>">
                                      <label for="Hasta2">Hasta</label>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">Precio3</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde3" name="Desde3" type="number" class="validate" value="<?php echo $row['Desde3'] ?>">
                                      <label for="Desde3">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Hasta3" name="Hasta3" type="number" class="validate" value="<?php echo $row['Hasta3'] ?>">
                                      <label for="Hasta3">Hasta</label>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">Precio4</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde4" name="Desde4" type="number" class="validate" value="<?php echo $row['Desde4'] ?>">
                                      <label for="Desde4">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Hasta4" name="Hasta4" type="number" class="validate" value="<?php echo $row['Hasta4'] ?>">
                                      <label for="Hasta4">Hasta</label>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">Precio5</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde5" name="Desde5" type="number" class="validate" value="<?php echo $row['Desde5'] ?>">
                                      <label for="Desde5">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Hasta5" name="Hasta5" type="number" class="validate" value="<?php echo $row['Hasta5'] ?>">
                                      <label for="Hasta5">Hasta</label>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 0px;padding-top: 0px;"> Precio6</td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="input-field col s6">
                                      <input id="Desde6" name="Desde6" type="number" class="validate" value="<?php echo $row['Desde6'] ?>">
                                      <label for="Desde6">Desde</label>
                                    </div>
                                  </td>
                                  <td style="padding-bottom: 0px;padding-top: 0px;">
                                    <div class="col s6">
                                      <label for="Hasta6">En Adelante</label>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                           </table>
                          <a class="waves-effect waves-light btn green" onclick="$('#Nivel<?php echo $row['Codigo'] ?>').submit()">
                            <i class="material-icons left">save</i>Guardar
                          </a>
                          </form>
                          </div>
                        </li>

                          <?php
                        }
                      ?>
                        
                       
                      </ul>
                      <div id="Load" class=" container center-align ">
                        <div class="preloader-wrapper small  active ">
                          <div class="spinner-layer spinner-blue">
                            <div class="circle-clipper left">
                              <div class="circle"></div>
                            </div><div class="gap-patch">
                              <div class="circle"></div>
                            </div><div class="circle-clipper right">
                              <div class="circle"></div>
                            </div>
                          </div>

                          <div class="spinner-layer spinner-red">
                            <div class="circle-clipper left">
                              <div class="circle"></div>
                            </div><div class="gap-patch">
                              <div class="circle"></div>
                            </div><div class="circle-clipper right">
                              <div class="circle"></div>
                            </div>
                          </div>

                          <div class="spinner-layer spinner-yellow">
                            <div class="circle-clipper left">
                              <div class="circle"></div>
                            </div><div class="gap-patch">
                              <div class="circle"></div>
                            </div><div class="circle-clipper right">
                              <div class="circle"></div>
                            </div>
                          </div>

                          <div class="spinner-layer spinner-green">
                            <div class="circle-clipper left">
                              <div class="circle"></div>
                            </div><div class="gap-patch">
                              <div class="circle"></div>
                            </div><div class="circle-clipper right">
                              <div class="circle"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="outer_div"></div>
                    </div>
                </div>
            </div>
        
      <br><br>
      
    </div>
  </div>
<br>
<br>
<br>
<br>
 
  
 
  <footer class="page-footer blue darken-4">
    
    <div class="footer-copyright">
      <div class="container">
      Realizado Por <a class="orange-text text-lighten-1" href="https://sai-open.com/" target="_blank">Grupo Sai S.A.S</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/autocomplete.js"></script>
  <script>
    $(document).ready(function(){
    
      $('.collapsible').collapsible();
      $('.modal').modal();
      $('#Load').hide();
    });
    $(".FNiveles").submit(function( event ) { 
      var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "Componentes/Ajax/Editar_Nivel.php",
				data: parametros,
				beforeSend: function(objeto){
				},
				success: function(datos){										
          alert(datos);
				}
			});			
  			event.preventDefault();
		})

    function NuevoNivel(){
      $.ajax({
				type: "POST",
				url: "Componentes/Ajax/Nuevo_Nivel.php",
				beforeSend: function(objeto){
				},
				success: function(datos){										
          location.reload();
				}
			});			
    }
    
    
    </script>
  </body>
</html>
