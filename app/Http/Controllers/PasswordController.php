<?php

namespace App\Http\Controllers;
use Hash;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pass.index', [
            "title" => "SMP PTIK | Profil Pengguna",
            "judul" => "Profil Pengguna"
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pass.edit', [
            "title" => "SMP PTIK | Profil Pengguna",
            "judul" => "Profil Pengguna"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $input = $request->all();
        try {
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }
            
            $user = User::find($id);

            $user->update($input);

            return redirect()->route('pass.index')
                ->with('status', 'User updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('pass.index')
            ->with('failed', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
