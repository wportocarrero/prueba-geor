<?php

namespace Tasks\Http\Controllers;

use Illuminate\Http\Request;
use Tasks\Tasks;
use Illuminate\Support\Facades\Auth;
use DB;
use Tasks\User;

class TasksController extends Controller
{

    public function logueo(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');

        $validar = DB::select(DB::raw("select * from users where email ='$email'"));
        if(count($validar) == 0){
            $notificacion = "el usuario no existe";
        }else{

            $pass_designada = $validar[0]->password;
            if($pass_designada == $pass){
                $notificacion = "se a logueado correctamente";
                $usuario = User::where('email', $email)
                        ->get()
                        ->first();
                    Auth::login($usuario);
            }else{
                $notificacion = "la contraseña es incorrecta";
            }
            
        }

        return $notificacion;
    }

    public function inicio()
    {

        $notificacion= "acceso no autorizado, requiere loguearse.";
        return $notificacion;
    }

    public function getAll(){
        $tasks = Tasks::all();
        return $tasks;
    }
    public function agregar(Request $request){
        $con_agregar= Tasks::create($request->all());

        return $con_agregar;
    }
    public function mostrar($id){
        $con_mostrar = Tasks::find($id);
        return $con_mostrar;
    }

    public function editar($id,Request $request){
        $con_editar = $this->mostrar($id);
        $con_editar->fill($request->all())->save();
        return $con_editar;
    }
    
  public function eliminar($id){
    $con_eliminar = $this->mostrar($id);
    $con_eliminar->delete();

    return $con_eliminar;
  }

}
