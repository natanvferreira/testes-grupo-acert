<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequisicaoController extends Controller
{
    /**
     * Função que faz a requisição com base nos parâmetros passados
     *
     * @param string $url
     * @param string $method
     * @param string|null $json
     * @return string
     */
    public static function request(string $url, string $method = "GET", ?string $json = null)
    {
        if (empty($url) || is_null($url)) {
            return response()->json([
                "message" => "A URL não pode ser vazia ou nula!"
            ], 500)->content();
        }

        $validMethods = ["GET", "POST", "PUT", "DELETE"];

        if (!in_array($method, $validMethods)) {
            return response()->json([
                "message" => "Método inválido! Use um dos seguintes métodos: " . implode(', ', $validMethods)
            ], 500)->content();
        }

        if (($method === "POST" || $method === "PUT") && (empty($json) || is_null($json))) {
            return response()->json([
                "message" => "O JSON não pode ser vazio ou nulo nos métodos POST/PUT!"
            ], 500)->content();
        }

        $headers = array();
        $curl = curl_init($url);

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            )
        );

        if ($method === "POST" || $method === "PUT") {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
        }

        $response = curl_exec($curl);

        if ($response === false) {
            return response()->json([
                "message" => "Erro na requisição: " . curl_error($curl)
            ], 500)->content();
        }

        curl_close($curl);

        return $response;
    }
}
