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

    public function listRiset()
    {
        $category = $this->request->category;
        $perPage = $this->request->page ? $this->request->page : 1;
        $query = DB::table('post')
            ->select(
                DB::raw('REPLACE(post.title,"-"," ") as formatted_title'),
                'post.id_post as id',
                'post.id_category',
                'post.stockcode',
                'post.title',
                'post.judul',
                'post.content',
                'post.isi',
                'post.seotitle', 'post.tags', 'post.tag',
                DB::raw('DATE_FORMAT(post.date,"%Y-%M-%d") as date'),
                'post.time',
                'post.editor',
                'post.protect',
                'post.active',
                'post.headline',
                'post.picture',
                'post.hits',
                'post.status',
                'post.new_version',
                'category.title',
                'created_by_user.nama_lengkap as created_by',
                'updated_by_user.nama_lengkap as updated_by',
                DB::raw('DATE_FORMAT(post.created_on,"%d-%M-%Y %H:%m") as created_on'),
                DB::raw('DATE_FORMAT(post.updated_on,"%d-%M-%Y %H:%m") as updated_on'),
            )
            ->leftJoin('category', 'post.id_category', '=', 'category.id_category')
            ->leftJoin('users as created_by_user', 'post.created_by', '=', 'created_by_user.id_user')
            ->leftJoin('users as updated_by_user', 'post.updated_by', '=', 'updated_by_user.id_user')
            ->where('category.seotitle', $category);

        if ($this->request->q) {
            $searchTerm = '%' . $this->request->q . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('post.title', 'LIKE', $searchTerm);
                $query->orWhere('post.judul', 'LIKE', $searchTerm);
            });
        }
        if ($this->request->sort) {
            if ($this->request->column == 'formatted_title') {
                $query->orderBy('post.title', $this->request->sort);
            } else {
                $query->orderBy('post.id_post', $this->request->sort);
            }
        }
        $posts = $query->paginate(7, ['*'], 'page', $perPage);

        return response()->json(['data' => $posts]);
    }
    public function index(Request $request)
    {
        $perPage = $request->page ? $request->page : 1;
        $category = $request->input('category', '');
        $parameter_id = $this->request->parameter_id;
        $limit = isset($this->request->limit) ? $this->request->limit : 7;
        $query = DB::table('post')
            ->select(
                DB::raw('REPLACE(post.title,"-"," ") as formatted_title'),
                'post.id_post as id',
                'post.id_category',
                'post.stockcode',
                'post.title',
                'post.judul',
                'post.content',
                'post.isi',
                'post.seotitle', 'post.tags', 'post.tag',
                DB::raw('DATE_FORMAT(post.date,"%d-%M-%Y %H:%m") as date'),
                'post.time',
                'post.editor',
                'post.protect',
                'post.active',
                'post.headline',
                'post.picture',
                'post.hits',
                'post.status',
                'post.new_version',
                'category.title',
                'created_by_user.nama_lengkap as created_by',
                'updated_by_user.nama_lengkap as updated_by',
                DB::raw('DATE_FORMAT(post.created_on,"%d-%M-%Y %H:%m") as created_on'),
                DB::raw('DATE_FORMAT(post.updated_on,"%d-%M-%Y %H:%m") as updated_on')
            )
            ->leftJoin('category', 'post.id_category', '=', 'category.id_category')
            ->leftJoin('users as created_by_user', 'post.created_by', '=', 'created_by_user.id_user')
            ->leftJoin('users as updated_by_user', 'post.updated_by', '=', 'updated_by_user.id_user');

        if ($this->request->parameter_id === 'artikel') {
            $query->whereIn('category.id_category', [
                35,
                36,
            ]);
        } else {
            $query->whereNotIn('category.seotitle', [
                'mncs-daily-scope-wave',
                'mncs-morning-navigator',
                'market-focus',
                'company-update',
            ]);
        }
        $user_id = $this->request->user_id;
        if ($this->request->level != 1) {
            $query->where('post.editor', $user_id);
        }
        if ($this->request->q) {
            $searchTerm = '%' . $this->request->q . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('post.title', 'LIKE', $searchTerm);
                $query->orWhere('post.judul', 'LIKE', $searchTerm);
            });
        }
        if ($this->request->sort) {
            if ($this->request->column == 'formatted_title') {
                $query->orderBy('post.title', $this->request->sort);
            } else {
                $query->orderBy('post.id_post', $this->request->sort);
            }
        }
        if ($this->request->filter) {
            $query->where('post.id_category', $this->request->filter);
        }
        $posts = $query->paginate(7, ['*'], 'page', $perPage);
        return response()->json(['data' => $posts]);
    }

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
                'picture' => 'required|mimes:jpeg,jpg,png,bmp,pdf,ppt',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $validator->errors(),
                ], 400); // Menggunakan status HTTP 400 untuk kesalahan validasi
            }

            $date = Carbon::now()->format('Y-m-d H:i:s');
            $gambar = $request->file('picture');
            $filename = $gambar->getClientOriginalName(); // Use the original file name
            // 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();

            $gambar->move('./files/', $filename);

            $action = isset($this->request->action) ? $this->request->action : '';
            $id_category = $this->request->id_category;

            if ($action == 'riset') {
                $catdata = DB::table('category')->where('seotitle', $id_category)->first();
                $namacat = isset($catdata->id_category) ? $catdata->id_category : $catdata->id_category;
            } else {
                $namacat = $this->request->id_category;
            }

            $insert = new Post;
            $insert->stockcode = "";
            $insert->id_category = $namacat;
            $insert->title = $this->request->title;
            $insert->seotitle = $this->createSeoUrl($this->request->title);
            $insert->judul = $this->request->judul;
            $insert->content = $this->request->content;
            $insert->isi = $this->request->isi;
            $insert->tags = $this->request->tags;
            $insert->tag = '1';
            $insert->protect = 'Y';
            $insert->picture = $filename;
            $insert->editor = $this->request->user_id;

            $insert->created_on = date('Y-m-d H:i:s');
            $insert->created_by = $this->request->id_user;

            if ($this->request->level_id === '1') {
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
        $data = post::select('post.id_post',
            'post.id_category',
            'post.stockcode',
            'post.title',
            'post.judul',
            'post.content',
            'post.isi',
            'post.seotitle',
            'post.tags',
            'post.tag',
            'post.date',
            'post.time',
            'post.editor',
            'post.protect',
            'post.active',
            'post.headline',
            'post.picture',
            'post.hits',
            'post.new_version',
            'category.id_category',
            'category.title as title_category',
            'category.seotitle as seotitle_category'
        )->join('category', 'post.id_category', '=', 'category.id_category', 'left')->where('id_post', $id)->first();

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
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $validator->errors(),
                ], 400);
            }
            if ($gambar != null) {
                $validator = Validator::make($request->all(), [
                    'picture' => 'mimes:jpeg,jpg,png,bmp,pdf',
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
                $filename = $gambar->getClientOriginalName();
                $gambar->move('./files/', $filename);
            } else {
                $filename = isset($edit->first()->picture) ? $edit->first()->picture : '';
            }
            $action = isset($this->request->action) ? $this->request->action : '';
            $category_id = $this->request->id_category;

            // if ($action == 'riset') {
            //     $catdata = DB::table('category')->where('seotitle', $category_id)->first();
            //     $namacat = $catdata->id_category;
            // } else {
            $namacat = $this->request->id_category;
            // }

            if ($this->request->action == 'riset') {
                $parameter = [
                    'stockcode' => $request->input('stockcode', ''),
                    'title' => $this->request->title,
                    'seotitle' => $this->createSeoUrl($request->input('title')),
                    'judul' => $this->request->judul,
                    'content' => $this->request->content,
                    'isi' => $this->request->isi,
                    'tags' => 'Riset, MNC',
                    'tag' => 'Riset, MNC',
                    'protect' => ($this->request->protect) ? $this->request->protect : $this->request->active,
                    'editor' => $this->request->user_id,
                    'picture' => $filename,
                    'date' => $date,
                    'updated_by' => $this->request->user_id,
                    'updated_on' => date('Y-m-d'),

                ];
            } else {
                $parameter = [
                    'id_category' => $namacat,
                    'stockcode' => $request->input('stockcode', ''),
                    'title' => $this->request->title,
                    'seotitle' => $this->createSeoUrl($request->input('title')),
                    'judul' => $this->request->judul,
                    'content' => $this->request->content,
                    'isi' => $this->request->isi,
                    'tags' => $this->request->tags,
                    'tag' => $this->request->tags,
                    'protect' => ($this->request->protect) ? $this->request->protect : $this->request->active,
                    'editor' => $this->request->user_id,
                    'picture' => $filename,
                    'date' => $date,
                    'updated_by' => $this->request->user_id,
                    'updated_on' => date('Y-m-d'),
                ];
            }
            $edit->update($parameter);
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
        }
    }
    public function categoryartikel()
    {
        $data = DB::table('category')->whereIn('id_category', [
            '35',
            '36',
        ])->get();
        return response()->json($data);
    }

}
