<?php  session_start();
if ($_SESSION['user_login_status'] <> 1) {
  header("location: login.php");
} 
require_once ("config/db.php");
require_once ("config/conexion.php");
$Total =0;
$sql="SELECT * FROM PEDIDOE where Fecha =CURDATE() and PEDIDOE.USERNAME ='".$_SESSION['USERNAME']."'";
      $query = mysqli_query($con, $sql);
      while($row=mysqli_fetch_array($query)){
        $Total =$Total+ $row['Subtotal'] + $row['Iva']-$row['Descuento'];
      }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("Head.html");?>
  <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
</head>

<body>
<?php
			include("Menu.php");?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
    
      <br><br>
      <h3 class="header center blue-text"><?php echo $_SESSION['NOMBRE'];?></h3>
      <div class="row center">
        <h5 class="header col s12 light">Total de Pedidos Del Dia</h5>
        <h5 class="header col s12 light">$ <?php echo number_format($Total,2);?></h5>
      </div>
      
      <br><br>
      <div class="row " style="margin: 0 auto;margin-left: 0px;margin-right: 0px;width: 100%;">
        <div class="col m2 s1 center-align back-text"><b>N°</b></div>
        <div class="col m7 s7"><b>Cliente</b></div>
        <div class="col m3 s4 right-align"><b>Total</b></div>
      </div>
      <ul class="collapsible">
        <?php
        $sql="SELECT Tipo,Numero,(Subtotal+Iva-PEDIDOE.Descuento) as Total ,TERCEROS.company FROM PEDIDOE 
        inner join TERCEROS on  TERCEROS.Id_N = PEDIDOE.Id_N and TERCEROS.succliente = PEDIDOE.succliente
        where PEDIDOE.Fecha =CURDATE() and PEDIDOE.USERNAME ='".$_SESSION['USERNAME']."'
        GROUP BY Tipo,Numero,total ,TERCEROS.company ";
        $SumCant= 0;
        $SumTotal= 0;
        $query = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($query)){
          $Tercero =$row['company'];
          $Tipo =$row['Tipo'];
          $Numero =$row['Numero'];
          $Total =$row['Total'];
          ?>
          <li>
            <div class="collapsible-header" style="padding-right: 0px;padding-left: 0px;">
              <div class="row " style="margin: 0 auto;margin-left: 0px;margin-right: 0px;width: 100%;">
                <div class="col m2 s1 center-align"><?php echo  $Tipo.'-'.$Numero;?></div>
                <div class="col m7 s7"><?php echo  $Tercero;?> </div>
                <div class="col m3 s4 right-align">$<?php echo number_format($Total,2);?></div>
              </div>  
            </div>
            <div class="collapsible-body" >
              <table class="highlight">
                <tbody>
                  <?php
                  $sql1="SELECT ITEMS.Item,ITEMS.Descripcion,sum(cantidad) as Cantidad,sum(PEDIDOD.Subtotal+PEDIDOD.Iva-(PEDIDOD.Descuento*PEDIDOD.Subtotal/100))Total FROM PEDIDOE 
                  inner join PEDIDOD on  PEDIDOE.tipo = PEDIDOD.tipo and PEDIDOE.numero = PEDIDOD.Numero
                  inner join ITEMS on PEDIDOD.item= ITEMS.item
                  where PEDIDOE.Tipo ='$Tipo' and PEDIDOE.Numero=$Numero and PEDIDOD.Bonificado = 'N'
                  group by Item;";
                  $query1 = mysqli_query($con, $sql1);
                  while($row1=mysqli_fetch_array($query1)){
                    $Item=$row1['Item'];
                    $Descripcion=$row1['Descripcion'];
                    $Cantidad=$row1['Cantidad'];
                    $Total=$row1['Total'];
                    $SumCant= $SumCant+$Cantidad;
                    $SumTotal= $SumTotal+$Total;
                    ?>
                    <tr>
                      <td>
                        <span class="blue-text text-darken-4">
                          <?php echo $Descripcion;?>
                        </span>
                      </td>
                          
                      <td class="center-align">
                        <span class="blue-text text-darken-4">
                          <?php echo number_format($Cantidad,2);?>
                        </span>
                      </td>
                      <td class="right-align">
                        <span class="blue-text text-darken-4">
                          $<?php echo number_format($Total,2);?>
                        </span>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </li>
          <?php
        }
        ?>
      </ul>
      <table class="highlight">
        <tbody>
          <tr>
              <th>Total</th>
              <th class="center-align"><?php echo '';?></th>
              <th class="right-align">$<?php echo number_format($SumTotal,2);?></th>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
<br>
<br>
<br>
<br>
 
  <div class="container">
    <div class="section">
    <div class="row center">
        <a href="Consulta_Terceros.php" id="download-button" class="btn-large waves-effect waves-light orange">Pedidos</a>
      </div>
      <button  onclick="initMap()">Find Me</button>
    <div id="map"></div>
    
      <!--
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>
-->
    </div>
    <br><br>
  </div>
  
 
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

<script> $(document).ready(function(){
    $('.collapsible').collapsible();
    $('select').formSelect();
    $('.modal').modal();
      $('.fixed-action-btn').floatingActionButton();
  });</script>
  <script>
// Initialize and add the map
function initMap() {
  var latitude;
  var longitude;
  if (navigator.geolocation){ //check geolocation available 
    //try to get user current location using getCurrentPosition() method
    navigator.geolocation.getCurrentPosition(function(position){ 
      longitude =position.coords.longitude;
      latitude=position.coords.latitude;
      console.log("Ubicacion: "+latitude+" nLang :"+ longitude);
  var uluru = {lat: latitude, lng: longitude};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 20, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
        });
}else{
    alert('No se puede Acceder a localizacion');
}

}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG3D421KThrAsWqCyJkXqDJ5rLZQbr-2Q&callback=initMap">
    </script>
  </body>
</html>
