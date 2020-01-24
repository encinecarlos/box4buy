<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 7/2/19
 * Time: 2:39 PM
 */

namespace App\Services\Contracts;


interface UploadServiceInterface
{
    public function upload(array $attributes);
    public function delete(array $attributes);
}
