@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	<div class="container-fluid pt-5 pb-5">

		<h3 class="text-center">Mostra como és lindo... por fora!</h3>
		<h5 class="text-center">CIPICS... porque o Mundo fica mais feio sem ti.</h5>

		<div class="text-center mt-5">

			<p>Se já tens conta faz o teu <a href={{ route('login') }}>Login</a>.</p>
			<p>Se ainda não tens conta, <a href={{ route('signup') }}>Cria uma nova conta</a>.</p>

		</div>
	</div>

@endsection