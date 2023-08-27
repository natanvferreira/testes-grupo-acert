<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Rota inicial
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function home(): View
    {
        return view("index");
    }

    /**
     * Rota responsável por receber os ceps e retornar tantos os validos quantos os que nao estao validos
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getCeps(Request $request): View
    {
        $dados = [];
        $dados["erros"] = "";

        $request->ceps = str_replace("-", "", str_replace(" ", "", $request->ceps));

        if (strpos($request->ceps, ",")) {
            $request->ceps = explode(",", $request->ceps);
        } else {
            $request->ceps = (array)$request->ceps;
        }

        foreach ($request->ceps as $cep) {
            $dados[] = json_decode(RequisicaoController::request("https://viacep.com.br/ws/$cep/json/"), true);
        }

        foreach ($dados as $key => $value) {
            if (isset($value["erro"]) or is_null($value)) {
                $dados["erros"] .= "O cep {$request->ceps[$key]} não foi encontrado! - ";
            }
        }

        if (!empty($dados["erros"])) {
            $dados["erros"] = substr($dados["erros"], 0, -3);
        }

        return view("index", ["dados" => $dados]);
    }
}
