<?php

namespace App\Http\Controllers;

use App\Repositories\AlertRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    private $alert;

    public function __construct(AlertRepository $alert)
    {
        $this->alert = $alert;
    }

    public function index()
    {
        return $this->alert->getAll();
    }

    public function store()
    {
        $data = [
            'title' => str_random(10),
            'description' => str_random(200),
            'expires_at' => Carbon::now()->addDays(15)
        ];
        $this->alert->create($data);
        return $data;
    }

    public function show($id)
    {
        return $this->alert->getById($id);
    }

    public function update($id)
    {
        $data = [
            'description' => uniqid()
        ];
        $this->alert->update($data, $id);
        return [$data, $id];
    }

    public function destroy($id)
    {
        $this->alert->delete($id);
        return "Registro $id excluido!";
    }
}
