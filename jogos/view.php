<?php 
	include('functions.php'); 
	view($_GET['id']);
	if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if ($_SESSION['user'] != "teste_adm") { 
        if (!isset($_SESSION)) {
            session_start();
		}}}
	include(HEADER_TEMPLATE);
?>

        <link rel="stylesheet" href="./css/estilo.css">
		<h2 class="mt-2 pn">Jogo: <?php echo $jogo['nome']; ?></h2>
		<hr>

		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?>
			</div>
		<?php endif; ?>

		<dl class="dl-horizontal pn">
			<dt>Nome:</dt>
			<dd><?php echo $jogo['nome']; ?></dd>

			<dt>Plataforma:</dt>
			<dd><?php echo $jogo['plataforma']; ?></dd>

			<dt>Descrição:</dt>
			<dd><?php echo $jogo['descricao']; ?></dd>

			<dt>Data de Cadastro:</dt>
			<dd><?php echo formatadata($jogo['data'], "d/m/Y - H:i:s"); ?></dd>

			<dt>Foto:</dt>
			<dd>
				<?php
					if (!empty($jogo['foto'])) {
						echo "<img src=\"foto/" . $jogo['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
					} else {
						echo "<img src=\"foto/SemImagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
					}
				?>
			</dd>
			 
		</dl>


		<div id="actions" class="row">
			<div class="col-md-12">
				<?php if(empty($_SESSION['message'])) : ?>
			  	<a href="edit.php?id=<?php echo $jogo['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pencil"></i> Editar</a>
				<?php endif; ?>
				<a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</a>
			</div>
		</div>
		<?php clear_messages(); ?>

<?php include(FOOTER_TEMPLATE); ?>