<?php

use yii\db\Migration;

/**
 * Handles the creation of table `film`.
 */
class m171115_114334_create_film_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('film', [
            'id' => $this->primaryKey(),
            'film_name'=>$this->string()->null(),
            'film_description'=>$this->text()->null(),
            'film_data'=>$this->date()->notNull(),
            'film_image_name'=>$this->string()->null(),
            'film_url_trailer'=>$this->string()->null(),
            'film_is_2d'=>$this->boolean(),
            'film_is_3d'=>$this->boolean(),
            'film_is_imax'=>$this->boolean(),
            'film_is_active'=>$this->integer(1)->defaultValue(1),
            'film_seo_url'=>$this->string()->null(),
            'film_seo_title'=>$this->string()->null(),
            'film_seo_keywords'=>$this->string()->null(),
            'film_seo_description'=> $this->text()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('film');
    }
}
