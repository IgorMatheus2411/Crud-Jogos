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
		<h2 class="mt-2 pn">Cliente <?php echo $customer['id']; ?></h2>
		<hr>

		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?>
			</div>
		<?php endif; ?>

		<dl class="dl-horizontal pn">
			<dt>Nome / Razão Social:</dt>
			<dd><?php echo $customer['name']; ?></dd>

			<dt>CPF / CNPJ:</dt>
			<dd><?php echo $customer['cpf_cnpj']; ?></dd>

			<dt>Data de Nascimento:</dt>
			<dd><?php echo formatadata($customer['birthdate'], "d/m/Y - H:i:s"); ?></dd>
			 
		</dl>

		<dl class="dl-horizontal pn">
			<dt>Endereço:</dt>
			<dd><?php echo $customer['address']; ?></dd>

			<dt>Bairro:</dt>
			<dd><?php echo $customer['hood']; ?></dd>

			<dt>CEP:</dt>
			<dd><?php echo formatacep($customer['zip_code']); ?></dd>

			<dt>Data de Cadastro:</dt>
			<dd><?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?></dd>
			
			<dt>Alterado em:</dt>
			<dd><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></dd>
			
		</dl>

		<dl class="dl-horizontal pn">
			<dt>Cidade:</dt>
			<dd><?php echo $customer['city']; ?></dd>

			<dt>Telefone:</dt>
			<dd><?php echo formatatel($customer['phone']); ?></dd>

			<dt>Celular:</dt>
			<dd><?php echo formatamobile($customer['mobile']); ?></dd>

			<dt>Estado:</dt>
			<dd><?php echo $customer['state']; ?></dd>

			<dt>Inscrição Estadual:</dt>
			<dd><?php echo $customer['ie']; ?></dd>
		</dl>

		<div id="actions" class="row pn">
			<div class="col-md-12">
			  <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pencil"></i> Editar</a>
			  <a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</a>
			</div>
		</div>

<?php include(FOOTER_TEMPLATE); ?>