<?php

namespace app\controllers;

use app\models\Cities;
use app\models\Skills;
use app\models\Users;
use Faker\Factory;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Request;

class UserController extends Controller
{

    /**
     * Get new user with city.
     *
     * @return string
     */
    public function actionNew()
    {
        $facker = Factory::create('ru_RU');
        $newUser = [
            'user' => $facker->name('male'),
            'city' => $facker->city
        ];
        return $this->asJson($newUser);
    }

    /**
     * Get new user with city.
     *
     * @return string
     */
    public function actionAll()
    {
        $users = Users::find()->with(['city', 'skills'])
            ->asArray()->all();
        return $this->asJson($users);
    }

    /**
     * Create user.
     *
     * @return string
     */
    public function actionCreate()
    {
        try {
            $user = new Users();
            $request = \Yii::$app->request;
            if ($user->validate($request->post())) {

                $user->name = $request->post('name');
                $user->city_id = $this->createOrGetCity($request);
                $user->save();
                $this->addSkills($user);

                // Refresh user with relations
                $user = Users::find()->where(['id' => $user->id])
                    ->with(['city', 'skills'])->asArray()->one();

                return $this->asJson($user);
            } else {
                return $this->asJson($user->errors);
            }
        } catch (\Exception $e) {
            return $this->asJson($e->getMessage());
        }
    }

    /**
     * If generated in actionNew city isset in db get ID that city,
     * or a new city will created and its ID is taken
     *
     * @param Request $request
     * @return mixed
     */
    public function createOrGetCity(Request $request)
    {
        $city = Cities::find()->where(['name' => $request->post('city')])->one();
        if ($city) {
            $city_id = $city->id;
        } else {
            $newCity = new Cities();
            $newCity->name = $request->post('city');
            $newCity->save();
            $city_id = $newCity->getPrimaryKey();
        }

        return $city_id;
    }

    /**
     * Adding random skills to the user
     *
     * @param Users $user
     */
    public function addSkills(Users $user)
    {
        $random = rand(0, Skills::find()->count());
        $skills = Skills::find()->orderBy(['rand()' => SORT_DESC])->limit((int)$random)->all();
        foreach ($skills as $skill) {
            $user->link('skills', $skill);
        }
    }
}
