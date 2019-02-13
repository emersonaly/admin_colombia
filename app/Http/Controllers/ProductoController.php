<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index() {
    	$productos = \App\Producto::orderBy('id','desc')->paginate(10);
    	return view('producto.index',['listproductos'=>$productos]);

    }

    public function insertPage() {
    	$unidadmedida = \App\UnidadMedida::All();
    	$empresas = \App\Empresa::All();
    	$impuestos = \App\Impuesto::All();
    	return view('producto.insert',compact('unidadmedida','empresas','impuestos'));
    }

    public function insertForm(Request $request) {
        $user = \Auth::user();
    	$data = $request->validate([
    		'codigo'=>'required|unique:productos,codigo_barrra',
    		'descripcion'=>'required',
    		'existen'=>'required',
    		'existencia_minima'=>'required',
    		'costo'=>'required',
    		'precio_venta1'=>'required',
    		'precio_venta2'=>'required',
    		'unimed_id'=>'required',
    		'status'=>'required',
    		'empre_id'=>'required',
    		'descuento'=>'required',
    		'impuestos_id'=>'required',
    	]);
    	$productos = new \App\Producto;
    	
    	$productos->user_id = $user->id;
    	$productos->codigo_barrra = $request->input('codigo');
    	$productos->descripcion = $request->input('descripcion');
    	$productos->existen = $request->input('existen');
    	$productos->existencia_minima = $request->input('existencia_minima');
    	$productos->costo = $request->input('costo');
    	$productos->precio_venta1 = $request->input('precio_venta1');
    	$productos->precio_venta2 = $request->input('precio_venta2');
    	$productos->unimed_id = $request->input('unimed_id');
    	$productos->servicio = $request->input('status');
    	$productos->empre_id = $request->input('empre_id');
    	$productos->porcentaje_descuento = $request->input('descuento');
    	$productos->impuestos_id = $request->input('impuestos_id');
    	$productos->save();

        $productos_kardex = \App\Producto::All()->last();
           if ($productos_kardex) {
                $kardex                 = new \App\Kardex;     
                $kardex->user_id        = $user->id;
                $kardex->producto_id    = $productos_kardex->id;
                $kardex->empresa_id     = $productos_kardex->empre_id;
                $kardex->factura        = '0';
                $kardex->tipo           = '0';
                $kardex->existen_anter  = '0';
                $kardex->cantidad       = $productos_kardex->existen;
                $kardex->existen_post   = '0';
                $kardex->precio_momento = $productos_kardex->precio_venta1;   
                $kardex->impuesto       = $productos_kardex->impuestos_id;
                $kardex->save();

              }         
    	return redirect()->route('config.producto')->with([
    		'message'=>$productos->descripcion.' ha sido agregado correctamente'
    	]);
    }

    public function updatePage($producto_ide) {
    	$producto = \App\Producto::whereIn($producto_ide);
        $unidadmedida = \App\UnidadMedida::All();
        $empresas = \App\Empresa::All();
        $impuestos = \App\Impuesto::All();

        return view('producto.update',compact('producto','unidadmedida','empresas','impuestos'));
    }

    public function updateForm(Request $request) {
    	       $data = $request->validate([
            'codigo'=>'required',
            'codigo'=>Rule::unique('productos', 'codigo_barrra')->ignore($request->input('producto_id')),
            'descripcion'=>'required',
            'existen'=>'required',
            'existencia_minima'=>'required',
            'costo'=>'required',
            'precio_venta1'=>'required',
            'precio_venta2'=>'required',
            'unimed_id'=>'required',
            'status'=>'required',
            'empre_id'=>'required',
            'descuento'=>'required',
            'impuestos_id'=>'required',
        ]);
        $productos = \App\Producto::findOrFail($request->input('producto_id'));
        $user = \Auth::user();
        $productos->user_id = $user->id;
        $productos->codigo_barrra = $request->input('codigo');
        $productos->descripcion = $request->input('descripcion');
        $productos->existen = $request->input('existen');
        $productos->existencia_minima = $request->input('existencia_minima');
        $productos->costo = $request->input('costo');
        $productos->costo_dolar = $request->input('costo_dolar');
        $productos->precio_venta1 = $request->input('precio_venta1');
        $productos->precio_venta2 = $request->input('precio_venta2');
        $productos->precio_venta_dolar1 = $request->input('precio_venta_dolar1');
        $productos->precio_venta_dolar2 = $request->input('precio_venta_dolar2');
        $productos->unimed_id = $request->input('unimed_id');
        $productos->servicio = $request->input('status');
        $productos->empre_id = $request->input('empre_id');
        $productos->porcentaje_descuento = $request->input('descuento');
        $productos->impuestos_id = $request->input('impuestos_id');
        $productos->save();
        
        
        return redirect()->route('config.producto.update',['producto_id'=>$request->input('producto_id')])->with([
            'message'=>$productos->descripcion.' ha sido actualizado correctamente'
        ])
    }
    
    public function deletePage($producto_id) {
        $producto = \App\Producto::findOrFail($producto_id);
        $unidadmedida = \App\UnidadMedida::All();
        $empresas = \App\Empresa::All();
        $impuestos = \App\Impuesto::All();
        return view('producto.delete',compact('producto','unidadmedida','empresas','impuestos'));
    }

    public function deleteForm(Request $request) {
    	$producto = \App\Producto::findOrFail($request->input('producto_id'));
    	$producto->delete();
    	return redirect()->route('config.producto')->with([
    		'message'=>$request->input('descripcion').' ha sido eliminado correctamente'
    	]);
    }
}
