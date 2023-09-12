<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Funcionario;
use App\Models\Loja;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Cria cargo e loja
        $cargo = Cargo::create([
            'nome' => "admin",
            'descricao' => "gerente",
        ]);
        $loja = Loja::create();

        // Cria funcionário
        $funcionario = new Funcionario;

        $funcionario->numero = "+xx (xx) xxxxx-xxxx";
        $funcionario->cpf = "xx.xxx.xxx-xx";
        $funcionario->loja_id = $loja->id;
        $funcionario->cargo_id = $cargo->id;
        $funcionario->save();

        // Cria usuário e associa ao funcionário
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isfuncionario' => false,
        ]);

        // Associa o funcionário ao usuário
        $user->funcionario_id = $funcionario->id;
        $user->save();

        return $user;
    }
}
