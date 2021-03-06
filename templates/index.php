<?php
/**
 * @var $budgets \Dto\Budgets[]
 * @var $expense \Dto\Expense[]
 */
$budgets = $this->data['budgets'];
$expense = $this->data['expense'];
?>
<header class="header">
	<div><a class="header__title" href="/">Household accounts</a></div>
</header>
<div>
	<a href="#" class="control__add-button">+</a>
	<div class="control__add-spending">
		<form method="POST" action="/add.php">
			<table>
				<tr><td>日付</td><td><input type="date" name="created_at" required opattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" /></td></tr>
				<tr><td>金額</td><td><input type="text" name="amount" /></td></tr>
				<tr><td>分類</td><td>
					<select name="type">
						<option value="spending" selected="selected">支出</option>
						<option value="income">収入</option>
					</select>
				</td></tr>
				<tr><td>費目</td><td>
					<select name="expense_id">
						<?php foreach($expense as $item): ?>
						<option value="<?php echo $item->id; ?>"><?php echo $item->expense_name; ?></option>
						<?php endforeach; ?>
					</select>
				</td></tr>
				<tr>
					<td>品目</td>
					<td><textarea name="item_name"></textarea></td>
				</tr>
			</table>
			<div><input type="submit" value="登録"/></div>
		</form>
	</div>
</div>
<div class="control__refinement">
	<form method="GET">
		<input type="hidden" name="refinement" value="1">
		<table>
			<tr><td>期間</td><td>
				<input type="date" name="from" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				&nbsp;〜&nbsp;
				<input type="date" name="to" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
			</td></tr>
			<tr><td>費目</td><td>
				<select name="expense_id">
					<option value="---" selected="selected">---</option>
					<?php foreach($expense as $item): ?>
					<option value="<?php echo $item->id; ?>"><?php echo $item->expense_name; ?></option>
					<?php endforeach; ?>
				</select>
			</td></tr>
		</table>
		<input type="submit" value="絞り込み">
	</form>
</div>
<div class="main">
	<div class="main__total">
		<?php if(isset($this->data['income']) && isset($this->data['spending'])): ?>
		<div>収支: <span><?php echo $this->data['income'] - $this->data['spending']; ?></span></div>
		<?php endif; ?>

		<?php if(isset($this->data['spending'])): ?>
		<div>支出: <span><?php echo $this->data['spending']; ?></span></div>
		<?php endif; ?>
		<?php if(isset($this->data['income'])): ?>
		<div>収入: <span><?php echo $this->data['income']; ?></span></div>
		<?php endif; ?>
	</div>

	<?php if(isset($budgets) && 0 < count($budgets)): ?>
	<div class="main__recent">
		<table>
			<tr><th>収入/支出</th><th>費目</th><th>品目</th><th>金額</th><th>日付</th></tr>
		<?php foreach($budgets as $item): ?>
			<tr>
			<td><?php echo $item->type == 'spending' ? '支出' : '収入'; ?></td>
			<td><?php echo $item->expense_name; ?></td>
			<td><?php echo $item->item_name; ?></td>
			<td><?php echo $item->amount; ?></td>
			<td><?php echo $item->created_at; ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
	<?php endif; ?>
</div>

