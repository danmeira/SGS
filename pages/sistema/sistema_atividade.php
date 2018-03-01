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

    <link rel="shortcut icon" href="../../assets/images/favicon.png">

    <title>Lista de Atividade do Sistema</title>

    <!--Morris Chart CSS -->
	<link rel="stylesheet" href="../../assets/plugins/morris/morris.css">

    <!-- DataTables -->
    <link href="../../assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="../../assets/js/modernizr.min.js"></script>
</head>
<body class="fixed-left">
    <!-- Come&ccedil;o da P&aacute;gina -->
    <div id="wrapper">
        <!-- ========== Come&ccedil;o da Sidebar ========== -->
        <div class="left side-menu" style="padding-bottom: 0px;top: 0px;">
            <div class="sidebar-inner slimscrollleft">
                <!-- Usu&aacute;rio -->
                <div class="user-box">
                    <!--TODO aqui vai o nome do usu&aacute;rio, carregar do servidor-->
                    <h5>
                        <a href="#">
                            <?php
                                date_default_timezone_set("America/Sao_Paulo");
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
                            <!--TODO deve enviar para p&aacute;gina de configura&ccedil;ões e parâmetros-->
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
                <!-- Fim Usu&aacute;rio -->

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul>
                    	<li>
                            <a href="../../dashboard.php" class="waves-effect"><i class="zmdi dripicons-meter"></i> <span> Painel </span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-archive"></i> <span> Cadastros </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="../cadastro/cadastro_samu.php">SAMU 192</a></li>
                                <li><a href="../cadastro/cadastro_conveniados.php">Conveniados</a></li>
                                <li><a href="../cadastro/cadastro_colaboradores.php">Colaboradores</a></li>
                                <li><a href="../cadastro/cadastro_cargos.php">Cargos</a></li>
                                <li><a href="../cadastro/cadastro_fornecedores.php">Fornecedores</a></li>
                                <li><a href="../cadastro/cadastro_itens.php">Itens</a></li>
                                <li><a href="../cadastro/cadastro_classes.php">Classes</a></li>
                                <li><a href="../cadastro/cadastro_areas.php">&Aacute;reas</a></li>
                                <li><a href="../cadastro/cadastro_rateio.php">Rateio</a></li>
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
                                <li><a href="../cadastro/cadastro_fontes.php">Fontes</a></li>
                                <li><a href="../cadastro/cadastro_contas.php">Contas</a></li>
                                <li><a href="../cadastro/cadastro_custo.php">Custos</a>
                                <li><a href="../cadastro/cadastro_documentos.php">Documentos</a>
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
                            <a href="javascript:void(0);" class="waves-effect active open subdrop"><i class="zmdi dripicons-gear"></i> <span> Sistema </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                            	<li><a href="sistema_usuarios.php">Usu&aacute;rios</a></li>
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
                                <li><a href="sistema_atividade.php" class="waves-effect active">Relat&oacute;rio de Atividades</a></li>
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

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- Começo Table -->
                    <div class="row" style="margin-top: -85px;">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <h4 class="header-title m-t-0 m-b-30">Lista de Atividade do Sistema</h4>

                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>Atividade</th>
                                            <th>Usu&aacute;rio</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $get_act = "SELECT * FROM s_atividade";
                                        $act_result = mysqli_query($connection, $get_act) or die(mysqli_error($connection));
                                        while($table = mysqli_fetch_row($act_result)){
                                            $date = explode("-", $table[1]);
                                            $date_r = $date[2] . "/" . $date[1] . "/" . $date[0];
                                            echo "
                                            <tr>
                                                <td>$table[0]</td>
                                                <td>$date_r</td>
                                                <td>$table[2]</td>
                                                <td>$table[3]</td>
                                                <td>$table[4]</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var resizefunc = [];
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

    <!-- Datatables-->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.buttons.js"></script>
    <script src="../../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="../../assets/plugins/datatables/jszip.min.js"></script>
    <script src="../../assets/plugins/datatables/pdfmake_atividades.js"></script>
    <script src="../../assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="../../assets/plugins/datatables/buttons.html5_atividade.js"></script>
    <script src="../../assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.scroller.min.js"></script>

    <!-- Datatable init js -->
    <script src="../../assets/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable( { keys: true } );
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable( { ajax: "../../assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
            var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
        } );
        TableManageButtons.init();

    </script>

</body>
</html>