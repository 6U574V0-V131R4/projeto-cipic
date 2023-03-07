@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	@include('./aplicacao/barra_usuario')

	<div class="container-fluid bg-secondary pt-5 pb-5">
		<h4 class="text-center pt-2 pb-3 text-white">Minhas fotos</h4>

		@if(count($fotos) === 0)

			<p class="text-center">Não tenho fotos na minha conta.</p>

		@else

			<!-- <pre><?php print_r($fotos) ?></pre> -->

			<div class="row">

				@foreach($fotos as $foto)

					<div class="col-sm-3 col-12 text-center">

						<!-- condiciona a apresentação das fotografias públicas/privadas -->

						<!-- FOTO PÚBLICA -->
						@if($foto->publica)

							<div class="foto-info-publica">
								<div class="row">
									<div class="col-8 text-left">
										<div class="p-2">
											{{ $foto->usuario }}
											<br/>
											<small>{{ $foto->data_hora }}</small>
										</div>
									</div>
									<div class="col-4 text-right">
										<div class="p-2">
											<a href={{ route("privada", $foto->id_foto) }} class="mr-3"><i class="fa fa-unlock-alt"></i></a>
											<a href={{ route("eliminar", $foto->id_foto) }}><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</div>
							</div>

						@else

							<!-- FOTO PRIVADA -->

							<div class="foto-info-privada">
								<div class="row">
									<div class="col-8 text-left">
										<div class="p-2">
											{{ $foto->usuario }}
											<br/>
											<small>{{ $foto->data_hora }}</small>
										</div>
									</div>
									<div class="col-4 text-right">
										<div class="p-2">
											<a href={{ route("publica", $foto->id_foto) }} class="mr-3"><i class="fa fa-lock"></i></a>
											<a href={{ route("eliminar", $foto->id_foto) }}><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</div>
							</div>

						@endif

						<div class="foto-size p-2">
							<img src={{ url("./storage/".$foto->foto) }} class="img-fluid">
						</div>

					</div>

				@endforeach

			</div>

		@endif
	</div>

@endsection