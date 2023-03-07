@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	<div class="container mt-5 mb-5">

		<h3 class="alert alert-success text-center">Nova conta criada com sucesso</h3>

		<p class="text-center">Agora já pode começar a mostrar ao mundo como você é fotogênico!</p>

		<div class="text-center">

			<a href={{ route('paginaInicial') }} class="btn btn-primary">Voltar</a>

		</div>
	</div>

@endsection