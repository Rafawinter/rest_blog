<?php
	header('Content-Type: application/json; charset=utf-8');
	
	require_once '../../config/Conexao.php';
	require_once '../../models/Post.php';
	if($_SERVER['REQUEST_METHOD']=='DELETE'){

		$db = new Conexao();
		$con = $db->getConexao();

		$post = new Post($con);
		
		$dados = json_decode(file_get_contents("php://input"));	

		$post->id = $dados->id;

		if($post->delete()) {
			$res = array('mensagem'=>'Post deletada');
		} else {
			$res = array('mensagem'=>'Erro na deleção da Post');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem'=> 'método não suportado']);
	}
