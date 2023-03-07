<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;         # POSSIBILITA USAR O POST                   (FIXO)
use Illuminate\Support\Facades\Hash; # POSSIBILITA USAR O HASHING                (FIXO)
use Illuminate\Support\Facades\Mail; # POSSIBILITA USAR O EMAIL                  (FIXO)
use Session;                         # POSSIBILITA USAR A SESSÃO                 (FIXO)

use App\Mail\meuEmail;               # POSSIBILITA USAR A CLASSE DO EMAIL        (VARIÁVEL)
use App\Classes\nome_ficheiro;       # POSSIBILITA USAR A NOSSA PRÓPRIA CLASSE   (VARIÁVEL)

use App\Models\Aplicacao_model;      # POSSIBILITA USAR O MODEL                  (VARIÁVEL)
use App\Classes\Upload;
use App\Classes\GerarNome;
use App\Http\Requests\FotoRequest;

class Aplicacao extends Controller
{
	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function index()
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){

			return redirect('/home');
		}

		# apresenta o quadro inicial da aplicação
		$model_aplicacao = new Aplicacao_model;
		$dados['fotos'] = $model_aplicacao->todas_fotos_publicas();

		return view('aplicacao/pagina_inicial', $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	# adicionar uma nova foto
	public function adicionar_get($usuario = null)
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){
			
			return redirect('/home');
		}
		
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			# apresenta o formulario para carregar nova imagem
			$dados['erros'] = '';

			return view('aplicacao/adicionar_foto', $dados);
		}
	}
	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	# adicionar uma nova foto
	public function adicionar(FotoRequest $post, $usuario = null)
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){
			
			return redirect('/home');
		}
		
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			# apresenta o formulario para carregar nova imagem
			$dados['erros'] = '';

			return view('aplicacao/adicionar_foto', $dados);
		}

		# checar se veio a imagem na requisição
		if($post->hasFile('ficheiro_foto'))
		{
			# checar se não houve erro no upload da imagem
			if($post->ficheiro_foto->isValid())
			{
				#  path						                 local         disk
				$fotoPath = $post->ficheiro_foto->store("fotos/$usuario", 'public');

				# guarda os dados na base de dados
				$model_aplicacao = new Aplicacao_model;

				# verifica se é para colocar publica
				$publica = true;

				if($post->check_publica === null){

					$publica = false;
				}
				# guarda a informação na base de dados
				$model_aplicacao->guardar_foto($fotoPath, $publica);

				# indica que a fotografia foi carregada com sucesso
				return view('aplicacao/sucesso');
			}
			return view('aplicacao/erro');
		}
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function minhas()
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){

			return redirect('/home');
		}

		# apresenta o quadro com as fotografias do usuário ativo

		$model_aplicacao = new Aplicacao_model;

		# vai buscar todas as imagens que são públicas
		$dados['fotos'] = $model_aplicacao->buscar_fotos_usuario();
		return view('aplicacao/minhas', $dados);
	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function eliminar($id)
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){

			return redirect('/home');
		}

		$model_aplicacao = new Aplicacao_model;

		# elimina a foto
		$model_aplicacao->eliminar($id);

		// $this->minhas();
		return redirect('/minhas');

	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function privada($id)
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){

			return redirect('/home');
		}

		$model_aplicacao = new Aplicacao_model;

		# passa a foto de publica para privada
		$model_aplicacao->mudar_para_privada($id);

		// $this->minhas();
		return redirect('/minhas');

	}

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	public function publica($id)
	{
		# controla existencia de sessão
		if(!Session::has('id_usuario')){

			return redirect('/home');
		}

		$model_aplicacao = new Aplicacao_model;

		# passa a foto de privada para publica
		$model_aplicacao->mudar_para_publica($id);

		// $this->minhas();
		return redirect('/minhas');
	}
}
