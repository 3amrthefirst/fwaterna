<?php


namespace App\MyHelper;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Mockery\Exception;


class Photo
{


    static function addPhoto($file, $model, $folder_name, $relation = 'photo', $usage = null, $type = 'image')
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension

        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        if ($extension == 'svg') {
            $model->$relation()->create(
                [
                    'path'  => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                    'type'  => $type,
                    'usage' => $usage
                ]
            );
            return true;
        }

//        $image_400 = '400-' . time() . '' . rand(11111, 99999) . '.' . $extension;
//                    $resize_image = Image::make($destinationPath . $name);
//            $resize_image->resize(400, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath . $image_400, 100);



        $model->$relation()->create(
            [
                'path'  => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                'type'  => $type,
                'usage' => $usage
            ]
        );
    }

    static function addOriginalPhoto($file, $model, $folder_name, $relation = 'photo', $usage = null, $type = 'image')
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->$relation()->create(
            [
                'path'  => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                'type'  => $type,
                'usage' => $usage
            ]
        );
    }

    static function addPhotos($file, $model, $folder_name)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $image_400 = '400-' . time() . '' . rand(11111, 99999) . '.' . $extension;

//        $resize_image = Image::make($destinationPath . $name);
//
//        $resize_image->resize(400, null, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath . $image_400, 100);

        $model->create(['photo_url' => 'uploads/thumbnails/' . $folder_name . '/' . $name,

            'type' => 'photo']);
    }


    static function updatePhoto($file, $oldFiles, $model, $folder_name, $relation = 'photo', $usage = null, $type = 'image')
    {
//        info("start");
        if ($oldFiles) {
            File::delete(public_path() . '/' . $oldFiles->path);
        }

        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given
//        dd('uploads/thumbnails/' . $folder_name . '/' . $name);
        if ($extension == 'svg') {
            $input =
                [
                    'name' => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                    'type' => $type,
                    'usage' => $usage
                ];

            if ($oldFiles) {
                $model->$relation()->where(['type' => $type])->update($input);
            } else {

                $model->$relation()->create($input);
            }
            return true;
        }

        $image_400 = '400-' . time() . '' . rand(11111, 99999) . '.' . $extension;

//        $resize_image = Image::make($destinationPath . $name);
//
//        $resize_image->resize(400, null, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath . $image_400, 100);

        $input =
            [
                'path' => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                'type' => $type,
                'usage' => $usage,
            ];

        if ($oldFiles) {

            $oldFiles->update($input);

        } else {

            $model->$relation()->create($input);
        }

    }

    static function deletePhoto($model, $relation = 'photo', $multiple = false, $type = 'photo')
    {
        $photos = $model->$relation;

        if ($multiple == true) {
            foreach ($photos as $photo) {
                File::delete(public_path() . '/' . $photo->path);
                $photo->delete();
            }
            return true;
        } else {
            File::delete(public_path() . '/' . $photos->path);
        }

        $model->$relation()->where('type', $type)->delete();

    }

}
