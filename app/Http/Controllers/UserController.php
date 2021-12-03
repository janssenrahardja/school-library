<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dataUser = User::all();

        return view('pages.user.index', [
            'dataUser' => $dataUser
        ]);
    }

    public function create() {
        return view('pages.user.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        if ($user->roles !== 'admin') {
            return redirect('/dashboard');
        }

        try {
            DB::beginTransaction();

            $data = new User();
            $data->roles = $request->role;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect('/dashboard/users')->with('success', 'User Created');
    }

    public function show($id)
    {
        $dataUser = User::findOrFail($id);

        return view('pages.user.detail', [
            'dataUser' => $dataUser
        ]);
    }

    public function profile()
    {
        $id = Auth::id();
        $dataUser = User::findOrFail($id);

        return view('pages.user.detail', [
            'dataUser' => $dataUser
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        if ($user->roles === 'user' && $user->id != $id) {
            return redirect('/dashboard');
        }

        $userByEmail = User::where('email', $request->email)->first();
        if ($userByEmail) {
            if ($userByEmail->id != $id) {
                return redirect(url()->previous())->withInput()->with('failed', 'Email already exists');
            }
        }

        try {
            DB::beginTransaction();

            if ($user->roles != 'user') {
                $data['roles'] = $request->role;
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            if($request->password && $request->password === $request->password_confirmation) {
                $data['password'] = Hash::make($request->password);
            }
            $data['updated_by'] = $user->id;
            
            User::where('id', $id)->update($data);

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect(url()->previous())->with('success', 'User Updated');
    }

    public function delete($id)
    {
        $data['deleted_by'] = Auth::id();
        User::where('id', $id)->update($data);

        $dataUser = User::findOrFail($id);

        if ($dataUser) {
            $dataUser->delete();
        }

        return view('pages.user.index');
    }
}
