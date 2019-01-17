@extends('layouts.principal')
@section('title') Eliminar Tipos de Factura @endsection
@section('content')
	{!!\Basics::Breadcrumb(['Configuración','Tipos de Factura','Eliminar'])!!}
	<div class="col-8 offset-2">
		<div class="card">
			<div class="card-header">
				Eliminar Tipos de Factura
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					Esta acción borrará el registro de la base de datos. ¿Está segur@ que desea continuar?
				</div>
				<form action="{{route('config.tiposdefacturas.delete.form')}}" id="form_bancos" method="POST" class="col-8 offset-2">
					@csrf
					<div class="form-group row">
						<label for="descripcion" class="col-3 col-form-label">Descripción:</label>
						<div class="col-9">
							<input readonly type="text" name="descripcion" class="form-control" value="{{$tiposdefacturas->descripcion}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-2 col-form-label">Status:</label>
						<div class="col-10">
							<select disabled name="status" id="status" class="custom-select">
								<option value="1" {{\Basics::selected(1,$tiposdefacturas->status)}}>Activo</option>
								<option value="0" {{\Basics::selected(0,$tiposdefacturas->status)}}>Inactivo</option>
							</select>
						</div>
					</div>
					<div class="btn-group d-flex justify-content-center">
						<a href="{{route('config.tiposdefacturas')}}" class="btn btn-link mr-2">
							<i class="fa fa-arrow-left"></i> Volver
						</a>
						<button class="btn btn-danger">
							<i class="fa fa-times"></i> Si, continuar
						</button>
					</div>
					<input type="hidden" value="{{$tiposdefacturas->id}}" name="tipfacturas_ide">
				</form>
			</div>
		</div>
	</div>
@endsection