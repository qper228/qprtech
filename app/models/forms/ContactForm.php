<?php

namespace app\models\forms;

use app\models\db\Contact;
use GuzzleHttp\Client;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body = '';
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            ['email', 'email'],
            [['phone', 'body'], 'string'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function contact()
    {
        if ($this->validate()) {
            $client = new Client();
            $leadEndpoint = Yii::$app->params['leadEndpoint'];
            $websiteId = Yii::$app->params['websiteId'];
            try {
                $client->post($leadEndpoint, [
                    'form_params' => [
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'website_id' => $websiteId,
                        'message' => $this->body,
                    ]
                ]);
                return true;
            } catch (\Exception $e) {
                Yii::error('Failed to send lead: ' . $e->getMessage());
                return false;
            }
        }
        return false;
    }
}
