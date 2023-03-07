<div class="container-fluid">
	<div class="d-flex">

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
				<i class="fa fa-cog"></i>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href={{ route('aplicacao') }}><i class="fa fa-home mr-2"></i>Página inicial</a>
				<a class="dropdown-item" href={{ route('adicionar') }}><i class="fa fa-plus-circle mr-2"></i>Adicionar Foto</a>
				<a class="dropdown-item" href={{ route('minhas') }}><i class="fa fa-cog mr-2"></i>As minhas fotos</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href={{ route('logout') }}><i class="fa fa-sign-out mr-2"></i>Logout</a>
			</div>
		</div>

		<div class="align-self-center ml-3">
			<h4>
				<i class="fa fa-user mr-3"></i><span>{{ session('usuario') }}</span>
			</h4>
		</div>
	</div>
	<hr/>
</div>