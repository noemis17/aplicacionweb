<?php

namespace App\Http\Controllers;

use App\Orden;
use App\EstadoVenta;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */

   
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }

    public function ConsultarComprasHechas(Request $request)
    {
      $code='';
      $message ='';
      $items ='';
      if (empty($request->idUsuario)) {
          $code='403';
          $items = 'null';
          $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
      }else{
        $validad = User::where('nome_token',$request->idUsuario)->first();
        if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
          $code='418';
          $message ='ERROR';
            //no existe ese usuarios o fue dado de baja.
        } else {
          $items = Orden::with('Compras','TipoPago','Estado','Usuarios')->where('idUsuario',$validad->id)->get();
        }
      }
      $result =   array(
                      'items'     => $items,
                      'code'      => $code,
                      'message'   => $message
                  );
      return response()->json($result);
    }


<<<<<<< HEAD
=======
    public function SoloPedidos(Request $request)
    {
        
        $code='';
        $message ='';
        $items ='';
        $estado=EstadoVenta::where("cod", "001")->first();
        $items= Orden::with('Compras','TipoPago','Estado','Usuarios')->where("idestado", $estado->id)->get();
        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);
    }

    public function AsignarCourier(Request $request) // paso dos de la venta es asignar el courier
    {
        // return response()->json($request);
       
        $code='';
        $message ='';
        $items ='';

        try {
            $items = Orden::where("id",$request->idOrden)->first();
         
        // como la venta pasa al 2 nivel que es asigar el courier entonces se debe cambiar el estado de la venta.
        $estado = EstadoVenta::where('cod','002')->first();
        
        $items->idestado = $estado->id;
        
       
        $courier = User::where('id',$request->nome_token_courier)->first();
        $items->idcourier = $courier->id;
        //return response()->json($items);

        $items->update();
        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        
        return response()->json($result);
    }
>>>>>>> c92d93ec0584281b41ecad817dea80a2708ea2d9

}
