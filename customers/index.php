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
						<h2>Clientes</h2>
					</div>
					<div class="col-sm-6 text-end h2">
						<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
						<a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
					</div>
				</div>
			</header>

			<form name="filtro" action="index.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" maxlength="80" name="users" placeholder="Nome">
                                <button type="submit" class="btn btn-secondary">   <i class="fas fa-search"></i> Consultar</button>
                            </div>
                        </div>
                    </div>
            </form>

			<?php if (!empty($_SESSION['message'])) : ?>
				<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php clear_messages(); ?>
			<?php endif; ?>

			<hr>

			<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th width="30%">Nome</th>
					<th>CPF/CNPJ</th>
					<th>Telefone</th>
					<th>Atualizado em</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($customers) : ?>
			<?php foreach ($customers as $customer) : ?>
				<tr>
					<td><?php echo $customer['id']; ?></td>
					<td><?php echo $customer['name']; ?></td>
					<td><?php echo $customer['cpf_cnpj']; ?></td>
					<td><?php echo formatatel($customer['mobile']); ?></td>
					<td><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
					<td class="actions text-start">
						<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
						<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
						<a href="delete.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>">
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