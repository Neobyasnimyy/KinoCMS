<?php


namespace common\components;

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

    function getRuMouth($id){
        $month_name = [
            1 => 'январь',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'окттября',
            11 => 'ноября',
            12 => 'декабря'
        ];
        return $month_name[$id];
    }

}