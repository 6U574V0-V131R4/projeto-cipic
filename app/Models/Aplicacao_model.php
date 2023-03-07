<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;   # POSSIBILITA USAR A QUERY SQL/BUILDER      (FIXO)
use Session;                         # POSSIBILITA USAR A SESSÃO                 (FIXO)

date_default_timezone_set('America/Sao_Paulo');

class Aplicacao_model
{

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function todas_fotos_publicas()
	{
		# vai buscar todas as imagens que são públicas

		$resultado = DB::select("SELECT * FROM fotos f JOIN usuarios u ON u.id_usuario = f.id_usuario AND f.publica = true");

		return $resultado;
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function guardar_foto($nome_foto, $publica)
	{
		# guarda a fotografia na base de dados (com o nome original)

		$dados = array(
			'id_usuario' => session('id_usuario'),
			'foto' 		 => $nome_foto,
			'data_hora'  => date('Y-m-d H:i:s'),
			'publica' 	 => $publica
		);

		DB::select("INSERT INTO fotos VALUES(0, :id_usuario, :foto, :data_hora, :publica)", $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function buscar_fotos_usuario()
	{
		# vai buscar as fotos do usuário com sessão ativa

		$session = array(
			'session_id_usuario' => session('id_usuario')
		);

		$resultado = DB::select("SELECT * FROM fotos f JOIN usuarios u ON u.id_usuario = f.id_usuario AND f.id_usuario = :session_id_usuario", $session);

		return $resultado;
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function mudar_para_privada($id)
	{
		# muda de publica para privada

		$dados = array(
			'id_foto' => $id,
			'publica' => false
		);

		DB::select("UPDATE fotos SET publica = :publica WHERE id_foto = :id_foto", $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function mudar_para_publica($id)
	{
		# muda de privada para publica

		$dados = array(
			'id_foto' => $id,
			'publica' => true
		);

		DB::select("UPDATE fotos SET publica = :publica WHERE id_foto = :id_foto", $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function eliminar($id)
	{
		# elimina a fotografia selecionada

		# vai buscar os dados da foto

		$dados = array(
			'id_foto' => $id
		);

		$resultado = DB::select("SELECT * FROM fotos WHERE id_foto = :id_foto", $dados);

		if(count($resultado) !== 0){

			# elimina da base de dados

			DB::select("DELETE FROM fotos WHERE id_foto = :id_foto", $dados);

			# elimina a fotografia da pasta
			$foto = $resultado[0]->foto;
			unlink("./storage/".$foto);
			# unlink é uma função nativa do PHP
		}
	}
}
