<?php include "config.php"; ?>
<?php require DBAPI; ?>

<?php 

		try{
			$db = open_database(); 
			echo "<h1>Banco de Dados Conectado!</h1>";
		} catch (Exception $e){
			echo "<h1>ERRO: Não foi possível Conectar!</h1>";
			echo "<h4>" . $e->getMessage() . "</h4>";
		}
		
		
		/*
		$db = open_database(); 
		
		if ($db) {
			echo '<h1>Banco de Dados Conectado!</h1>';
		} else {
			echo '<h1>ERRO: Não foi possível Conectar!</h1>';
		}
		*/
?>