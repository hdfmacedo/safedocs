# SafeDocs

Sistema simples em PHP para controle de usuários.

## Funcionalidades
- Registro e login de usuários
- Tema claro/escuro com opção de alternar (botão com ícones de sol e lua)
- Menu lateral após login
- Usuários administradores podem gerenciar níveis de outros usuários
- Tela para trocar senha
- Registro da data/hora do último login (visível em Usuários)
- Menu Admin com gerenciamento de Linhas de Produto
- CRUD de Produtos vinculados a uma Linha de Produto
- Edição inline de usuários, linhas de produto e produtos com botões Editar, Salvar e Cancelar
- Todas as ações geram logs em `storage/app.log`
- Listagens utilizam cores alternadas e botões estilizados

Configure o acesso ao banco de dados em `conf.env`.

## Estrutura MVC
O código agora segue o padrão MVC. Os controladores ficam em `src/controllers`, as
views em `src/views` e os modelos continuam em `src`. O menu foi isolado em
`src/views/partials/menu.php`, facilitando a manutenção.
