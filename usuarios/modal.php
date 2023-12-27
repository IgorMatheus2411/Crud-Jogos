<!-- Modal de Delete-->

<div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <a class="close" style="font-size:30px;" data-dismiss="modal" href="index.php" aria-label="Fechar"><span aria-hidden="true"><i class="fa-solid fa-turn-up fa-rotate-270" style="color: #000000;"></i></span></a>
        <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
      </div>
      <div class="modal-body">
        Deseja realmente excluir este item?
      </div>
      <div class="modal-footer">
        
        <a id="confirm" class="btn btn-secondary" href="delete.php?id=<?php echo $usuario['id']; ?>" >Sim</a>
        <a id="cancel" class="btn btn-dark" href="index.php" data-dismiss="modal">N&atilde;o</a>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->
