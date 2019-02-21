<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstoqueImagem;
use Intervention\Image\ImageManagerStatic as Image;

class EstoqueImagemController extends Controller
{
    public function rotateLeft(Request $request)
    {
        $image = EstoqueImagem::select('caminho_imagem')
                              ->where('seq_imagem', $request->imgid)
                              ->get();
        $img = Image::make($image[0]->caminho_imagem);
        $img->rotate(-90);
        $img->save($image[0]->caminho_imagem);
        return redirect()->back();
//        return dump($image[0]->caminho_imagem);
    }
}
