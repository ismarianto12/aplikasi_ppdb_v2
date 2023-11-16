<?php

namespace App\Http\Controllers;

use App\Models\events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 9); // Default to 10 per page, change as needed
        $tahun = $request->input('tahun', ''); // Filter by tahun
        $limit = $request->input('limit', ''); // Limit the results
        $sort = $request->input('sort', 'desc');
        $query = DB::table('posts')
            ->select('id', 'title', 'headline', 'published', 'active', 'images', 'images_desc', 'created_at')
            ->where('active', 'Y') // Ubah 1 menjadi 'Y' sesuai dengan enum
            ->whereNotNull('title');

        if (!empty($tahun)) {
            $query->whereYear('published', $tahun); // Ubah 'date' menjadi 'published' sesuai dengan nama kolom yang baru
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
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(events $events)
    {
        //
    }
}
