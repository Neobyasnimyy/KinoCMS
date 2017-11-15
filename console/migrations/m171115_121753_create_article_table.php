<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171115_121753_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'article_title'=>$this->string()->notNull(),
            'article_data'=>$this->date()->Null(),
            'article_description'=>$this->text()->null(),
            'article_image_name'=>$this->string()->null(),
            'article_video_url'=>$this->string()->null(),
            'article_is_active'=>$this->integer(1)->defaultValue(1),
            'article_seo_url'=>$this->string()->null(),
            'article_seo_title'=>$this->string()->null(),
            'article_seo_keywords'=>$this->string()->null(),
            'article_seo_description'=> $this->text()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
