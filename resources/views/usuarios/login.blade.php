@extends('layout/app')

@section('titulo')

    {{'CIPICS'}}

@stop

@section('conteudo')

	<div class="container pt-5 pb-5">
		<div class="row">
			<div class="col-sm-6 col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
				<div class="card p-4">
					<h3>Login</h3>
					<hr/>

					<form action={{ route('login_post') }} method="post">

						{{ csrf_field() }}

						{{-- erro --}}
						@if(isset($erro))
							<p class="alert alert-danger text-center">{{ $erro }}</p>
						@endif

						<div class="form-group">
							<input type="text" 
							class="form-control"
							name="text_usuario" 
							placeholder="Usuário"
							required>
						</div>

						<div class="form-group">
							<input type="password" 
							class="form-control"
							name="text_senha" 
							placeholder="Senha"
							required>
						</div>

						<div class="text-center">
							<a href={{ route('paginaInicial') }} class="btn btn-primary">Cancelar</a>
							<button type="submit" class="btn btn-primary">Entrar</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>

@endsection