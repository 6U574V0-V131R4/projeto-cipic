@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	@include('./aplicacao/barra_usuario')

	<div class="container-fluid bg-secondary pt-5 pb-5">
		<h4 class="text-center pt-2 pb-2 text-white">Fotos públicas</h4>

		@if(count($fotos) === 0)

			<p class="text-center">Não foram encontradas fotos públicas.</p>

		@else

			<div class="row">

				@foreach($fotos as $foto)

					<div class="col-sm-3 col-12">
						<div class="p-1 foto-info">
							<p>
								{{ $foto->usuario }}
								<br/>
								<small>{{ $foto->data_hora }}</small>
							</p>
						</div>
						<div class="p-2 text-center">
							<img src={{ url("./storage/".$foto->foto) }} class="img-fluid">
						</div>
					</div>
				@endforeach

			</div>

		@endif
	</div>

@endsection