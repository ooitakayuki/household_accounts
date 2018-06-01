<?php
namespace Controller;

use Common\View;
use Repository\Budgets;
use Repository\Expense;
use Request\IndexRequest;

class IndexController {
    const DEFAULT_LIMIT = 30;

    public function run() {
        $request = new IndexRequest();
        if($request->validate()) {
            // TODO goto error page
        }

        $offset = ($request->page - 1) * static::DEFAULT_LIMIT;
        $budgets_model = new Budgets();
        $budgets = $budgets_model->find($offset, static::DEFAULT_LIMIT);

        $expense_model = new Expense();
        $expense = $expense_model->findAll();

        $view = new View();
        $view->set_data('budgets', $budgets);
        $view->set_data('expense', $expense);
        $view->render('index');
    }
}
