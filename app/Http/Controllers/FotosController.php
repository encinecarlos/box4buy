<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FotosController extends Controller
{
    private $foto;

    public function __construct(Foto $Foto)
    {
        $this->foto = $Foto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Foto::all();
        return $todos;
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
        $filename = str_random(30) . '.' . $request->file('file')->clientExtension();

        $destination = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'fotos';

        $fullpath = DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . $filename;
        $request->file('file')->move($destination, $filename);

        $this->foto->user_id = $request->codigo;
        $this->foto->order = $request->order;
        $this->foto->description = $request->description;
        $this->foto->path = $fullpath;
        $this->foto->filename = $filename;

        $this->foto->save();

        return response()->json([$request, $filename]);
    }

    /**
     * Display the specified resource.
     *
     * @param $codId
     * @return \Illuminate\Http\Response
     * @internal param ImovelFoto $imovelFoto
     */
    public function show($id)
    {
        $fotos = DB::table('fotos')->where('user_id', $id)->orderBy('order', 'asc')->get();
        //$fotos = ImovelFoto::where('imovel_id', $codId);
        return response()->json($fotos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImovelFoto  $imovelFoto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $Foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $filename = str_random(30) . '.' . $request->file('file')->clientExtension();

            $destination = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'fotos';

            $fullpath = DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . $filename;
            $request->file('file')->move($destination, $filename);

            DB::table('fotos')->where('id', $id)->update($request->all());
        } else {
            DB::table('fotos')->where('id', $id)->update($request->all());
        }

        return response()->json(['msg' => 'Descrição alterada!']);
    }

    /**
     * update orrder of image
     *
     * @param Illuminate\Http\Request  $request
     * @param int $id id of resource
     * @return \Illuminate\Http\Response
     */
    public function changeOrder(Request $request, $id)
    {
        DB::table('fotos')->where('id', $id)->update(['order' => $request->input('order')]);

        return response()->json("Ordem da foto alterada!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param ImovelFoto $imovelFoto
     */
    public function destroy($id)
    {
        $fotoimovel = DB::table('fotos')->where('id', $id)->first();

        $file = public_path() . "/storage/fotos/$fotoimovel->filename";
        if (file_exists($file)) {
            unlink($file);
        }

        DB::table('imovel_fotos')->where('id', $id)->delete();

        return response()->json($fotoimovel);
    }
}
