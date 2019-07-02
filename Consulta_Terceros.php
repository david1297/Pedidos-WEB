<?php  session_start();
if ($_SESSION['user_login_status'] <> 1) {
  header("location: Login.php");
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
        <form class="col s12">  
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="BuscarTercero" class="autocomplete"autocomplete="off" >

                            <label for="BuscarTercero">Tercero</label>
                            <input class="hidden"type="text" name="ModificaV" id="ModificaV" value="<?php echo $ModificaV;?>">
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
                        <div class="outer_div"></div>
                    </div>
                </div>
            </div>
        </form>
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
    /*  $("#BuscarTercero").blur(function(){
        $("#BuscarTercero").change(function(){
          load(1);
        })
      })*/

      $('#Load').hide();
      $('input.autocomplete').autocomplete({
        data: {
          <?PHP
          $sql="SELECT id_n,Company,COMPANY_EXTENDIDO FROM terceros ";
          if ($_SESSION['MODIFICAVEND']=='N'){
            $sql.="where id_vend=".$_SESSION['IDVEND']."";
          }
          $sql.=" group by id_n,Company ;";
          
          $query = mysqli_query($con, $sql);
          $h=0;
          while($row=mysqli_fetch_array($query)){
            if($h==0){
              echo '"'.$row['id_n'].' - '.$row['Company'].'('.$row['COMPANY_EXTENDIDO'].')":null';
              $h=1;
            }
            echo ',
            "'.$row['id_n'].' - '.$row['Company'].'('.$row['COMPANY_EXTENDIDO'].')":null';
          }
          ?>
        
        },onAutocomplete: function (){load(1)},
    
      });
    });
    function load(page){
      var Tercero = $("#BuscarTercero").val();
      var ModificaV = $("#ModificaV").val();
      var ajax;
      var palabras = Tercero.split(" ");
			Tercero= palabras[0];
    
        $("#loader").fadeIn('slow');
      ajax = null;
      
      ajax= $.ajax({
        url:'Componentes/Ajax/Buscar_Terceros.php?action=ajax&page='+page+'&Tercero='+Tercero+'&ModificaV='+ModificaV,
        beforeSend: function(objeto){
          $('#Load').show();
        },
        success:function(data){
      
          $(".outer_div").html(data).fadeIn('slow');
          $('#Load').hide();  
                              
        }
      })
        
   
     
      
    }
    function EditarPedido(Tipo,Numero,Id_N){
      var ajax;
        ajax = null;
        ajax= $.ajax({
        url:'Componentes/Ajax/CargarPedido.php?Id_N='+Id_N+'&Tipo='+Tipo+'&Numero='+Numero,
          beforeSend: function(objeto){
      
          },
          success:function(data){
            location.href='pedido.php?T='+Id_N;
            
          }
          })
    }
    function NuevoPedido(Id_N){
        var ajax;
        ajax = null;
        ajax= $.ajax({
        url:'Componentes/Ajax/EliminarPedido.php?Id_N='+Id_N,
          beforeSend: function(objeto){
          },
          success:function(data){
           location.href='pedido.php?T='+Id_N;
          }
          })
      
    }
    </script>
  </body>
</html>
