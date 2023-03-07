@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	@include('./aplicacao/barra_usuario')

	<div class="container">
		<div class="row">
			<div class="col-sm-6 offset-sm-3 card p-4">
				
				@error('ficheiro_foto')
					<div class="text-center alert alert-danger">
						{{ $message }}
					</div>
				@enderror

				<h3>Adicionar foto</h3>
				<hr/>

				<form action={{ route('adicionar_post', session('usuario')) }} method="post" enctype="multipart/form-data">

					{{ csrf_field() }}

					<div class="form-group">
						<input type="file"
								class="form-control"
								name="ficheiro_foto"
								required>
					</div>

					<div class="form-check">
						<input type="checkbox"
								name="check_publica"
								id="check_publica"
								class="form-check-input"
								checked>
						<label class="form-check-label" for="check_publica">Definir como pública</label>
					</div>

					<div class="text-center mt-3">
						<a href={{ route('aplicacao') }} class="btn btn-primary">Cancelar</a>
						<button type="submit" class="btn btn-primary">Adicionar</button>
					</div>

				</form>

			</div>
		</div>
	</div>

@endsection