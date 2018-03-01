<?php
session_start();
header('Content-Type: text/html; charset=ascII');
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>SGS - Painel</title>

    <!--Morris Chart CSS -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="assets/js/modernizr.min.js"></script>
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
                                if(date("H") >= 06 and date("H") < 12){
                                    echo "Bom dia, " . $_SESSION['nome'];
                                }
                                else if(date("H") >= 12 and date("H") < 18){
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
                            <a href="assets/php/logout.php" class="text-custom">
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
                            <a href="dashboard.php" class="waves-effect"><i class="zmdi dripicons-meter"></i> <span> Painel </span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-archive"></i> <span> Cadastros </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="pages/cadastro/cadastro_samu.php">SAMU 192</a></li>';
                                    echo '<li><a href="pages/cadastro/cadastro_conveniados.php">Conveniados</a></li>';
                                }
                                ?>
                                <li><a href="pages/cadastro/cadastro_colaboradores.php">Colaboradores</a></li>
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="pages/cadastro/cadastro_cargos.php">Cargos</a></li>';
                                }
                                ?>
                                <li><a href="pages/cadastro/cadastro_fornecedores.php">Fornecedores</a></li>
                                <li><a href="pages/cadastro/cadastro_itens.php">Itens</a></li>
                                <li><a href="pages/cadastro/cadastro_classes.php">Classes</a></li>
                                <li><a href="pages/cadastro/cadastro_areas.php">&Aacute;reas</a></li>
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="pages/cadastro/cadastro_rateio.php">Rateio</a></li>';
                                    echo '
                                        <li>
                                            <a>Listas<span class="menu-arrow"></span></a>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Conv&ecirc;nios</a></li>
                                                <li><a href="#">Colaboradores</a></li>
                                                <li><a href="#">Fornecedores</a></li>
                                                <li><a href="#">Itens</a></li>
                                                <li><a href="#">Rateio</a></li>
                                            </ul>
                                        </li>';
                                    echo '<li><a href="pages/cadastro/cadastro_fontes.php">Fontes</a></li>';
                                    echo '<li><a href="pages/cadastro/cadastro_contas.php">Contas</a></li>';
                                    echo '<li><a href="pages/cadastro/cadastro_custo.php">Custos</a></li>';
                                    echo '<li><a href="pages/cadastro/cadastro_documentos.php">Documentos</a></li>';
                                    echo '<li><a href="#">Checklist</a></li>';
                                }
                                ?>
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
                        <?php 
                        if ($_SESSION['nivel'] != "Usuário") {
                            echo '
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi dripicons-gear"></i> <span> Sistema </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="pages/sistema/sistema_usuarios.php">Usu&aacute;rios</a></li>
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
                                        <li><a href="pages/sistema/sistema_atividade.php">Relat&oacute;rio de Atividades</a></li>
                                        <li><a href="#">Direitos</a></li>
                                    </ul>
                                </li>';  
                        }
                        ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <!-- Fim da Sidebar -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div id="Modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
                    <h4 class="modal-title" id="mySmallModalLabel"><strong>Sua senha foi resetada</strong></h4>
                    <p class="modal-title"> Defina uma nova senha abaixo: </p>
                </div>
                <div class="modal-body">
                    <div id="form-body" class="form-group">
                        <label for="field-1" class="control-label">Senha:</label>
                        <input class="form-control" id="field-1" type="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="definirSenha()" class="btn btn-info waves-effect waves-light">Salvar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        var resizefunc = [];
    </script>

    <script>
        function definirSenha(){
            //pega os textos
            var senha = document.getElementById("field-1").value;
            if(senha != ""){
                //manda informação
                var http = new XMLHttpRequest();
                var url = "../../assets/php/definir_senha.php";
                var params = "senha=" + senha + "";
                http.open("POST", url, true);

                //Send the proper header information along with the request
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                http.send(params);

                $(document).ready(function(){
                    $("#Modal").modal("hide");
                });
            }
            else{
                document.getElementById("form-body").setAttribute("class", "form-group has-error");
            }
        }
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- KNOB JS -->
    <!--[if IE]>
    <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
    <![endif]-->
    <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

    <!--Morris Chart-->
	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/plugins/raphael/raphael-min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/pages/jquery.dashboard.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
    <?php
    if($_SESSION['resetado'] == 1){
        echo '
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#Modal").modal("show");
                });
            </script>';  
    }
    ?>
</body>
</html>