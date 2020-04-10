<?php

use yii\db\Migration;

/**
 * Class m200410_094245_add_fk_to_users_table
 */
class m200410_094245_add_fk_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_user_city',
            'users',
            'city_id',
            'cities',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_city', 'users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200410_094245_add_fk_to_users_table cannot be reverted.\n";

        return false;
    }
    */
}
