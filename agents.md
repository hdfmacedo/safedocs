# agents.md

## Diretrizes B�sicas para os Agentes

* **Stack**: Sistema 100% em **PHP**. Frontend em javascript/php. 
* **Navegador**: Sistema ser� usado sempre em computadores. Nunca em celulares. N�o se preocupar com uso no celular.
* **Separa��o de Camadas**: Parte visual totalmente isolada da l�gica de neg�cio (ex.: MVC).
* **Banco de Dados**: Rodar� com banco de dados SQL Server, mas isolar o mais que puder a parte de acesso ao BD do resto do MVC.
* **Intera��o**: Ao ser inserido uma nova informa��o no sistema, pode se carregar toda tela, simplificando o uso do sistema. Vai ser um sistema local, ent�o sem problemas recarregar.
* **Tema**: **Dark�Mode** como op��o de escolha para o usu�rio (l� em cima). Sempre pensar em cores para agradar os 2 p�blicos.
* **Manutenibilidade**: C�digo f�cil de manter por **I.A.** e humanos.
* **Estrutura**: Tudo organizado em **classes** e **m�todos**.
* **Tamanho dos M�todos**: Fun��es com menos de?40�linhas, responsabilidade �nica (SRP).
* **Documenta��o**: Sempre atualize o README.md para explicar as funcionalidades do sistema.
* **Configura��o**: Vari�veis sens�veis em conf.env (ex.: segredo de sess�o, caminho de dados).
* **Logs**: Toda intera��o do usu�rio no sistema gerar logs, para ser consultado em uma tela de logs que fica fazendo polling. Assim, d� pra manter mais f�cil e descobrir bugs. Sempre logar: data/hora, usu�rio, qual URL que ele est�, qual a��o ele chamou, e uma mensagem amig�vel explicando tudo (em ingl�s).