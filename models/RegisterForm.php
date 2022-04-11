<?php

namespace app\models;

use Yii;
use yii\base\Model;
class RegisterForm extends Model
{

    public $email;
    public $password;
    public $confirmpassword;
    public $companyPhoneNo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['companyPhoneNo', 'trim'],
            ['companyPhoneNo', 'required'],
            ['companyPhoneNo', 'string', 'max' => 255],
            ['companyPhoneNo', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This Phone No has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmpassword','compare','compareAttribute'=>'password','message'=>'Passwords do not match, try again'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'companyPhoneNo' => 'Company Phone No',
            'email' => 'Company Email',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->email = $this->email;
        $user->companyPhoneNo = $this->companyPhoneNo;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
      
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => 'Vendor Portal'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . 'Vendors Portal')
            ->send();
    }

    public function goHome()
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/login']));
    }
   
}
