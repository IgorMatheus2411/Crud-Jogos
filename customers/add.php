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

	

	add();



	include(HEADER_TEMPLATE);

	?>

	

	<?php if (!empty($_SESSION['message'])): ?>

	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">

		<?php echo $_SESSION['message']; ?>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

	</div>

	<?php else: ?>

			<link rel="stylesheet" href="css/estilo.css">

			<h2 class="mt-2 tit">Novo Cliente</h2>



			<form action="add.php" method="post">

				

				<hr>

			<div class="row">

				<div class="form-group col-md-7">

					<label for="name">Nome / Razão Social</label>

					<input type="text" class="form-control" name="customer['name']" required placeholder="Nome / Razão Social">

				</div>



				<div class="form-group col-md-3">

					<label for="campo2">CNPJ / CPF</label>

					<input type="text" class="form-control" name="customer['cpf_cnpj']" required placeholder="CNPJ / CPF" maxlength="14">

				</div>



				<div class="form-group col-md-2">

					<label for="campo3">Data de Nascimento</label>

					<input type="date" class="form-control" name="customer['birthdate']" required>

				</div>

			</div>



			<div class="row">

				<div class="form-group col-md-5">

					<label for="campo1">Endereço</label>

					<input type="text" class="form-control" name="customer['address']" required placeholder="Endereço">

				</div>



				<div class="form-group col-md-3">

					<label for="campo2">Bairro</label>

					<input type="text" class="form-control" name="customer['hood']" required placeholder="Bairro">

				</div>



				<div class="form-group col-md-2">

					<label for="campo3">CEP</label>

					<input type="text" class="form-control" name="customer['zip_code']" required placeholder="CEP" maxlength="8">

				</div>



				<div class="form-group col-md-2">

					<label for="campo3">Data de Cadastro</label>

					<input type="text" class="form-control" name="customer['created']" disabled>

				</div>

			</div>



			<div class="row">

				<div class="form-group col-md-5">

					<label for="campo1">Município</label>

					<input type="text" class="form-control" name="customer['city']" required placeholder="Município">

				</div>



				<div class="form-group col-md-2">

					<label for="campo2">Telefone</label>

					<input type="text" class="form-control" name="customer['phone']" required  placeholder="Telefone" maxlength="11">

				</div>



				<div class="form-group col-md-2">

					<label for="campo3">Celular</label>

					<input type="text" class="form-control" name="customer['mobile']" required placeholder="Celular" maxlength="11">

				</div>



				<div class="form-group col-md-1">

					<label for="campo3">Estado</label>

					<input type="text" class="form-control" name="customer['state']" required placeholder="Estado" maxlength="2">

				</div>



				<div class="form-group col-md-2">

					<label for="campo3">Inscrição Estadual</label>

					<input type="text" class="form-control" name="customer['ie']" required placeholder="Inscrição Estadual" maxlength="9">

				</div>



				

			</div>



				<div id="actions" class="mt-2 row">

					<div class="col-md-12">

						<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>

						<a href="index.php" class="btn btn-light"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>

					</div>

				</div>

			</form>

			<?php endif; ?>



<?php include(FOOTER_TEMPLATE); ?>