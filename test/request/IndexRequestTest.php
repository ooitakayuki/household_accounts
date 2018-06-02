<?php
namespace Test\Request;

use PHPUnit\Framework\TestCase;
use Request\IndexRequest;

class IndexRequestTest extends TestCase {

    public function test_empty_values() {
        $request = new IndexRequest();

        $assertObject = [
            'page' => 1,
            'from' => date('Y-m-d', strtotime('-1 month')),
            'to' => date('Y-m-d', time()),
            'expense_id' => null,
            'refinement' => null
        ];

        $this->assertSame($assertObject, $request->values());
    }
}