<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    // регистрация/авторизация
    public function auth(Request $request) {
        if($request->user) return redirect(route('index'));
        return view('auth');
    }

    // обработка регистрации
    public function register(Request $request){
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения',
        ];

        $request->merge(['role' => 1]);
        $data = $request->all();
        $fields = Validator::make($data, [
            'phone' => 'required|unique:users|min:10|max:10',
            'password' => 'required|min:6',
            'confirm-password' => 'required',
        ], $messages);

        if($fields->fails()) {
            return(redirect(url()->previous()))
                ->withErrors($fields)
                ->withInput();
        }

        if($data['password'] !== $data['confirm-password']) {
            return(redirect(url()->previous()))
                ->withErrors(['error' => 'Пароли не совпадают'])
                ->withInput();
        }
        
        Auth::login(User::create($data));
        return redirect(route('index'));
    }

    // обработка авторизации
    public function login(Request $request) {
        $fields = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($fields->fails()) {
            return (redirect(url()->previous()))
                ->withErrors($fields)
                ->withInput();
        }

        $phone = $request->phone;
        $password = $request->password;
        $user = User::where('phone', $phone)
            ->where('password', $password)
            ->first();

        if(!$user) {
            return redirect(url()->previous())
                ->withErrors(['error' => 'Неверный логин или пароль'])
                ->withInput();
        }

        Auth::login($user);
        return redirect(route('index'));
    }

    // обработка выхода
    public function logout(Request $request) {
        if($request->user) Auth::logout();
        return redirect(route('index'));
    }
}
