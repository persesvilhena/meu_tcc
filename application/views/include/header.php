<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FAQSCIF</title>

    <!-- Bootstrap core CSS-->
    <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">

      <script>
        function createRequest() {
            try {
                request = new XMLHttpRequest();
            } catch (tryMS) {
                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (otherMS) {
                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (failed) {
                        request = null;
                    }
                }
            }
            return request;
        }
        function ajax(elemento_id, func, par, pag) {
            elemento = document.getElementById(elemento_id);
            elemento.innerHTML = "<center><img src=\"<?= base_url(); ?>assets/imgs/loader.gif\" width=\"50\"></center>";
            request = createRequest();
            //alert(elemento_id + func + par);
            if (request == null) {
                alert("Unable to create request");
                return;
            }
            //alert("teste");
            var url= "<?= base_url(); ?>" + escape(func) + "/" + escape(par) + "/";
            request.open("GET", url, true);
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) {
                      if(request.responseText == "ok"){
                        if (typeof(pag) == "undefined"){
                          elemento.innerHTML = "<center>Operação realizada com sucesso! <img src=\"<?= base_url(); ?>assets/imgs/ok.png\" width=\"50\"></center>";
                          eres = document.getElementById('next_step');
                          eres.style.display = "block"; 
                        }else{
                          window.location.href = pag;
                        }
                        
                      }else{
                        elemento.innerHTML = request.responseText;
                      }
                    }
                }
            };
            request.send(null);
        }
    </script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="<?= base_url(); ?>">FAQSCIF</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!--<div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>-->
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>perfil">Configurações</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      
      <ul class="sidebar navbar-nav">
        <?php if($this->conf->user()->adm == 1){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-cog"></i>
            <span>Administração</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>painel/index">Home</a>
            <a class="dropdown-item" href="<?= base_url(); ?>admin/users">Usuários</a>
            <a class="dropdown-item" href="<?= base_url(); ?>admin/alimentacao">Alimentação</a>
            <!--<a class="dropdown-item" href="<?= base_url(); ?>painel/limpeza">Limpeza</a>-->
            <a class="dropdown-item" href="<?= base_url(); ?>admin/config_geral">Configurações gerais</a>
          </div>
        </li>
      <?php } ?>
        <!--<li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/index">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span>
          </a>
        </li>-->
        <!--<li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/alimentacao">
            <i class="fas fa-fw fa-plus"></i>
            <span>Alimentação</span>
          </a>
        </li>-->

        <!--<li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/limpeza">
            <i class="fas fa-fw fa-database"></i>
            <span>Limpeza</span>
          </a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/analise">
            <i class="fas fa-fw fa-spinner"></i>
            <span>Análise</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/regras">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Visualizar regras</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>painel/config">
            <i class="fas fa-fw fa-cog"></i>
            <span>Configurações</span></a>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-cog"></i>
            <span>Configurações</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>painel/config_geral">Configurações gerais</a>
            <a class="dropdown-item" href="<?= base_url(); ?>painel/config">Configurações apriori</a>
          </div>
        </li>-->
        
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">