<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private $messages = [
      'email.required' => 'Поле email не должно быть пустым',
      'email.email' => 'Значение email должно быть почтой',
      'email.unique' => 'Такой пользователь уже существует',
      'password.required' => 'Поле password не должно быть пустым',  
      'password.confirmed' => 'Пароли не совпадают',
      'password.min' => 'Мало символов в пароле',
      'password.max' => 'Превышено количество символов в пароле',
    ];
    public function register() {
        return view('user.register');
    }

    public function store(Request $request) {
        // dump($request->all());

        // $request->only('name')->validate([

        // ]);

        // $request->validate([
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed|min:4|max:16',
        // ]);

        // $request->validate([],)
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4|max:16',
        ];
        Validator::make($request->all(), $rules, $this->messages)->validate();

        $req = $request->all();
        $req['password'] = bcrypt($req['password']);
        $user = User::create($req);

        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        
        return redirect()->route('home');
    }


    public function login() {
        return view('user.login');
    }

    public function checkLogin(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $cred = Validator::make($request->all(), $rules, $this->messages)->validate();

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        if (Auth::attempt($cred)) {
            if (auth()->user()->role === 1) {
                //admin@ mail.ru  12345
                return redirect()->to('admin');
            } else {
                return redirect()->route('home');
            }
        }
        
        return back()->with('errorLogin', 'Неверный логин или пароль');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
