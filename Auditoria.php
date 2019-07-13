<?php  session_start();
if ($_SESSION['user_login_status'] <> 1) {
  header("location: login.php");
} 
if ($_SESSION['Auditoria']=='False') {
  header("location: index.php");
} 


require_once ("config/db.php");
require_once ("config/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("Head.html");?>
</head>
<body >
<?php
    include("Menu.php");?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">
        
          <div class="row">
            <div class="input-field col s4">
              <input id="Tipo" type="text" class="validate" onkeyup="javascript:this.value=this.value.toUpperCase();">
              <label for="Tipo">Tipo</label>
            </div>
            <div class="input-field col s4">
              <input id="Numero" type="number" class="validate">
              <label for="Numero">Numero</label>
            </div>
            <div class="input-field col s2">
            <button class="btn waves-effect waves-light"  onclick="load(1)">
              <span class="material-icons right">search</span>
            </button>
            </div>
          </div>
       
      </div>
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
      
      <br><br>
    </div>
    <div class="container-fluid"> 
    <div class="outer_div"></div>
      
     
        
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
    /*  $("#BuscarTercero").blur(function(){
        $("#BuscarTercero").change(function(){
          load(1);
        })
      })*/

      $('.modal').modal();
      $('#Load').hide();
      $('.tabs').tabs();
      $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });
      
    });
    function load(page){

      var Tipo = $("#Tipo").val();
      var Numero = $("#Numero").val();
      if (Tipo ==''){
        alert('Debe Definir el Tipo de Pedido a Consultar');
      }else{
        if (Numero==''){ 
          alert('Debe Definir el Numero de Pedido a Consultar');     
        }else{
          var ajax;
            $("#loader").fadeIn('slow');
          ajax = null;
          
          ajax= $.ajax({
            url:'Componentes/Ajax/Buscar_Auditoria.php?Tipo='+Tipo+'&Numero='+Numero,
            beforeSend: function(objeto){
              $('#Load').show();
            },
            success:function(data){
          
              $(".outer_div").html(data).fadeIn('slow');
              $('#Load').hide();  
                                  
            }
          })
        }
      }

     

    }
    
   
    </script>
  </body>
</html>
