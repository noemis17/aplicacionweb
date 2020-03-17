<?php

namespace App\Http\Controllers;

use App\ProductoPromociones;
use App\User;
use App\Promociones;
use App\Producto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoPromocionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($nome_token_user='',Request $request)
    {
      
        $ignorar = array("/", ".", "$");

        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {
           
        
            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
              
                $items = new ProductoPromociones();
                // $items->idPromociones = (Promociones::where('nome_token',$request->nome_token)->first())->id;
                $items->idPromociones = $request->idPromociones;
                // $items->idProducto = (Producto::where('id',$request->idProducto)->first())->id;
                $items->idProducto = $request->idProducto;
                // return response()->json($items);
                
                $items->fecha_inicio = $request->fecha_inicio;
                $items->fecha_fin = $request->fecha_fin;
                $items->precio= $request->precio;
                $items->estado_del = '1';
                $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                
                $items->save();
              
                
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductoPromociones  $productoPromociones
     * @return \Illuminate\Http\Response
     */
    public function show($nome_token_user='',Request $request)
    {
       //return response()->json($request);
    
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = ProductoPromociones::with(['Promociones','Productos'])->where("nome_token",$request->nome_token)->first();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductoPromociones  $productoPromociones
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductoPromociones $productoPromociones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductoPromociones  $productoPromociones
     * @return \Illuminate\Http\Response
     */
    public function update($nome_token_user='',Request $request)
    {
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();
            
            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {
                $code = '200';

                $items = ProductoPromociones::where("nome_token",$request->nome_token)->first();
                $items->idPromociones = (Promociones::where('nome_token',$request->nome_token_Promociones)->first())->id;
                $items->idProducto = (Producto::where('id',$request->idProducto)->first())->id;
                $items->fecha_inicio = $request->fecha_inicio;
                $items->fecha_fin = $request->fecha_fin;
                $items->precio= $request->precio;


                $items->update();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductoPromociones  $productoPromociones
     * @return \Illuminate\Http\Response
     */
    public function destroy($nome_token_user='',Request $request)
    {
        $code='';
        $message ='';
        $items ='';
       
        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = ProductoPromociones::where("nome_token",$request->nome_token)->first();
                $items->estado_del='0';
                $items->delete();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }
    public function Filtro($nome_token_user='',Request $request)
    {
        
        //return response()->json($request);
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = Producto::with(['PromocionesProducto'])->where('id',$request->idProducto)->get();
                $message = 'OK';
                return response()->json($items);

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

}
