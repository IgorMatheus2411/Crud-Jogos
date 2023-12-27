<?php

		include('../config.php');
		include(DBAPI);

		$jogos = null;
		$jogo = null;

		/**
		 *  Listagem de Clientes
		 */
		function index() {
			global $jogos;
			$jogos = find_all('jogos');
		}
		

	

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
	  global $jogo;
	  $jogo = find('jogos', $id);
	}
	
	
	 /**
	 *Formata datas
	 */
	function formatadata($data , $formato) {
	 $dt = new DateTime ($data, new DateTimeZone("America/Sao_Paulo"));
	 return $dt->format($formato);
	}

	
	
	 /**
	 
	*	Atualizacao/Edicao de Cliente
	*/

	function edit()
{
    //$now = new DateTime("now");
    try {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            
            if (isset($_POST['jogo'])) {
                $jogo = $_POST['jogo'];
            
                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "foto/"; // pasta onde ficam as foto
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); // Caminho completo até o arquivo que será gravado
                    $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                    $tamanho_arquivo = $_FILES["foto"]["size"]; // tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["name"]; // nome e caminho do arquivo no servidor
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo
               
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                    $jogo['foto'] = $nomearquivo;
                    
                } 

                update('jogos', $id, $jogo);
                header('Location: index.php');
            
            }else {
                global $jogo;
                $jogo = find("jogos", $id);
            }

        }else {
            header("Location: index.php");
        }

    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
	 *  Cadastro de Clientes
	 */
	function add()
{
    if (!empty($_POST['jogo'])) {
        try {
            $jogo = $_POST['jogo'];
            if (!empty($_FILES["foto"]["name"])) {
				
                // Upload da foto
                $pasta_destino = "foto/"; // pasta onde ficam as foto
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); // Caminho completo até o arquivo que será gravado
                $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                $tamanho_arquivo = $_FILES["foto"]["size"]; // tamanho do arquivo em bytes
                $nome_temp = $_FILES["foto"]["name"]; // nome e caminho do arquivo no servidor
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo
                // Chamada da função upload para gravar a imagem
                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                $jogo["foto"] = $nomearquivo;
				
            }

            save('jogos', $jogo);
            header('Location: index.php');
        }catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    } 
}


//UPLOAD


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


	/**
	*  Exclusão de um Cliente
	*/
	function delete($id = null) {

		global $jogo;
		$jogo = remove('jogos', $id);
  
		header('location: index.php');
	}

	
?>