<?php 
	include('functions.php');
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
		if ($_SESSION['user'] != "teste_adm") { // Verifica se o usuário é admin
			$_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
			$_SESSION['type'] = "danger";
			header("Location:" . BASEURL . "index.php");
		}
	} else {
		$_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
		$_SESSION['type'] = "danger";
		header("Location:" . BASEURL . "index.php");
	}
	
	include(HEADER_TEMPLATE);
	?>
	
	<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php else: ?>

<?php 
  require_once('functions.php'); 

  if(isset($_GET['id'])){
    try{
      $jogo = find("jogos", $_GET['id']);
      delete($_GET['id']);
      unlink("foto/".$jogo['foto']);
    }catch(Exception $e){
      $_SESSION['message'] = "Não foi possível realizar essa operação:" . $e -> getMessage();
    	$_SESSION['type'] = 'danger'; 
    }
  }
?>
<?php endif; ?>
