<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../../index.php");
}

require("../../assets/php/connect.php");
header('Content-Type: text/html; charset=ascII');
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta charset="ascII">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="../../assets/images/favicon.png">

        <!-- App title -->
        <title>Grade de Rateio de Despesas</title>
        
        <!-- Editatable  Css-->
        <link rel="stylesheet" href="../../assets/plugins/magnific-popup/dist/magnific-popup.css" />
        <link rel="stylesheet" href="../../assets/plugins/jquery-datatables-editable/datatables.css" />

		<!-- App CSS -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <script src="../../assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu" style="padding-bottom: 0px;top: 0px;">
                <div class="sidebar-inner slimscrollleft">
                    <!-- Usuário -->
                    <div class="user-box">
                        <!--TODO aqui vai o nome do usuário, carregar do servidor-->
                        <h5>
                            <a href="#">
                                <?php
                                    date_default_timezone_set("America/Sao_Paulo");
                                    //echo date("H:i:s");
                                    if(date("H") > 06 and date("H") < 12){
                                        echo "Bom dia, " . $_SESSION['nome'];
                                    }
                                    else if(date("H") > 12 and date("H") < 18){
                                        echo "Boa tarde, " . $_SESSION['nome'];
                                    }
                                    else{
                                        echo "Boa noite, " . $_SESSION['nome'];
                                    }
                                ?>
                            </a>
                        </h5>
                        <ul class="list-inline">
                            <li>
                                <!--TODO deve enviar para página de configurações e parâmetros-->
                                <a href="#" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>
                            <li>
                                <!--TODO linkar arquivo de logout-->
                                <a href="../../assets/php/logout.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Fim Usuário -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li>
                                <a href="../../dashboard.php" class="waves-effect"><i class="zmdi dripicons-meter"></i> <span> Painel </span> </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-archive"></i> <span> Cadastros </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="cadastro_samu.php">SAMU 192</a></li>
                                    <li><a href="cadastro_conveniados.php">Conveniados</a></li>
                                    <li><a href="cadastro_colaboradores.php">Colaboradores</a></li>
                                    <li><a href="cadastro_cargos.php">Cargos</a></li>
                                    <li><a href="cadastro_fornecedores.php">Fornecedores</a></li>
                                    <li><a href="cadastro_itens.php">Itens</a></li>
                                    <li><a href="cadastro_classes.php">Classes</a></li>
                                    <li><a href="cadastro_areas.php">&Aacute;reas</a></li>
                                    <li><a href="cadastro_rateio.php">Rateio</a></li>
                                    <li>
                                        <a>Listas<span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">
                                            <li><a href="#">Conv&ecirc;nios</a></li>
                                            <li><a href="#">Colaboradores</a></li>
                                            <li><a href="#">Fornecedores</a></li>
                                            <li><a href="#">Itens</a></li>
                                            <li><a href="#">Rateio</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="cadastro_fontes.php">Fontes</a></li>
                                    <li><a href="cadastro_contas.php">Contas</a></li>
                                    <li><a href="cadastro_custo.php">Custos</a>
                                    <li><a href="cadastro_documentos.php">Documentos</a>
                                    <li><a href="#">Checklist</a>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-pill"></i> <span> Almoxarifado </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="#">Entrada</a></li>
                                    <li><a href="#">Sa&iacute;da</a></li>
                                    <li><a href="#">Devolu&ccedil;&atilde;o</a></li>
                                    <li>
                                        <a>Descarte<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Almoxarifado</a></li>
                                            <li><a href="#">&Aacute;rea</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Rastrear Requisi&ccedil;&atilde;o</a></li>
                                    <li>
                                        <a>Listas<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Almoxarifado</a></li>
                                            <li><a href="#">Sa&iacute;da</a></li>
                                            <li><a href="#">Devolu&ccedil;&atilde;o</a></li>
                                            <li><a href="#">Descarte</a></li>
                                            <li><a href="#">Validade</a></li>
                                            <li><a href="#">Vencidos</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-wallet"></i> <span> Financeiro </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li>
                                        <a>Repasses<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Previs&atilde;o</a></li>
                                            <li><a href="#">Realizado</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Despesas</a></li>
                                    <li><a href="#">Sal&aacute;rios</a></li>
                                    <li>
                                        <a>Relat&oacute;rios<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Repasses</a></li>
                                            <li><a href="#">Despesas</a></li>
                                            <li><a href="#">Sal&aacute;rios</a></li>
                                            <li><a href="#">Almoxarifado</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a>Contas<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Repasses</a></li>
                                            <li><a href="#">Despesas</a></li>
                                            <li><a href="#">Sal&aacute;rios</a></li>
                                            <li><a href="#">Almoxarifado</a></li>
                                            <li><a href="#">Demonstrativo</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-gear"></i> <span> Sistema </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="../sistema/sistema_usuarios.php" class="waves-effect">Usu&aacute;rios</a></li>
                                    <li>
                                        <a>Configura&ccedil;&atilde;o<span class="menu-arrow"></span></a>
                                        <ul class="#">
                                            <li><a href="#">Propriedades</a></li>
                                            <li><a href="#">Par&acirc;metros</a></li>
                                            <li><a href="#">Contas</a></li>
                                            <li><a href="cadastro_documentos.php">Documentos</a></li>
                                            <li><a href="#">Colaboradores</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="../sistema/sistema_atividade.php">Relat&oacute;rio de Atividades</a></li>
                                    <li><a href="#">Direitos</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Fim da Sidebar -->
                    <div class="clearfix"></div>
                </div>
            </div>




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Começo Table -->
                        <div class="row" style="margin-top: -85px;">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <h4 class="header-title m-t-0 m-b-30">Grade de Rateio de Despesas</h4>
                                        <div class="editable-responsive">
                                            <table class="table table-striped" id="datatable-editable">
                                                <thead>
                                                    <tr>
                                                        <th>Conta</th>
                                                        <?php
                                                        $get = "SELECT cc FROM c_custo";
                                                        $get = mysqli_query($connection, $get) or die(mysqli_error($connection));

                                                        while ($custo = mysqli_fetch_row($get)) {
                                                            echo "<th>$custo[0]</th>";
                                                        }
                                                        ?>
                                                        <th>A&ccedil;&otilde;es</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $get_users = "SELECT * FROM c_rateio";
                                                    $users_result = mysqli_query($connection, $get_users) or die(mysqli_error($connection));
                                                    
                                                    while($table = mysqli_fetch_row($users_result)){
                                                        echo "
                                                        <tr class='gradeX'>
                                                            <td>$table[0]</td>";

                                                        $boxes = explode(";", $table[1]);

                                                        for ($i = 0; $i < count($boxes); $i++) {
                                                            if ($boxes[$i] == '0') {
                                                                echo "
                                                                <td>
                                                                    <div>
                                                                        <input type='checkbox' disabled>
                                                                    </div>
                                                                </td>";
                                                            }
                                                            else {
                                                                echo "
                                                                <td>
                                                                    <div>
                                                                        <input type='checkbox' checked disabled>
                                                                    </div>
                                                                </td>";
                                                            }
                                                        }

                                                        echo "
                                                            <td class='actions'>
                                                                <a href='#' onclick='cadastrarRateio()' class='hidden on-editing save-row'><i class='fa fa-save'></i></a>
                                                                <a href='#' class='hidden on-editing cancel-row'><i class='fa fa-times'></i></a>
                                                                <a href='#' class='on-default edit-row'><i class='fa fa-pencil'></i></a>
                                                            </td>
                                                        </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="dialog" class="modal-block mfp-hide">
            <section class="panel panel-info panel-color">
                <header class="panel-heading">
                    <h2 class="panel-title">Voc&ecirc; tem certeza?</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                            <p>Voc&ecirc; quer mesmo deletar esta linha?</p>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-md-12 text-right">
                            <button id="dialogConfirm" onclick="removerRateio()" class="btn btn-primary waves-effect waves-light">Confirmar</button>
                            <button id="dialogCancel" class="btn btn-default waves-effect">Cancelar</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            var resizefunc = [];
        </script>

        <script>
            function cadastrarRateio(){
                //pega os textos
                var conta = document.getElementById("0").innerText;
                var columns = document.getElementById('datatable-editable').rows[0].cells.length - 2;
                var rateio = '';
                for (var i = 1; i < columns + 1; i++) {
                    var checkbox = document.getElementById(i.toString());
                    if (checkbox.checked == true) {
                        if (i != columns) {
                            rateio += '1;';
                        }
                        else {
                            rateio += '1';  
                        }
                    }
                    else {
                        if (i != columns) {
                            rateio += '0;';
                        }
                        else {
                            rateio += '0';  
                        }
                    }
                }
                //manda informação
                var http = new XMLHttpRequest();
                var url = "../../assets/php/cadastro/cadastrar_rateio.php";
                var params = "conta=" + conta + "&rateio=" + rateio + "";
                http.open("POST", url, true);

                //Send the proper header information along with the request
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                http.send(params);

                location.reload();
            }
        </script>
        
        <!-- jQuery  -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/detect.js"></script>
        <script src="../../assets/js/fastclick.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>
        <script src="../../assets/js/jquery.blockUI.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/jquery.nicescroll.js"></script>
        <script src="../../assets/js/jquery.scrollTo.min.js"></script>
        
        <!-- Editable js -->
	    <script src="../../assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
	    <script src="../../assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
	    <script src="../../assets/plugins/datatables/dataTables.bootstrap.js"></script>
	    <script src="../../assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
	    <script src="../../assets/plugins/tiny-editable/numeric-input-example.js"></script>
		<!-- init -->
	    <script src="../../assets/pages/datatables.editable_rateio.init.js"></script>
        <!-- input mask -->
        <script src="../../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        
        <!-- App js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>
        
        <script>
			$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
		</script>

    </body>
</html>