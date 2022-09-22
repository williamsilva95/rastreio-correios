<?php

namespace App\WebService\Correios;

class Rastreio{

    /**
     * URL base dos serviços da API rastreio
     * @var string
     */
    const URL_BASE = 'https://proxyapp.correios.com.br';

    /**
     * Metodo responsavel por realizar as consultas dos endpoints dos correios
     * @param string $codigo
     * @return array
     */
    public static function consultarRastreio($codigo)
    {
        //inicia o curl
        $curl = curl_init();

        //configura a requisição do curl
        curl_setopt_array($curl, [
            CURLOPT_URL => self::URL_BASE.'/v1/sro-rastro/'.strtoupper($codigo),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //Response
        $response = curl_exec($curl);

        //Fecha a conexão do curl
        curl_close($curl);

        //Retorno dos dados em Array
        return json_decode($response, true);
    }
}