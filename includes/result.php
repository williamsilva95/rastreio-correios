<?php

use App\WebService\Correios\Rastreio;

//Itera os objetos retornados
foreach($response['objetos'] as $objeto){
    //Codigo do Objeto
    echo'<h2 class="mt-3">'.$objeto['codObjeto'].'</h2>';

    //Verifica os eventos do Objeto
    if(!isset($objeto['eventos'])){
        //Mensagem de erro
        $mensagem = $objeto['mensagem'] ?? 'Problemas ao buscar dados da API dos Correios';

        //Alerta no HTML
        echo'<div class="alert alert-warning">'.$mensagem.'</div>';

        //Pula para o proximo indice
        continue;
    }

    //Itera os eventos do objeto
    foreach($objeto['eventos'] as $evento){
        //Imagem
        $imagem = isset($evento['urlIcone']) ?
            '<div style="width:150px;">
                <img src="'.Rastreio::URL_BASE.$evento['urlIcone'].'">
            </div>' : '';

        //Cidade
        $cidade = isset($evento['unidade']['endereco']['cidade']) ? 
            $evento['unidade']['endereco']['cidade'].'/'.$evento['unidade']['endereco']['uf'] :
            null;

        //dados descritivos do evento
        $dados = [
            $evento['descricao'],
            $cidade,
            $evento['unidade']['nome'] ?? null
        ];
        //HTML completo
        echo'<div class="alert alert-light d-flex align-items-center">
            '.$imagem.'
            <div style="flex:1;">
                '.implode(' - ',array_filter($dados)).'
            </div>

            <div style="width:200px;">
                <span class="badge bg-dark">
                    '.date('d/m/Y à\s H:i:s', strtotime($evento['dtHrCriado'])).'
                </span>
            </div>
        </div>';
    }
}