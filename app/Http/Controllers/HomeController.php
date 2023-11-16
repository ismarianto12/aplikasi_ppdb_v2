<?php
namespace App\Http\Controllers;

use App\Models\post;
use App\Models\Promosi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json(['api' => 'v1']);
    }
    public function artikel()
    {
        $data = post::get();
        return response()->json($data);
    }

    private function removeCharacter($parmater)
    {
        $paramater = str_replace($parmater, ' ', '-');
        $data = ucfirst($paramater);
        return $data;
    }

    private function filterPenghargaan($perPage, $tahun, $limit)
    {
        $query = DB::table('penghargaan')
            ->select('id', 'namapenghargaan', 'kategori', 'diberikanoleh', 'lokasi', 'tahun', 'file', 'updated_at', 'user_id');

        if ($tahun) {
            $query->whereYear('tahun', $tahun);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $penghargaan = $query->paginate($perPage);
        return response()->json($penghargaan);
    }

    public function penghargaan(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $tahun = $request->input('tahun');
        $limit = $request->input('limit');

        $penghargaan = $this->filterPenghargaan($perPage, $tahun, $limit);

        return $penghargaan;
    }

    public function randomPromo()
    {
        $data = Promosi::select('*')->orderBy('id','desc')->limit(4)->get();
        return response()->json($data);
    }

    public function filterPromo(Request $request)
    {
        $perPage = $request->input('per_page', 9);
        $tahun = $request->input('tahun', '');
        $limit = $request->input('limit', '');
        $sort = $request->input('sort', 'desc');

        $query = DB::table('promo')
            ->select(DB::raw('REPLACE(promo.titleID,"-"," ") as formatted_title'), 'id', 'titleID', 'seotitle', 'titleEn', 'deskripsiId', 'deskripsiEn', 'filethumnaild', 'imagepopup', 'imageheader', 'document1', 'document2', 'linkvideo', 'created_at', 'updated_at')
            ->whereNotNull('titleEn');

        if (!empty($tahun)) {
            $query->whereYear('created_at', $tahun);
        }

        if (!empty($sort)) {
            $query->orderBy('id', $sort);
        }

        if (!empty($limit)) {
            $query->limit($limit);
        }

        $posts = $query->paginate($perPage);

        return response()->json($posts);
    }

    public function filterPosts(Request $request)
    {
        $perPage = $request->input('per_page', 9); // Default to 10 per page, change as needed
        $tahun = $request->input('tahun', ''); // Filter by tahun
        $limit = $request->input('limit', ''); // Limit the results
        $sort = $request->input('sort', 'desc');
        $query = DB::table('post')
            ->select(DB::raw('REPLACE(post.title,"-"," ") as formatted_title'), 'post.id_post', 'post.id_category', 'post.stockcode', 'post.title', 'post.judul', 'post.content', 'post.isi', 'post.seotitle', 'post.tags', 'post.tag', DB::raw('DATE_FORMAT(post.date,"%Y-%M-%d") as date'), 'post.time', 'post.editor', 'post.protect', 'post.active', 'post.headline', 'post.picture', 'post.hits', 'post.new_version', 'category.title as category_title')
            ->join('category', 'post.title', '=', 'category.id_category', 'left')
            ->where('post.id_category', '!=', 33)
            ->where('post.active', 1)
            ->whereNotNull('post.title');
        if (!empty($tahun)) {
            $query->whereYear('post.date', $tahun);
        }
        if (!empty($sort)) {
            $query->orderBy('post.id_post', $sort);
        }
        if (!empty($limit)) {
            $query->limit($limit);
        }
        $posts = $query->paginate($perPage);
        return response()->json($posts);
    }

    public function filterNewGalery(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'per_page' => 'integer|min:1|max:100',
                'year' => 'nullable|date_format:Y',
                'limit' => 'nullable|integer|min:1|max:100',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
        $perPage = $validatedData['per_page'] ?? 8;
        $tahun = $validatedData['year'] ?? '';
        $limit = $validatedData['limit'] ?? '';

        $query = DB::table('events')
            ->select(
                'events.title',
                'events.headline',
                'events.published',
                'events.active',
                'events.images',
                'events.images_desc'
            );

        if ($tahun != '') {
            $query->whereYear('events.created_at', $tahun);
        }
        if (!empty($limit)) {
            $query->limit($limit);
        }

        $data = $query->paginate($perPage);
        return response()->json($data);
    }

    public function filterGalery(Request $request)
    {
        $perPage = $request->input('per_page', 8); // Default to 10 per page, change as needed
        $tahun = $request->input('year', ''); // Filter by tahun
        $limit = $request->input('limit', ''); // Limit the results
        $query = DB::table('galery')
            ->select(
                'galery.id',
                'galery.title',
                'galery.deskripsiId',
                'galery.deskripsiEn',
                'galery.id_album',
                'galery.gambar',
                'galery.created_at',
                'album.title AS album_title',
                'album.seotitle AS album_seotitle',
                'album.active AS album_active'
            )
            ->leftJoin('album', 'galery.id_album', '=', 'album.id_album'); // Left join with the album table

        if ($tahun != '') {
            $query->whereYear('galery.created_at', $tahun);
        }

        if (!empty($limit)) {
            $query->limit($limit);
        }

        $galeries = $query->paginate($perPage);
        return response()->json($galeries);
    }

    public function filterEvent(Request $request)
    {
        $perPage = $request->input('per_page', 8); // Default to 10 per page, change as needed
        $tahun = $request->input('year', ''); // Filter by tahun
        $limit = $request->input('limit', ''); // Limit the results
        $query = DB::table('events')
            ->select(
                'events.title',
                'events.headline',
                'events.published',
                'events.active',
                'events.images',
                'events.images_desc'
            );
        // if ($tahun != '') {
        //     $query->whereYear('events.created_at', $tahun);
        // }

        if (!empty($limit)) {
            $query->limit($limit);
        }

        $galeries = $query->paginate($perPage);
        return response()->json($galeries);
    }

    public function filterPostsBycat(Request $request)
    {
        $perPage = $request->input('per_page', 9); // Default to 10 per page, change as needed
        $category = $request->input('category', ''); // Filter by tahun
        $limit = $request->input('limit', ''); // Limit the results

        $query = DB::table('post')
            ->select(DB::raw('REPLACE(post.title,"-"," ") as formatted_title'), 'post.id_post', 'post.id_category', 'post.stockcode', 'post.title', 'post.judul', 'post.content', 'post.isi', 'post.seotitle', 'post.tags', 'post.tag', DB::raw('DATE_FORMAT(post.date,"%Y-%M-%d") as date'), 'post.time', 'post.editor', 'post.protect', 'post.active', 'post.headline', 'post.picture', 'post.hits', 'post.new_version', 'category.title')

            ->join('category', 'post.id_category', '=', 'category.id_category', 'left')
            ->where('post.active', 1)
            ->where('category.seotitle', $category)
            ->whereNotNull('post.title');
        if (!empty($tahun)) {
            $query->whereYear('post.date', $tahun);
        }

        if (!empty($limit)) {
            $query->limit($limit);
        }
        $posts = $query->paginate($perPage);
        return response()->json($posts);
    }

    public function jadwalEdukasi(Request $request)
    {
        $perPage = $request->input('per_page', 9);
        $category = $request->category === 'Konvensional' ? 1 : 2;
        $limit = $request->input('limit', '');
        $tahun = $request->input('tahun', '');
        $query = DB::table('jadwal')
            ->select('id', 'topic', 'descriptionId', 'descriptionEn', 'type_edukasi', 'link_registrasi', 'image', 'created_at', 'updated_at', 'user_id')
        // ->where('active', 1)
            ->where('type_edukasi', $category);
        if (!empty($tahun)) {
            $query->whereYear('created_at', $tahun); // Adjust this based on your actual column name
        }

        if (!empty($limit)) {
            $query->limit($limit);
        }

        $posts = $query->paginate($perPage);

        return response()->json($posts);
    }

    public function searchPost(Request $request)
    {

        $rules = array(
            'q' => 'required',
        );
        $messages = array(
            'q.required' => 'query pencarian wajib.',
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response()->json($errors);
        }
        $perPage = $request->input('per_page', 9);
        $query = $request->input('q', '');
        $limit = $request->input('limit', '');

        $query = Post::select('post.id_post', 'post.id_category', 'post.stockcode', 'post.title', 'post.judul', 'post.content', 'post.isi', 'post.seotitle', 'post.tags', 'post.tag', 'post.date', 'post.time', 'post.editor', 'post.protect', 'post.active', 'post.headline', 'post.picture', 'post.hits', 'post.new_version', 'category.title')
            ->join('category', 'post.id_category', '=', 'category.id_category', 'left')
            ->where('post.judul', 'like', '%' . $query . '%')
            ->where('post.title', 'like', '%' . $query . '%')
            ->where('post.isi', 'like', '%' . $query . '%');
        // ->whereNotNull('post.title');
        if (!empty($tahun)) {
            $query->whereYear('post.date', $tahun);
        }
        if (!empty($limit)) {
            $query->limit($limit);
        }
        $posts = $query->paginate($perPage);
        return response()->json($posts);
    }

    //

    public function currency()
    {
        $path = public_path() . '/dataxmls/currencies.xml';

        if (File::exists($path)) {
            $xmlContent = File::get($path);

            return $xmlContent;
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }

    public function promoshow($id)
    {
        try {
            $data = Promosi::where('seotitle', $id)->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function parameterbiaya()
    {
        $data = DB::table('biaya_ppdb')->get();
        return response()->json($data);


    }
}
