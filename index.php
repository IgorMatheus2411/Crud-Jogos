<?php
  require "config.php";
  include DBAPI; 
  if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if ($_SESSION['user'] != "teste_adm") { 
        if (!isset($_SESSION)) {
            session_start();
		}}}
 ?>


<?php include(HEADER_TEMPLATE); ?>
		<?php $db = open_database(); ?>
		
		<h1 class="pn">Controle de Cadastros</h1>
		<hr>
		<link rel="stylesheet" href="css/estilo.css">
		<?php if ($db) : ?>
		<div class="row d-flex justify-content-center ">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
					<a href="customers/add.php" class="btn btn-secondary">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-user-plus fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo Cliente</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
					<a href="customers/index.php" class="btn btn-light">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-users fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Clientes</p>
							</div>
						</div>
					</a>
				</div>
			</div>	
		<div class="row d-flex justify-content-center">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
					<a href="jogos/add.php" class="btn btn-secondary">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-user-plus fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo Jogo</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
					<a href="jogos/index.php" class="btn btn-light">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-users fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Jogos</p>
							</div>
						</div>
					</a>
				</div>
		</div>














			<?php else : ?>
			<div class="alert alert-danger" role="alert">
				<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
			</div>

		<?php endif; ?>

		<?php if (isset($_SESSION['user'])) : ?>
        <?php if ($_SESSION['user'] == "teste_adm") : ?>
            
                        



                            <div class="row" id="actions">
                                <div class="row d-flex justify-content-center ">

                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
                                        <a href="<?php echo BASEURL; ?>usuarios/add.php" class="btn btn-secondary">
                                        <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <i class="fa-solid fa-user-tie fa-5x"></i>
                                                </div>
                                                <div class="col-xs-12 text-center">
                                                    <p>Novo usuário</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-2 pndnt">
                                        <a href="<?php echo BASEURL; ?>usuarios" class="btn btn-light">
                                        <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <i class="fa-solid fa-users-gear fa-5x"></i>
                                                </div>
                                                <div class="col-xs-12 text-center">
                                                    <p>Usuários</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>





        <?php endif; ?>
		<?php else: ?>
			<?php if (!empty($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
					<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
					<?php echo $_SESSION['message']; ?></p>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php clear_messages(); ?>
			<?php endif; ?>
		<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>