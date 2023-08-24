<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function getUser(Request $request)
    {
        $dados = [];
        if (empty(env("GITHUB_TOKEN")) or is_null(env("GITHUB_TOKEN"))) {
            $dados["erros"] = "Token do Github não configurado! Favor colocar o seu token no arquivo .env";
        }

        $dados = json_decode(RequisicaoController::request("https://api.github.com/users/$request->nomeDoUsuario"), true);
        if (isset($dados["message"]) and $dados["message"] === "Not Found") {
            $dados["erros"] = "Usuário não encontrado!";
        }

        return view("index", ["dados" => $dados]);
    }
}
