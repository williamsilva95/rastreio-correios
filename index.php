<?php

//Autoload do composer
require __DIR__.'/vendor/autoload.php';

//Dependencias do arquivo
use App\WebService\Correios\Rastreio;

//Executa a requisição na API dos Correios
$response = isset($_POST['codigo']) ? Rastreio::consultarRastreio($_POST['codigo']) : null;

//Cabeçalho da pagina
include __DIR__.'/includes/header.php';
//Rodapé da pagina
include __DIR__.'/includes/footer.php';
//Conteudo da pagina
include isset($response['objetos']) ? __DIR__.'/includes/result.php' : __DIR__.'/includes/form.php';