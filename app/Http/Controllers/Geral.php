<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;         # POSSIBILITA USAR O POST                   (FIXO)
use Illuminate\Support\Facades\Hash; # POSSIBILITA USAR O HASHING                (FIXO)
use Illuminate\Support\Facades\Mail; # POSSIBILITA USAR O EMAIL                  (FIXO)
use Session;                         # POSSIBILITA USAR A SESSÃO                 (FIXO)

use App\Mail\meuEmail;               # POSSIBILITA USAR A CLASSE DO EMAIL        (VARIÁVEL)
use App\Classes\minhaClasse;         # POSSIBILITA USAR A NOSSA PRÓPRIA CLASSE   (VARIÁVEL)

use App\Models\Aplicacao_model;      # POSSIBILITA USAR O MODEL                  (VARIÁVEL)

class Geral extends Controller
{

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function index()
	{
		# verifica se existe sessão
		if(!Session::has('id_usuario')){
			# apresenta o quadro inicial da página
			return redirect('/home');
		}

		# redireciona para o menu inicial da aplicação
		return redirect('/aplicacao');
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function home(){
		# apresenta o quadro de login
		if(!Session::has('id_usuario')){

			return view('home');
		}

		return redirect('/aplicacao');
	}
}
