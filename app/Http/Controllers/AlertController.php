<?php

namespace App\Http\Controllers;

use App\Facades\CotacaoDolar;
use App\Services\AlertService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    private $alert;

    public function __construct(AlertService $alert)
    {
        $this->alert = $alert;
    }

    public function index()
    {
        $alerts = $this->alert->getAll();
//        $alerts = $this->alert->orderRecords('created_at', 'desc');
//        CotacaoDolar::
        return view('alerts.main', ['alerts' => $alerts]);
    }

    public function add()
    {
        return view('alerts.add');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->alert->create($data);
        return response('Publicado com sucesso!');
    }

    public function show($id)
    {
        $alert = $this->alert->getById($id);
        return view('alerts.edit', ['alert' => $alert]);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        $this->alert->update($data, $id);
        return response('Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->alert->delete($id);
        return response("O registro foi excluido com sucesso!");
    }
}
