<?php
namespace Controllers;

use Common\View;
use Request\IndexRequest;
use Repository\Budgets;

class IndexController {
    const DEFAULT_LIMIT = 30;

    public function run() {
        $request = new IndexRequest();
        if($request->validate()) {
            // TODO goto error page
        }

        $offset = ($request->page - 1) * static::DEFAULT_LIMIT;
        $model = new Budgets();
        $budgets = $model->find($offset, static::DEFAULT_LIMIT);

        $view = new View();
        $view->setData('budgets', $budgets);
        $view->render('index');
    }
}
