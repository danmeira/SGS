<?php
session_start();
require("../../assets/php/connect.php");
header('Content-Type: text/html; charset=ascII');
if(!isset($_SESSION['id'])){
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/favicon.png">

    <title>Cadastro de Conveniados</title>

    <!-- Plugins css-->
    <link href="../../assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
    
    <!-- App css -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="../../assets/js/modernizr.min.js"></script>
</head>
<body class="fixed-left" onload="focusSelect()">
    <div id="wrapper">
        <div class="left side-menu" style="padding-bottom: 0px;top: 0px;">
            <div class="sidebar-inner slimscrollleft">
                <div class="user-box">
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
                            <a href="#" >
                                <i class="zmdi zmdi-settings"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../../assets/php/logout.php" class="text-custom">
                                <i class="zmdi zmdi-power"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div id="sidebar-menu">
                    <ul>
                    	<li>
                            <a href="../../dashboard.php" class="waves-effect"><i class="zmdi dripicons-meter"></i> <span> Painel </span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect active open subdrop"><i class="zmdi dripicons-archive"></i> <span> Cadastros </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="cadastro_samu.php">SAMU 192</a></li>';
                                    echo '<li><a class="waves-effect active" href="cadastro_conveniados.php">Conveniados</a></li>';
                                }
                                ?>
                                <li><a href="cadastro_colaboradores.php">Colaboradores</a></li>
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="cadastro_cargos.php">Cargos</a></li>';
                                }
                                ?>
                                <li><a href="cadastro_fornecedores.php">Fornecedores</a></li>
                                <li><a href="cadastro_itens.php">Itens</a></li>
                                <li><a href="cadastro_classes.php">Classes</a></li>
                                <li><a href="cadastro_areas.php">&Aacute;reas</a></li>
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a href="cadastro_rateio.php">Rateio</a></li>';
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
                                    echo '<li><a href="cadastro_fontes.php">Fontes</a></li>';
                                    echo '<li><a href="cadastro_contas.php">Contas</a></li>';
                                    echo '<li><a href="cadastro_custo.php">Custos</a></li>';
                                    echo '<li><a href="cadastro_documentos.php">Documentos</a></li>';
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
                                        <li><a href="../sistema/sistema_usuarios.php">Usu&aacute;rios</a></li>
                                        <li>
                                            <a>Configura&ccedil;&atilde;o<span class="menu-arrow"></span></a>
                                            <ul class="#">
                                                <li><a href="#">Propriedades</a></li>
                                                <li><a href="#">Par&acirc;metros</a></li>
                                                <li><a href="#">Contas</a></li>
                                                <li><a href="#">Documentos</a></li>
                                                <li><a href="#">Colaboradores</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../sistema/sistema_atividade.php">Relat&oacute;rio de Atividades</a></li>
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

    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" style="margin-top: -85px;">
                    <div id="box" class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Cadastro de Conveniados</h4>
                            <form method="post">
                                <div id="div-conveniado" class="form-group col-sm-9">
                                    <label>Conveniado</label>
                                    <select id="conveniado_select" class="form-control select2" onclick="carregarCampos(this.value, event, 'no')" onkeydown="carregarCampos(this.value, event, 'no')" onchange="carregarCampos(this.value, event, 'yes')">
                                        <option id="blank"></option>
                                        <?php
                                        $query = "SELECT * FROM c_conveniados ORDER BY conveniado ASC";
                                        $query = mysqli_query($connection, $query) or die($connection);
                                        
                                        while($list = mysqli_fetch_row($query)){
                                            echo "<option>$list[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="div-convenio" class="form-group col-sm-3">
                                    <label>Conv&ecirc;nio</label>   
                                    <select id="convenio" class="form-control select2" disabled>
                                        <option id="op_fed">Federal</option>
                                        <option id="op_ges">Gestor</option>
                                        <option id="op_mun">Municipal</option>
                                    </select>
                                </div>
                                <div id="div-cnpj" class="form-group col-sm-4">
                                    <label>CNPJ</label>
                                    <input id="cnpj" type="text" data-mask="99.999.999/9999-99" class="form-control" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Inscri&ccedil;&atilde;o Estadual</label>
                                    <input id="ie" type="text" data-mask="999.999.999.999" class="form-control" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Telefone</label>
                                    <input id="telefone" type="text" data-mask="(99) 9999-9999" class="form-control" disabled>
                                </div>
                                <div class="form-group col-sm-5">
                                    <label>Contato</label>
                                    <input id="contato" class="form-control" type="text" disabled>
                                </div>
                                <div class="form-group col-sm-7">
                                    <label>E-mail</label>
                                    <input id="email" class="form-control" type="email" disabled>
                                </div>
                                <div id="div-cep" class="form-group col-sm-3">
                                    <label>CEP</label>
                                    <input id="cep" type="text" data-mask="99999-999" class="form-control" onblur="pesquisacep(this.value)" disabled>
                                </div>
                                <div id="div-endereco" class="form-group col-sm-9" disabled>
                                    <label>Endere&ccedil;o</label>
                                    <input id="endereco" class="form-control" type="text" disabled>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Complemento</label>
                                    <input id="complemento" class="form-control" type="text" disabled>
                                </div>
                                <div id="div-cidade" class="form-group col-sm-7">
                                    <label>Cidade</label>
                                    <input id="cidade" class="form-control" type="text" disabled>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>UF</label>
                                    <select id="uf" class="form-control select2" disabled>
                                        <option id="ac">AC</option>
                                        <option id="al">AL</option>
                                        <option id="ap">AP</option>
                                        <option id="am">AM</option>
                                        <option id="ba">BA</option>
                                        <option id="ce">CE</option>
                                        <option id="df">DF</option>
                                        <option id="es">ES</option>
                                        <option id="go">GO</option>
                                        <option id="ma">MA</option>
                                        <option id="mt">MT</option>
                                        <option id="ms">MS</option>
                                        <option id="mg">MG</option>
                                        <option id="pa">PA</option>
                                        <option id="pb">PB</option>
                                        <option id="pr">PR</option>
                                        <option id="pe">PE</option>
                                        <option id="pi">PI</option>
                                        <option id="rj">RJ</option>
                                        <option id="rn">RN</option>
                                        <option id="rs">RS</option>
                                        <option id="ro">RO</option>
                                        <option id="rr">RR</option>
                                        <option id="sc">SC</option>
                                        <option id="sp">SP</option>
                                        <option id="se">SE</option>
                                        <option id="to">TO</option>
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button id="btnCadastrar" class="btn btn-success waves-effect waves-light" type="button" onclick="cadastrarConveniado()">
                                        Cadastrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="Modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="margin-top: 230px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
                    <h4 class="modal-title"> Quer mesmo excluir este cadastro? </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger waves-effect waves-light">Cancelar</button>
                    <button type="button" onclick="removerCadastro()" class="btn btn-info waves-effect waves-light">Confirmar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/detect.js"></script>
    <script src="../../assets/js/fastclick.js"></script>
    <script src="../../assets/js/jquery.blockUI.js"></script>
    <script src="../../assets/js/waves.js"></script>
    <script src="../../assets/js/jquery.nicescroll.js"></script>
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <script src="../../assets/js/jquery.scrollTo.min.js"></script>

    <!-- Plugins Js -->
    <script type="text/javascript" src="../../assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
    <script src="../../assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

    <script src="../../assets/plugins/jquery-knob/jquery.knob.js"></script>

    <!-- App js -->
    <script src="../../assets/js/cnpj.js"></script>
    <script src="../../assets/js/ie.js"></script>
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>
    <script type="text/javascript">
        var count = 0;
                
        function focusSelect(){
            $('#conveniado_select').focus();
        }    
        function carregarCampos(conveniado, event, change) {
            var x = event.which || event.keyCode;
            if (conveniado == "") {
                $('#op_fed').prop('selected', true);
                $('#cnpj').val("");
                $('#ie').val("");
                $('#telefone').val("");
                $('#contato').val("");
                $('#email').val("");
                $('#cep').val("");
                $('#endereco').val("");
                $('#complemento').val("");
                $('#cidade').val("");
                $('#ac').prop('selected', true);
                $('#btnRemover').remove();
                $('#btnAlterar').remove();
                count = 0;
            }
            if (x == 13 && conveniado != "" || x == 1 && conveniado != "" || change == "yes" && conveniado != ""){
                if (window.XMLHttpRequest) {
                    var xmlhttp = new XMLHttpRequest();
                }
                else{
                    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function(){
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        if (count == 0) {
                            $('<button id="btnRemover" class="btn btn-danger waves-effect waves-light" type="button" onclick="showModal()" style="margin-left: 4px;">Remover</button>').insertAfter('#btnCadastrar');
                            $('<button id="btnAlterar" class="btn btn-primary waves-effect waves-light" type="button" onclick="alterarCadastro()" style="margin-left: 4px;">Alterar</button>').insertAfter('#btnRemover');
                            count++;    
                        }
                        var returnval = xmlhttp.responseText;
                        returnval = returnval.toString();
                        returnval = returnval.split(";");
                        returnval[0] = returnval[0].trim();
                        if (returnval[0] == "Federal") {
                            $('#op_fed').prop('selected', true);
                        }
                        else if (returnval[0] == "Gestor") {
                            $('#op_ges').prop('selected', true);
                        }
                        else if (returnval[0] == "Municipal") {
                            $('#op_mun').prop('selected', true);
                        }
                        $('#cnpj').val(returnval[1]);
                        $('#ie').val(returnval[2]);
                        $('#telefone').val(returnval[5]);
                        $('#contato').val(returnval[3]);
                        $('#email').val(returnval[4]);
                        $('#cep').val(returnval[8]);
                        $('#endereco').val(returnval[6]);
                        $('#complemento').val(returnval[7]);
                        $('#cidade').val(returnval[9]);

                        var estado = '#' + returnval[10].toLowerCase();
                        $(estado).prop('selected', true);
                    }

                }
            }
            var params = "conveniado=" + conveniado + "";

            xmlhttp.open("POST", "../../assets/php/cadastro/consultar_conveniados.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(params);
        }
        function cadastrarConveniado(){
            $('#btnRemover').remove();
            $('<input id="conveniado_input" class="form-control" type="text">').insertAfter('#conveniado_select');
            $('#conveniado_select').remove();
            $('#conveniado_input').focus();
            $('<button id="btnCancelar" class="btn btn-danger waves-effect waves-light" type="button" onclick="cancelarCadastro()">Cancelar</button>').insertAfter('#btnCadastrar');
            $('#btnCadastrar').remove();
            $('<button id="btnSalvar" class="btn btn-primary waves-effect waves-light" type="button" onclick="salvarCadastro()" style="margin-left: 4px;">Salvar</button>').insertAfter('#btnCancelar');
            $('#btnAlterar').remove();
            $('#convenio').prop("disabled", false);
            $('#op_fed').prop('selected', true);
            $('#cnpj').prop("disabled", false);
            $('#cnpj').val("");
            $('#ie').prop("disabled", false);
            $('#ie').val("");
            $('#telefone').prop("disabled", false);
            $('#telefone').val("");
            $('#contato').prop("disabled", false);
            $('#contato').val("");
            $('#email').prop("disabled", false);
            $('#email').val("");
            $('#cep').prop("disabled", false);
            $('#cep').val("");
            $('#endereco').prop("disabled", false);
            $('#endereco').val("");
            $('#complemento').prop("disabled", false);
            $('#complemento').val("");
            $('#cidade').prop("disabled", false);
            $('#cidade').val("");
            $('#uf').prop("disabled", false);
            $('#ac').prop('selected', true);
        }
        function alterarCadastro(){
            $('#btnRemover').remove();
            $('<input id="conveniado_input" class="form-control" type="text" value="' + $('#conveniado_select').val() + '">').insertAfter('#conveniado_select');
            $('#conveniado_select').remove();
            $('#conveniado_input').focus();
            $('<button id="btnSalvar" class="btn btn-primary waves-effect waves-light" type="button" onclick="salvarCadastro()" style="margin-left: 4px;">Salvar</button>').insertAfter('#btnAlterar');
            $('#btnAlterar').remove();
            $('<button id="btnCancelar" class="btn btn-danger waves-effect waves-light" type="button" onclick="cancelarCadastro()">Cancelar</button>').insertAfter('#btnCadastrar');
            $('#btnCadastrar').remove();
            
            $('#convenio').prop("disabled", false);
            $('#cnpj').prop("disabled", false);
            $('#ie').prop("disabled", false);
            $('#telefone').prop("disabled", false);
            $('#contato').prop("disabled", false);
            $('#email').prop("disabled", false);
            $('#cep').prop("disabled", false);
            $('#endereco').prop("disabled", false);
            $('#complemento').prop("disabled", false);
            $('#cidade').prop("disabled", false);
            $('#uf').prop("disabled", false);
        }
        function cancelarCadastro(){
            location.reload();
        }
        function showModal(){
            $(document).ready(function(){
                $("#Modal").modal("show");
            });
        }
        function removerCadastro(){
            var cnpj = document.getElementById('cnpj').value;

            if (window.XMLHttpRequest) {
                var xmlhttp = new XMLHttpRequest();
            }
            else{
                var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    location.reload();
                }
            }
            var params = "cnpj=" + cnpj + "";

            xmlhttp.open("POST", "../../assets/php/cadastro/remover_conveniados.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(params);
        }
        function salvarCadastro(){
            var conveniado_input = document.getElementById("conveniado_input").value;
            var convenio = document.getElementById('convenio').value;
            var cnpj = document.getElementById('cnpj').value;
            var ie = document.getElementById('ie').value;
            var telefone = document.getElementById('telefone').value;
            var contato = document.getElementById('contato').value;
            var email = document.getElementById('email').value;
            var endereco = document.getElementById('endereco').value;
            var complemento = document.getElementById('complemento').value;
            var cep = document.getElementById('cep').value;
            var cidade = document.getElementById('cidade').value;
            var uf = document.getElementById('uf').value;
            
            var ie_val = inscricaoEstadual(ie, uf);
            var cnpj_val = validarCNPJ(cnpj);

            if (conveniado_input != "" && cnpj != "" && endereco != "" && cep != "" && cidade != ""){
                if (ie != "" && ie != "000.000.000.000") {
                    if(ie_val == true && cnpj_val == true){
                        var http = new XMLHttpRequest();
                        var url = "../../assets/php/cadastro/cadastro_coveniados.php";
                        var params = "conveniado=" + conveniado_input + "&convenio=" + convenio + "&cnpj=" + cnpj + "&ie=" + ie + "&telefone=" + telefone + "&contato=" + contato + "&email=" + email + "&endereco=" + endereco + "&complemento=" + complemento + "&cep=" + cep + "&cidade=" + cidade + "&uf=" + uf + "";
                        http.open("POST", url, true);

                        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        http.send(params);
                    }
                    else if(ie_val != true && cnpj_val != true){
                        document.getElementById('div-ie').setAttribute("class", "form-group col-sm-4 has-error");
                        document.getElementById('div-cnpj').setAttribute("class", "form-group col-sm-4 has-error");
                    }
                    else if (ie_val != true && cnpj_val == true) {
                        document.getElementById('div-ie').setAttribute("class", "form-group col-sm-4 has-error");
                    }
                    else if (ie_val == true && cnpj_val != true) {
                        document.getElementById('div-cnpj').setAttribute("class", "form-group col-sm-4 has-error");
                    }


                    http.onreadystatechange = function(){
                        if (http.readyState == 4 && http.status == 200) {
                            location.reload();
                        }
                        var returnval = http.responseText;
                        console.log(returnval);
                    }
                }
                else {
                    if (cnpj_val == true) {
                        var http = new XMLHttpRequest();
                        var url = "../../assets/php/cadastro/cadastro_conveniados.php";
                        var params = "conveniado=" + conveniado_input + "&convenio=" + convenio + "&cnpj=" + cnpj + "&ie=" + ie + "&telefone=" + telefone + "&contato=" + contato + "&email=" + email + "&endereco=" + endereco + "&complemento=" + complemento + "&cep=" + cep + "&cidade=" + cidade + "&uf=" + uf + "";
                        http.open("POST", url, true);

                        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        http.send(params);
                    }
                    else{
                        document.getElementById('div-cnpj').setAttribute("class", "form-group col-sm-4 has-error");
                    }
                    http.onreadystatechange = function(){
                        if (http.readyState == 4 && http.status == 200) {
                            location.reload();
                        }
                        var returnval = http.responseText;
                        console.log(returnval);
                    }
                }
            }
            else{
                if (conveniado_input == "") {
                    document.getElementById('div-conveniado').setAttribute("class", "form-group col-sm-9 has-error");
                }
                if (convenio == "") {
                    document.getElementById('div-convenio').setAttribute("class", "form-group col-sm-3 has-error");
                }
                if (cnpj == "") {
                    document.getElementById('div-cnpj').setAttribute("class", "form-group col-sm-4 has-error");
                }
                if (endereco == "") {
                    document.getElementById('div-endereco').setAttribute("class", "form-group col-sm-9 has-error");
                }
                if (cep == "") {
                    document.getElementById('div-cep').setAttribute("class", "form-group col-sm-3 has-error");
                }
                if (cidade == "") {
                    document.getElementById('div-cidade').setAttribute("class", "form-group col-sm-7 has-error");
                }
            }
        }
    </script>
    <script type="text/javascript" >
    
    function limpa_formulario_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('endereco').value = "";
        document.getElementById('cidade').value = "";
        document.getElementById('uf').value = "";
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro) + ", ";
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulario_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {
        var valor = document.getElementById("cep").value;
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulario_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulario_cep();
        }
    }

    </script>
</body>
</html>