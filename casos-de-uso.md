# Documento de Casos de Uso

## Lista dos Casos de Uso

 - [CDU 01](#CDU-01): Login.
 - [CDU 02](#CDU-02): Cadastro de usuário.
 - [CDU 03](#CDU-03): Pesquisa de perfil de usuário.
 - [CDU 04](#CDU-04): Gerenciamento de cadastros.
 - [CDU 05](#CDU-05): Listagem das postagens dos usuários.
 - [CDU 06](#CDU-06): Alteração de dados pessoais.


## Lista dos Atores

 - Administrador.
 - Usuário comum.

## Diagrama de Casos de Uso

![Diagrama de Casos de Uso](diagrama-exemplo.png)

## Descrição dos Casos de Uso

### CDU 01

Atores: Administradores e usuários comuns.

**Fluxo Principal**

1. O sistema disponibiliza um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão "Entrar".
4. O sistema valida o login e a senha do usuário.
5. O sistema inicia a sessão do usuário.
6. O sistema encaminha o usuário para a tela inicial do usuário.

**Fluxo Alternativo A**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão “Entrar”.
4. O sistema valida o login e a senha do usuário.
5. O sistema informa que o e-mail ou a senha não coincidem.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário clica no botão “Entrar” sem colocar o login ou a senha.
3. O sistema informa que o login ou a senha estão em branco.
4. O sistema retorna ao fluxo principal.

### CDU 02

Atores: Administradores e usuários comuns.

**Fluxo Principal**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário insere nome real, nome de usuário, email, senha e confirmar senha.
3. O usuário clica no botão “Cadastrar”.
4. O sistema valida as entradas.
5. O sistema marca o usuário como não administrador. 
6. O sistema armazena o usuário e informa ao usuário que a operação foi realizada com sucesso.
7. O sistema retorna ao início do caso de uso para cadastro de um novo usuário.

**Fluxo Alternativo A**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário insere nome real, nome de usuário, email, senha e confirmar senha.
3. O usuário clica no botão “Cadastrar”.
4. O sistema valida as entradas.
5. O sistema informa que já existe um usuário com o email ou nome do usuário fornecido.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário insere nome real, nome de usuário, email, senha e confirmar senha.
3. O usuário clica no botão “Cadastrar”.
4. O sistema valida as entradas.
5. O sistema informa que o campo senha e confirmar senha não coincidem.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo C**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário não digita em alguns dos campos obrigatórios.
3. O usuário clica no botão “Cadastrar”.
4. O sistema informa que alguns dos campos estão em branco.
5. O sistema retorna ao fluxo principal.

### CDU 03
 
Atores: Administradores e usuários comuns.

**Fluxo Principal**

1. O usuário clica na barra de pesquisa.
2. O usuário digite o nome de um usuário.
3. O usuário aperta a tecla "enter" ou no símbolo de pesquisar.
4. O sistema encaminha o usário para uma nova página com o link para o perfil dos usuário(s) encontrados.

**Fluxo Alternativo A**

1. O usuário clica na barra de pesquisa.
2. O usuário não digita nada.
3. O usuário aperta a tecla "enter" ou no símbolo de pesquisar.
4. O sistema informa ao usuário que a barra de pesquisa está vazia.
5. O sistema retorna ao fluxo principal.

### CDU 04

Atores: Administradores.

**Fluxo Principal**

1. No painel do administrador, o sistema disponibiliza uma lista com todos os usuários cadastrados.
2. O administrador seleciona um usuário da lista.
3. O administrador clica no botão "Conceder permissão", "Retirar permissão" ou "Excluir usuário".
4. O sistema confirma a decisão do administrador.
5. De acordo com o botão clicado, o sistema armazena a alteração de status de administrador ou exclui um certo usuário e informa que a operação foi realizada.

### CDU 05

Atores: Administradores e usuários comuns.

**Fluxo Principal**

1. Na página inicial do usuário, o sistema disponibiliza uma lista com todas as postagens deste usuários e dos seus amigos.
2. O usuário ou quem buscou, com o nome de usuário, o perfil consulta as postagens.

### CDU 06

Atores: Administradores e usuários comuns.

**Fluxo Principal**

1. 
