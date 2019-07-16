<nav class="light-white lighten-1" role="navigation">
    <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo"><img class="responsive-img" style="width: 250px;" src="Img/saiopen1.png" /></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php" ><span class="material-icons" style="vertical-align: middle;">home</span> Inicio </a></li>
        <li><a class="   modal-trigger" href="#IngresoAuditoria"><span class="material-icons" style="vertical-align: middle;">assignment</span>Auditoria</a></li>
        <li><a href="Consulta_Terceros.php" ><span class="material-icons" style="vertical-align: middle;">library_add</span> Pedidos </a></li>
        <li><a href="login.php?logout" ><span class="material-icons" style="vertical-align: middle;">exit_to_app</span> Cerrar Sesion </a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
  
        <li><a href="index.php"><i class="material-icons">home</i> <span>Inicio</span></a></li>
        <li><a class=" modal-trigger" href="#IngresoAuditoria"><i class="material-icons">assignment</i> <span>Auditoria</span></a></li>
        <li><a href="Consulta_Terceros.php"><i class="material-icons">library_add</i> <span>Pedidos</span></a></li>
        <li><a href="login.php?logout"><i class="material-icons">exit_to_app</i> <span>Cerrar Sesion</span></a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div id="IngresoAuditoria" class="modal"> 
  <br>
  <div class="row">
  <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">person</i>
          <input id="Usuario" Name="Usuario"  type="text" class="validate">
          <label for="Usuario">Usuario</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input id="Clave" Name="Clave" type="password" class="validate" onkeypress="Pulsar(event)">
          <label for="Clave">Clave</label>
        </div>
      </div>
    </form>
    </div>

    <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancelar</a>
      <a href="#!" class=" waves-effect waves-green btn-flat" onclick="IngresoAuditoria()" >Agregar</a>
    </div>
  </div>
  <script>
  function Pulsar(e){
    if (e.keyCode === 13 && !e.shiftKey) {
      IngresoAuditoria();
    }
  }
  function IngresoAuditoria(){
    var Usuario = $("#Usuario").val();
    var Clave = $("#Clave").val();
    ajax = null;
      
      ajax= $.ajax({
        url:'Componentes/Ajax/ValidarIAuditoria.php?Usuario='+Usuario+'&Clave='+Clave,
        beforeSend: function(objeto){
          
        },
        success:function(data){
        if(data == 'False'){
          alert('El Usuario o Clave Esta Incorrecta');
        }else{
          location.href="Auditoria.php";
        }
                              
        }
      })
  }
  </script>