# Documento de Casos de Uso

## Lista dos Casos de Uso

 - [CDU 01](#CDU-01): Login.
 - [CDU 02](#CDU-02): Cadastro de usuário.
 - [CDU 03](#CDU-03): Pesquisa de perfil de usuário.
 - [CDU 04](#CDU-04): Gerenciamento de cadastros.
 - [CDU 05](#CDU-05): Listagem das postagens dos usuários.
 - [CDU 06](#CDU-06): Alteração de dados pessoais.
 - [CDU 07](#CDU-07): Publicação de postagens.
 - [CDU 08](#CDU-08): Exclusão de postagens.
 - [CDU 09](#CDU-09): Alteração de postagens.
 - [CDU 10](#CDU-10): Publicação de comentários.


## Lista dos Atores

 - Administrador.
 - Usuário comum.
 - Usuário (administrador e usuário comum)

## Diagrama de Casos de Uso

![Diagrama de Casos de Uso](diagrama-exemplo.png)

## Descrição dos Casos de Uso

### CDU 01

Atores: Usuário.

**Fluxo Principal**

1. O sistema disponibiliza um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão "Entrar".
4. O sistema valida o login e a senha do usuário.
5. O sistema inicia a sessão do usuário.
6. O sistema retorna ao início do caso de uso.

**Fluxo Alternativo A**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão “Entrar”.
4. O sistema valida o login e a senha do usuário.
5. O sistema informa que o e-mail ou a senha não coincidem.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão “Entrar” sem colocar o login ou a senha.
4. O sistema informa que o login ou a senha estão em branco.
5. O sistema retorna ao fluxo principal.

**Fluxo Alternativo C**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha.
3. O usuário clica no botão “Entrar”.
4. O sistema informa que o formato de alguns campos está incorreto.
5. O sistema retorna ao fluxo principal.

### CDU 02

Atores: Usuário.

**Fluxo Principal**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário insere nome real, nome de usuário, email, senha e confirmar senha.
3. O usuário clica no botão “Cadastrar”.
4. O sistema valida as entradas.
5. O sistema marca o usuário como não administrador. 
6. O sistema armazena o usuário no banco de dados.
7. O sistema informa ao usuário que a operação foi realizada com sucesso.
8. O sistema retorna ao início do caso de uso.

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
 
Atores: Usuário.

**Fluxo Principal**

1. O usuário clica na barra de pesquisa.
2. O usuário digite o nome de um usuário.
3. O usuário aperta a tecla "enter" ou no símbolo de pesquisar.
4. O sistema encaminha o usário para uma nova página com o link para o perfil dos usuário(s) encontrados no banco de dados.

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
5. De acordo com o botão clicado, o sistema armazena a alteração de status de administrador ou exclui um certo usuário no banco de dados.
6. O sistema informa ao usuário que a operação foi realizada com sucesso.
7. O sistema retorna ao início do caso de uso.

### CDU 05

Atores: Usuário.

**Fluxo Principal**

1. Na página inicial do usuário, o sistema disponibiliza uma lista com todas as postagens deste usuários e dos seus amigos.
2. O usuário ou quem buscou, com o nome de usuário, o perfil consulta as postagens.

### CDU 06

Atores: Usuários.

**Fluxo Principal**

1. Na página de perfil do usuário, o sistema disponibiliza um formulário com os campos de dados pessoais do usuário.
2. O usuário altera alguns dos campos de dados pessoais que o interessa.
3. O usuário clica em "Salvar".
4. O sistema valida as entradas.
5. O sistema armazena as alterações dos dados pessoais no banco de dados.
6. O sistema informa ao usuário que a operação foi realizada com sucesso.
7. O sistema retorna ao início do caso de uso.

**Fluxo Alternativo A**

1. Na página de perfil do usuário, o sistema disponibiliza um formulário com os campos de dados pessoais do usuário.
2. O usuário altera alguns dos campos de dados pessoais que o interessa.
3. O usuário clica em "Salvar".
4. O sistema valida as entradas.
5. O sistema informa que já existe um usuário com o email ou nome do usuário fornecido.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. Na página de perfil do usuário, o sistema disponibiliza um formulário com os campos de dados pessoais do usuário.
2. O usuário altera alguns dos campos de dados pessoais que o interessa.
3. O usuário clica em "Salvar".
4. O sistema valida as entradas.
5. O sistema informa que o campo senha e confirmar senha não coincidem.
6. O sistema retorna ao fluxo principal.

**Fluxo Alternativo C**

1. Na página de perfil do usuário, o sistema disponibiliza um formulário com os campos de dados pessoais do usuário.
2. O usuário altera alguns dos campos de dados pessoais que o interessa.
3. O usuário clica em "Salvar".
4. O sistema informa que alguns dos campos obrigatórios estão em branco.
5. O sistema retorna ao fluxo principal.

**Fluxo Alternativo D**
1. Na página de perfil do usuário, o sistema disponibiliza um formulário com os campos de dados pessoais do usuário.
2. O usuário altera alguns dos campos de dados pessoais que o interessa.
3. O usuário clica em "Salvar".
4. O sistema informa que o formato de alguns campos está incorreto.
5. O sistema retorna ao fluxo principal.

### CDU 07

Atores: Usuário.

**Fluxo Principal**

1. Na tela inicial do usuário, o sistema disponibiliza um cartão com um campo para texto e um ícone de câmera para carregar imagens.
2. O usuário digita algo no campo de texto e, se quiser, carrega uma imagem clicando no ícone de câmera.
3. O usuário clica em "Publicar".
4. O sistema valida a entrada.
5. O sistema armazena a postagem no banco de dados.
6. O sistema coloca esta postagem na lista de postagens deste e dos seus amigos.
7. O sistema informa que a postagem foi publicada com sucesso.

**Fluxo Alternativo A**

1. Na tela inicial do usuário, o sistema disponibiliza um cartão com um campo para texto e um ícone de câmera para carregar imagens.
2. O usuário deixa o campo de texto em branco.
3. O usuário clica em "Publicar".
4. O sistema informa que é obrigatório preencher o campo de texto.
5. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. Na tela inicial do usuário, o sistema disponibiliza um cartão com um campo para texto e um ícone de câmera para carregar imagens.
2. O usuário digita algo no campo de texto e, se quiser, carrega uma imagem clicando no ícone de câmera.
3. O usuário clica em "Publicar".
4. O sistema informa que o usuário excedeu o número máximo de 1000 caracteres no campo texto.
5. O sistema retorna ao fluxo principal.

### CDU 08

Atores: Administrador e usuário comum.

**Fluxo Principal**

1. Na parte direita do menu da postagem presente na lista de postagens, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica na opção "Excluir postagem".
4. O sistema exclui a postagem do banco de dados.
5. O sistema informa que a postagem em questão foi excluída com sucesso.

### CDU 09

Atores: Usuário.

**Fluxo Principal**

1. Na parte direita do menu da postagem presente na lista de postagens, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar postagem".
4. O sistema encaminha o usuário para uma página com tal postagem passível de edição.
5. O usuário altera o texto e, se quiser, carrega uma imagem clicando no ícone de câmera.
6. O usuário clica em "Publicar".
7. O sistema valida a entrada.
8. O sistema armazena a postagem no banco de dados.
9. O sistema coloca esta postagem na lista de postagens deste e dos seus amigos.
10. O sistema informa que a postagem foi alterada com sucesso.

**Fluxo Alternativo A**

1. Na parte direita do menu da postagem presente na lista de postagens, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar postagem".
4. O sistema encaminha o usuário para uma página com tal postagem passível de edição.
5. O usuário não preenche o campo texto.
6. O usuário clica em "Publicar".
7. O sistema informa que é obrigatório preencher o campo de texto.
8. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. Na parte direita do menu da postagem presente na lista de postagens, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar postagem".
4. O sistema encaminha o usuário para uma página com tal postagem passível de edição.
5. O usuário altera o texto e, se quiser, carrega uma imagem clicando no ícone de câmera.
6. O usuário clica em "Publicar".
7. O sistema informa que o usuário excedeu o número máximo de 1000 caracteres no campo texto.
8. O sistema retorna ao fluxo principal.

### CDU 10

Atores: Usuário.

**Fluxo Principal**

1. Em uma determinada postagem, o sistema disponibiliza, abaixo do texto da postagem, um campo para os amigos do autor poderem comentar.
2. O usuário digita algo no campo de texto.
3. O usuário clica em "Comentar".
4. O sistema valida a entrada.
5. O sistema armazena o comentário no banco de dados.
6. O sistema coloca este comentário na lista de comentários daquela postagem.
7. O sistema informa que o comentário foi publicado com sucesso.

**Fluxo Alternativo A**

1. Em uma determinada postagem, o sistema disponibiliza, abaixo do texto da postagem, um campo para o autor e os amigos deste poderem comentar.
2. O usuário deixa o campo de texto em branco.
3. O usuário clica em "Comentar".
4. O sistema informa que é obrigatório preencher o campo de texto.
5. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. Em uma determinada postagem, o sistema disponibiliza, abaixo do texto da postagem, um campo para o autor e os amigos deste poderem comentar.
2. O usuário deixa o campo de texto em branco.
3. O usuário clica em "Comentar".
4. O sistema informa que o usuário excedeu o número máximo de 400 caracteres no campo texto.
5. O sistema retorna ao fluxo principal.

### CDU 11

Atores: Administrador e usuário comum.

**Fluxo Principal**

1. No parte direita do menu do comentário de uma postagem, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica na opção "Excluir comentário".
4. O sistema exclui o comentário do banco de dados.
5. O sistema informa que o comentário em questão foi excluído com sucesso.

### CDU 12

Atores: Usuário.

**Fluxo Principal**

1. Na parte direita do menu do comentário de uma postagem, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar comentário".
4. O sistema encaminha o usuário para uma página com tal comentário passível de edição.
5. O usuário altera o texto.
6. O usuário clica em "Comentar".
7. O sistema valida a entrada.
8. O sistema armazena o comentário no banco de dados.
9. O sistema coloca este comentário na lista de comentários daquela postagem.
10. O sistema informa que o comentário foi alterado com sucesso.

**Fluxo Alternativo A**

1. Na parte direita do menu do comentário de uma postagem, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar comentário".
4. O sistema encaminha o usuário para uma página com tal comentário passível de edição.
5. O usuário não preenche o campo texto.
6. O usuário clica em "Comentar".
7. O sistema informa que é obrigatório preencher o campo de texto.
8. O sistema retorna ao fluxo principal.

**Fluxo Alternativo B**

1. Na parte direita do menu do comentário de uma postagem, o sistema disponibilizará um ícone de três pontos verticais.
2. O usuário clica no ícone citado.
3. O usuário clica em "Alterar comentário".
4. O sistema encaminha o usuário para uma página com tal comentário passível de edição.
5. O usuário altera o texto.
6. O usuário clica em "Comentar".
7. O sistema informa que o usuário excedeu o número máximo de 400 caracteres no campo texto.
8. O sistema retorna ao fluxo principal.
