@extends('layouts.principal')
@section('title') Eliminar Cliente @endsection
@section('content')
	{!!\Basics::Breadcrumb(['Configuración','Cliente','Eliminar'])!!}
	<div class="col-8 offset-2">
		<div class="card">
			<div class="card-header">
				Eliminar Cliente
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					Esta acción borrará el registro de la base de datos. ¿Está segur@ que desea continuar?
				</div>
				<form action="{{route('config.clientes.delete.form')}}" id="form_clientes" method="POST" class="col-8 offset-2">
					@csrf
					<div class="form-group row">
						<label for="dni" class="col-3 col-form-label">Dni:</label>
						<div class="col-9">
							<input required type="text" name="dni" class="form-control" value="{{$listclientes->dni}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="nombres" class="col-3 col-form-label">Nombres:</label>
						<div class="col-9">
							<input required type="text" name="nombres" class="form-control" value="{{$listclientes->nombres}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="apellidos" class="col-3 col-form-label">Apellidos:</label>
						<div class="col-9">
							<input required type="text" name="apellidos" class="form-control" value="{{$listclientes->apellidos}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="direccion" class="col-3 col-form-label">Dirección:</label>
						<div class="col-9">
							<input required type="text" name="direccion" class="form-control" value="{{$listclientes->direccion}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="correo" class="col-3 col-form-label">Correo:</label>
						<div class="col-9">
							<input required type="text" name="correo" class="form-control" value="{{$listclientes->correo}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="tlf1" class="col-3 col-form-label">Telefono:</label>
						<div class="col-9">
							<input required type="text" name="tlf1" class="form-control" value="{{$listclientes->telefono}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="tlf2" class="col-3 col-form-label">Telefono oficina:</label>
						<div class="col-9">
							<input required type="text" name="tlf2" class="form-control" value="{{$listclientes->telefono_oficina}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="movil" class="col-3 col-form-label">Movil:</label>
						<div class="col-9">
							<input required type="text" name="movil" class="form-control" value="{{$listclientes->movil}}">
						</div>
					</div>
					<div class="btn-group d-flex justify-content-center">
						<a href="{{route('config.clientes')}}" class="btn btn-link mr-2">
							<i class="fa fa-arrow-left"></i> Volver
						</a>
						<button class="btn btn-danger">
							<i class="fa fa-times"></i> Si, continuar
						</button>
					</div>
					<input type="hidden" value="{{$listclientes->id}}" name="cliente_ide">
				</form>
			</div>
		</div>
	</div>
@endsection