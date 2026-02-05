<?php

namespace Tests\Unit\Modules\Customers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Customers\Models\Customer;
use Tests\TestCase;

class CustomerModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_has_fillable_attributes(): void
    {
        $customer = new Customer;
        $this->assertContains('customers_firstname', $customer->getFillable());
        $this->assertContains('customers_lastname', $customer->getFillable());
        $this->assertContains('customers_email', $customer->getFillable());
    }

    public function test_customer_has_trader_relation(): void
    {
        $customer = new Customer;
        $this->assertTrue(method_exists($customer, 'trader'));
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $customer->trader());
    }

    public function test_customer_uses_correct_table_and_primary_key(): void
    {
        $customer = new Customer;
        $this->assertSame('crm_customers_db', $customer->getTable());
        $this->assertSame('customers_id', $customer->getKeyName());
    }
}
