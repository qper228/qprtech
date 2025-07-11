<?php

namespace app\models\forms;

use GuzzleHttp\Client;
use Yii;
use yii\base\Model;

class LeadForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

    public function send()
    {
        if ($this->validate()) {
            $client = new Client();
            $leadEndpoint = Yii::$app->params['leadEndpoint'];
            $websiteId = Yii::$app->params['websiteId'];
            try {
                $client->post($leadEndpoint, [
                    'form_params' => [
                        'email' => $this->email,
                        'website_id' => $websiteId,
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