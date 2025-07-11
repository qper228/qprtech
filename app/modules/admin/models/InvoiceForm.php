<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\helpers\Url;

class InvoiceForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $amount;

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'amount'], 'required'],
            [['firstName', 'lastName', 'email', 'amount'], 'string']
        ];
    }

    public function getInvoiceUrl() {
        return Url::toRoute([
            '/site/checkout',
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'amount' => $this->amount
        ], true);
    }
}