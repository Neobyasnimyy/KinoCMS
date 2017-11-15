<?php

use yii\db\Migration;

/**
 * Handles the creation of table `film_images`.
 */
class m171115_120745_create_film_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('film_images', [
            'id' => $this->primaryKey(),
            'parent_id'=>$this->integer()->notNull(),
            'name'=>$this->string()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-film_images-parent_id',
            'film_images',
            'parent_id'
        );

        // add foreign key for table `film`
        $this->addForeignKey(
            'fk-film_images-parent_id',
            'film_images',
            'parent_id',
            'film',
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
        // drops foreign key for table `film`
        $this->dropForeignKey(
            'fk-film_images-parent_id',
            'film_images'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-film_images-parent_id',
            'film_images'
        );

        $this->dropTable('film_images');
    }
}
