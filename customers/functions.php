<?php

		include('../config.php');
		include(DBAPI);

		$customers = null;
		$customer = null;

		/**
		 *  Listagem de Clientes
		 */
		function index() {
			global $customers;
			$customers = find_all('customers');
		}
		
	?>
	<?php
	/**
	 *  Cadastro de Clientes
	 */
	function add() {

		if (!empty($_POST['customer'])) {
		  
		  $today =  new DateTime("now",new DateTimeZone("America/Sao_Paulo"));
		   
  
		  $customer = $_POST['customer'];
		  $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
		  
		  save("customers", $customer);
		  header('location: index.php');
		}
	  }
	?>
	<?php

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
	  global $customer;
	  $customer = find('customers', $id);
	}
	?>
	<?php
	
	 /**
	 *Formata datas
	 */
	function formatadata($data , $formato) {
	 $dt = new DateTime ($data, new DateTimeZone("America/Sao_Paulo"));
	 return $dt->format($formato);
	}

	
	
	 /**
	 *Formata CEP
	 */
	function formatacep($cep) {
	$cf = substr($cep,0,5) . "-" . substr($cep,5);
	 return $cf;
	}


	function formatamobile($mobile) {
		return substr($mobile, 0,0) . "(" . substr($mobile, 0, 2) . ") " . substr($mobile, 3, 5) . "-" . substr($mobile, 7);
	  }
	  
		  function formatatel($tel) {
			return substr($tel, 0,0) . "(" . substr($tel, 0, 2) . ") " . substr($tel, 2, 5) . "-" . substr($tel, 7);
	  }
  
	  function formatacpf($cpf) {
		  return substr($cpf, 0, 3) . "." . substr($cpf, 3,3) . "." . substr($cpf, 5,3) . "-" . substr($cpf, 9);
	  }
	
	/**
	*	Atualizacao/Edicao de Cliente
	*/

	function edit() {

		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	  
		if (isset($_GET['id'])) {
	  
		  $id = $_GET['id'];
	  
		  if (isset($_POST['customer'])) {
	  
			$customer = $_POST['customer'];
			$customer['modified'] = $now->format("Y-m-d H:i:s");
	  
			update('customers', $id, $customer);
			header('location: index.php');
		  } else {
	  
			global $customer;
			$customer = find('customers', $id);
		  } 
		} else {
		  header('location: index.php');
		}
	  }

	/**
	*  Exclusão de um Cliente
	*/
	function delete($id = null) {

		global $customer;
		$customer = remove('customers', $id);
  
		header('location: index.php');
	}

	
?>