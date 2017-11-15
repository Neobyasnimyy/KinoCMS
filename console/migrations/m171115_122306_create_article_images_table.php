<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_images`.
 */
class m171115_122306_create_article_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_images', [
            'id' => $this->primaryKey(),
            'parent_id'=>$this->integer()->notNull(),
            'name'=>$this->string()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-article_images-parent_id',
            'article_images',
            'parent_id'
        );

        // add foreign key for table `article`
        $this->addForeignKey(
            'fk-article_images-parent_id',
            'article_images',
            'parent_id',
            'article',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `article`
        $this->dropForeignKey(
            'fk-article_images-parent_id',
            'article_images'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-article_images-parent_id',
            'article_images'
        );

        $this->dropTable('article_images');
    }
}
