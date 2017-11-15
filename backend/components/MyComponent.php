<?php


namespace backend\components;

use yii\base\Component;


class MyComponent extends Component
{
    /**
     * delete file or dir
     * @param $path
     */
    public function myDeleteFile($path)
    {
        if (is_file($path)) {
            unlink($path);
        } elseif (is_dir($path)) {
            if ($objs = glob($path . "/*")) {
                foreach ($objs as $obj) {
                    is_dir($obj) ? $this->delTree($obj) : unlink($obj);
                }
            }
            rmdir($path);
        }
    }

}