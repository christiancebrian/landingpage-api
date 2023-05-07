<?php
    // Configuracao do registro para data e hora
    $dataHora = new DateTime();
    $dataHora->setTimezone(new DateTimeZone('America/Sao_Paulo'));
    $dataEnvio = $dataHora->format("d-m-Y");
    $horaEnvio = $dataHora->format("H:i:s");
    // Função envio API
    function sisApi($data, $hora, $nome, $email) {
        $dados = [
            'data' => $data,
            'hora' => $hora,
            'name' => $nome,
            'email' => $email
        ];
        $url  = "http://localhost/landingpage-api/api/rest/v1/creator/";
        $ch = curl_init($url);
        $payload = json_encode($dados);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    // Criando variavel
    // Pegando valores via POST
    if(isset($_POST['name']) && isset($_POST['email'])) {
        echo '<pre>'.print_r($_POST, true).'</pre>';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $retorno = sisApi($dataEnvio, $horaEnvio, $name, $email);
        $retorno = json_decode($retorno, true);
        echo '<pre>'.print_r($retorno, true).'</pre>';
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Javascript Data Layer -->
    <script type="text/javascript">
        // Serviço para Google Tag Manager ou Google Analytics 4
        window.dataLayer = window.dataLayer || []; // Verificando se dataLayer já existe e incrementa, caso contrário cria um novo
        window.dataLayer.push({
            'event': 'acesso', // Nome do evento
            'parametro1': 'valor1', // Nome e parametro 1
            'parametro2': 'valor2', // Nome e parametro 2
        });
    </script>
    <!-- Fim Javascript Data Layer -->
    <!--Include Google Tag Manager -->
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!--CSS Customized-->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Landing Page API</title>
    <!--Meta de informação-->
    <meta name="robots" content="all">
    <meta name="author" content="Christian Cebrian">
    <meta name="keywords" content="lading page, API, teste, desenvolvimento">
    <meta property="og:type" content="page">
    <meta property="og:url" content="https://localhost/landigpage-api/">
    <meta property="og:title" content="Landing Page API">
    <meta property="og:image" content="./assets/img/image.jpg">
    <meta property="og:description" content="Página de teste para formulário de leads com uso de API">
    <meta property="article:author" content="Christian Cebrian">
</head>

<body>
    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./assets/img/bootstrap-logo.svg" alt="Logo" width="30"
                        height="24" class="d-inline-block align-text-top">Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link 1</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Menu Suspenso</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Link 2</a></li>
                                <li><a class="dropdown-item" href="#">Link 3</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Link 4</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Desativado</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="palavra..." aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Busca</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <!--Seção 1-->
        <div class="container my-5 py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <!--Condição de tratamento da resposta da API-->
                    <?php if($retorno['status'] == 1): ?>
                        <div class="alert alert-success" role="alert">
                            <p><strong>Sucesso!</strong><br>Mensagem enviada com sucesso</p>
                        </div>
                    <?php elseif($retorno['status'] == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><strong>Erro!</strong><br>Problemas para enviar a mensagem</p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            <p><strong>Acesso inválido!</strong><br>Para informações nesta página, é necessário o prenchimento do formulário</p>
                        </div>
                        <div class="d-grid gap-2">
                            <p>Para preenchimento do formulário, clique no botão abaixo.</p>
                            <a name="btn-form" id="btn-form" class="btn btn-primary" href="http://localhost/landingpage-api/#formulario" role="button">Preencher Formulário</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div style="height: 100px;"></div>
    </main>
    <footer>
        <div class="container-fluid bg-primary">
            <div class="container px-2 py-5">
                <div class="row">
                    <div class="col-12 col-md-3 text-light">
                        <img src="./assets/img/logo-rodape.png" class="img-fluid rounded-top mx-auto" alt="Logo">
                    </div>
                    <div class="col-12 col-md-3 text-light">
                        <h4>Menu 1</h4>
                        <ul class="nav justify-content-start flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" aria-current="page">Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 3</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 text-light">
                        <h4>Menu 2</h4>
                        <ul class="nav justify-content-start flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" aria-current="page">Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 3</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 text-light">
                        <h4>Menu 3</h4>
                        <ul class="nav justify-content-start flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" aria-current="page">Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Link 3</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <copyright>
                    <div class="row mt-5">
                        <div class="col-12 text-center text-light">
                            <i class="fas fa-copyright">© 2023 Copyright Landing Page API - Todos os direitos
                                reservados.</i>
                        </div>
                    </div>
                </copyright>
            </div>
        </div>
    </footer>
    <!--Bootstrap Javascript-->
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>