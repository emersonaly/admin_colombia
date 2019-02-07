{!!\Basics::modalHeader(null,'clientes','Agregar Cliente - Modo Rápido')!!}
<div class="modal-body">
	<div id="errors-modal"></div>
	<form action="{{route('config.cliente.insert.form.fast')}}" id="form_clientes_fast" method="POST" class="col-10 offset-1">
		@csrf
		<div class="form-group row">
			<label for="dni" class="col-12 col-md-3 col-form-label">Dni:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="dni" name="dni" class="form-control" value="{{old('dni')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="nombres" class="col-12 col-md-3 col-form-label">Nombres:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="nombres" name="nombres" class="form-control" value="{{old('nombres')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="apellidos" class="col-12 col-md-3 col-form-label">Apellidos:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="apellidos" name="apellidos" class="form-control" value="{{old('apellidos')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="direccion" class="col-12 col-md-3 col-form-label">Direcci&oacute;n:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="direccion" name="direccion" class="form-control" value="{{old('direccion')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="correo" class="col-12 col-md-3 col-form-label">Correo:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="correo" name="correo" class="form-control" value="{{old('correo')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="tlf1" class="col-12 col-md-3 col-form-label">Teléfono:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="tlf1" name="tlf1" class="form-control" value="{{old('tlf1')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="tlf2" class="col-12 col-md-3 col-form-label">Teléfono oficina:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="tlf2" name="tlf2" class="form-control" value="{{old('tlf2')}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="movil" class="col-12 col-md-3 col-form-label">Móvil:</label>
			<div class="col-12 col-md-9">
				<input required type="text" id="movil" name="movil" class="form-control" value="{{old('movil')}}">
			</div>
		</div>

		
		<div class="btn-group d-flex justify-content-center">
			<button type="button" id="submit-clientes-form" class="btn btn-primary">
				<i class="fa fa-save"></i> Crear
			</button>
		</div>
	</form>
</div>
{!!\Basics::modalFooter()!!}

@section('scripts')
	@parent
	<script type="text/javascript">
		j(function(){
			j('#submit-clientes-form').on('click',function(e){
				j.ajax({
	                type: "POST",
	                dataType: 'json',
	                url: j('#form_clientes_fast').attr('action'),
	                data: j('#form_clientes_fast').serialize(),
	                success: function (data) {
	                	j('#errors-modal').fadeOut();
	                	var comp_1 = '<option value=""></option>';
	                	var respo = "";
	                	var selected = "";
	                	for(i in data) {
	                		selected = (data[i]['dni']==j('#dni').val()) ? 'selected' : "";
	                		respo += '<option value="'+data[i]['id']+'" '+selected+'>'+data[i]['nombres']+' '+data[i]['apellidos']+' - '+data[i]['dni']+'</option>';
	                	}
	                	j('#client_id').html(comp_1+respo);
	                	j('#form_clientes_fast').each(function(){
	                		this.reset()
	                	})
	                	$('#clientes').modal('hide');
	                	j('#client_id').trigger("chosen:updated");
	                },
	                error: function (xhr) {
	                	var result = "";
	                	if(xhr.responseJSON.errors) {
	                		for(i in xhr.responseJSON.errors) {
	                			result += "<li>"+xhr.responseJSON.errors[i]+"</li>"
	                		}
	                	}
	                    j('#errors-modal').html('<div class="alert alert-danger alert-dismissible fade show"><ul>'+result+'</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>')
	                }
	            }, "json")
			})
		})
	</script>
@endsection