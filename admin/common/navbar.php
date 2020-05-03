<header class="topbar" data-navbarbg="skin6">
<nav class="navbar top-navbar navbar-expand-md navbar-light">
    <div class="navbar-header" data-logobg="skin5">
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
            <i class="ti-menu ti-close"></i>
        </a>
        <div class="navbar-brand">
            <a href="<?php echo $root_folder;?>/admin/principal.php" class="logo">
                <?php if(isset($nombrePagina) && !empty($nombrePagina)) echo $nombrePagina; else echo 'Sin Nombre'?>
            </a>
        </div>
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti-more"></i>
        </a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
      <?php if(isset($ventas)){ ?>
        <ul class="navbar-nav float-left mr-auto">
          <li class="nav-item search-box">
              <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                  <div class="d-flex align-items-center">
                      <i class="mdi mdi-magnify font-20 mr-1"></i>
                      <div class="ml-1 d-none d-sm-block">
                        <?php if(isset($pagos) && $pagos==1){ ?>
                          <span>Buscar</span>
                        <?php }elseif(isset($ventas) && $ventas==1){ ?>
                          <span>Buscar  por CI & RIF</span>
                        <?php }; ?>
                      </div>
                  </div>
              </a>
              <?php if(isset($pagos) && $pagos==1){ ?>
                <form class="app-search position-absolute" method="GET" action="../pagos/">
              <?php }elseif(isset($ventas) && $ventas==1){ ?>
                <form class="app-search position-absolute" method="GET" action="../pagos/">
              <?php }; ?>
                  <input type="text" class="form-control" placeholder="Buscar &amp; enter" name="search">
                  <a class="srh-btn"><i class="ti-close"></i></a>
              </form>
          </li>
        </ul>
      <?php }else{ ?>
        <ul class="navbar-nav float-left mr-auto">
          <li class="nav-item search-box">
          </li>
        </ul>
      <?php } ?>
      <ul class="navbar-nav float-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>" alt="user" class="rounded-circle" width="31"></a>
          <div class="dropdown-menu dropdown-menu-right user-dd animated">
            <a class="dropdown-item" href="/admin/perfil.php"><i class="ti-user m-r-5 m-l-5"></i>Mi Perfil</a>
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#closeSesion"><i class="ti-export m-r-5 m-l-5"></i>Cerrar sesión</a>
          </div>
        </li>
      </ul>
    </div>
</nav>
</header>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
              <?php if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){ ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-btn-sidebar">
                      <i class="mdi mdi-account-network"></i>
                      <span class="hide-menu">Configuración General </span>
                    </a>
                    <div class="dropdown-container-sidemenu" style="display:none;" id="dropdown1">
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/pagina.php"><span class="hide-menu">Página Web </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/categoria.php"><span class="hide-menu">Categorias </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/marcas.php"><span class="hide-menu">Marcas </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/colores.php"><span class="hide-menu">Colores </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/tallas.php"><span class="hide-menu">Tallas </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/generales/usuarios.php"><span class="hide-menu">Usuarios </span></a>
                    </div>
                  </li>
              <?php } if($_SESSION['nivel']==7 || $_SESSION['nivel']==1){ ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-btn-sidebar">
                      <i class="mdi mdi-arrange-bring-forward"></i>
                      <span class="hide-menu">Inventario </span>
                    </a>
                    <div class="dropdown-container-sidemenu" style="display:none;" id="dropdown1">
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/inventario/index.php"><span class="hide-menu">Crear Productos </span></a>
                      <a class="d-block sidebar-link waves-effect waves-dark sidebar-link ml-5" href="<?php echo $root_folder;?>/admin/inventario/ver_productos.php"><span class="hide-menu">Ver Productos  </span></a>
                    </div>
                  </li>
              <?php } if($_SESSION['nivel']==3 || $_SESSION['nivel']==1){ ?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $root_folder;?>/admin/ventas/" aria-expanded="false">
                    <i class="mdi mdi-cart"></i>
                    <span class="hide-menu">Ventas</span>
                  </a>
               </li>
              <?php } if($_SESSION['nivel']==3 || $_SESSION['nivel']==1){ ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $root_folder;?>/admin/pagos/" aria-expanded="false">
                      <i class="mdi mdi-ticket"></i>
                      <span class="hide-menu">Pagos</span>
                    </a>
                  </li>
              <?php } if ($_SESSION['nivel']==4 || $_SESSION['nivel']==1) { ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $root_folder;?>/admin/despacho/" aria-expanded="false">
                      <i class="mdi mdi-truck"></i>
                      <span class="hide-menu">Despacho</span>
                    </a>
                  </li>
              <?php } if ($_SESSION['nivel']==1) {?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $root_folder;?>/admin/fallas/" aria-expanded="false">
                    <i class="mdi mdi-alert-box"></i>
                    <span class="hide-menu">Fallas</span>
                  </a>
                </li>
              <?php } ?>
            </ul>
        </nav>
    </div>
</aside>
<div class="modal fade" id="closeSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closeSesionLabel">Cerrar sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea cerrar sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="<?php echo $root_folder;?>/admin/common/salir_sesion.php" class="btn btn-primary">Salir</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var dropdown = document.getElementsByClassName("dropdown-btn-sidebar");
  var i;
  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function(){
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>
