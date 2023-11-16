<?php

namespace App\Http\Controllers;

use App\Models\post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class PostController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index(Request $request)
    {
        $perPage = $request->page ? $request->page : 8; // Default to 10 per page, change as needed
        $category = $request->input('category', ''); // Filter by tahun
        $limit = 7; //$request->input('limit', ''); // Limit the results
        $query = DB::table('post')
            ->select(DB::raw('REPLACE(post.title,"-"," ") as formatted_title'), 'post.id_post as id', 'post.id_category', 'post.stockcode', 'post.title', 'post.judul', 'post.content', 'post.isi', 'post.seotitle', 'post.tags', 'post.tag', DB::raw('DATE_FORMAT(post.date,"%Y-%M-%d") as date'), 'post.time', 'post.editor', 'post.protect', 'post.active', 'post.headline', 'post.picture', 'post.hits', 'post.new_version', 'category.title')

            ->join('category', 'post.id_category', '=', 'category.id_category', 'left');
        // ->where('post.active', 1)
        // ->where('category.seotitle', $category)
        // ->whereNotNull('post.title');

        $user_id = $this->request->user_id;
        if ($this->request->level != 1) {
            $query->where('post.editor', $user_id);
        }
        // if (!empty($limit)) {
        //     $query->limit($limit);
        // }
        // $posts = $query->paginate($perPage);
        $posts = $query->get();
        return response()->json(['data' => $posts]);
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

    public function createSeoUrl($string)
    {
        $string = strtolower($string); // Convert to lowercase
        $string = preg_replace('/[^a-z0-9\-]/', '-', $string); // Replace non-alphanumeric characters with hyphens
        $string = preg_replace('/-+/', '-', $string); // Replace multiple hyphens with a single hyphen
        $string = trim($string, '-');
        return $string;
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_category' => 'required',
                'title' => 'required',
                'judul' => 'required',
                'content' => 'required',
                'isi' => 'required',
                // 'tags' => 'required',
                // 'tag' => 'required',
                // 'protect' => 'required',
                'picture' => 'required|mimes:jpeg,jpg,png,bmp',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $validator->errors(),
                ], 400); // Menggunakan status HTTP 400 untuk kesalahan validasi
            }

            $date = Carbon::now()->format('Y-m-d H:i:s');
            $gambar = $request->file('picture');
            $filename = 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('./files/', $filename);

            $insert = new Post;
            $insert->stockcode = "";
            $insert->id_category = $this->request->id_category;
            $insert->title = $this->request->title;
            $insert->seotitle = $this->createSeoUrl($this->request->title);
            $insert->judul = $this->request->judul;
            $insert->content = $this->request->content;
            $insert->isi = $this->request->isi;
            $insert->tags = $this->request->tags;
            $insert->tag = '1';
            $insert->protect = $this->request->protect;
            $insert->picture = $filename;
            $insert->editor = $this->request->id_user;
            // $insert-

            if ($this->request->role === '1') {
                $insert->active = 1;
            } else {
                $insert->active = 2;
            }

            $insert->new_version = '1';
            $insert->date = $date;
            $insert->save();

            return response()->json([
                'status' => 'ok',
                'messages' => 'Data berhasil ditambahkan',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error event insert data',
                'errorcode' => 'error code ' . $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = post::where('id_post', $id)->first();
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            $edit = Post::where('id_post', $id);
            $date = Carbon::now()->format('Y-m-d H:i:s');
            $gambar = $request->file('picture');

            // Validasi input
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'picture' => 'mimes:jpeg,jpg,png,bmp',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $validator->errors(),
                ], 400);
            }

            // Validasi gambar jika diunggah
            if ($gambar != null) {
                $validator = Validator::make($request->all(), [
                    'picture' => 'mimes:jpeg,jpg,png,bmp',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'messages' => $validator->errors(),
                    ], 400);
                }

                if ($edit->count() > 0 && $edit->first()->picture) {
                    @unlink('./files/' . $edit->first()->picture);
                }

                $filename = 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move('./files/', $filename);
            } else {
                $filename = isset($edit->first()->picture) ? $edit->first()->picture : '';
            }

            $edit->update([
                'stockcode' => $request->input('stockcode', ''),
                'id_category' => $request->input('id_category', ''),
                'title' => $request->input('title', ''),
                'seotitle' => $this->createSeoUrl($request->input('title')),
                'judul' => $request->input('judul', ''),
                'content' => $request->input('content', ''),
                'isi' => $request->input('isi', ''),
                'tags' => $request->input('tags', ''),
                'tag' => $request->input('tag', ''),
                'protect' => $request->input('protect', ''),
                'editor' => $this->request->user_id,
                'picture' => $filename,
                'date' => $date,
            ]);
            return response()->json([
                'status' => 'ok',
                'messages' => 'Data berhasil diupdate',
            ]);
        } catch (\Post $th) {
            return response()->json([
                'status' => 'error event update data',
                'errorcode' => 'error code ' . $th->getMessage(),
            ], 400);
        }
    }
    public function destroy($id)
    {
        try {
            $get = post::where('id_post', $id);
            if ($get->count() > 0) {
                @unlink('./file/' . $get->first()->picture);
            }
            $get->delete($id);
            return response()->json(['messages' => 'data berhasil dihapus']);
        } catch (\post $th) {
            return response()->json(['messages' => $th]);

        }
    }

    public function setactive($id)
    {
        try {
            Post::where('id_post', $id)->update([
                'active' => 1,
            ]);
            return response()->json([
                'messages' => 'data berhasil di perbarui',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);

        }

    }
    public function actived()
    {
        $active = $this->request->active;
        $artikel_id = $this->request->artikel_id;
        try {
            $post = Post::where('id_post', $artikel_id)->first();
            if (!$post) {
                return response()->json(['message' => 'Data Post tidak ditemukan'], 404);
            }
            $post->active = $active;
            $post->save(); // Simpan perubahan ke dalam database

            return response()->json(['message' => 'Data Post berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }}

}
