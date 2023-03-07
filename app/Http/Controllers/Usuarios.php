<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;         # POSSIBILITA USAR O POST                   (FIXO)
use Illuminate\Support\Facades\Hash; # POSSIBILITA USAR O HASHING                (FIXO)
use Illuminate\Support\Facades\Mail; # POSSIBILITA USAR O EMAIL                  (FIXO)
use Session;                         # POSSIBILITA USAR A SESSÃO                 (FIXO)

use App\Mail\meuEmail;               # POSSIBILITA USAR A CLASSE DO EMAIL        (VARIÁVEL)
use App\Classes\minhaClasse;         # POSSIBILITA USAR A NOSSA PRÓPRIA CLASSE   (VARIÁVEL)

use App\Models\Usuarios_model;       # POSSIBILITA USAR O MODEL                  (VARIÁVEL)

class Usuarios extends Controller
{	

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function login(Request $post)
	{
		# apresenta o quadro de login ou processa o post do login
		// if($post->method() != 'post'){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			# apresenta o formulario para fazer login
			return view('usuarios/login');
		}

		# tratamento do formulário

		# verifica se os campos foram preenchidos (validação do lado do servidor)
		if($post->text_usuario == '' || $post->text_senha == ''){
			# define mensagem de erro
			$dados['erro'] = 'Os dois campos são de preenchimento obrigatório.';
			# apresenta novamente o formulário
			return view('usuarios/login', $dados);
		}

		$model_usuario = new Usuarios_model;

		# verifica se o login foi válido
		if($model_usuario->verificar_login($post)){

			return redirect('/home');
			
		} else {
			$dados['erro'] = 'Usuário ou senha inválidos.';
			return view('usuarios/login', $dados);
		}
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function signup(Request $post)
	{
		# apresenta o formulario para criar um nono usuario ou trata o post do formulario
		// if($post->method() != 'post'){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			# apresenta o formulario para criação de novo usuário
			return view('usuarios/signup');
		}

		// validações - - - - - - - - - - - - - - - - - - - - - - - - -
		// verifica se as senhas correspodem
		if($post->text_pass_1 !== $post->text_pass_2){

			$dados['erro'] = 'As senhas não correspondem.';
			return view('usuarios/signup', $dados);
		}

		$model_usuario = new Usuarios_model;

		# verifica se já existe um usuário com o mesmo nome ou email
		if($model_usuario->signup_check_usuario($post)){

			$dados['erro'] = 'Já existe um usuário com o mesmo nome ou email.';
			return view('usuarios/signup', $dados);
		}

		# executa o signup
		$model_usuario->signup_criar_conta($post);
		# apresenta a informação de que foi criada uma nova conta de usuário
		return view('usuarios/signup_sucesso');

	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function logout()
	{
		# faz o logout do usuário
		if(Session::has('id_usuario')){
			# destroi os dados da sessão
			Session::flush();
			
			return redirect('/home');

		} else {

			return redirect('/home');
		}
	}
}
