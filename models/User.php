<?php

namespace app\models;

use app\models\forms\LoginForm;
use app\models\forms\Registration;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\db\ActiveRecord as ActiveRecordAlias;
use yii\web\IdentityInterface;

/**
 *
 * @property int $id
 * @property string $login
 * @property string $pass
 * @property int|null $role
 * @property int|null $active
 *
 * @property Comment[] $comments
 * @property Record[] $records
 */
class User extends ActiveRecordAlias implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['login', 'pass'], 'required'],
//            [['role', 'active'], 'integer'],
            [['login', 'pass'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'pass' => 'Pass',
            'role' => 'Role',
            'active' => 'Active',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    public function getRecords()
    {
        return $this->hasMany(Record::class, ['user_id' => 'id']);
    }

    public function registration(Registration $registration)
    {

        $this->login = $registration->login;
        $this->pass = Yii::$app->security->generatePasswordHash($registration->pass);

    }
    public static function findByLogin($login)
    {
        return static::findOne(['login'=>$login]);
    }


    public function validatePassword($password)
    {
        //      print_r($password);
        return Yii::$app->security->validatePassword($password, $this->pass);
    }



    //method from identityInterface
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

}
