<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;   # POSSIBILITA USAR A QUERY SQL/BUILDER      (FIXO)
use Session;                         # POSSIBILITA USAR A SESSÃO                 (FIXO)

class Usuarios_model
{

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function signup_check_usuario($dados_post)
	{
		# verifica se já existe um usuário com o mesmo nome ou email

		$parametros = array(
			'usuario' => $dados_post->text_usuario,
			'email'	  => $dados_post->text_email
		);

		$resultado = DB::select("SELECT * FROM usuarios WHERE usuario = :usuario AND email = :email", $parametros); # get()

		return count($resultado) !== 0 ? true : false;
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function signup_criar_conta($dados_post)
	{
		# cria uma nova conta de usuário
		$dados = array(
			'usuario' => $dados_post->text_usuario,
			'senha'   => md5($dados_post->text_pass_1),
			'email'   => $dados_post->text_email
		);

		DB::select("INSERT INTO usuarios VALUES(0, :usuario, :senha, :email)", $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function verificar_login($dados_post)
	{
		# verifica se os dados inseridos são os corretos para o login
		$dados = array(
			'usuario' => $dados_post->text_usuario,
			'senha'   => md5($dados_post->text_senha)
		);

		$resultado = DB::select("SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha", $dados); # get()

		if(!count($resultado)){
            # login inválido
            return false;

        } else {
            # login válido

			# coloca os dados do usuário na sessão

			$dados_usuario = $resultado[0]; # first()

			Session::put('id_usuario', $dados_usuario->id_usuario);
            Session::put('usuario', $dados_usuario->usuario);
            Session::put('email', $dados_usuario->email);

			return true;
		}
	}
}
