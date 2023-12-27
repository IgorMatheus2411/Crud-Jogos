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
	
	view($_GET['id']);
	include(HEADER_TEMPLATE);
	?>
	
	<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php else: ?>

		<header>
			<h2>Usuário <?php echo $usuario['id'];?></h2>
		</header>
		<hr>

		<dl class="dl-horizontal pn">
			<dt>Nome:</dt>
			<dd><?php echo $usuario['nome']; ?></dd>

			<dt>Login:</dt>
			<dd><?php echo $usuario['user']; ?></dd>

			<dt>Senha:</dt>
			<dd><?php echo $usuario['password']; ?></dd>

			<dt>Foto:</dt>
			<dd>
				<?php
					if (!empty($usuario['foto'])) {
						echo "<img src=\"foto/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
					} else {
						echo "<img src=\"foto/SemImagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
					}
				?>
			</dd>
		</dl>


		<div id="actions" class="row">
			<div class="col-md-12">
				<?php if(empty($_SESSION['message'])) : ?>
			  	<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pencil"></i> Editar</a>
				<?php endif; ?>
				<a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</a>
			</div>
		</div>
		<?php clear_messages(); ?>
<?php endif; ?>
<?php include(FOOTER_TEMPLATE); ?>