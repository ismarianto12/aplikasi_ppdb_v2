<?php

namespace App\Http\Controllers;

use App\Models\pages;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PagesController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $data = pages::get();

        return response()->json($data);

    }

    public function create()
    {
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

            $date = Carbon::now()->format('y-m-d h:i:s');
            $gambar = $this->request->file('picture');
            $filename = 'halaman_pages' . rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('./halaman/', $filename);

            $data = new pages();
            $data->id_pages = $this->request->id_pages;
            $data->title = $this->request->title ? $this->request->title : $this->request->headline;
            $data->titleen = $this->request->titleen ? $this->request->titleen : '';
            $data->content = $this->request->content ? $this->request->content : '';
            $data->contenten = $this->request->contenten ? $this->request->contenten : '';
            $data->seotitle = $this->createSeoUrl($data->title);
            $data->tags = $this->request->tags;
            $data->picture = $filename;
            $data->active = $this->request->active;
            $data->save();
            return response()->json([
                'status' => 'ok', 'messages' => 'databerhasil di tambahkan',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error event insert data',
                'errorcode' => 'error code' . $th,
            ]);
        }

    }

    public function createSeoUrl($string)
    {
        $string = strtolower($string); // Convert to lowercase
        $string = preg_replace('/[^a-z0-9\-]/', '-', $string); // Replace non-alphanumeric characters with hyphens
        $string = preg_replace('/-+/', '-', $string); // Replace multiple hyphens with a single hyphen
        $string = trim($string, '-'); // Trim hyphens from the beginning and end
        return $string;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(pages $pages)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pages  $pages
     * @return \Illuminate\Http\Response
     */

    private function convertToHTML($text)
    {
        // Define an array of special characters and their corresponding HTML entities
        $htmlEntities = array(
            '<' => '&lt;',
            '>' => '&gt;',
            '"' => '&quot;',
            '&' => '&amp;',
            ' ' => '&nbsp;',
        );

        foreach ($htmlEntities as $char => $entity) {
            $text = str_replace($char, $entity, $text);
        }

        return $text;
    }
    public function edit($id)
    {
        $data = pages::where('id_pages', $id)->first();
        return response()->json($data);
    }
    public function update($id)
    {
        try {
            // Find the record by ID or throw a 404 exception if not found
            $data = pages::findOrFail($id);

            // Check if a new picture file is uploaded
            if ($this->request->hasFile('picture')) {
                $gambar = $this->request->file('picture');
                $filename = 'halaman_pages' . rand() . '.' . $gambar->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $gambar->move('./halaman/', $filename);
            } else {
                $filename = $data->picture;
            }

            // Update the record with the new data
            $data->update([
                'title' => $this->request->title,
                'titleen' => $this->request->titleen,
                'content' => $this->request->content,
                'contenten' => $this->request->contenten,
                'seotitle' => $this->createSeoUrl($this->request->title),
                'tags' => $this->request->tags,
                'picture' => $filename,
                'active' => $this->request->active,
            ]);

            return response()->json([
                'status' => 'ok',
                'message' => 'Data berhasil diupdate',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate data: ' . $th->getMessage(),
                'errorcode' => 'error code' . $th->getCode(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(pages $pages)
    {
        try {
            $data = pages::where('id_pages')->delete();
            return response()->json([
                'status' => 'ok',
                'messages' => 'berhasil',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'messages' => $th,
            ]);
        }
    }
}
