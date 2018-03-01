<?php
session_start();
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

    <title>SGS - Cadastro - SAMU</title>

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
                            <a href="javascript:void(0);" class="waves-effect active open subdrop"><i class="zmdi dripicons-archive"></i> <span> Cadastros </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <?php 
                                if ($_SESSION['nivel'] != "Usuário") {
                                    echo '<li><a class="waves-effect active" href="cadastro_samu.php">SAMU 192</a></li>';
                                    echo '<li><a href="cadastro_conveniados.php">Conveniados</a></li>';
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
                                                <li><a href="cadastro_documentos.php">Documentos</a></li>
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
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row" style="margin-top: -85px;">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Cadastro SAMU 192</h4>
                            <form>
                                <?php
                                require("../../assets/php/connect.php");
                                $query = "SELECT * FROM c_samu";
                                $query = mysqli_query($connection, $query) or die($connection);
                                $query = mysqli_fetch_assoc($query);

                                if ($query['cnpj'] != "") {
                                    $samu = $query['samu'];
                                    $convenio = $query['convenio'];
                                    $cnpj = $query['cnpj'];
                                    $ie = $query['ie'];
                                    $telefone = $query['telefone'];
                                    $contato = $query['contato'];
                                    $email = $query['email'];
                                    $endereco = $query['endereco'];
                                    $complemento = $query['complemento'];
                                    $cep = $query['cep'];
                                    $cidade = $query['cidade'];
                                    $uf = $query['uf'];
                                }
                                ?>
                                <div id="div-samu" class="form-group col-sm-9">
                                    <label>SAMU</label>
                                    <input id="samu" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$samu'";} ?> >
                                </div>
                                <div id="div-convenio" class="form-group col-sm-3">
                                    <label>Conv&ecirc;nio</label>
                                    <input id="convenio" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$convenio'";} ?> >
                                </div>
                                <div id="div-cnpj" class="form-group col-sm-4">
                                    <label>CNPJ</label>
                                    <input id="cnpj" type="text" data-mask="99.999.999/9999-99" class="form-control" <?php if ($query['cnpj'] != "") {echo "value='$cnpj'";} ?> >
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Inscri&ccedil;&atilde;o Estadual</label>
                                    <input id="ie" type="text" data-mask="999.999.999.999" class="form-control" <?php if ($query['cnpj'] != "") {echo "value='$ie'";} ?> >
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Telefone</label>
                                    <input id="telefone" type="text" data-mask="(99) 9999-9999" class="form-control" <?php if ($query['cnpj'] != "") {echo "value='$telefone'";} ?> >
                                </div>
                                <div class="form-group col-sm-5">
                                    <label>Contato</label>
                                    <input id="contato" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$contato'";} ?> >
                                </div>
                                <div class="form-group col-sm-7">
                                    <label>E-mail</label>
                                    <input id="email" class="form-control" type="email" <?php if ($query['cnpj'] != "") {echo "value='$email'";} ?> >
                                </div>
                                <div id="div-cep" class="form-group col-sm-3">
                                    <label>CEP</label>
                                    <input id="cep" type="text" data-mask="99999-999" class="form-control" onblur="pesquisacep(this.value)" <?php if ($query['cnpj'] != "") {echo "value='$cep'";} ?> >
                                </div>
                                <div id="div-endereco" class="form-group col-sm-9">
                                    <label>Endere&ccedil;o</label>
                                    <input id="endereco" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$endereco'";} ?> >
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Complemento</label>
                                    <input id="complemento" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$complemento'";} ?> >
                                </div>
                                <div id="div-cidade" class="form-group col-sm-7">
                                    <label>Cidade</label>
                                    <input id="cidade" class="form-control" type="text" <?php if ($query['cnpj'] != "") {echo "value='$cidade'";} ?> >
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>UF</label>
                                    <select id="uf" class="form-control select2">
                                        <option <?php if ($query['uf'] == "AC") {echo "selected";} ?>>AC</option>
                                        <option <?php if ($query['uf'] == "AL") {echo "selected";} ?>>AL</option>
                                        <option <?php if ($query['uf'] == "AP") {echo "selected";} ?>>AP</option>
                                        <option <?php if ($query['uf'] == "AM") {echo "selected";} ?>>AM</option>
                                        <option <?php if ($query['uf'] == "BA") {echo "selected";} ?>>BA</option>
                                        <option <?php if ($query['uf'] == "CE") {echo "selected";} ?>>CE</option>
                                        <option <?php if ($query['uf'] == "DF") {echo "selected";} ?>>DF</option>
                                        <option <?php if ($query['uf'] == "ES") {echo "selected";} ?>>ES</option>
                                        <option <?php if ($query['uf'] == "GO") {echo "selected";} ?>>GO</option>
                                        <option <?php if ($query['uf'] == "MA") {echo "selected";} ?>>MA</option>
                                        <option <?php if ($query['uf'] == "MT") {echo "selected";} ?>>MT</option>
                                        <option <?php if ($query['uf'] == "MS") {echo "selected";} ?>>MS</option>
                                        <option <?php if ($query['uf'] == "MG") {echo "selected";} ?>>MG</option>
                                        <option <?php if ($query['uf'] == "PA") {echo "selected";} ?>>PA</option>
                                        <option <?php if ($query['uf'] == "PB") {echo "selected";} ?>>PB</option>
                                        <option <?php if ($query['uf'] == "PR") {echo "selected";} ?>>PR</option>
                                        <option <?php if ($query['uf'] == "PE") {echo "selected";} ?>>PE</option>
                                        <option <?php if ($query['uf'] == "PI") {echo "selected";} ?>>PI</option>
                                        <option <?php if ($query['uf'] == "RJ") {echo "selected";} ?>>RJ</option>
                                        <option <?php if ($query['uf'] == "RN") {echo "selected";} ?>>RN</option>
                                        <option <?php if ($query['uf'] == "RS") {echo "selected";} ?>>RS</option>
                                        <option <?php if ($query['uf'] == "RO") {echo "selected";} ?>>RO</option>
                                        <option <?php if ($query['uf'] == "RR") {echo "selected";} ?>>RR</option>
                                        <option <?php if ($query['uf'] == "SC") {echo "selected";} ?>>SC</option>
                                        <option <?php if ($query['uf'] == "SP") {echo "selected";} ?>>SP</option>
                                        <option <?php if ($query['uf'] == "SE") {echo "selected";} ?>>SE</option>
                                        <option <?php if ($query['uf'] == "TO") {echo "selected";} ?>>TO</option>
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button onclick="cadastrarSamu()" class="btn btn-primary waves-effect waves-light" type="button">
                                        Salvar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
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

    <!-- KNOB JS -->
    <!--[if IE]>
    <script type="text/javascript" src="../../assets/plugins/jquery-knob/excanvas.js"></script>
    <![endif]-->
    <script src="../../assets/plugins/jquery-knob/jquery.knob.js"></script>

    <!-- App js -->
    <script src="../../assets/js/cnpj.js"></script>
    <script src="../../assets/js/ie.js"></script>
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>

    

    <script type="text/javascript">
        function cadastrarSamu(){
            var samu = document.getElementById('samu').value;
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

            if (samu != "" && cnpj != "" && endereco != "" && cep != "" && cidade != "") {
                if (ie != "" && ie != "000.000.000.000") {
                    if(ie_val == true && cnpj_val == true){
                        var http = new XMLHttpRequest();
                        var url = "../../assets/php/cadastro/cadastro_samu.php";
                        var params = "samu=" + samu + "&convenio=" + convenio + "&cnpj=" + cnpj + "&ie=" + ie + "&telefone=" + telefone + "&contato=" + contato + "&email=" + email + "&endereco=" + endereco + "&complemento=" + complemento + "&cep=" + cep + "&cidade=" + cidade + "&uf=" + uf + "";
                        http.open("POST", url, true);

                        //Send the proper header information along with the request
                        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        http.send(params);

                        window.location.replace("cadastro_samu.php");
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
                }
                else {
                    if (cnpj_val == true) {
                        var http = new XMLHttpRequest();
                        var url = "../../assets/php/cadastro/cadastro_samu.php";
                        var params = "samu=" + samu + "&convenio=" + convenio + "&cnpj=" + cnpj + "&telefone=" + telefone + "&contato=" + contato + "&email=" + email + "&endereco=" + endereco + "&complemento=" + complemento + "&cep=" + cep + "&cidade=" + cidade + "&uf=" + uf + "";
                        http.open("POST", url, true);

                        //Send the proper header information along with the request
                        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        http.send(params);

                        window.location.replace("cadastro_samu.php");
                    }
                    else{
                        document.getElementById('div-cnpj').setAttribute("class", "form-group col-sm-4 has-error");
                    }
                }
            }
            else{
                if (samu == "") {
                    document.getElementById('div-samu').setAttribute("class", "form-group col-sm-9 has-error");
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
            document.getElementById('endereco').value=(conteudo.logradouro);
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