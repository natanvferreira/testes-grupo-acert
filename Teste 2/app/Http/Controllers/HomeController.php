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
     * Rota responsável por receber o nome do usuário informado no front-end e retornar os dados do mesmo se tiver
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUser(Request $request): View
    {
        $dados = [];
        $dados["erros"] = "";

        $dados = json_decode(RequisicaoController::request("https://api.github.com/users/$request->nomeDoUsuario"), true);

        if (isset($dados["message"])) {
            switch ($dados["message"]) {
                case "Not Found":
                    $dados["erros"] = "Usuário não encontrado!";
                    break;

                case "Bad credentials":
                    $dados["erros"] = "Token não encontrado ou não válido!";
                    break;

                default:
                    $dados["erros"] = $dados["message"];
                    break;
            }
        }

        if (empty($dados["erros"])) {
            $sitesSemHttps = ['html_url', 'blog'];

            foreach ($sitesSemHttps as $siteSemHttps) {
                if (!preg_match('/^https:\/\//', $dados[$siteSemHttps])) {
                    $dados[$siteSemHttps] = 'https://' . $dados[$siteSemHttps];
                }
            }
        }

        return view("index", ["dados" => $dados]);
    }
}
