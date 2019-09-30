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
            <a class="waves-effect waves-light btn green" onclick="CargarItems()">
              <i class="material-icons left">add</i>Cargar Itmes
            </a>         
            <a href="Niveles.php" id="download-button" class="btn waves-effect waves-light orange">Niveles de Items</a>

            <table class="striped">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Descripcion</th>
                  <th>Nivel</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql1="SELECT NIVEL_ITEM.Item,ITEMS.DESCRIPCION,NIVEL_ITEM.Nivel FROM NIVEL_ITEM inner join ITEMS on ITEMS.ITEM = NIVEL_ITEM.Item";
                  $query1 = mysqli_query($con, $sql1);
                  while($row=mysqli_fetch_array($query1)){
                    ?>
                    <tr>
                      <td style="padding-bottom: 0px;padding-top: 0px;"><?php echo $row['Item'] ?></td>
                      <td style="padding-bottom: 0px;padding-top: 0px;"><?php echo $row['DESCRIPCION'] ?></td>
                      <td style="padding-bottom: 0px;padding-top: 0px;">
                        <div class="input-field col s12">
                          <select onchange='CambioNivel("<?php echo $row["Item"] ?>")' id='S<?php echo $row['Item'] ?>'>
                          <?php
                          if($row['Nivel']==0){
                            echo '<option value="0" disabled selected>Seleccione un nivel</option>';
                          }
                          $sql="SELECT Codigo FROM NIVELES";
                          $Query = mysqli_query($con, $sql);
                          while($row1=mysqli_fetch_array($Query)){
                            
                              if($row1[0]==$row['Nivel']){
                                echo '<option value="'.$row1[0].'" selected>'.$row1[0].'</option>';
                              }else{
                                echo '<option value="'.$row1[0].'" >'.$row1[0].'</option>';
                              }
                            
                            
                          }
                          ?>  
                          
                  
                            
                          </select>
                        </div>
                      </td>
                      <td style="padding-bottom: 0px;padding-top: 0px;">
                      <div id='R<?php echo $row['Item'] ?>'></div>
                      </td>
                    </tr>
                   
                      

                    <?php
                  }
                ?>
              
            </tbody>
          </table>
                    
                        
                       
                      
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
      $('select').formSelect();
      $('.chips').chips();
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
          alert(datos)
				}
			});			
  			event.preventDefault();
		})

    function CargarItems(){
      $.ajax({
				type: "POST",
				url: "Componentes/Ajax/Cargar_ITemNivel.php",
				beforeSend: function(objeto){
				},
				success: function(datos){		
          alert('Items Cargados');								
          location.reload();
				}
			});			
    }
    function CambioNivel(Item){
      
      var Nivel = $('#S'+Item).val();
      $.ajax({
				type: "GET",
				url: "Componentes/Ajax/Actualizar_Nivel.php?Item="+Item+"&Nivel="+Nivel,
				beforeSend: function(objeto){
				},
				success: function(datos){		
          $('#R'+Item).html('<div class="chip green "><i class="material-icons">check</i></div>');
				}
			});	
    }
    
    
    </script>
  </body>
</html>
