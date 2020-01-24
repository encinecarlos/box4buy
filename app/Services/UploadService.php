<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 7/2/19
 * Time: 2:01 PM
 */

namespace App\Services;


use App\ConfirmaDados;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function upload(array $attributes, Model $model = null)
    {
        if (key_exists('file', $attributes)) {
            $filename = $attributes['filename'] . '.' . $attributes['file']->clientExtension();

            $user_folder = $attributes['folder_name'];
            if(!is_dir($user_folder)) {
                Storage::disk('s3')->makeDirectory($user_folder);
            }

            if (Storage::allFiles($user_folder) == []) {
                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);

                if ($model != null) {
                    $data = [
                        'config_id' => '1',
                        'home_image' => Storage::url($path),
                        'is_overlay' => key_exists('is_overlay', $attributes) ? $attributes['is_overlay'] : '0'
                    ];

                    $model::create($data);
                }
            } else {
                Storage::delete($user_folder.DIRECTORY_SEPARATOR.$filename);

                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                if ($model != null) {
                    $dataUpdate = [
                        'home_image' => Storage::url($path),
                        'is_overlay' => key_exists('is_overlay', $attributes) ? $attributes['is_overlay'] : '0'
                    ];

                    $model::updateOrCreate(['id' => '1'], $dataUpdate);
                }
            }
        }

        return response(['url' => Storage::url($path)]);
    }

    public function delete(array $attributes)
    {

    }
}
