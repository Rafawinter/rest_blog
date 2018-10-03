<?php
	header('Content-Type: application/json');
	
	require_once '../../config/Conexao.php';
	require_once '../../models/Post.php';
	if($_SERVER['REQUEST_METHOD']=='POST'){

		$db = new Conexao();
		$con = $db->getConexao();

		$post = new Post($con);
		
		$dados = json_decode(file_get_contents("php://input"));	

		$post->titulo = $dados->titulo;
        $post->texto = $dados->texto;
        $post->id_categoria = $dados->id_categoria;
        $post->autor = $dados->autor;

		if($post->create()) {
			$res = array('mensagem','post criado');
		} else {
			$res = array('mensagem','Erro na criação do post');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem'=> 'método não suportado']);
	}
