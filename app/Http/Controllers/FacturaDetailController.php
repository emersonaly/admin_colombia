<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaDetailController extends Controller
{
    public function addProduct(Request $request) {
    	// Retrieving user
    	$user = \Auth::user();
    	// Creating factura if it does not exits
    	if($request->input('facturas_id')==0) {
    		$factura = new \App\Facturacion;
    		$factura->user_id = $user->id;
    		$factura->fecha_creacion = date('Y-m-d');
    		$factura->save();
    		$facturas_id = $factura->id;
    	} else {
    		$facturas_id = $request->input('facturas_id');
    	}

    	$detail_factura = \App\FacturaDetail::all()->where('facturas_id',$facturas_id)->where('productos_id',$request->input('productos_id'))->first();
    	if($detail_factura) {
    		$detail_factura->cantidad = $detail_factura->cantidad+$request->input('cantidad');
    		$detail_factura->total_sin_impuesto = $detail_factura->precio*$detail_factura->cantidad;
    		$detail_factura->total_impuestos = ($detail_factura->total_sin_impuesto*$detail_factura->impuesto)/100;
    		$detail_factura->total_pagar = $detail_factura->total_sin_impuesto+$detail_factura->total_impuestos;
    		$detail_factura->save();
    	} else {
	    	// Insert details
	    	$detail_producto_list         = \App\Producto::findOrFail($request->input('productos_id'));
			$detail_factura                     = new \App\FacturaDetail;
			$detail_factura->facturas_id        = $facturas_id;
			$detail_factura->productos_id       = $request->input('productos_id');
			$detail_factura->user_id            = $user->id;
			$detail_factura->cantidad           = $request->input('cantidad');
			$detail_factura->precio             = $detail_producto_list->precio_venta1;
			$detail_factura->impuesto           = $detail_producto_list->impuestos->descripcion;
			$detail_factura->descuento          = $detail_producto_list->porcentaje_descuento;
			$detail_factura->total_sin_impuesto = $detail_producto_list->precio_venta1;
			$detail_factura->total_impuestos 	= ($detail_factura->total_sin_impuesto*$detail_factura->impuesto)/100;
			$detail_factura->total_pagar = $detail_factura->total_sin_impuesto+$detail_factura->total_impuestos;
			$detail_factura->save();
    	}

    	$totales = \App\FacturaDetail::where('facturas_id',$facturas_id);

        return response()->json([
        	$detail_factura,
        	$detail_factura->producto,
        	$detail_factura->facturacion,
        	'total_pagar'=>$totales->sum('total_pagar'),
        	'total_sin_impuesto'=>$totales->sum('total_sin_impuesto'),
        	'total_impuestos'=>$totales->sum('total_impuestos'),
        ]);
    }

    public function editProduct(Request $request) {
    	$detail_factura = \App\FacturaDetail::findOrFail($request->input('factura_detalles_id'));
    	return response()->json([
        	$detail_factura,
        	$detail_factura->producto,
        	$detail_factura->producto->unimed,
        	$detail_factura->facturacion,
        ]);
    }
}
