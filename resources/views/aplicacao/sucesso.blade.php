@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	<div class="container mt-5 mb-5">

		<div class="text-center alert alert-success">
			A sua foto foi carregada com sucesso.
		</div>

		<div class="text-center">

			<a href={{ route('aplicacao') }} class="btn btn-primary">Voltar</a>

			<a href={{ route('adicionar') }} class="btn btn-primary">Adicionar outra foto</a>

		</div>
	</div>

@endsection