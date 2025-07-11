<?php

namespace app\modules\admin\controllers;

use app\models\db\Contact;
use app\models\search\ContactSearch;


class ContactController extends AbstractAdminController
{
    protected $model = Contact::class;
    protected $searchModel = ContactSearch::class;
}
