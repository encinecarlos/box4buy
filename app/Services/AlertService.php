<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 5/23/19
 * Time: 9:54 AM
 */

namespace App\Services;


use App\Alert;
use App\Services\Contracts\ServiceInterface;

class AlertService implements ServiceInterface
{
    private $model;

    public function __construct(Alert $alert)
    {
        $this->model = $alert;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function orderRecords($filter, $order)
    {
        return $this->model->orderBy($filter, $order)->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        $this->model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $this->model->find($id)->update($attributes);
    }

    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }
}
