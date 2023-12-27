<?php
// Esse é o valida.php
include("../config.php");
require_once(DBAPI);
if (!isset($_SESSION)) {
    session_start();
}
include(HEADER_TEMPLATE);

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) && (empty($_POST['login']) || empty($_POST['senha']))){
    header("Location:" . BASEURL . "index.php");
    exit;
}

// Tenta se conectar a um banco de dados MySQL
$bd = open_database();
try {
    // Selecionando o Banco de dados que está ajustado na constante DB_NAME
    $bd->select_db(DB_NAME);

    // Pegando o login e senha digitado no form
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];

    // Testando para ver se o login e senha digitados no form não estão vazios
    if (!empty($usuario) && !empty($senha)) {
        // Pegando a senha digitada no form e criptografando ela para poder comparar
        // a função de criptografia FOI MOVIDA para o arquivo database.php (DBAPI)
        $senha = criptografia($_POST['senha']);

        // Validação do usuário/senha digitados
        $sql = "SELECT id, nome, user, password FROM usuarios WHERE (user = '" . $usuario . "') AND (password = '" . $senha . "') LIMIT 1";
        $query = $bd->query($sql);
            
        if ($query->num_rows > 0) {
            // Coletando os dados
            $dados = $query->fetch_assoc();
            //var_dump($dados);
            $id = $dados['id'];
            $nome = $dados['nome'];
            $user = $dados['user'];
            $password = $dados['password'];
            //var_dump($user);

            // Verifica se $user não está vazio
            if (!empty($user)) {
                $_SESSION['message'] = "Bem-vindo " . $nome;
                $_SESSION['type'] = "info";
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                $_SESSION['user'] = $user;
                //var_dump($user);
            } else {
                // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
                throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
                // Direciona para o index do site
                header("Location: " . BASEURL . "index.php");
            }
        } else {
            // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
            throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
        }
    } else {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
}
?>

<?php if (!empty($_SESSION['message'])): ?>
<div class="alert mt-5 alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>

<header>
    <a href="<?php echo BASEURL ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
</header>

<?php include(FOOTER_TEMPLATE); ?>
