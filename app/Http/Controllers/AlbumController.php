<?php

namespace App\Http\Controllers;

use App\album;
use Illuminate\Http\Request;

class albumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $albums = album::all();

         return response()->json($albums);
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
         $request->validate([
             'title' => 'required',
             'description' => 'required'
         ]);

         $album = album::create($request->all());

         return response()->json([
             'message' => 'Great success! New album created',
             'album' => $album
         ]);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\album  $album
     * @return \Illuminate\Http\Response
     */
     public function show(album $album)
     {
         return $album;
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\album  $album
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, album $album)
     {
         $request->validate([
            'title'       => 'nullable',
            'description' => 'nullable'
         ]);

         $album->update($request->all());

         return response()->json([
             'message' => 'Great success! album updated',
             'album' => $album
         ]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\album  $album
     * @return \Illuminate\Http\Response
     */
     public function destroy(album $album)
     {
         $album->delete();

         return response()->json([
             'message' => 'Successfully deleted album!'
         ]);
     }

     public function search(Request $request)
    {

        if ($request->has('id')) {

            $res = Albums::find($request->input('id'));
            return $res ? $res : 'raté.';
        }

        elseif ($request->has('string')) {

            $res = Albums::where(
                'artists', 'LIKE', '%'.$request->input('string').'%')->orWhere(
                'name', 'LIKE', '%'.$request->input('string').'%')->get();
            return $res ? $res : 'raté.';
         }

        return 'the search has yielded no result';

    }
}
