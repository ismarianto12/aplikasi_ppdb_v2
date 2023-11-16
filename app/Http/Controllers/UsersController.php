<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $data = User::get();
        return response()->json($data);
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
        try {

            $data = new User();
            $data->id_user = $this->request->id_user;
            $data->username = $this->request->username;
            $data->password = $this->request->password;
            $data->nama_lengkap = $this->request->nama_lengkap;
            $data->email = $this->request->email;
            $data->no_telp = $this->request->no_telp;
            $data->sector = $this->request->sector;
            $data->bio = $this->request->bio;
            $data->userpicture = $this->request->userpicture;
            $data->level = $this->request->level;
            $data->blokir = $this->request->blokir;
            $data->id_session = $this->request->id_session;
            $data->tgl_daftar = $this->request->tgl_daftar;
            $data->forget_key = $this->request->forget_key;
            $data->locktype = $this->request->locktype;
            $data->save();
            return response()->json(['messages' => 'Data user berhasil dis simpan']);

        } catch (\User $th) {
            return response()->json(['messages' => $th]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Users::where('id_user', $id)->first();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if ($this->request->password === '' || $this->request->user_id === '') {
            return response()->json(['message' => 'Password berhasil diperbarui'], 400);
        } else {
            $hashedPassword = bcrypt($this->request->password);
            $user_id = $this->request->user_id;
            DB::table('users')
                ->where('id_user', $user_id)
                ->update(['password' => $hashedPassword]);

            return response()->json(['message' => 'Password berhasil diperbarui'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Users::where('id_user', $id)->delete();
            return response()->json('berhasil di hapus');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
