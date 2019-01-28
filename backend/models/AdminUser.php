<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/25
 * Time: 16:45
 */
namespace backend\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;


class AdminUser extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    private $SuperAdministratorIds = [1];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getRolesName()
    {
        if( in_array( $this->getId(), $this->SuperAdministratorIds ) ){
            return [Yii::t('app', 'System')];
        }
        $role = array_keys( Yii::$app->getAuthManager()->getRolesByUser($this->getId()) );
        if( !isset( $role[0] ) ) return [];
        return $role;
    }

    public function getRolesNameString($glue=',')
    {
        $roles = $this->getRolesName();
        $str = '';
        foreach ($roles as $role){
            $str .= Yii::t('admin', $role) . $glue;
        }
        return rtrim($str, $glue);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'username' => Yii::t('admin', 'UserName'),
            'avatar' => Yii::t('admin', 'Avatar'),
            'auth_key' => Yii::t('admin', 'AuthKey'),
            'password_hash' => Yii::t('admin', 'PasswordHash'),
            'password_reset_token' => Yii::t('admin', 'PasswordResetToken'),
            'email' => Yii::t('admin', 'Email'),
            'role' => Yii::t('admin', 'Role'),
            'status' => Yii::t('admin', 'Status'),
            'created_at' => Yii::t('admin', 'CreatedAt'),
            'updated_at' => Yii::t('admin', 'UpdateddAt'),
        ];
    }
}