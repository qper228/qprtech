<?php

namespace app\modules\admin\controllers;

use app\models\Contact;
use app\models\ContactSearch;


class ContactController extends AbstractAdminController
{
    protected $model = Contact::class;
    protected $searchModel = ContactSearch::class;
}
