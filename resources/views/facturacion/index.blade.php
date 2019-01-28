@extends('layouts.principal')
@section('title') Facturaci&oacute;n @endsection
@section('content')
	{!!\Basics::Breadcrumb(['Maestros','Facturaci&oacute;n'])!!}
	<div class="">
		<div class="card">
			<div class="card-header">
				<h3>Nueva Factura</h3>
			</div>
			<div class="card-body">
				{!!\Basics::printErrors($errors->any(),$errors->all())!!}

				{{-- DATOS FACTURA --}}
				<form action="" method="POST" accept-charset="utf-8"  class="cliente col-12">
					@csrf
					<div class="form-group row">
						<label for="seleccioncliente" class="col-sm-2 col-form-label">Cliente:</label>
						<div class="col-sm-2">
							<select data-placeholder="Seleccione una opción" name="cliente" class="chosen" >
								<option value=""></option>
								@foreach ($clientes as $cliente)
									<option value="{{ $cliente->id}}">{{ $cliente->dni.' '. $cliente->nombres .' '. $cliente->apellidos}}</option>
								@endforeach
							</select>
						</div>
						<label for="fecha" class="col-sm-2 col-form-label">Fecha:</label>
						<div class="col-sm-2">
							<input required type="date" name="fecha" id="fecha" max="" class="form-control fecha" value="{{old('fecha')}}">
						</div>
					</div>	
					<div class="form-group row">
						<label for="formasdepago" class="col-sm-2 col-form-label">Forma de Pago:</label>
						<div class="col-sm-2">
							<select data-placeholder="Seleccione una opción" name="formadepago" class="chosen" onchange="updateFechVenc($(this).val())">

								<option value=""></option>
								@foreach ($formasdepago as $formadepago)
								{{-- EN EL VALUE SE PASA EL VALOR DE DIAS PARA USARLO EN LA FUNCION --}}
									<option value="{{ $formadepago->id }}-{{ $formadepago->dias }}">{{ $formadepago->descripcion}}</option>
								@endforeach
							</select>
						</div>
						<label for="vencimiento" class="col-sm-2 col-form-label">Vencimiento:</label>
						<div class="col-sm-2">
							<input disabled type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="">
						</div>
					</div>
				{{-- FIN DE DATOS FACTURA --}}
					<hr>
				{{-- DETALLE DE FACTURA --}}
					<div class="space-20"></div>
					<div class="table-responsive-sm">


						<div class="form-group text-center table-responsive-sm">
							<h5><b>Detalle de Factura</b></h5>
						</div>
						<table id="table-factura" class="table tabla-responsiva table-sm">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Descripci&oacute;n</th>
									<th title="Unidad de Medida">UM</th>
									<th title="Precio Unitario">Precio Un.</th>
									<th title="Cantidad">Cant.</th>
									<th title="Porcentaje de Descuento">% Dcto.</th>
									<th title="Valor de Descuento">Valor Dcto</th>
									<th title="Impuestos">Impuestos</th>
									<th title="Precio Total">Precio Total</th>
									<th title="Opciones">Opciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td  width="12%"><input disabled type="text" name="codigo" id="codigo" class="form-control" value=""></td>
									<td>
										<select data-placeholder="Seleccione una opción" name="producto" id="producto" class="chosen" onchange="cargarProducto($(this).val())">
											<option value=""></option>
											@foreach ($productos as $producto)
												<option value="{{ $producto->id }}" > {{ $producto->descripcion}} </option>
											@endforeach
										</select>
									</td>
									<td width="10%"><input disabled type="text" name="unidadmedida" id="unidadmedida" class="form-control" value=""></td>
									<td id="precios">
										{{-- <input disabled type="text" name="precio_unitario" id="precio_unitario" class="form-control" value=""> --}}
										<select disabled data-placeholder="Seleccione una opción" name="precio_uni" id="precio_unitario" class="custom-select">
											{{-- <option value=""></option>
			 								@foreach($unidadmedida as $unidadmed)
				   								<option value="{{$unidadmed->id}}"> 
				   									{{ $unidadmed->descripcion }} 
				   								</option>
											@endforeach --}}
										</select>
									</td>
									<td width="8%"><input disabled type="number" min="0" name="cantidad" id="cantidad" class="form-control" value=""></td>
									<td  width="5%"><input disabled type="text" name="porc_descuento" id="porc_descuento" class="form-control" value=""></td>
									<td><input disabled type="text" name="valor_descuento" id="valor_descuento" class="form-control" value=""></td>
									<td width="5%"><input disabled type="text" name="impuesto" id="impuesto" class="form-control" value=""></td>
									<td><input disabled type="text" name="precio_total" id="precio_total" class="form-control" value=""></td>
									<td align="center">
										<div class="btn-group">
											<button class="btn btn-outline-primary btn-sm col-sm-6" title="Editar"><i class="fa fa-pencil-alt"></i></button>
											<button class="btn btn-outline-danger btn-sm col-sm-6" title="Borrar"><i class="fa fa-trash"></i></button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="unidmed_id" id="unidmed_id" value="">
						<input type="hidden" name="impuesto_id" id="impuesto_id" value="">
				</form>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script>
	var d = new Date();
	year = d.getFullYear();
	month = d.getMonth()+1;
	day = d.getDate();
	var fecha_actual = (year + '-' +(month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day);
	// VALIDAR QUE LA FECHA DE LA FACTURA NO SEA MAYOR A LA ACTUAL
	$(".fecha").attr('max', fecha_actual);
	// FUNCION CARDTABLE PARA LA TABLA RESPONSIVE
	$('#table-factura').cardtable();

	$(function(){
		// CLASES CHOSEN
		var j = jQuery.noConflict();
		$(".chosen").chosen({
			width:'100%',
			no_results_text:'No hay resultados para:'
		});

	});
	
	// VALIDAR QUE LA FECHA DE VENCIMIENTO SE ACTUALICE DEPENDIENDO DE LA FORMA DE PAGO SELECCIONADA

	function updateFechVenc(formPago){
		var forma = formPago.split('-') ;
		var formaPago = forma[0];
		if (formaPago == 1) {  /*pago a contado*/
			$("#fecha_vencimiento").attr('value',fecha_actual);
		}else if((formaPago != 1) || (forma[1] > 0)){  /*pago a credito 30 dias*/
			  var fecha_venc = new Date(fecha_actual);
			  //dias a sumar
			  var dias = parseInt(forma[1]);
			  //nueva fecha sumada
			  fecha_venc.setDate(fecha_venc.getDate() + dias +1);
			  //formato de salida para la fecha
			  var ano = fecha_venc.getFullYear();
			  var mes = fecha_venc.getMonth() + 1;
			  var dia = fecha_venc.getDate();
			  var resultado = ano + '-' + (mes<10 ? '0' : '') + mes  + '-'+ (dia<10 ? '0' : '') + dia;
			  $("#fecha_vencimiento").attr('value',resultado);
		}else{
			$("#fecha_vencimiento").attr('value','');
		}
	};



	function cargarProducto(producto_id){
		$(function(){
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "{{ route('ventaspos.facturacion.getproducto') }}",
				data:{'producto_id' : producto_id} ,
                success: function (data) {
                	// LAS POSICIONES 0,1,2 SE TOMAN JSON QUE LLEGA DESDE EL CONTROLADOR PARA TOMAR LAS FORANEAS
                	$('input[name="codigo"]').val(data[0].codigo_barrra);
                	$('input[name="unidadmedida"]').val(data[1].descripcion);
                	$('input[name="unidmed_id"]').val(data[1].id); // PARA PASAR EL ID DE UNID-MED EN EL INPUT HIDDEN
                	$('input[name="cantidad"]').removeAttr('disabled');
                	//$('input[name="precio_unitario"]').val(data[0].precio_venta1); // ESTO DEBE SER UN SELECT
                	$('input[name="porc_descuento"]').val(data[0].porcentaje_descuento+'%');
                	$('input[name="valor_descuento"]').val('VALOR DESCUENTO'); // CALCULAR CON RESPECTO AL PRECIO DE VENTA SELECCIONADO
                	$('input[name="impuesto"]').val(data[2].descripcion+'%');
                	$('input[name="impuesto_id"]').val(data[2].id); // PARA PASAR EL ID DEL IMPUESTO EN EL INPUT HIDDEN
                	$('input[name="precio_total"]').val('TOTAL'); // CALCULAR CON RESPECTO A LA CANTIDAD Y AL DESCUENTO

                	$('select[name="precio_uni"').hide();
                	var respo = "";
                	var selected = "";
                	selected = (data[0]['id'] == 1) ? 'selected' : "";

                	respo += '<select data-placeholder="Seleccione una opción" name="precio_unitario" id="precio_unitario" class="custom-select chosen">';
                	respo += '<option value="'+data[0]['precio_venta1']+'" '+selected+'>'+data[0]['precio_venta1']+'</option>';
                	respo += '<option value="'+data[0]['precio_venta2']+'">'+data[0]['precio_venta2']+'</option>';
                	respo += '</select>'
                	$('td[id="precios"').html(respo);

                },
                error: function (xhr) {
                	var result = "";
                	if(xhr.responseJSON.errors) {
                		for(i in xhr.responseJSON.errors) {
                			result += "<li>"+xhr.responseJSON.errors[i]+"</li>"
                		}
                	}
                	$('#errores').html('<div class="alert alert-danger alert-dismissible fade show"><ul>'+result+'</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>')
                }
            }, "json")
		})
	}
</script>
@endsection