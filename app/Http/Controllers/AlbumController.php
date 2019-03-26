<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
        {
           $albums = Album::all();
          return response()->json($albums, 200);
       }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('albums.create');
        }
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
             if($request->hasfile('filename'))
             {
                $file = $request->file('filename');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
            }
            $request->validate([
                'name'=>'required',
                'gender'=>'required',
                'year' => 'required',
                'label'=>'required',
                'note'=>'required',
            ]);
            $albums = new Album([
                'name' => $request->get('name'),
                'file'=> $request->get('file'),
                'gender'=> $request->get('gender'),
                'year'=> $request->get('year'),
                'label'=> $request->get('label'),
                'note'=> $request->get('note'),
                'artists'=> json_encode($request->get('artists')),
                'songs'=> json_encode($request->get('songs'))
            ]);
            $status = $albums->save();

            return $status ? "OK" : 'raté';


        }
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
             $albums = Album::find($id);
             return response()->json($albums, 200);

        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $albums = Album::find($id);
            return view('albums.edit', compact('albums'));
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $request->validate([
                'name'=>'required',
                'gender'=>'required',
                'year' => 'required',
                'label'=>'required',
                'note'=>'required',
            ]);
            $album = Album::find($id);
            $album->name = $request->get('name');
            $album->file = $request->get('file');
            $album->gender = $request->get('gender');
            $album->year = $request->get('year');
            $album->label = $request->get('label');
            $album->note = $request->get('note');
            $album->artists = json_encode($request->get('artists'));
            $album->songs = json_encode($request->get('songs'));

            $status = $album->save();

             return $status ? "OK" : 'raté';
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $albums = Album::find($id);
            $status=$albums->delete();

             return $status ? "OK" : 'raté';
        }


        public function search(Request $request)
        {

            if ($request->has('id')) {

                $res = Album::find($request->input('id'));
                return $res ? $res : 'raté.';
            }

            elseif ($request->has('string')) {

                $res = Album::where(
                    'artists', 'LIKE', '%'.$request->input('string').'%')->orWhere(
                    'name', 'LIKE', '%'.$request->input('string').'%')->get();
                return $res ? $res : 'raté.';
             }

            return 'coucou';

        }
    }
