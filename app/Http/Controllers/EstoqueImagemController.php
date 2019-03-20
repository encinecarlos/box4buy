<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstoqueImagem;
use Intervention\Image\ImageManagerStatic as Image;

class EstoqueImagemController extends Controller
{
    private $iamge;

    public function getImage(Request $image)
    {
        $extension = $image->file('file')->getClientOriginalExtension();
        $name = str_random(20). '.'. $extension;
        $this->iamge = $name;
        return $this->iamge;
    }

    public function rotateLeft(Request $request)
    {
        $image = $request->file('file')->getClientOriginalExtension();
        $img = Image::make($image);
        $img->rotate(-90);
        $img->save($image);
        return $image;
//        return redirect()->back();
//        return dump($image[0]->caminho_imagem);
    }
}
