<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequisicaoController extends Controller
{
    public static function request($url, $method = "GET", $json = null)
    {
        if (empty($url) || is_null($url)) {
            return "A URL não pode ser vazia ou nula!";
        }

        $validMethods = ["GET", "POST", "PUT", "DELETE"];

        if (!in_array($method, $validMethods)) {
            return "Método inválido! Use um dos seguintes métodos: " . implode(', ', $validMethods);
        }

        if (($method === "POST" || $method === "PUT") && (empty($json) || is_null($json))) {
            return "O JSON não pode ser vazio ou nulo nos métodos POST/PUT!";
        }

        $token = env("GITHUB_TOKEN", "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");
        $headers = array(
            "Accept: application/vnd.github+json",
            "Authorization: Bearer $token",
            "X-GitHub-Api-Version: 2022-11-28",
            "User-Agent: natanvferreira",
        );

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
            return "Erro na requisição: " . curl_error($curl);
        }

        curl_close($curl);

        return $response;
    }
}
