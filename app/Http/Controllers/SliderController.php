<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class SliderController extends Controller
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
        $data = Slider::select('id_slide as id', 'title', 'judul', 'link', 'image', 'active','updated_at','created_at','user_id')->get();
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
            $rules = array(
                'judul' => 'required',
                'link' => 'required',
                'user_id' => 'required',
            );
            $messages = array(
                'image.required' => 'Gambar wajib di isi.',
                'link.required'=> 'Link Url wajib di isi',
            );
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                $errors = $messages->all();
                return response()->json($errors, 400);
            }
            $date = Carbon::now()->format('y-m-d h:i:s');
            $gambar = $this->request->file('gambar');
            $filename = 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('./slider/', $filename);

            $data = new Slider();
            $data->title = $this->request->titlen;
            $data->judul = $this->request->judul;
            $data->link = $this->request->link;
            $data->created_at = date('Y-m-d h:i:s');
            $data->updated_at = date('Y-m-d h:i:s');
            $data->user_id = $this->request->user_id;
            $data->image = $filename;
            $data->save();
            return response()->json([
                'messages' => 'data berhasil di tambahkan',
            ]);

        } catch (\App\Models\Slider $th) {
            return response()->json([
                'code' => '400',
                'messages' => $th->getMessage(),
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Slider::where('id_slide', $id)->get();
        return response()->json($data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        try {
            $rules = array(
                'image' => 'required',
                'judul' => 'required',
                'link' => 'required',
                'title' => 'required',
            );
            $messages = array(
                'image.required' => 'Gambar wajib di isi.',
                'judul.required' => 'Judul wajib di isi',
                'link.required' => 'Link Wajib di isi',
                'title.required' => 'Judul dalam bahasa inggris wajib di isi',
            );
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {

                $messages = $validator->messages();
                $errors = $messages->all();
                return response()->json($errors, 400);
            }

            $date = Carbon::now()->format('y-m-d h:i:s');
            $gambar = $this->request->file('picture');
            $filename = 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('./slider/', $filename);

            $data = new Slider();
            $data->title = $this->request->title;
            $data->judul = $this->request->judul;
            $data->link = $this->request->link;
            $data->image = $filename;
            $data->save();
            return response()->json([
                'messages' => 'data berhasil di tambahkan',
            ]);
        } catch (\App\Models\Slider $th) {
            return response()->json([
                'code' => '400',
                'messages' => $th->getMessage(),
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Slider::where('id_slide', $id);
            if ($data->get()->count() > 0) {
                $filename = $data->get()->first()->filename;
                @unlink('./slider/', $filename);
                $data->delete();
                return response()->json([
                    'messages' => 'data berhasil di hapus',
                ]);
            }
        } catch (\App\Models\Slider $th) {
            return response()->json([
                'code' => '400',
                'messages' => $th->getMessage(),
            ], 400);
        }

    }
}
