@extends('layouts.principal')
@section('title') Eliminar Unidad de Medida @endsection
@section('content')
	{!!\Basics::Breadcrumb(['Configuración','Unidades de Medida','Eliminar'])!!}

	<div class="col-xs-6 col-md-6 offset-md-3 offset-xs-3">

		<div class="card">
			<div class="card-header">
				Eliminar Unidad de Medida
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					Esta acción borrará el registro de la base de datos. ¿Está segur@ que desea continuar?
				</div>
				<form action="{{route('config.unidadmedida.delete.form')}}" id="form_unidadmedida" method="POST" class="col-md-8 col-xs-6 col-form-label offset-md-2 offset-xs-3">
					@csrf
					<div class="form-group row">

						<label for="descripcion" class="col-md-4 col-xs-12 col-form-label">Descripci&oacute;n:</label>
						<div class="col-md-8 col-xs-12">
							<input disabled readonly type="text" name="descripcion" class="form-control" value="{{$unidmed->descripcion}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-md-4 col-xs-12 col-form-label">Status:</label>
						<div class="col-md-8 col-xs-12">

							<select disabled name="status" id="status" class="custom-select">
								<option value="1" {{\Basics::selected(1,$unidmed->status)}}>Activo</option>
								<option value="0" {{\Basics::selected(0,$unidmed->status)}}>Inactivo</option>
							</select>
						</div>
					</div>
					<div class="btn-group d-flex justify-content-center">
						<a href="{{route('config.unidadmedida')}}" class="btn btn-link mr-2">
							<i class="fa fa-arrow-left"></i> Volver
						</a>
						<button class="btn btn-danger">
							<i class="fa fa-times"></i> Si, continuar
						</button>
					</div>
					<input type="hidden" value="{{$unidmed->id}}" name="unidmed_id">
				</form>
			</div>
		</div>
	</div>
@endsection