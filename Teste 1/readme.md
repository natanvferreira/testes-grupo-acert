## Funcionamento
A aplicação utiliza o método fetch do JavaScript para fazer uma requisição à API do ViaCEP.

A URL utilizada para a requisição é https://viacep.com.br/ws/cep/json/, onde *cep* você pode substituir por um CEP qualquer válido para buscar informações de endereço.

A resposta da requisição é verificada quanto à sua validade. Se a resposta não estiver no formato esperado ou se o status não for 200 (OK), a aplicação irá capturar o erro e exibi-lo no console.

Caso a resposta esteja correta, ela é convertida para JSON usando o método response.json(). Os dados do endereço são então exibidos no console.

## Resultados
Se a requisição for bem-sucedida (status 200), você verá no console os detalhes do endereço correspondente ao CEP fornecido.
Se a requisição não for bem-sucedida (status diferente de 200), você verá uma mensagem de erro no console indicando o motivo da falha na requisição.
