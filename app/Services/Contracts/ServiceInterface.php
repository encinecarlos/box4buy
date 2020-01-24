<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 5/23/19
 * Time: 9:49 AM
 */

namespace App\Services\Contracts;


interface ServiceInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function delete($id);
}
