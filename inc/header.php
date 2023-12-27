<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
			<title>CRUD com Bootstrap</title>
			<meta name="description" content="">
			<meta name="keywords" content="">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" href="css/estilo.css">

			<style>
				body {
					padding-top: 50px;
					padding-bottom: 20px;
				}
				.btn-light{
					background-color: #bbbbbb;
					border-color: #bbbbbb;
				}
				.btn-light:hover{
					background-color: #999999;
					border-color: #999999;
					color: #ffffff;
				}
				
			</style>
			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
	</head>
	<body>
			<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary  bg-dark border-bottom border-body" data-bs-theme="dark">
					  <div class="container-fluid">
						<a class="navbar-brand"  href="<?php echo BASEURL; ?>"><i class="fa-solid fa-house-chimney"></i>  CRUD</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						  <span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
						  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item dropdown">
							  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-users"></i> Clientes
							  </a>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo BASEURL;?>customers"><i class="fa-solid fa-users"></i> Gerenciar clientes</a></li>
								<li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo clientes</a></li>
							  </ul>
							</li>
							<li class="nav-item dropdown">
							  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Jogos
							  </a>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo BASEURL; ?>jogos">Gerenciar Jogos</a></li>
								<li><a class="dropdown-item" href="<?php echo BASEURL; ?>jogos/add.php">Novo Jogos</a></li>
							  </ul>
							</li>

							<?php if (isset($_SESSION['user'])): //Verifica se está logado ?>
								<?php if ($_SESSION['user'] == "admluiz"): //Verifica se está logado como admin ?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="fa-solid fa-user-lock"></i> Usuários
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="<?php echo BASEURL;?>usuarios/index.php"><i class="fa-solid fa-users-gear"></i> Gerenciar usuários</a></li>
										<li><a class="dropdown-item" href="<?php echo BASEURL;?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Novo usuário</a></li>
										</ul>
									</li>
								<?php endif; ?>
							<?php endif; ?> 
								<li class="nav-item d-flex">
									<?php if (isset($_SESSION['user'])): ?>
										<a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
											
											<i class="fa-solid fa-person-walking-arrow-right"></i>   Desconectar
										</a>
									<?php else: ?>
										<a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
											<i class="fa-solid fa-users"></i> Login
										</a>
									<?php endif; ?>
								</li>
								
						  </ul>
						</div>
					  </div>
		    </nav>
			
	    <main class="container">

