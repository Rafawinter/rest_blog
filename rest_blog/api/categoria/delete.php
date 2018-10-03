<?php
	header('Content-Type: application/json; charset=utf-8');
	
	require_once '../../config/Conexao.php';
	require_once '../../models/Categoria.php';
	if($_SERVER['REQUEST_METHOD']=='DELETE'){

		$db = new Conexao();
		$con = $db->getConexao();

		$categoria = new Categoria($con);
		
		$dados = json_decode(file_get_contents("php://input"));	

		$categoria->id = $dados->id;

		if($categoria->delete()) {
			$res = array('mensagem'=>'Categoria deletada');
		} else {
			$res = array('mensagem'=>'Erro na deleção da categoria');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem'=> 'método não suportado']);
	}
