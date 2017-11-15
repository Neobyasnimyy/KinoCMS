<?php

namespace backend\models;

use yii\base\Model;
use Yii;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class UploadImages extends Model
{

    public $images;
    public $parent_id;
    public $dirName;

    public function rules()
    {
        return [
            [['images'],
                'file',
                'extensions' => 'png, jpg, gif, bmp',
                'skipOnEmpty' => true, // обязательная загрузка файла
                'maxSize' => 1024 * 1024 * 3,
                'tooBig' => "Файл «{file}» слишком большой. Размер не должен превышать 3 MB.",
                'mimeTypes' => ['image/gif', 'image/jpeg', 'image/png'],
                'maxFiles' => 5,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'images' => 'Изображения',
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@upImages')."/{$this->dirName}/{$this->parent_id}";
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }
            foreach ($this->images as $file) {
                $file->name = rand(0, 9999) . "-" . date('YmdHi', time()) . '.' . $file->extension;
                $file->saveAs("{$path}/{$file->name}");
                // ресайз с соотношением пропорций
//                Image::getImagine()->open("{$path}/{$file->name}")->thumbnail(new Box(1000, 190))->save("{$path}/{$file->name}" , ['quality' => 90]);
//                 обрезаем 1000x190
                Image::thumbnail("{$path}/{$file->name}", 1000, 190)
                    ->save("{$path}/{$file->name}", ['quality' => 90]);

            }
            return true;
        } else {
            return false;
        }

    }

}