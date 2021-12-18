<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("location: ../../inicial/index.php");
    }
 
    require_once("../../funcao/conexao.php");
 
    $usuario = $_SESSION["usuario"];
    $tipoUsuario = $_SESSION["tipoUsuario"];

    if($tipoUsuario != 1){
        header("location: ../usuarioComum/pagPublicacao.php");
    }
 
    $PDO = CriarConexao();
 
    $sql = "SELECT nome FROM usuario WHERE usuario = :usuario";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":usuario",$usuario);
    $consulta->execute();
 
    $nome = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../../css/styleGeneral.css">
</head>
<body>

    <header class="py-3 mb-3 border-bottom shadow-sm" style="background-color:white;">
        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
            <a href="../usuarioComum/pagPublicacao.php" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none" id="dropdownNavLink" aria-expanded="false">
                <img src="../../imagens/logo_completa.png" height="64" width="256">
            </a>
            <div class="d-flex align-items-center">
                <form class="w-100 me-3" name="formPesquisaUsuario" action="../usuarioComum/pagPesquisaUsuario.php" method="GET">
                    <input type="search" class="form-control" placeholder="Pesquisar usuário..." name="nomeUsuarioPesquisado" aria-label="Search" title="Use apenas alfanuméricos com, no mínimo, três alfanuméricos" pattern="[A-Za-z1-9]{3,}" required>
                </form>

                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <strong><?php echo $_SESSION["usuario"];?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="../usuarioComum/pagAlterarPerfil.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../usuarioComum/pagPublicacao.php">Página inicial</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../funcao/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <div class="main">
        <div class="container">
            <div class="card text-center shadow-sm" id="edicaoUsuario">
                <div class="card-header text-center">
                    <h3>Usuários cadastrados</h3>
                </div>
                <div class="card-body text-center">
                    <?php
                        $sql = "SELECT nome, id FROM usuario";
                    ?>
                    <form action="edicaoUsuario.php" method="POST" id="formEdicaoUsuario" class="row g-3">
                        <div>
                            <div>
                                <div class="form-inline">
                                    <select name="idUsuarioEdicao" class="form-select rounded col-6 mx-auto">
                                        <?php foreach($PDO->query($sql) as $dadoUsuario){?>
                                        <option value="<?php echo $dadoUsuario[1];?>"><?php echo $dadoUsuario[0]; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer text-center">
                        <div class="row g-3">
                            <div class="col">
                                <input type="submit" name="btnConcederPermissao" class="col-md-4 rounded form-control styleButton" value="Promover a admin" onclick="mudarCorFundoBotao(this)">
                            </div>
                            <div class="col">
                                <input type="submit" name="btnRetirarPermissao"  class="col-md-4 rounded form-control styleButton" value="Retirar admin" onclick="mudarCorFundoBotao(this)">
                            </div>
                            <div class="col">
                                <input type="submit" name="btnEditarUsuario"  class="col-md-4 rounded form-control styleButton" value="Editar usuário" onclick="mudarCorFundoBotao(this)">
                            </div>
                            <div class="col">
                                <input type="submit" name="btnExcluirUsuario"  class="col-md-4 rounded form-control styleButton" value="Excluir usuário" onclick="mudarCorFundoBotao(this)">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../funcao/mudarCorFundo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
		/* function previewImagem(){
			var imagem = document.querySelector('input[name=]').files[0];
			var preview = document.querySelector('img[name=preView]');
				
			var reader = new FileReader();
				
			reader.onloadend = function () {
				preview.src = reader.result;
			}
				
			if(imagem){
				reader.readAsDataURL(imagem);
			}else{
				preview.src = "";
			}
        } */
    </script>
</body>
</html>