<?php
namespace Controller;

use Common\View;
use Repository\BudgetsRepository;
use Repository\ExpenseRepository;
use Request\IndexRequest;

class IndexController implements Controller {
    const DEFAULT_LIMIT = 30;

    public function run(): void {
        $request = new IndexRequest();
        if($request->validate()) {
            // TODO goto error page
        }

        $budgets_model = new BudgetsRepository();
        $spending = $budgets_model->sum_with_distance('spending', $request->from, $request->to, $request->expense_id);
        $income = $budgets_model->sum_with_distance('income', $request->from, $request->to, $request->expense_id);

        if ($request->refinement) {
            $budgets_list = $budgets_model->find_with_distance($request->from, $request->to, $request->expense_id);
        } else {
            $offset = ($request->page - 1) * static::DEFAULT_LIMIT;
            $budgets_list = $budgets_model->find($offset, static::DEFAULT_LIMIT);
        }

        $expense_model = new ExpenseRepository();
        $expense = $expense_model->find_all();

        $view = new View();
        $view->set_data('budgets', $budgets_list);
        $view->set_data('expense', $expense);
        $view->set_data('spending', $spending);
        $view->set_data('income', $income);
        $view->render('index');
    }
}
