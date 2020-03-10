<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use App\TipoUsuario;

class UserController extends Controller
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
    // store
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

                $items = new User();
                // $tipo = TipoUsuario::where('nome_token',$request->nome_token_tipo)->first();
                $items->idtipo = (TipoUsuario::where('nome_token',$request->nome_token_tipo)->first())->id;
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // show
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
                $items = User::with(['tipo','ubicacion'])->where("nome_token",$request->nome_token)->first();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // update
    public function update($nome_token_user='',Request $request)
    {
        //return response()->json('hol');
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

                $items = User::where("nome_token",$request->nome_token)->first();
                $items->idtipo = (TipoUsuario::where('nome_token',$request->nome_token_tipo)->first())->id;
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //destroy
    public function destroy ($nome_token_user='',Request $request)
    {
        //return response()->json($nome_token_user);
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
                $items = User::where("nome_token",$request->nome_token)->first();
                $items->email=$items->email.'*';
                $items->estado_del='0';
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
    //filtro
    public function Filtro($nome_token_user='',Request $request)
    //public function Filtro($value='')
    {
        // $items = User::with('tipo')->where([["estado_del","1"]])->first();//->orderBy('name', 'desc')->get();
        

        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::with('tipo')->where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = User::with('tipo')->where([["estado_del","1"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();
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

    // //filtro Courier
    public function FiltroCourier($nome_token_user='',Request $request)
    //public function Filtro($value='')
    {
    
        // $tipo = TipoUsuario::where('cod','003')->first();
        // $items = User::with('tipo')->where([["estado_del","1"],["idtipo","$tipo->id"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();
        
    
        $code='';
        $message ='';
        $items ='';
    
        if (empty($nome_token_user)) {
    
            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
    
        }else{
    
            $validad = User::with('tipo')->where('nome_token',$nome_token_user)->first();
    
            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {
                try {
                    $tipo = TipoUsuario::where('cod','003')->first(); //Courier
    
                    $code = '200';
                    $items = User::with('tipo')->where([["estado_del","1"],["idtipo","$tipo->id"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();
                    $message = 'OK';
                } catch (\Throwable $th) {
                    //throw $th;
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

    public function prueba()
    {
      // $request->email = 'hola';
      // return response()->json($request);
      // $code='';
      // $message ='';
      // $items ='';
      //
      // $result =   array(
      //                 'items'     => $items = User::all(),
      //                 'code'      => $code,
      //                 'message'   => $message
      //             );
      $result=User::with('tipo')->first();
      return response()->json($result);
    }

    public function login(Request $request)
    {
      $code='';
      $message ='';
      $items ='';
      //
      // if (empty($request->email) || empty($request->password)) {
      //
      //     $code='403';
      //     $items = 'null';
      //     $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
      //
      // }else{
      //
      //     $validad = User::with('tipo')->where('email',$request->email)->first();
      //     dd($validad);
      //     return;
      //     if (empty($validad['name']) || $validad['estado_del']=='0' ) {
      //         //no existe ese usuarios o fue dado de baja.
      //     }
      //     else {
      //
      //         $code = '200';
      //         $items = $validad;
      //         $message = 'OK';
      //
      //     }
      //
      // }
      //
      // $result =   array(
      //                 'items'     => $items,
      //                 'code'      => $code,
      //                 'message'   => $message
      //             );
      $items = User::with("tipo")->where([["estado_del","1"],["email",$request->email]])->first();
      $result =   array(
                      'items'     => $items,
                      'code'      => $code,
                      'message'   => $message
                  );
      return response()->json($result);

    }
    public function register(Request $request)
    {
        //return $request;
        $ignorar = array("/", ".", "$");

        $code='';
        $message ='';
        $items ='';

        try {
   
            $items = User::where([["estado_del","1"],["email",$request->email]])
                            ->orWhere([["estado_del","1"],["cedula",$request->cedula]])
                            // ->orWhere([["estado_del","1"],["celular",$request->celular]])
                            ->first();

            if (empty($items['cedula'])) {

                $items = new User();
                $items->idtipo = (TipoUsuario::where('cod','004')->first())->id;
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
                $items->estado_del = '1';
                $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                $items->save();
        
                $items = User::with("tipo")->where("nome_token",$items->nome_token)->first();

                $code = '200';
                $message = 'OK';
                
            }else{
                $items = '';
                $code = '418';
                $message = 'I am a teapot';
            }

        } catch (\Throwable $th) {
            $items ='';
            $code = '418';
            $message = 'I am a teapot';
        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

}
