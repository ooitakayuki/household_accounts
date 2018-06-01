<?php

namespace Controller;

use Repository\Budgets;
use Request\AddRequest;

class AddController
{
    public function run() {
        $request = new AddRequest();
        if($request->validate()) {
            // TODO goto error page
        }

        $model = new Budgets();
        $result = $model->add($request->values());

        header('location: /index.php');
    }
}