<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\profile;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuariosResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



// use Illuminate\Support\Collection;
// use PhpParser\Node\Expr\Print_;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return usuarios::all();
        
        $usuarios=(new Usuarios())->paginate();
        // return UsuariosResource::collection($usuarios);
        return $usuarios;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'

        ]);
           
        $usuarios=Usuarios::where('email',$request->email)->first();
        if(!$usuarios||!Hash::check($request->password, $usuarios->password)){
            // return response([
            //     'message'=>['Email o Contraseña incorrecto']
            // ]);
            $result=[
                'code'=>2,
                'data'=>[]

            ];
            return $result;
        }
        

        $token=$usuarios->createToken($request->email)->plainTextToken;
        
        $usuarios=DB::table('usuarios')->select('id','name','career','roles','email','profile','jobTitle','skills','jobSummary','permissions')->where('email', $request->email)->get();
        $result=[
            'code'=>0,
            'data'=>[
                $usuarios,
              'token'=>$token
            ]
        ];

        return $result;

    }

    public function resend(Request $request)
    {
        $request->usuario()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string'

        ]);
            $value1=DB::table('usuarios')->where('name',$request->name)->value('name');
            $value2=DB::table('usuarios')->where('email',$request->email)->value('email');
            if($value1 != null || $value2 != null){
                $result=[
                    'code'=>1,
                    'data'=>[]
                ];
                return $result;
            }else{



                $usuarios=new Usuarios();
       
                 $usuarios->permissions=$request->permissions;
                $usuarios->roles=$request->roles;
                $usuarios->email=$request->email;
                $usuarios->password=Hash::make($request->password);
               
                        $usuarios->fill(
                   
                            $request->merge(['roles'=>'Estudiante'])->only('name','career','roles','email','profile','jobTitle','skills','jobSummary','permissions'),
                            
                           
                        );
               
                $usuarios->save();
                
                $usuarios=DB::table('usuarios')->select('name','career','roles','email','profile','jobTitle','skills','jobSummary','permissions')->where('email', $request->email)->get();
                event(new Registered($usuarios));
                $result=[
                    'code'=>0,
                    'data'=>$usuarios 
                ];
        
                return $result;
            }
         
            
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $usuarios=Usuarios::find($request->id);
        if(is_null($usuarios))
        {
            return response()->json(['message'=>'Users not found'],404);
        }
         $usuarios->password=Hash::make($request->password);
            $usuarios->update(
                $request->only('name','career','roles','email','profile','jobTitle','skills','jobSummary','permissions')
            );
            $usuarios=DB::table('usuarios')->select('name','career','roles','email','profile','jobTitle','skills','jobSummary','permissions')->where('id', $request->id)->get();
            $result=[
                'code'=>0,
                'data'=>$usuarios,
                
            ];

            return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios,$id)
    {
        $usuarios=Usuarios::find($id);
        if(is_null($usuarios)){
            return response()->json(['message'=>'Users not found'],404);
        }

        $usuarios->delete();
        return response()->json(['message'=>'Users deleted succesfully'],204);
    }
}
