<?php

namespace sisAdmin\Http\Controllers\Auth;

use sisAdmin\User;
use Validator;
use sisAdmin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
     

    protected $redirectTo = 'administracion/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
     
      /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'name';
    }
     
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'Tipos_idTipos'=>'required',
        ]);
    }

    protected function authenticated( $user)
    {
        $usuario = DB::table('users')
        ->select('users.*')
        ->where('name','=',$user->name)
        ->first();

        switch($usuario->Tipos_idTipos){
            case 1;            
                return redirect('administracion/home');
                break;         
            case 2;            
                return redirect('chofer/home');
                break;        
            case 3;            
                return redirect('inspector/home');
                break;        
        }

        return redirect('my-account'.$user->Tipos_idTipos);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'Tipos_idTipos'=>$data['tipo'],
            
        ]);
    }
    
}
