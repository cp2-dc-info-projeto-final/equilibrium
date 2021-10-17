# Documento de Requisitos

## Requisitos Funcionais

### RF 01

O sistema deverá possuir autenticação e controle de acesso com utilização de criptografia.

### RF 02

O sistema deverá permitir a inclusão, exclusão, alteração e consulta de clientes e administradores.

### RF 03

O sistema deverá permitir, através da chave de busca, a pesquisa do perfil de um determinado usuário.

### RF 04

O sistema deverá permitir a inclusão, exclusão e alteração de postagens.

### RF 05

O sistema deverá permitir a inclusão, exclusão e alteração de comentários.

### RF 06

O sistema deverá exibir as postagens dos usuários (timeline).

### RF 07

O sistema deverá permitir que o usuário comente em uma postagem. Os comentários desta postagem deverão ser exibidos.

### RF 08

O sistema deverá permitir que o usuário curta uma postagem.

### RF 09

O sistema deverá diferenciar administradores de usuários comuns.

### RF 10

O sistema deverá validar todas as entradas de dados no sistema.

### RF 11

Para cada usuário, o sistema deverá ser capaz de armazenar o id, email, caminho da foto de perfil, nome, senha, nome de usuário, bem como um indicador sinalizando se o usuário é administrador ou não.

### RF 12

Para cada postagem, o sistema deverá ser capaz de armazenar o id, id do usuário que fez a postagem, data da postagem, caminho da imagem e descricao.

### RF 13

Para cada comentário, o sistema deverá ser capaz de armazenar o id, id do usuário que fez o comentário, id da postagem que o comentário está vinculado, data da postagem e texto.

## Requisitos Não-Funcionais

### RNF 01
O sistema deverá ser feito a partir da linguagem PHP.

### RNF 02
O sistema deverá utilizar o SESSION do PHP no controle de usuários.

### RNF 03
O sistema deverá estar em uma plataforma web.

### RNF 04
O banco de dados do sistema deverá ser feito sobre o SGBD MySQL

### RNF 05
O sistema deverá ser responsivo ao possuir o front-end nas tecnologias CSS e o framework Bootstrap.
