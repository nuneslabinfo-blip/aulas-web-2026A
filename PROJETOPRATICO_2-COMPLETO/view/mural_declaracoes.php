<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural de Declarações</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main>
    <h1>Mural de Declarações e Mensagens</h1>
    
    <section class="acoes">
        <a href="listar_tarefas.php" class="btn">Voltar para Tarefas</a>
    </section>

    <h2>Nova Declaração para o Mural</h2>
    <form id="formMural" onsubmit="gravarDeclaracao(event)">
        <label>Autor / Remetente:</label>
        <input type="text" id="autor" required placeholder="Ex: Vinicius Nunes, Setor Técnico, etc.">

        <label>Mensagem / Conteúdo:</label>
        <textarea id="conteudo" required placeholder="Digite aqui a sua declaração ou mensagem para o mural..." style="width: 100%; min-height: 100px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-family: inherit; font-size: 14px; resize: vertical;"></textarea>

        <div class="botoes">
            <button type="submit">Publicar no Mural</button>
        </div>
    </form>

    <h2>Declarações Registradas</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 25%;">Autor</th>
                <th>Declaração / Mensagem</th>
                <th style="width: 15%;">Ações</th>
            </tr>
        </thead>
        <tbody id="tabelaCorpoMural">
            </tbody>
    </table>
</main>

<script>
    // URL do MockAPI para o Mural
    const URL_MURAL = 'https://6a3b272fe4a07f202e149937.mockapi.io/api/cep/v1/declaracoes';

    // FUNÇÃO: Listar Mensagens
    function listarDeclaracoes() {
        fetch(URL_MURAL)
            .then(response => response.json())
            .then(dados => {
                const tabela = document.getElementById('tabelaCorpoMural');
                tabela.innerHTML = ''; 

                dados.forEach(item => {
                    const linha = document.createElement('tr');
                    
                    // Tratando para usar 'nome' como Autor e 'banco' como o Conteúdo da mensagem no MockAPI
                    linha.innerHTML = `
                        <td><strong>${item.nome}</strong></td>
                        <td style="font-style: italic; color: #444;">"${item.banco}"</td>
                        <td>
                            <a href="#" onclick="excluirDeclaracao('${item.id}')" style="color: red; font-weight: bold;">Excluir</a>
                        </td>
                    `;
                    tabela.appendChild(linha);
                });
            })
            .catch(erro => console.log('Erro ao buscar mural:', erro));
    }

    // FUNÇÃO: Cadastrar Nova Mensagem
    function gravarDeclaracao(event) {
        event.preventDefault();

        const payload = {
            nome: document.getElementById('autor').value.trim(),
            banco: document.getElementById('conteudo').value.trim(),
            chavePix: "Mural",
            tipo: "Declaração"
        };

        fetch(URL_MURAL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (response.ok) {
                alert('Declaração publicada com sucesso!');
                document.getElementById('formMural').reset();
                listarDeclaracoes(); // Recarrega a tabela na hora
            } else {
                alert('Erro ao salvar no servidor.');
            }
        });
    }

    // FUNÇÃO: Excluir Mensagem
    function excluirDeclaracao(id) {
        if (confirm('Deseja realmente remover esta declaração do mural?')) {
            fetch(`${URL_MURAL}/${id}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    alert('Declaração removida.');
                    listarDeclaracoes();
                } else {
                    alert('Erro ao tentar excluir.');
                }
            });
        }
    }

    // Inicializa a listagem assim que carregar a página
    window.onload = listarDeclaracoes;
</script>

</body>
</html>