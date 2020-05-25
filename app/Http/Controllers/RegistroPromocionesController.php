<?php

namespace App\Http\Controllers;

use App\RegistroPromociones;
use App\TipoPromocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroPromocionesController extends Controller
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
        $code='';
        $message ='';
        $items ='';
        return response()->json($request);
        if($request->idTipoPromocion == null){
            $code='403';
            $items = 'null';
            $message = 'El producto a aplicar la promocion esta vacio';
        }else if($request->descuento == null){
            $code='403';
            $items = 'null';
            $message = 'La cantidad a descontar esta vacio';
        }else if($request->cantidad == null){
            $code='403';
            $items = 'null';
            $message = 'La cantidad a colocar en promocion esta vacio';
        }else if($request->fecha_inicio == null){
            $code='403';
            $items = 'null';
            $message = 'La fecha de inicion de la promoción esta vacio';
        }else if($request->fecha_fin== null){
            $code='403';
            $items = 'null';
            $message = 'La fecha final de la promoción  esta vacio';
        }else
            {
            $Promociones =(TipoPromocion::where('id',$request->idTipoPromocion)->first());
            if($Promociones['id'] == ""){
                $code='403';
                $items = 'null';
                $message = 'El promocion no existe ';
            }else{
                if((int)$request->cantidad <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No puede existir un cantidad igual o menor a cero ';
                }else if((int)$request->descuento <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No puede existir un descuento igual o menor a cero';
                }else{
                    $DataPromocion = RegistroPromociones::where([["estado_del","1"],["idTipoPromocion",$Promociones['id']]])->get();
                    if(count($DataPromocion) == 0){
                        $items = new RegistroPromociones();
                        $items->idTipoPromocion =$Promociones['id'];
                        $items->descuento = $request->descuento;
                        $items->cantidad = $request->cantidad ;  
                        $items->fecha_inicio = $request->fecha_inicio;
                        $items->fecha_fin = $request->fecha_fin;    
                        $items->estado_del = "1";
                        $items->publicado="1";
                        $items->save();       
                        $code = '200';
                        $message = 'OK';
                    }else{
                        $code='403';
                        $items = 'null';
                        $message = 'Ya existe una promocion activa en este momento';
                    }
                }
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
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
                $code='';
                $message ='';
                $items ='';
               
                $registro=RegistroPromociones::withCount(['kits'])->where("id",$request->id)->first();
               
                if($registro->kits_count==0){
                    
                    $registro->delete();
    
                   
                    $code = '200';
                $message = 'OK';    
                }
                      
         

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
            
        return response()->json($result);       
    }
    //m


    public function Filtro(Request $request)
    {
        
        $code='';
        $message ='';
        $items ='';

             
                $code = '200';
                 $items = RegistroPromociones::with(['tipoPromocion'])->withCount(['kits'])->get();
               
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }
    public function BuscarPromocion(Request $request)
    {
        $code='';
        $message ='';
        $items ='';
        $item1= [];
        $palabra = $request->term;
        $code = '200';        
        if(trim($palabra) == ''){
            $items =RegistroPromociones::where([["estado_del","1"]])->get();
        }else{
            $items = RegistroPromociones::with('tipoPromocion1')->whereHas('tipoPromocion1', function ($query) use ($palabra) {
                $query->where("descripcion","like",'%'.$palabra.'%');
            })->get();
        }
        if(COUNT($items) > 0){
            foreach ($items as $item) {
                $item1[] = ['id' => $item->id, 'text' => $item->tipoPromocion1->descripcion];
            }
        }
        $message = 'OK';
        $result =   array(
                        'items'     => $item1,
                        'code'      => $code,
                        'message'   => $message
                    );
            
        return response()->json($result);
    }

    
    
}
