<?php

use yii\db\Migration;

/**
 * Class m200414_031321_add_data_to_skills_table
 */
class m200414_031321_add_data_to_skills_table extends Migration
{
    public $skills = [
        'mysql', 'php', 'javascript', 'html', 'docker', 'oop', 'redis', 'css',
        'go', 'postgresql', 'sql', 'linux', 'nginx', 'apache2', 'git', 'c++', 'ruby',
        'phpmyadmin'
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->skills as $skill) {
            $this->insert('skills', [
                'name' => $skill
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->skills as $skill) {
            $this->delete('skills', [
                'name' => $skill
            ]);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200414_031321_add_data_to_skills_table cannot be reverted.\n";

        return false;
    }
    */
}
