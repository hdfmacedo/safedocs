# agents.md

## Diretrizes Básicas para os Agentes

* **Stack**: Sistema 100% em **PHP**. Frontend em javascript/php. 
* **Navegador**: Sistema será usado sempre em computadores. Nunca em celulares. Não se preocupar com uso no celular.
* **Separação de Camadas**: Parte visual totalmente isolada da lógica de negócio (ex.: MVC).
* **Banco de Dados**: Rodará com banco de dados SQL Server, mas isolar o mais que puder a parte de acesso ao BD do resto do MVC.
* **Interação**: Ao ser inserido uma nova informação no sistema, pode se carregar toda tela, simplificando o uso do sistema. Vai ser um sistema local, então sem problemas recarregar.
* **Tema**: **Dark Mode** como opção de escolha para o usuário (lá em cima). Sempre pensar em cores para agradar os 2 públicos.
* **Manutenibilidade**: Código fácil de manter por **I.A.** e humanos.
* **Estrutura**: Tudo organizado em **classes** e **métodos**.
* **Tamanho dos Métodos**: Funções com menos de?40 linhas, responsabilidade única (SRP).
* **Documentação**: Sempre atualize o README.md para explicar as funcionalidades do sistema.
* **Configuração**: Variáveis sensíveis em conf.env (ex.: segredo de sessão, caminho de dados).
* **Logs**: Toda interação do usuário no sistema gerar logs, para ser consultado em uma tela de logs que fica fazendo polling. Assim, dá pra manter mais fácil e descobrir bugs. Sempre logar: data/hora, usuário, qual URL que ele está, qual ação ele chamou, e uma mensagem amigável explicando tudo (em inglês).