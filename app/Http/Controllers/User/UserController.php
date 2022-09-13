<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function postDetailsAccount(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            'name' => ['required'],
            'email' => ['required']
        ]);

        $user = User::where('email',$request->email)->first();

        if(!is_null($user)){
            if($request->has("image")){
                if (\Storage::disk(config('services.urls.FILESYSTEM_DRIVER'))->exists($user->avatar)) {
                    \Storage::disk(config('services.urls.FILESYSTEM_DRIVER'))->delete($user->avatar);
                }
                $fileName = $user->name."_".time().'.'.$request->image->extension();
                $path = $request->file('image')->storeAs(
                    'users', $fileName, 'public'
                );
                $user->avatar = $path;
            }

            try {
                $user->update($request->all());
            } catch (QueryException $e) {
                return response(['error' => $e], 500);
            }

            \Session::flash('success', 'dados alterados');
            return redirect()->route('settings.details');
        }
        \Session::flash('error', 'Opss... houve um problema. Tente novamente mais tarde.');
        return redirect()->route('settings.details');
    }


    public function postDetailsBank(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            //'name' => ['required'],
            'email' => ['required']
        ]);

        $user = User::where('email',$request->email)->first();

        if(!is_null($user)){
            try {
                $user->update($request->all());
            } catch (QueryException $e) {
                return response(['error' => $e], 500);
            }
            \Session::flash('success', 'dados alterados');
            return redirect()->route('settings.bank');
        }
        \Session::flash('error', 'Opss... houve um problema. Tente novamente mais tarde.');
        return redirect()->route('settings.bank');
    }
    
    public function postChangePassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            'email' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required','same:password']
        ]);

        if ($validator->fails()) {
            \Session::flash('error', 'As senhas não conferem');
            return redirect()->route('settings.password');
        }

        $user = User::where('email',$request->email)->first();

        if(!is_null($user)){
            try {
                $data['password'] = bcrypt($data['password']);
                $user->password = $data['password'];
                $user->save();
            } catch (QueryException $e) {
                return response(['error' => $e], 500);
            }
            Auth::setUser($user);
            \Session::flash('success', 'dados alterados');
            return redirect()->route('settings.password');
        }
        \Session::flash('error', 'Opss... houve um problema. Tente novamente mais tarde.');
        return redirect()->route('settings.password');
    }
}
