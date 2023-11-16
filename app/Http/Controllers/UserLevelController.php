<?php

namespace App\Http\Controllers;

use App\Models\user_level;
use Illuminate\Http\Request;

class UserLevelController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $data = user_level::get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $level = new user_level;
        $level->level = $this->request->level;
        $level->save();
        return response()->json([
            'messages' => "berhasil",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user_level  $user_level
     * @return \Illuminate\Http\Response
     */
    public function show(user_level $user_level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user_level  $user_level
     * @return \Illuminate\Http\Response
     */
    public function edit(user_level $user_level)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user_level  $user_level
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $level = user_level::where('id', $id);
        $level->level = $this->request->level;
        $level->save();
        return response()->json([
            'messages' => "berhasil",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user_level  $user_level
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_level $user_level)
    {
        //
    }
}
