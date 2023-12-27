<?php 
	include('functions.php');
	if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
	  if ($_SESSION['user'] != "teste_adm") { 
	  if (!isset($_SESSION)) {
		  session_start();
	  }}}
	
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
			<h2 class="mt-2 tit">Novo Usuário</h2>

			<form action="add.php" method="post" enctype="multipart/form-data">
				
				<hr>
				<div class="row">
					<div class="form-group col-md-7">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="usuario['nome']" required placeholder="Nome">
				</div>

				<div class="form-group col-md-3">
					<label for="user">Usuário(login)</label>
					<input type="text" class="form-control" id="user" name="usuario['user']" required placeholder="User">
				</div>

				<div class="form-group col-md-2">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" name="usuario[password]" required placeholder="Senha">
				</div>

				<div class="row">
				<?php
						$foto = "";
						if(!empty($usuario['foto'])){
							$foto = $usuario['foto'];
						}else{
							$foto = "SemImagem.png";
						}
				?>
					<div class="form-group col-md-3">
						<label for="foto">Foto</label>
						<input type="file" class="form-control" id="inputFile" accept="image/*" name="foto" required>
					</div>

					<div class="form-group col-md-3">
						<label for="pre">Pré-Visualização</label>

						<img class="form-control shadow p-2 mb-2 bg-body rounded" id="imagePreview" src="#" alt="Preview da Imagem" style="display: none; max-width: 100%;">

					</div>
				</div>
				
				<div id="actions" class="mt-2 mb-2 row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
						<a href="index.php" class="btn btn-light"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
					</div>
				</div>
			</form>
			<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>



<script>
function previewImage() {
    var input = document.getElementById('inputFile');
    var preview = document.getElementById('imagePreview');

    var file = input.files[0];
    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
}

document.getElementById('inputFile').addEventListener('change', previewImage);




	$(document).ready(()=>{
		$("#inputFile").change(function(){
			const file = this.files[0];
			if(file){
				let reader = new FileReader();
				reader.onload = function (event){
					$("#imagePreview").attr("src", event.target.result);
				};
				reader.readeAsDataURL(file);
			}
		});
	});


</script>
