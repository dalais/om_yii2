<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_skills}}`.
 */
class m200410_093546_create_users_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_skills}}', [
            'user_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_user_of_skill',
            'users_skills',
            'user_id',
            'users',
            'id'
        );
        $this->addForeignKey(
            'fk_skill_of_user',
            'users_skills',
            'skill_id',
            'skills',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users_skills}}');
        $this->dropForeignKey('fk_user_of_skill', 'users_skills');
        $this->dropForeignKey('fk_skill_of_user', 'users_skills');
    }
}
