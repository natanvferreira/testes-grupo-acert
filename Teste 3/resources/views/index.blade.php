<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <form class="container" method="post" action="/getCeps">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="ceps" class="form-label">Digite o(s) CEP('s) que deseja buscar: </label>
                <input type="text" class="form-control" id="ceps" name="ceps"
                    placeholder="Digite os CEP's que deseja buscar." required>
                <div id="cepsDica" class="form-text">Exemplo de busca de mais de um CEP: 00000000, 11111111. Se
                    preferir também pode digitar: 00000-000, 00000-000</div>
            </div>
            <button type="submit" class="btn btn-success">Pesquisar</button>
        </form>

        @isset($dados)
            @if (!empty($dados['erros']))
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $dados['erros'] }}
                </div>
            @endif

            <div class="mt-2">
                <button type="button" class="btn btn-success" id="btnExportarCSV">Exportar para .csv</button>
                <button type="button" class="btn btn-danger" id="btnLimparTabela">Limpar tabela</button>
            </div>
            <div class="table-responsive mt-2">
                <table class="table" id="tabelaCEPs">
                    <thead>
                        <tr>
                            <th scope="col">CEP</th>
                            <th scope="col">Logradouro</th>
                            <th scope="col">Complemento</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">Localidade</th>
                            <th scope="col">UF</th>
                            <th scope="col">IBGE</th>
                            <th scope="col">GIA</th>
                            <th scope="col">DDD</th>
                            <th scope="col">SIAFI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $dado)
                            @if (isset($dado['cep']))
                                <tr>
                                    <th scope="row">{{ $dado['cep'] }}</th>
                                    <td>{{ $dado['logradouro'] }}</td>
                                    <td>{{ $dado['complemento'] }}</td>
                                    <td>{{ $dado['bairro'] }}</td>
                                    <td>{{ $dado['localidade'] }}</td>
                                    <td>{{ $dado['uf'] }}</td>
                                    <td>{{ $dado['ibge'] }}</td>
                                    <td>{{ $dado['gia'] }}</td>
                                    <td>{{ $dado['ddd'] }}</td>
                                    <td>{{ $dado['siafi'] }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>


        @endisset
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('btnLimparTabela').addEventListener('click', function() {
            var tabela = document.getElementById('tabelaCEPs');
            while (tabela.firstChild) {
                tabela.removeChild(tabela.firstChild);
            }
        });

        document.getElementById('btnExportarCSV').addEventListener('click', function() {
            var tabela = document.getElementById('tabelaCEPs');
            var linhas = tabela.querySelectorAll('tr');

            var csv = [];

            for (var i = 0; i < linhas.length; i++) {
                var linha = [];
                var colunas = linhas[i].querySelectorAll('td, th');

                for (var j = 0; j < colunas.length; j++) {
                    linha.push(colunas[j].innerText);
                }

                csv.push(linha.join(','));
            }

            var csvText = csv.join('\n');
            var blob = new Blob([csvText], {
                type: 'text/csv;charset=utf-8;'
            });

            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'ceps.csv';
            link.style.display = 'none';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    </script>
</body>

</html>
