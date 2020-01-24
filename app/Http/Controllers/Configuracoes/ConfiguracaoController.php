<?php

namespace App\Http\Controllers\Configuracoes;

use App\Services\Contracts\ConfiguracaoService;
use App\Services\UploadService;
use App\SiteImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Configuration;

class ConfiguracaoController extends Controller
{
    private $service;
    private $upload;

    public function __construct(ConfiguracaoService $service, UploadService $uploadService)
    {
        $this->service = $service;
        $this->upload = $uploadService;
    }

    public function index()
    {
        return $this->service->render();
    }

    public function update(Request $request)
    {
        return $this->service->save($request->all());
    }

    public function generatePassword()
    {
        return $this->service->passGenerator();
    }

    public function uploadHomeImage(Request $request)
    {
        $this->upload->upload($request->all(), new SiteImage());
    }
}
