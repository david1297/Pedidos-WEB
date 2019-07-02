<?php  session_start();
if ($_SESSION['user_login_status'] <> 1) {
  header("location: Login.php");
} 
require_once ("config/db.php");
require_once ("config/conexion.php");

if(isset($_GET['T'])){
    $Id_N =$_GET['T'];
    $sql="SELECT count(*) FROM temp_pedidoe where Id_N ='$Id_N' ";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    if ($row[0]==0){
      $sql="SELECT Terms FROM Terceros where Id_N ='$Id_N' ";
      $query = mysqli_query($con, $sql);
      $row=mysqli_fetch_array($query);

      $sql =  "INSERT INTO temp_pedidoe
       (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Terms) VALUES
      
       ('".$_SESSION['TIPO_PE']."',0,'$Id_N',0,0,0,0,".$row[0].");";
        $query_update = mysqli_query($con,$sql);
        $Pedido='Nuevo Pedido';
    }else{
      $sql="SELECT * FROM temp_pedidoe where Id_N =$Id_N ";
      $query = mysqli_query($con, $sql);
      $row=mysqli_fetch_array($query);
      $Tipo =$row['Tipo'];
      $Numero =$row['Numero'];
      $succliente =$row['succliente'];
      $Subtotal =$row['Subtotal'];
      $Iva =$row['Iva'];
      $Descuento =$row['Descuento'];
      $Tipo =$row['Tipo'];
      $Numero =$row['Numero'];

      $sql="SELECT Estado FROM pedidoe where Tipo ='$Tipo' and Numero = $Numero ";
      $query = mysqli_query($con, $sql);
      $row=mysqli_fetch_array($query);
      $Estado =$row['Estado'];
      if ($Estado=='Pendiente'){
        $Estado='';
        $Botones ='';
      }else{
        $Estado=' ('.$Estado.')';
        $Botones='disabled';
      }

      if ($Numero <> 0){
        $Pedido='Pedido N°. '.$Tipo.'-'.$Numero.$Estado;
      }else{
        $Pedido='Nuevo Pedido'; 
      }
      
    }
    $sql="SELECT Company,Id_n,Phone1,Addr1,succliente,Nivel FROM terceros where Id_n =$Id_N ";
    $query = mysqli_query($con, $sql);
    $h=0;
    while($row=mysqli_fetch_array($query)){
        $Tercero[$h]["Nombre"]= $row['Company'];
        $Tercero[$h]["Phone1"]= $row['Phone1'];
        $Tercero[$h]["Addr1"]= $row['Addr1'];
        $Tercero[$h]["succliente"]= $row['succliente'];
        $Tercero[$h]["Nivel"]= $row['Nivel'];
        $h=$h+1;
    }

}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("Head.html");?>
  
</head>
<body onload="CargarProductos()">
<?php include("Menu.php");?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <form class="col s12">  
        <div class="row z-depth-2" style="margin-bottom: 0px;">
          <div class="col s12">   
                         
            <h5 class="blue-text"><?php echo $Pedido;?></h5> 
              
            
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <form class="col s12">  
        <div class="row z-depth-2" >
          <div class="col s12">   
            <div class="input-field col s12">
            
              <i class="material-icons prefix">person</i>
              <input type="text" id="BuscarTercero" readonly="True"  value="<?php echo $Tercero[0]['Nombre'];?>">
              <input type="text" id="Id_N" name="Id_N"  class="hide" value="<?php echo $Id_N;?>">
              <input type="text" id="Nivel" name="Nivel"  class="hide" value="<?php echo $Tercero[0]['Nivel'];?>">
              <label for="BuscarTercero">Tercero</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">location_on</i>
              <select id="Addr1"  name="Addr1">
                <?php
                  for ($i = 0; $i < $h; $i++) {
                    if ($succliente == $Tercero[$i]['succliente']){
                      echo '<option value="'.$Tercero[$i]['succliente'].'" selected >'.$Tercero[$i]['Addr1'].'</option>';
                    }else{
                      echo '<option value="'.$Tercero[$i]['succliente'].'">'.$Tercero[$i]['Addr1'].'</option>';
                    }
                    
                  }
                ?>
              </select>
              <label for="Addr1">NBumero Telefonico</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">phone_iphone</i>
              <select id="Phone1"  name="Phone1">
                <?php
                  for ($i = 0; $i < $h; $i++) {
                    if ($succliente == $Tercero[$i]['succliente']){
                      echo '<option value="'.$Tercero[$i]['succliente'].'" selected>'.$Tercero[$i]['Phone1'].'</option>';
                    }else{
                      echo '<option value="'.$Tercero[$i]['succliente'].'">'.$Tercero[$i]['Phone1'].'</option>';
                    }
                    
                  }
                ?>
              </select>
              <label  for="Phone1">Direccion de Envio</label>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="Load" class=" container center-align ">
    <div class="preloader-wrapper big active ">
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
  
  <div class="container" id="Detalle"> 
  </div>
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large blue pulse">
      <i class="large material-icons">menu</i>
    </a>
    <ul>
      <li><a class="btn-floating red darken-4" onclick="CancelarPedido();"><i class="material-icons">cancel</i></a></li>
      <li><a class="btn-floating green darken-1 <?php echo $Botones;?>" onclick="GuardarPedido();"><i class="material-icons">send</i></a></li>
      <li><a class="btn-floating  blue-grey darken-4 <?php echo $Botones;?>" onclick="TraerNota();"><i class="material-icons">note_add</i></a></li>
      <li><a class="btn-floating red waves-effect waves-light btn <?php echo $Botones;?>"onclick=" $('#BuscarItem').modal('open');$('#Load1').hide();$('#BuscarItems').val('');$('.outer_div').html('<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');$('#BuscarItems').focus();"><i class="material-icons">add</i></a></li>
    </ul>
  </div>
  <div id="BuscarItem" class="modal"> 
    <div class="modal-content">
      <div class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">search</i>
            <input type="text" id="BuscarItems" class="autocomplete" autocomplete="off">
            <label for="BuscarItems">Item</label>
          </div>
          <div id="Load1" class=" container center-align ">
            <div class="preloader-wrapper small active ">
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
    <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancelar</a>
      <a href="#!" class=" waves-effect waves-green btn-flat" onclick="$('#AgregarItem').submit()" >Agregar</a>
    </div>
  </div>
  <div id="EditarItem" class="modal"> 
    <div id="CargarEdit"></div>
    <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancelar</a>
      <a href="#!" class=" waves-effect waves-green btn-flat" onclick="$('#FEditarItem').submit()" >Agregar</a>
    </div>
  </div>
  <div id="Nota" class="modal"> 
    <div id="CargarNota"></div>
    <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancelar</a>
    <a href="#!" class=" waves-effect waves-green btn-flat" onclick="$('#FNota').submit()" >Agregar</a>
    </div>
  </div>
  <footer class="page-footer blue darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12" Id="Total">
          <span class="white-text text-darken-4">Total:&nbsp;</span><span class="white-text text-darken-4">$ 0</span><br>
        </div>      
      </div>
    </div>
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
      $('select').formSelect();
      $('.modal').modal();
      $('.fixed-action-btn').floatingActionButton();
      $('input.autocomplete').autocomplete({
        data: {
          <?PHP
          $sql="SELECT ITEM,DESCRIPCION FROM items ";
         
          $sql.=" group by DESCRIPCION ;";
          
          $query = mysqli_query($con, $sql);
          $h=0;
          while($row=mysqli_fetch_array($query)){
            if($h==0){
              echo '"'.$row['DESCRIPCION'].'":null';
              $h=1;
            }
            echo ',
            "'.$row['DESCRIPCION'].'":null';
          }
          ?>
        
        },onAutocomplete: function (){load(1)},
    
      });

    });
    function load(page){
      var Item = $("#BuscarItems").val();
      var Nivel = $("#Nivel").val();
      var Id_N = $("#Id_N").val();
      var ajax;
      $("#loader").fadeIn('slow');
      ajax = null;
      ajax= $.ajax({
      url:'Componentes/Ajax/Buscar_Items.php?action=ajax&page='+page+'&Item='+Item+'&Nivel='+Nivel+'&Id_N='+Id_N,
        beforeSend: function(objeto){
          $('#Load1').show();
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $("#Cantidad").focus();
          $('#Load1').hide();  
        }
      })
    }
    function CargarProductos(){
      var Id_N = $("#Id_N").val();
      var ajax;
    
      ajax = null;
      ajax= $.ajax({
      url:'Componentes/Ajax/CargarProductos.php?Id_N='+Id_N,
        beforeSend: function(objeto){
          $('#Load').show();
        },
        success:function(data){
          $("#Detalle").html(data);
          $('#Load').hide(); 
          CargarTotales();
        }
      })
    }
    function EdiarItem(Id){
      var ajax;
      $("#CargarEdit").html('');
      $('#EditarItem').modal('open');
      
      ajax = null;
      ajax= $.ajax({
      url:'Componentes/Ajax/CargarProductoEditar.php?Id='+Id,
        beforeSend: function(objeto){
    
        },
        success:function(data){
          $("#CargarEdit").html(data);
          $('#Cantidad').focus();
        }
      })
    }
    function EliminarItem(Id){
      var r = confirm("Desea Eliminar El Item");
      if (r == true) {
        var ajax;
        ajax = null;
        ajax= $.ajax({
        url:'Componentes/Ajax/EliminarItem.php?Id='+Id,
          beforeSend: function(objeto){
      
          },
          success:function(data){
            $('#EditarItem').modal('close');		   
            CargarProductos();
            
          }
          })
        } 
      
    }
    function UbiComentario(Id){
      var posicion = $("#Comentario").offset().top;
      $("#"+Id).animate({
          scrollTop: posicion
      }, 1000); 
    }
    function CargarTotales(){
      var Id_N = $("#Id_N").val();
      var ajax;
      ajax = null;
      ajax= $.ajax({
      url:'Componentes/Ajax/CargarTotales.php?Id_N='+Id_N,
        beforeSend: function(objeto){
    
        },
        success:function(data){
          $("#Total").html(data);
          
        }
      })
    }
    function TraerNota(){
      $('#Nota').modal('open');
      var Id_N = $("#Id_N").val(); ajax = null;
      ajax= $.ajax({
      url:'Componentes/Ajax/CargarNota.php?Id_N='+Id_N,
        beforeSend: function(objeto){
    
        },
        success:function(data){
          $("#CargarNota").html(data);
          
        }
      })
    }
    function GuardarPedido(){
      var Id_N = $("#Id_N").val();
      var ajax;
        ajax = null;
        ajax= $.ajax({
        url:'Componentes/Ajax/GuardarPedido.php?Id_N='+Id_N,
          beforeSend: function(objeto){
      
          },
          success:function(data){
            //alert(data);
            var r = confirm("Deseas Realizar Un Nuevo Pedido");
            if (r == true) {
              location.href="Consulta_Terceros.php";
            }else{
              location.href="index.php";
            } 
          }
        })
    }
    function CancelarPedido(){
      var r = confirm("Desea Descartar El Pedido");
      if (r == true) {
        var Id_N = $("#Id_N").val();
        var ajax;
        ajax = null;
        ajax= $.ajax({
        url:'Componentes/Ajax/EliminarPedido.php?Id_N='+Id_N,
          beforeSend: function(objeto){
      
          },
          success:function(data){
           location.href="Consulta_Terceros.php";
            
          }
          })
      }
    }
    </script>
  </body>
</html>
