<?php

namespace Controller;

use Repository\BudgetsRepository;
use Request\AddRequest;

class AddController implements Controller
{
    public function run(): void {
        $request = new AddRequest();
        if($request->validate()) {
            // TODO goto error page
        }

        $model = new BudgetsRepository();
        $result = $model->add($request->values());

        header('location: /index.php');
    }
}