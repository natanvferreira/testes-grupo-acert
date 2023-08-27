<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <form class="container" method="post" action="/getUser">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="nomeDoUsuario" class="form-label">Nome do usuário a ser buscado: </label>
                <input type="text" class="form-control" id="nomeDoUsuario" name="nomeDoUsuario"
                    placeholder="Digite aqui o usuário que deseja buscar." required>
            </div>
            <button type="submit" class="btn btn-success">Pesquisar</button>
        </form>

        @isset($dados)
            @if (!empty($dados['erros']))
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $dados['erros'] }}
                </div>
            @else
                <div class="card mt-2">
                    <div class="text-center mt-2">
                        <img src="{{ $dados['avatar_url'] }}" class="card-img-top img-fluid img-thumbnail" alt="..."
                            style="width: 18rem;">
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Login: {{ $dados['login'] }}</li>
                            <li class="list-group-item">Perfil no Github: <a href="{{ $dados['html_url'] }}"
                                    target="_blank">{{ $dados['html_url'] }}</a></li>
                            <li class="list-group-item">Tipo: {{ $dados['type'] }}</li>
                            <li class="list-group-item">É administrador: {{ $dados['site_admin'] === true ? 'Sim' : 'Não' }}
                            </li>
                            <li class="list-group-item">Nome: {{ $dados['name'] }}</li>
                            <li class="list-group-item">Empresa: {{ $dados['company'] }}</li>
                            <li class="list-group-item">Site: <a href="{{ $dados['blog'] }}"
                                    target="_blank">{{ $dados['blog'] }}</a></li>
                            <li class="list-group-item">Localização: {{ $dados['location'] }}</li>
                            <li class="list-group-item">E-mail: {{ $dados['email'] }}</li>
                            <li class="list-group-item">Biografia: {{ $dados['bio'] }}</li>
                            <li class="list-group-item">Usuário desde:
                                {{ date('d/m/Y H:i:s', strtotime($dados['created_at'])) }}</li>
                        </ul>
                    </div>
                </div>
            @endif
        @endisset
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
