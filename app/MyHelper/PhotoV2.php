<?php


namespace App\MyHelper;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Mockery\Exception;


class PhotoV2
{

    static function inArray($key, $array, $value)
    {
        $return = array_key_exists($key, $array) ? $array[$key] : $value;
        return $return;
    }

    static function addPhoto($file, $model, $folder_name, array $options = []): void
    {
        //ser options
        // relation
        //usage
        //type
        //size

        $relation = self::inArray('relation', $options, 'photo');
        $usage = self::inArray('usage', $options, null);
        $type = self::inArray('type', $options, 'image');
        $size = self::inArray('size', $options, 400);

        ///////////////////////////////


        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $file->getClientOriginalExtension(); // getting image extension

        if ($extension == 'svg') {

            $name = $file->getFilename() . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given
            $model->$relation()->create(
                [
                    'path' => 'uploads/thumbnails/' . $folder_name . '/' . $name,
                    'type' => $type,
                    'usage' => $usage
                ]
            );

            return;
        }

        $imageResize = self::resizePhoto($extension, $destinationPath, $file , $size);


        $model->$relation()->create(
            [
                'path' => 'uploads/thumbnails/' . $folder_name . '/' . $imageResize,
                'type' => $type,
                'usage' => $usage
            ]
        );
    }

    static function updatePhoto($file, $oldFiles, $model, $folder_name, array $options = []):void
    {
        //ser options
        // relation
        //usage
        //type
        //size

        $relation = self::inArray('relation', $options, 'photo');
        $usage = self::inArray('usage', $options, null);
        $type = self::inArray('type', $options, 'image');
        $size = self::inArray('size', $options, 400);

        ///////////////////////////////
        $old_img_name=  strrchr( $oldFiles , '/' ); // regex old img name

        // dd(public_path() . '/uploads/thumbnails/' . $folder_name . '/'.$n );

        if ($oldFiles) {
            File::delete(public_path() . '/uploads/thumbnails/' . $folder_name . '/'.$old_img_name);
        }


        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension

        if ($extension == 'svg') {

            $name = $file->getFilename() . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given

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

            return;
        }

        $imageResize = self::resizePhoto($extension, $destinationPath, $file , $size);

        $input =
            [
                'path' => 'uploads/thumbnails/' . $folder_name . '/' . $imageResize,
                'type' => $type,
                'usage' => $usage,
            ];
            // dd($input);

        if ($oldFiles) {
  $model->$relation()->where(['type' => $type])->update($input);

        } else {

            $model->$relation()->create($input);
            // echo 'stop';
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

    /**
     * @param $extension
     * @param string $destinationPath
     * @param mixed $file
     * @param int $size
     * @return  string
     */
    public static function resizePhoto($extension, string $destinationPath, $file, int $size = 400): string
    {
        $image = $size . '-' . time() . '' . rand(11111, 99999) . '.' . $extension;

        $resize_image = Image::make($file);
        $resize_image->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $image, 100);

        return $image;
    }

}
