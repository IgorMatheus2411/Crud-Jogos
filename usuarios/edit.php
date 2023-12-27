<?php 
	include('functions.php');
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
		if ($_SESSION['user'] != "teste_adm") { 
		if (!isset($_SESSION)) {
			session_start();
		}}}
	edit();

	include(HEADER_TEMPLATE);
	?>
	
	<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php else: ?>

<h2>Atualizar Usuário</h2>

<form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
  <hr />
  <div class="row">
    <div class="form-group col-md-8">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="usuario['nome']" value="<?php echo $usuario['nome']; ?>">
    </div>

    <div class="form-group col-md-4">
      <label for="user">Usuário (Login)</label>
      <input type="text" class="form-control" name="usuario['user']" value="<?php echo $usuario['user']; ?>">
    </div>

    <div class="form-group col-md-4">
      <label for="password">Senha</label>
      <input type="password" class="form-control" name="usuario['password']" value="">
    </div>
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
     <div class="form-group col-md-4">
      <label for="foto">Foto</label>
      <input type="file" class="form-control" id="foto" name="foto" value="foto/<?php echo $foto ?>" required>
    </div>
    <div class="form-group col-md-2">
			<label for="pre">Pré-Visualização</label>
			<img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="foto/<?php echo $foto ?>" alt="Foto do usuário">
		</div>
  </div>
  
  <div id="actions" class="row">
    <div class="col-md-12 ">
      <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
    </div>
  </div>
</form>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>

<script>

	$(document).ready(()=>{
		$("#foto").change(function(){
			const file = this.files[0];
			if(file){
				let reader = new FileReader();
				reader.onload = function (event){
					$("#imgPreview").attr("src", event.target.result);
				};
				reader.readeAsDataURL(file);
			}
		});
	});
</script>