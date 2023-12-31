<?php
include("../config.php");
include(DBAPI);

$usuarios = null;
$usuario = null;

/**
 * Listagem de usuários
 */
function index()
{
    global $usuarios;
    if (!empty($_POST['users'])) {
        $usuarios = filter("usuarios", "nome like '" . $_POST['users'] . "%'");
    } else {
        $usuarios = find_all("usuarios");
    }
}



// Upload de imagens
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo)
{
    // Upload da foto
    try {
        $nomearquivo = basename($arquivo_destino); // nome do arquivo
        $uploadOk = 1;
        // Verificando se o arquivo é uma imagem
        if (isset($_POST["submit"])) {
            $check = getimagesize($nome_temp);
            if ($check !== false) {
                $_SESSION['message'] = "O arquivo é uma imagem - " . $check["mime"] . ".";
                $_SESSION['type'] = "info";
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                throw new Exception("O arquivo não é uma imagem!");
            }
        }

        // Verificando se o arquivo já existe na pasta
        if (file_exists($arquivo_destino)) {
            $uploadOk = 0;
            throw new Exception("Desculpe, o arquivo já existe!");
        }

        // Verificando se o tamanho do arquivo
        if ($tamanho_arquivo > 5000000) {
            $uploadOk = 0;
            throw new Exception("Desculpe, mas o arquivo é muito grande!");
        }

        // Allow certain file formats
        if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg"
            && $tipo_arquivo != "gif") {
            $uploadOk = 0;
            throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
        } else {
            // Se tudo estiver OK, tentamos fazer o upload do arquivo
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $arquivo_destino)) {
                $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
                $_SESSION['type'] = "success";
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

// Cadastro de Usuários
function add()
{
    if (!empty($_POST['usuario'])) {
        try {
            $usuario = $_POST['usuario'];
            if (!empty($_FILES["foto"]["name"])) {
                // Upload da foto
                $pasta_destino = "foto/"; // pasta onde ficam as foto
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); // Caminho completo até o arquivo que será gravado
                $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                $tamanho_arquivo = $_FILES["foto"]["size"]; // tamanho do arquivo em bytes
                $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo
                // Chamada da função upload para gravar a imagem
                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                $usuario['foto'] = $nomearquivo;
                // Criptografando a senha
                if (!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }
                $usuario['foto'] = $nomearquivo;
                save('usuarios', $usuario);
                header('Location: index.php');
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

// Atualização/Edição de Usuários
function edit()
{
    //$now = new DateTime("now");
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_POST['usuario'])) {
                $usuario = $_POST['usuario'];
            }
            // Criptografando a senha
            if (!empty($usuario['password'])) {
                $senha = criptografia($usuario['password']);
                $usuario['password'] = $senha;
            }

            if (!empty($_FILES["foto"]["name"])) {
                // Upload da foto
                $pasta_destino = "foto/"; // pasta onde ficam as foto
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); // Caminho completo até o arquivo que será gravado
                $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                $tamanho_arquivo = $_FILES["foto"]["size"]; // tamanho do arquivo em bytes
                $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo
                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                $usuario['foto'] = $nomearquivo;
                update('usuarios', $id, $usuario);
                header('Location: index.php');
            } else {
                global $usuario;
                $usuario = find("usuarios", $id);
            }
        } else {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

// Visualização de um Usuário
function view($id = null)
{
    global $usuario;
    $usuario = find("usuarios", $id);
}

// Exclusão de um Usuário
function delete($id = null)
{
    global $usuarios;
    $usuarios = remove("usuarios", $id);
    header("Location: index.php");
}
?>
