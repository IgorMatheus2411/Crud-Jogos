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
	


	include(HEADER_TEMPLATE);
	?>
	
	<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php else: ?>

<h2>Atualizar Jogo</h2>

<form action="edit.php?id=<?php echo $jogo['id']; ?>" method="post" enctype="multipart/form-data">
  <hr />
  <div class="row">
        <div class="form-group col-md-7">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="jogo['nome']" value="<?php echo $jogo['nome']; ?>">
        </div>

        <div class="form-group col-md-3">
          <label for="pla">Plataforma</label>
          <input type="text" class="form-control" name="jogo['plataforma']" value="<?php echo $jogo['plataforma']; ?>">
        </div>

        <div class="row">
        <div class="form-group col-md-5">
          <label for="desc">Descrição</label>
          <input type="text" class="form-control" name="jogo['descricao']" value="<?php echo $jogo['descricao']; ?>">
        </div>

        <div class="form-group col-md-2">
          <label for="dataCad">Data de Cadastro</label>
          <input type="date" class="form-control" name="jogo['data']" value="<?php echo $jogo['data']; ?>">
        </div>
  </div>

  
      


    <div class="row">
    <?php
            $foto = "";
            if(!empty($jogo['foto'])){
              $foto = $jogo['foto'];
            }else{
              $foto = "SemImagem.png";
            }
      ?>
        <div class="form-group col-md-3">
          <label for="inputFile">Foto</label>
          <input type="file" class="form-control" id="inputFile" accept="image/*" name="foto" >
        </div>

        <div class="form-group col-md-2">
          <label for="imagePreview">Pré-Visualização</label>

          <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imagePreview" src="#" alt="Preview da Imagem" style="display: none; max-width: 100%;">

        </div>
    </div>

    
  
    <div id="actions" class="row">
      <div class="col-md-12 ">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
        <a href="index.php" class="btn btn-default"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
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
