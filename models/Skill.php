<?php

namespace app\models;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord
{
    /**
     * @var string
     */
    public $name;

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{skills}}';
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Навык'
        ];
    }
}