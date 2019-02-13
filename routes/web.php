<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin_colombia');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/news',function(){
	return view('admin_colombia');
})->name('news');

// Bancos
Route::get('/config/banco/')->uses('BancoController@index')->name('config.banco')->middleware('auth');
Route::get('/config/banco/insert')->uses('BancoController@insertPage')->name('config.banco.insert')->middleware('auth');
Route::post('/config/banco/insert/form')->uses('BancoController@insertForm')->name('config.banco.insert.form')->middleware('auth');
Route::get('/config/banco/update/{banco_id}')->uses('BancoController@updatePage')->name('config.banco.update')->middleware('auth');
Route::post('/config/banco/update/form')->uses('BancoController@updateForm')->name('config.banco.update.form')->middleware('auth');
Route::get('/config/banco/delete/{banco_id}')->uses('BancoController@deletePage')->name('config.banco.delete')->middleware('auth');
Route::post('/config/banco/delete/form')->uses('BancoController@deleteForm')->name('config.banco.delete.form')->middleware('auth');

// Unidades de Medida
Route::get('/config/unidadmedida/')->uses('UnidadMedidaController@index')->name('config.unidadmedida')->middleware('auth');
Route::get('/config/unidadmedida/insert')->uses('UnidadMedidaController@insertPage')->name('config.unidadmedida.insert')->middleware('auth');
Route::post('/config/unidadmedida/insert/form')->uses('UnidadMedidaController@insertForm')->name('config.unidadmedida.insert.form')->middleware('auth');
Route::get('/config/unidadmedida/update/{unidmed_id}')->uses('UnidadMedidaController@updatePage')->name('config.unidadmedida.update')->middleware('auth');
Route::post('/config/unidadmedida/update/form')->uses('UnidadMedidaController@updateForm')->name('config.unidadmedida.update.form')->middleware('auth');
Route::get('/config/unidadmedida/delete/{unidmed_id}')->uses('UnidadMedidaController@deletePage')->name('config.unidadmedida.delete')->middleware('auth');
Route::post('/config/unidadmedida/delete/form')->uses('UnidadMedidaController@deleteForm')->name('config.unidadmedida.delete.form')->middleware('auth');
Route::post('/config/unidadmedida/insert/form/fast')->uses('UnidadMedidaController@insertFormFast')->name('config.unidadmedida.insert.form.fast')->middleware('auth');

//Impuestos
Route::get('/config/impuesto/')->uses('ImpuestoController@index')->name('config.impuesto')->middleware('auth');
Route::get('/config/impuesto/insert')->uses('ImpuestoController@insertPage')->name('config.impuesto.insert')->middleware('auth');
Route::post('/config/impuesto/insert/form')->uses('ImpuestoController@insertForm')->name('config.impuesto.insert.form')->middleware('auth');
Route::get('/config/impuesto/update/{impuesto_id}')->uses('ImpuestoController@updatePage')->name('config.impuesto.update')->middleware('auth');
Route::post('/config/impuesto/update/form')->uses('ImpuestoController@updateForm')->name('config.impuesto.update.form')->middleware('auth');
Route::get('/config/impuesto/delete/{impuesto_id}')->uses('ImpuestoController@deletePage')->name('config.impuesto.delete')->middleware('auth');
Route::post('/config/impuesto/delete/form')->uses('ImpuestoController@deleteForm')->name('config.impuesto.delete.form')->middleware('auth');
Route::post('/config/impuesto/insert/form/fast')->uses('ImpuestoController@insertFormFast')->name('config.impuesto.insert.form.fast')->middleware('auth');


// Route::get('/ventaspos/facturacion/')->uses('facturacionController@index')->name('ventaspos.facturacion')->middleware('auth');

// Route::post('/config/impuestos/insert/form/fast')->uses('ImpuestosController@insertFormFast')->name('config.impuestos.insert.form.fast')->middleware('auth');

// Facturación
Route::get('/ventaspos/facturacion/')->uses('FacturacionController@index')->name('ventaspos.facturacion')->middleware('auth');
// Route::post('ventaspos/facturacion/producto')->uses('FacturacionController@getProducto')->name('ventaspos.facturacion.getproducto')->middleware('auth');
// Route::get('/ventaspos/facturacion/insert')->uses('facturacionController@insertPage')->name('ventaspos.facturacion.insert')->middleware('auth');
// Route::post('/ventaspos/facturacion/insert/form')->uses('facturacionController@insertForm')->name('ventaspos.facturacion.insert.form')->middleware('auth');
// Route::get('/ventaspos/facturacion/update/{factura_id}')->uses('facturacionController@updatePage')->name('ventaspos.facturacion.update')->middleware('auth');
// Route::post('/ventaspos/facturacion/update/form')->uses('facturacionController@updateForm')->name('ventaspos.facturacion.update.form')->middleware('auth');
// Route::get('/ventaspos/facturacion/delete/{factura_id}')->uses('facturacionController@deletePage')->name('ventaspos.facturacion.delete')->middleware('auth');
// Route::post('/ventaspos/facturacion/delete/form')->uses('facturacionController@deleteForm')->name('ventaspos.facturacion.delete.form')->middleware('auth');
Route::post('ventaspos/facturacion/add-product')
	->uses("FacturaDetailController@addProduct")
	->name('facturacion.addProduct')
	->middleware('auth');
Route::post('ventaspos/facturacion/edit-product')
	->uses("FacturaDetailController@editProduct")
	->name('facturacion.editProduct')
	->middleware('auth');


//Formas de Pago
Route::get('/config/formasdepago/')->uses('FormasPagoController@index')->name('config.formasdepago')->middleware('auth');
Route::get('/config/formasdepago/insert')->uses('FormasPagoController@insertPage')->name('config.formasdepago.insert')->middleware('auth');
Route::post('/config/formasdepago/insert/form')->uses('FormasPagoController@insertForm')->name('config.formasdepago.insert.form')->middleware('auth');
Route::get('/config/formasdepago/update/{formaspago_id}')->uses('FormasPagoController@updatePage')->name('config.formasdepago.update')->middleware('auth');
Route::post('/config/formasdepago/update/form')->uses('FormasPagoController@updateForm')->name('config.formasdepago.update.form')->middleware('auth');
Route::get('/config/formasdepago/delete/{formaspago_id}')->uses('FormasPagoController@deletePage')->name('config.formasdepago.delete')->middleware('auth');
Route::post('/config/formasdepago/delete/form')->uses('FormasPagoController@deleteForm')->name('config.formasdepago.delete.form')->middleware('auth');

// Tipos de Facturas
Route::get('/config/tiposdefactura/')->uses('TiposFacturaController@index')->name('config.tiposdefactura')->middleware('auth');
Route::get('/config/tiposdefactura/insert')->uses('TiposFacturaController@insertPage')->name('config.tiposdefactura.insert')->middleware('auth');
Route::post('/config/tiposdefactura/insert/form')->uses('TiposFacturaController@insertForm')->name('config.tiposdefactura.insert.form')->middleware('auth');
Route::get('/config/tiposdefactura/update/{tipfacturas_ide}')->uses('TiposFacturaController@updatePage')->name('config.tiposdefactura.update')->middleware('auth');
Route::post('/config/tiposdefactura/update/form')->uses('TiposFacturaController@updateForm')->name('config.tiposdefactura.update.form')->middleware('auth');
Route::get('/config/tiposdefactura/delete/{tipfacturas_ide}')->uses('TiposFacturaController@deletePage')->name('config.tiposdefactura.delete')->middleware('auth');
Route::post('/config/tiposdefactura/delete/form')->uses('TiposFacturaController@deleteForm')->name('config.tiposdefactura.delete.form')->middleware('auth');

//Empresa
Route::get('/config/empresa/')->uses('EmpresaController@index')->name('config.empresa')->middleware('auth');
Route::get('/config/empresa/insert')->uses('EmpresaController@insertPage')->name('config.empresa.insert')->middleware('auth');
Route::post('/config/empresa/insert/form')->uses('EmpresaController@insertForm')->name('config.empresa.insert.form')->middleware('auth');
Route::get('/config/empresa/update/{empresa_ide}')->uses('EmpresaController@updatePage')->name('config.empresa.update')->middleware('auth');
Route::post('/config/empresa/update/form')->uses('EmpresaController@updateForm')->name('config.empresa.update.form')->middleware('auth');
Route::get('/config/empresa/delete/{empresa_ide}')->uses('EmpresaController@deletePage')->name('config.empresa.delete')->middleware('auth');
Route::post('/config/empresa/delete/form')->uses('EmpresaController@deleteForm')->name('config.empresa.delete.form')->middleware('auth');
Route::post('/config/empresa/insert/form/fast')->uses('EmpresaController@insertFormFast')->name('config.empresa.insert.form.fast')->middleware('auth');

// =======
// Route::post('/config/empresa/insert/form/fast')->uses('EmpresaController@insertFormFast')->name('config.empresa.insert.form.fast')->middleware('auth');
// >>>>>>> pr/7

//Clientes

Route::get('/config/cliente/')->uses('ClienteController@index')->name('config.cliente')->middleware('auth');
Route::get('/config/cliente/insert')->uses('ClienteController@insertPage')->name('config.cliente.insert')->middleware('auth');
Route::post('/config/cliente/insert/form')->uses('ClienteController@insertForm')->name('config.cliente.insert.form')->middleware('auth');
Route::get('/config/cliente/update/{cliente_ide}')->uses('ClienteController@updatePage')->name('config.cliente.update')->middleware('auth');
Route::post('/config/cliente/update/form')->uses('ClienteController@updateForm')->name('config.cliente.update.form')->middleware('auth');
Route::get('/config/cliente/delete/{cliente_ide}')->uses('ClienteController@deletePage')->name('config.cliente.delete')->middleware('auth');
Route::post('/config/cliente/delete/form')->uses('ClienteController@deleteForm')->name('config.cliente.delete.form')->middleware('auth');
Route::post('/config/cliente/insert/form/fast')->uses('ClienteController@insertFormFast')->name('config.cliente.insert.form.fast')->middleware('auth');


//Productos
Route::get('/config/producto/')->uses('ProductoController@index')->name('config.producto')->middleware('auth');
Route::get('/config/producto/insert')->uses('ProductoController@insertPage')->name('config.producto.insert')->middleware('auth');
Route::post('/config/producto/insert/form')->uses('ProductoController@insertForm')->name('config.producto.insert.form')->middleware('auth');
Route::get('/config/producto/update/{producto_ide}')->uses('ProductoController@updatePage')->name('config.producto.update')->middleware('auth');
Route::post('/config/producto/update/form')->uses('ProductoController@updateForm')->name('config.producto.update.form')->middleware('auth');
Route::get('/config/producto/delete/{producto_ide}')->uses('ProductoController@deletePage')->name('config.producto.delete')->middleware('auth');
Route::post('/config/producto/delete/form')->uses('ProductoController@deleteForm')->name('config.producto.delete.form')->middleware('auth');

// Regimen Iva
Route::get('/config/regimeniva/')->uses('RegimenIvaController@index')->name('config.regimeniva')->middleware('auth');
Route::get('/config/regimeniva/insert')->uses('RegimenIvaController@insertPage')->name('config.regimeniva.insert')->middleware('auth');
Route::post('/config/regimeniva/insert/form')->uses('RegimenIvaController@insertForm')->name('config.regimeniva.insert.form')->middleware('auth');
Route::get('/config/regimeniva/update/{regimen_id}')->uses('RegimenIvaController@updatePage')->name('config.regimeniva.update')->middleware('auth');
Route::post('/config/regimeniva/update/form')->uses('RegimenIvaController@updateForm')->name('config.regimeniva.update.form')->middleware('auth');
Route::get('/config/regimeniva/delete/{regimen_id}')->uses('RegimenIvaController@deletePage')->name('config.regimeniva.delete')->middleware('auth');
Route::post('/config/regimeniva/delete/form')->uses('RegimenIvaController@deleteForm')->name('config.regimeniva.delete.form')->middleware('auth');
Route::post('/config/regimeniva/insert/form/fast')->uses('RegimenIvaController@insertFormFast')->name('config.regimeniva.insert.form.fast')->middleware('auth');

// Tipo de Documento
Route::get('/config/tipodocumento/')->uses('TipoDocumentoController@index')->name('config.tipodocumento')->middleware('auth');
Route::get('/config/tipodocumento/insert')->uses('TipoDocumentoController@insertPage')->name('config.tipodocumento.insert')->middleware('auth');
Route::post('/config/tipodocumento/insert/form')->uses('TipoDocumentoController@insertForm')->name('config.tipodocumento.insert.form')->middleware('auth');
Route::get('/config/tipodocumento/update/{tipodocumento_id}')->uses('TipoDocumentoController@updatePage')->name('config.tipodocumento.update')->middleware('auth');
Route::post('/config/tipodocumento/update/form')->uses('TipoDocumentoController@updateForm')->name('config.tipodocumento.update.form')->middleware('auth');
Route::get('/config/tipodocumento/delete/{tipodocumento_id}')->uses('TipoDocumentoController@deletePage')->name('config.tipodocumento.delete')->middleware('auth');
Route::post('/config/tipodocumento/delete/form')->uses('TipoDocumentoController@deleteForm')->name('config.tipodocumento.delete.form')->middleware('auth');
Route::post('/config/tipodocumento/insert/form/fast')->uses('TipoDocumentoController@insertFormFast')->name('config.tipodocumento.insert.form.fast')->middleware('auth');

// Proveedores
Route::get('/config/proveedor/')->uses('ProveedorController@index')->name('config.proveedor')->middleware('auth');
Route::get('/config/proveedor/insert')->uses('ProveedorController@insertPage')->name('config.proveedor.insert')->middleware('auth');
Route::post('/config/proveedor/insert/form')->uses('ProveedorController@insertForm')->name('config.proveedor.insert.form')->middleware('auth');
Route::get('/config/proveedor/update/{proveedor_id}')->uses('ProveedorController@updatePage')->name('config.proveedor.update')->middleware('auth');
Route::post('/config/proveedor/update/form')->uses('ProveedorController@updateForm')->name('config.proveedor.update.form')->middleware('auth');
Route::get('/config/proveedor/delete/{proveedor_id}')->uses('ProveedorController@deletePage')->name('config.proveedor.delete')->middleware('auth');
Route::post('/config/proveedor/delete/form')->uses('ProveedorController@deleteForm')->name('config.proveedor.delete.form')->middleware('auth');
Route::post('/config/proveedor/insert/form/fast')->uses('ProveedorController@insertFormFast')->name('config.proveedor.insert.form.fast')->middleware('auth');

// Kardex 

