# Documento de Casos de Uso

## Lista dos Casos de Uso

 - [CDU 01](#CDU-01): Login.
 - [CDU 02](#CDU-02): Cadastro de usuário.
 - [CDU 03](#CDU-03): Duis nec orci quis velit faucibus hendrerit tempus vel libero.


## Lista dos Atores

 - Administrador
 - Usuário comum

## Diagrama de Casos de Uso

![Diagrama de Casos de Uso](diagrama-exemplo.png)

## Descrição dos Casos de Uso

### CDU 01: Login

Atores: Administradores e usuários comuns

**Fluxo Principal**

1. O sistema disponibiliza um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha e clica no botão “Entrar”.
3. O sistema valida o login e a senha do usuário.
4. O sistema inicia a sessão do usuário.
5. O sistema encaminha o usuário para a tela inicial do usuário.

**Fluxo Alternativo A**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário insere seu e-mail ou usuário, bem como a senha e clica no botão “Entrar”.
3. O sistema valida o login e a senha do usuário.
4. O sistema informa que o e-mail ou a senha não coincidem.
5. O usuário corrige as informações de login ou senha e clica no botão “Entrar”. 
6. O sistema valida o login e a senha do usuário.
7. O sistema encaminha o usuário para a tela inicial do usuário.

**Fluxo Alternativo B**

1. O sistema apresenta um formulário com os campos e-mail ou usuário, bem como a senha.
2. O usuário clica no botão “Entrar” sem colocar o login ou a senha.
3. O sistema informa que o login ou a senha estão em branco.
4. O usuário insere o login ou senha no campo vazio e clica no botão “Entrar”. 
5. O sistema valida o login e a senha do usuário.
6. O sistema encaminha o usuário para a tela inicial do usuário.

### CDU 02: Cadastro de usuários

Atores: Administradores e usuários comuns

**Fluxo Principal**

1. O sistema apresenta um formulário com os campos do usuário a ser inserido.
2. O usuário insere nome real, nome de usuário, email, senha e confirmar senha.
3. O usuário clica no botão “Cadastrar”.
4. O sistema valida as entradas.
5. O sistema marca o usuário como não administrador. 
6. O sistema armazena o usuário e informa ao usuário que a operação foi realizada com sucesso.
7. O sistema retorna ao início do caso de uso para cadastro de um novo usuário.

**Fluxo Alternativo A**

1. Nulla elementum diam eu elementum rutrum.
2. Aenean scelerisque est at nunc ornare, ac condimentum justo sollicitudin.
3. Quisque eget risus ut est lacinia sollicitudin ac non diam.
4. Quisque ac nulla convallis, lobortis nibh ac, tristique enim.
5. Nulla ultricies metus nec risus mollis, interdum ultrices justo malesuada.

### CDU 03

Duis nec orci quis velit faucibus hendrerit tempus vel libero.

**Fluxo Principal**

1. Praesent interdum lectus sit amet augue tincidunt imperdiet.
2. Duis ac dolor vel nisi imperdiet vehicula et non sem.
3. Nunc imperdiet tortor consequat, lobortis purus non, interdum risus.

**Fluxo Alternativo A**

1. Aliquam efficitur arcu ac fermentum egestas.
2. Pellentesque ac diam vitae erat bibendum hendrerit.
3. Mauris sed purus sit amet lectus efficitur placerat et eu diam.
4. Aenean ullamcorper tellus quis nibh porttitor congue.
5. Phasellus laoreet erat eget condimentum dictum.
