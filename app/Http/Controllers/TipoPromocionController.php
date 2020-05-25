<?php

namespace App\Http\Controllers;

use App\TipoPromocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;
class TipoPromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("index");
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
        //return response()->json($request);
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
               
            } else {
                
                $code = '200';

                $items = new TipoPromocion();
                $items->descripcion =ltrim(rtrim(mb_strtoupper($request->descripcion,'UTF-8')));
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
     * @param  \App\TipoPromocion  $tipoPromocion
     * @return \Illuminate\Http\Response
     */
    public function show($nome_token_user='',Request $request)
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
                //token de la tabla tio promociones
                $items = TipoPromocion::where("nome_token",$request->nome_token)->first();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPromocion  $tipoPromocion
     * @return \Illuminate\Http\Response
     */
    public function edit($nome_token_user='',Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPromocion  $tipoPromocion
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
                $items = TipoPromocion::where("nome_token",$request->nome_token)->first();
                $items->descripcion = $request->descripcion;
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
     * @param  \App\TipoPromocion  $tipoPromocion
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
              
                $tipo = TipoPromocion:: withCount(['registro'])->where("nome_token",$request->nome_token)->first();
              
                if($tipo->registro_count==0){
                $tipo->delete();
                $code = '200';
                $message = 'OK';    
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
    //mostrar los tipo de promociones

    public function Buscar($nome_token_user='',Request $request)
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
                
                if(trim($request->term) == ''){
                    $items = TipoPromocion::where([["estado_del","1"]])->limit(10)->get(['id','descripcion as text']);
                }else{
                    $items = TipoPromocion::where([["estado_del","1"],["descripcion","like",'%'.$request->term.'%']])->limit(10)->get(['id', 'descripcion as text']);
                }

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
    //esta funcion nos permite eliminar todo los tipos que tengan que no tenganregistroPromocion
    public function ObtenerTipoRelacionado(Request $request)
    {
        
        $code='';
        $message ='';
        $items ='';

             
                $code = '200';
                 $items = TipoPromocion:: withCount(['registro'])->get();
               
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,    
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }



}