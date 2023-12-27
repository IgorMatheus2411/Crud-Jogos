<?php
    include('functions.php');
    index();
	if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if ($_SESSION['user'] != "teste_adm") { 
        if (!isset($_SESSION)) {
            session_start();
		}}}
	include(HEADER_TEMPLATE);
?>

            <link rel="stylesheet" href="css/estilo.css">
			<header class="mt-2 ">
				<div class="row">
					<div class="col-sm-6  tit">
						<h2>Usuários</h2>
					</div>
					<div class="col-sm-6 text-end h2">
						<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-tie"></i> Novo usuário</a>
						<a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
					</div>
				</div>
			</header>

			<?php if (!empty($_SESSION['message'])) : ?>
				<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $_SESSION['message']; ?>
				</div>
				
				<?php 
					clear_messages();
					endif; 
				?>

			<hr>

			<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th width="30%">Nome</th>
					<th>Usuário (Login)</th>
					<th>Foto</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($usuarios) : ?>
			<?php foreach ($usuarios as $usuario) : ?>
				<tr>
					<td><?php echo $usuario['id']; ?></td>
					<td><?php echo $usuario['nome']; ?></td>
					<td><?php echo $usuario['user']; ?></td>
					
					<td>
						<?php
							if (!empty($usuario['foto'])) {
								echo "<img src=\"foto/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
							} else {
								echo "<img src=\"foto/SemImagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
							}
						?>
					</td>
					<td class="actions text-start">
						<a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
						<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
						<a href="delete.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-user" data-usuario="<?php echo $usuario['id']; ?>">
							<i class="fa fa-trash"></i> Excluir
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
			</tbody>
			</table>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>