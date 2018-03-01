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

    <title>Cadastro de Colaboradores</title>

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
    <link href="../../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                            <h4 class="header-title m-t-0 m-b-30">Cadastro de Colaboradores</h4>
                            <form method="post">
                                <div id="div-colaborador" class="form-group col-sm-7">
                                    <label>Colaborador</label>
                                    <select id="colaborador_select" class="form-control select2" onclick="carregarCampos(this.value, event, 'no')" onkeydown="carregarCampos(this.value, event, 'no')" onchange="carregarCampos(this.value, event, 'yes')">
                                        <option id="blank"></option>
                                        <?php
                                        $query = "SELECT * FROM c_colaboradores ORDER BY nome ASC";
                                        $query = mysqli_query($connection, $query) or die($connection);
                                        
                                        while($list = mysqli_fetch_row($query)){
                                            echo "<option>$list[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="div-cpf" class="form-group col-sm-3">
                                    <label>CPF</label>
                                    <input id="cpf" type="text" data-mask="999.999.999-99" class="form-control" disabled>
                                </div>
                                <div id="div-sexo" class="form-group col-sm-2">
                                    <label>Sexo</label>   
                                    <select id="sexo" class="form-control select2" disabled>
                                        <option id="sex_blank"></option>
                                        <option id="op_m">M</option>
                                        <option id="op_f">F</option>
                                    </select>
                                </div>
                                <div id="div-cep" class="form-group col-sm-2">
                                    <label>CEP</label>
                                    <input id="cep" type="text" data-mask="99999-999" class="form-control" onblur="pesquisacep(this.value)" disabled>
                                </div>
                                <div id="div-endereco" class="form-group col-sm-5" disabled>
                                    <label>Endere&ccedil;o</label>
                                    <input id="endereco" class="form-control" type="text" disabled>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Complemento</label>
                                    <input id="complemento" class="form-control" type="text" disabled>
                                </div>
                                <div id="div-cidade" class="form-group col-sm-2">
                                    <label>Cidade</label>
                                    <input id="cidade" class="form-control" type="text" disabled>
                                </div>
                                <div class="form-group col-sm-1">
                                    <label>UF</label>
                                    <select id="uf" class="form-control select2" disabled>
                                        <option id="uf_blank"></option>
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
                                <div class="form-group col-sm-2">
                                    <label>Telefone</label>
                                    <input id="telefone" type="text" data-mask="(99) 9999-9999" class="form-control" disabled>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Celular</label>
                                    <input id="celular" type="text" data-mask="(99) 99999-9999" class="form-control" disabled>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>E-mail</label>
                                    <input id="email" class="form-control" type="email" disabled>
                                </div>
                                <div id="div-cbo" class="form-group col-sm-4">
                                    <label>Cargo</label>
                                    <select id="cbo_select" class="form-control select2" disabled>
                                        <option id="cbo_blank"></option>
                                        <?php
                                        $query = "SELECT * FROM c_cargo";
                                        $query = mysqli_query($connection, $query) or die($connection);
                                        
                                        while($list = mysqli_fetch_row($query)){
                                            $id = $list[0];
                                            $id = explode("-", $id);
                                            echo "<option id='$id[0]'>$list[0] - $list[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="div-regime" class="form-group col-sm-2">
                                    <label>Regime</label>
                                    <select id="regime_select" class="form-control select2" disabled>
                                        <option id="reg_blank"></option>
                                        <option id="op_clt">CLT</option>
                                        <option id="op_estatutario">Estatut&aacute;rio</option>
                                        <option id="op_temporario">Tempor&aacute;rio</option>
                                    </select>
                                </div>
                                <div id="div-admissao" class="col-sm-2">
                                    <label>Admiss&atilde;o</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="admissao" id="datepicker-autoclose_1" disabled>
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Demiss&atilde;o</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="demissao" id="datepicker-autoclose_2" disabled>
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div>
                                </div>
                                <div id="div-cc" class="form-group col-sm-2">
                                    <label>Centro de Custo</label>
                                    <select id="cc_select" class="form-control select2" disabled>
                                        <option id="cc_blank"></option>
                                        <?php
                                        $query = "SELECT * FROM c_custo";
                                        $query = mysqli_query($connection, $query) or die($connection);
                                        
                                        while($list = mysqli_fetch_row($query)){
                                            echo "<option id='$list[0]'>$list[0]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="div-cfp" class="form-group col-sm-4">
                                    <label>Fonte Pagadora</label>
                                    <select id="cfp_select" class="form-control select2" disabled>
                                        <option id="cfp_blank"></option>
                                        <?php
                                        $query = "SELECT * FROM c_fontes";
                                        $query = mysqli_query($connection, $query) or die($connection);
                                        
                                        while($list = mysqli_fetch_row($query)){
                                            echo "<option id='$list[0]'>$list[0] - $list[1]</option>";
                                        }
                                        ?>
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
    <script src="../../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../../assets/plugins/jquery-knob/jquery.knob.js"></script>

    <!-- App js -->
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>
    <script type="text/javascript">
        var count = 0;
        
        function focusSelect(){
            $('#colaborador_select').focus();
        }    
        function carregarCampos(colaborador, event, change) {
            var x = event.which || event.keyCode;
            if (colaborador == "") {
                $('#cpf').val("");
                $('#sex_blank').prop('selected', true);
                $('#cep').val("");
                $('#endereco').val("");
                $('#complemento').val("");
                $('#cidade').val("");
                $('#uf_blank').prop('selected', true);
                $('#telefone').val("");
                $('#celular').val("");
                $('#email').val("");
                $('#cbo_blank').prop('selected', true);
                $('#reg_blank').prop('selected', true);
                $('input[name="admissao"]').val("");
                $('input[name="demissao"]').val("");
                $('#cc_blank').prop('selected', true);
                $('#cfp_blank').prop('selected', true);
                $('#btnRemover').remove();
                $('#btnAlterar').remove();
                count = 0;
            }
            if (x == 13 && colaborador != "" || x == 1 && colaborador != "" || change == "yes" && colaborador != ""){
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
                        $('#cpf').val(returnval[0]);
                        if (returnval[1] == "M") {
                            $('#op_m').prop('selected', true);
                        }
                        else {
                            $('#op_f').prop('selected', true);
                        }
                        $('#cep').val(returnval[4]);
                        $('#endereco').val(returnval[2]);
                        $('#complemento').val(returnval[3]);
                        $('#cidade').val(returnval[5]);
                        var estado = '#' + returnval[6].toLowerCase();
                        $(estado).prop('selected', true);
                        $('#telefone').val(returnval[7]);
                        $('#celular').val(returnval[8]);
                        $('#email').val(returnval[9]);
                        var cargo = returnval[10].split("-");
                        $("#" + cargo).prop('selected', true);
                        returnval[11].trim();
                        if (returnval[11] == "CLT") {
                            $('#op_clt').prop('selected', true);
                        }
                        else if (returnval[11] == "Estatut" + String.fromCharCode(225) + "rio") {
                            $('#op_estatutario').prop('selected', true);
                        }
                        else if (returnval[11] == "Tempor" + String.fromCharCode(225) + "rio") {
                            $('#op_temporario').prop('selected', true);
                        }
                        var adm = returnval[12].split("-");
                        var dem = returnval[13].split("-");
                        if (returnval[12] == "--") {
                            $('input[name="admissao"]').val("");
                        }
                        else{
                            $('input[name="admissao"]').val(adm[2] + "/" + adm[1] + "/" + adm[0]);    
                        }
                        
                        if (returnval[13] == "--") {
                            $('input[name="demissao"]').val("");
                        } 
                        else {
                            $('input[name="demissao"]').val(dem[2] + "/" + dem[1] + "/" + dem[0]);
                        }
                        var custo = "#" + returnval[14];
                        $(custo).prop('selected', true);
                        var fonte = "#" + returnval[15];
                        $(fonte).prop('selected', true);
                    }

                }
            }
            var params = "colaborador=" + colaborador + "";

            xmlhttp.open("POST", "../../assets/php/cadastro/consultar_colaboradores.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(params);
        }
        function cadastrarConveniado(){
            $('#btnRemover').remove();
            $('<input id="colaborador_input" class="form-control" type="text">').insertAfter('#colaborador_select');
            $('#colaborador_select').remove();
            $('#colaborador_input').focus();
            $('<button id="btnCancelar" class="btn btn-danger waves-effect waves-light" type="button" onclick="cancelarCadastro()">Cancelar</button>').insertAfter('#btnCadastrar');
            $('#btnCadastrar').remove();
            $('<button id="btnSalvar" class="btn btn-primary waves-effect waves-light" type="button" onclick="salvarCadastro()" style="margin-left: 4px;">Salvar</button>').insertAfter('#btnCancelar');
            $('#btnAlterar').remove();
            $('#cpf').prop("disabled", false);
            $('#cpf').val("");
            $('#sexo').prop('disabled', false);
            $('#sex_blank').prop('selected', true);
            $('#cep').prop('disabled', false);
            $('#cep').val("");
            $('#endereco').prop('disabled', false);
            $('#endereco').val("");
            $('#complemento').prop('disabled', false);
            $('#complemento').val("");
            $('#cidade').prop('disabled', false);
            $('#cidade').val("");
            $('#uf').prop('disabled', false);
            $('#uf_blank').prop('selected', true);
            $('#telefone').prop('disabled', false);
            $('#telefone').val("");
            $('#celular').prop('disabled', false);
            $('#celular').val("");
            $('#email').prop('disabled', false);
            $('#email').val("");
            $('#cbo_select').prop('disabled', false);
            $('#cbo_blank').prop('selected', true);
            $('#regime_select').prop('disabled', false);
            $('#reg_blank').prop('selected', true);
            $('input[name="admissao"]').prop('disabled', false);
            $('input[name="admissao"]').val("");
            $('input[name="demissao"]').prop('disabled', false);
            $('input[name="demissao"]').val("");
            $('#cc_select').prop('disabled', false);
            $('#cc_blank').prop('selected', true);
            $('#cfp_select').prop('disabled', false);
            $('#cfp_blank').prop('selected', true);
        }
        function alterarCadastro(){
            $('#btnRemover').remove();
            $('<input id="colaborador_input" class="form-control" type="text" value="' + $('#colaborador_select').val() + '">').insertAfter('#colaborador_select');
            $('#colaborador_select').remove();
            $('#colaborador_input').focus();
            $('<button id="btnSalvar" class="btn btn-primary waves-effect waves-light" type="button" onclick="salvarCadastro()" style="margin-left: 4px;">Salvar</button>').insertAfter('#btnAlterar');
            $('#btnAlterar').remove();
            $('<button id="btnCancelar" class="btn btn-danger waves-effect waves-light" type="button" onclick="cancelarCadastro()">Cancelar</button>').insertAfter('#btnCadastrar');
            $('#btnCadastrar').remove();
            
            $('#cpf').prop("disabled", false);
            $('#sexo').prop('disabled', false);
            $('#cep').prop('disabled', false);
            $('#endereco').prop('disabled', false);
            $('#complemento').prop('disabled', false);
            $('#cidade').prop('disabled', false);
            $('#uf').prop('disabled', false);
            $('#telefone').prop('disabled', false);
            $('#celular').prop('disabled', false);
            $('#email').prop('disabled', false);
            $('#cbo_select').prop('disabled', false);
            $('#regime_select').prop('disabled', false);
            $('input[name="admissao"]').prop('disabled', false);
            $('input[name="demissao"]').prop('disabled', false);
            $('#cc_select').prop('disabled', false);
            $('#cfp_select').prop('disabled', false);
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
            var cpf = $('#cpf').val();

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
            var params = "cpf=" + cpf + "";

            xmlhttp.open("POST", "../../assets/php/cadastro/remover_colaborador.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(params);
        }
        function salvarCadastro(){
            var colaborador = $('#colaborador_input').val();
            var cpf = $('#cpf').val();
            var sexo = $('#sexo').val();
            var cep = $('#cep').val();
            var endereco = $('#endereco').val();
            var complemento = $('#complemento').val();
            var cidade = $('#cidade').val();
            var uf = $('#uf').val();
            var telefone = $('#telefone').val();
            var celular = $('#celular').val();
            var email = $('#email').val();
            var cargo = $('#cbo_select').val();
            cargo.split("");
            var cargo_perm = "temp";
            var cargo_temp = "temp";
            for(var i = 0; i < 9; i++){
                if(i == 0){
                    cargo_temp = cargo[i];
                }
                else{
                    cargo_temp = cargo_temp.concat(cargo[i]);    
                }
            }
            cargo_perm = cargo_temp;
            var val_cpf = validarCPF(cpf);
            var regime = $('#regime_select').val();
            var admissao = $('input[name="admissao"]').val();
            var demissao = $('input[name="demissao"]').val();
            var custo = $('#cc_select').val();
            var fonte = $('#cfp_select').val();
            fonte.split(" - ");
            var fonte_perm = "temp";
            var fonte_temp = "temp";
            for(var i = 0; i < 3; i++){
                if(i == 0){
                    fonte_temp = fonte[i];
                }
                else{
                    fonte_temp = fonte_temp.concat(fonte[i]);    
                }
            }
            fonte_perm = fonte_temp;
            if (colaborador != "" && cpf != "" && cargo != "" && regime != "" && admissao != "" && custo != "" && fonte != ""){
                if(val_cpf == true){
                    var http = new XMLHttpRequest();
                    var url = "../../assets/php/cadastro/cadastrar_colaboradores.php";
                    var params = "colaborador=" + colaborador + "&cpf=" + cpf + "&sexo=" + sexo + "&cep=" + cep + "&endereco=" + endereco + "&complemento=" + complemento + "&cidade=" + cidade + "&uf=" + uf + "&telefone=" + telefone + "&celular=" + celular + "&email=" + email + "&cargo=" + cargo_perm + "&regime=" + regime + "&admissao=" + admissao + "&demissao=" + demissao + "&custo=" + custo + "&fonte=" + fonte_perm + "";
                    http.open("POST", url, true);

                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    http.send(params);
                }
                else{
                    document.getElementById('div-cpf').setAttribute("class", "form-group col-sm-3 has-error");
                }

                http.onreadystatechange = function(){
                    if (http.readyState == 4 && http.status == 200) {
                        $('#colaborador_input').val("");
                        $('#cpf').prop("disabled", false);
                        $('#cpf').val("");
                        $('#sexo').prop('disabled', false);
                        $('#sex_blank').prop('selected', true);
                        $('#cep').prop('disabled', false);
                        $('#cep').val("");
                        $('#endereco').prop('disabled', false);
                        $('#endereco').val("");
                        $('#complemento').prop('disabled', false);
                        $('#complemento').val("");
                        $('#cidade').prop('disabled', false);
                        $('#cidade').val("");
                        $('#uf').prop('disabled', false);
                        $('#uf_blank').prop('selected', true);
                        $('#telefone').prop('disabled', false);
                        $('#telefone').val("");
                        $('#celular').prop('disabled', false);
                        $('#celular').val("");
                        $('#email').prop('disabled', false);
                        $('#email').val("");
                        $('#cbo_select').prop('disabled', false);
                        $('#cbo_blank').prop('selected', true);
                        $('#regime_select').prop('disabled', false);
                        $('#reg_blank').prop('selected', true);
                        $('input[name="admissao"]').prop('disabled', false);
                        $('input[name="admissao"]').val("");
                        $('input[name="demissao"]').prop('disabled', false);
                        $('input[name="demissao"]').val("");
                        $('#cc_select').prop('disabled', false);
                        $('#cc_blank').prop('selected', true);
                        $('#cfp_select').prop('disabled', false);
                        $('#cfp_blank').prop('selected', true);
                        $('#colaborador_input').focus();
                    }
                    var returnval = http.responseText;
                }
            }
            else{
                if (colaborador == "") {
                    document.getElementById('div-colaborador').setAttribute("class", "form-group col-sm-7 has-error");
                }
                if (cpf == "") {
                    document.getElementById('div-cpf').setAttribute("class", "form-group col-sm-3 has-error");
                }
                if (cargo == "") {
                    document.getElementById('div-cbo').setAttribute("class", "form-group col-sm-4 has-error");
                }
                if (regime == "") {
                    document.getElementById('div-regime').setAttribute("class", "form-group col-sm-2 has-error");
                }
                if (admissao == "") {
                    document.getElementById('div-admissao').setAttribute("class", "form-group col-sm-2 has-error");
                }
                if (custo == "") {
                    document.getElementById('div-cc').setAttribute("class", "form-group col-sm-2 has-error");
                }
                if (fonte == "") {
                    document.getElementById('div-cfp').setAttribute("class", "form-group col-sm-4 has-error");
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

    <script>
        // Date Picker
        jQuery('#datepicker').datepicker();
        jQuery('#datepicker-autoclose_1').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#datepicker-autoclose_2').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#datepicker-inline').datepicker();
        jQuery('#datepicker-multiple-date').datepicker({
            format: "dd/mm/yyyy",
            clearBtn: true,
            multidate: true,
            multidateSeparator: ","
        });
    </script>
    <script>
        function validarCPF(cpf) {  
            cpf = cpf.replace(/[^\d]+/g,'');    
            if(cpf == '') return false; 
            // Elimina CPFs invalidos conhecidos    
            if (cpf.length != 11 || 
                cpf == "00000000000" || 
                cpf == "11111111111" || 
                cpf == "22222222222" || 
                cpf == "33333333333" || 
                cpf == "44444444444" || 
                cpf == "55555555555" || 
                cpf == "66666666666" || 
                cpf == "77777777777" || 
                cpf == "88888888888" || 
                cpf == "99999999999")
                    return false;       
            // Valida 1o digito 
            add = 0;    
            for (i=0; i < 9; i ++)       
                add += parseInt(cpf.charAt(i)) * (10 - i);  
                rev = 11 - (add % 11);  
                if (rev == 10 || rev == 11)     
                    rev = 0;    
                if (rev != parseInt(cpf.charAt(9)))     
                    return false;       
            // Valida 2o digito 
            add = 0;    
            for (i = 0; i < 10; i ++)        
                add += parseInt(cpf.charAt(i)) * (11 - i);  
            rev = 11 - (add % 11);  
            if (rev == 10 || rev == 11) 
                rev = 0;    
            if (rev != parseInt(cpf.charAt(10)))
                return false;       
            return true;   
        }
    </script>
</body>
</html>