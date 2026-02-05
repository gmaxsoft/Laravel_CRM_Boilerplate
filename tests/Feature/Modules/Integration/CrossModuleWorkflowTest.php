<?php

namespace Tests\Feature\Modules\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Advertisements\Models\Advertisement;
use Modules\Cases\Models\CrmCase;
use Modules\Customers\Models\Customer;
use Modules\Documents\Models\DocumentFile;
use Modules\Files\Models\CaseFile;
use Modules\Files\Models\CustomerFile;
use Modules\Users\Models\User;
use Tests\TestCase;

class CrossModuleWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        $this->user = User::factory()->create(['user_level' => 1]);
    }

    public function test_customer_creation_then_document_upload_workflow(): void
    {
        // Step 1: Create a customer
        $customerData = [
            'customers_firstname' => 'Jan',
            'customers_lastname' => 'Kowalski',
            'customers_phone' => '123456789',
            'customers_email' => 'jan@example.com',
            'customers_adres' => 'ul. Testowa 1',
            'customers_city' => 'Warszawa',
            'customers_postcode' => '00-001',
            'customers_trader_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)
            ->post(route('customers.store'), $customerData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('crm_customers_db', [
            'customers_firstname' => 'Jan',
            'customers_lastname' => 'Kowalski',
        ]);

        $customer = Customer::where('customers_firstname', 'Jan')
            ->where('customers_lastname', 'Kowalski')
            ->first();

        $this->assertNotNull($customer);

        // Step 2: Upload a document file
        $file = UploadedFile::fake()->create('test-document.pdf', 100);

        $response = $this->actingAs($this->user)
            ->postJson(route('documents.store'), [
                'file' => $file,
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success']);

        $this->assertDatabaseHas('crm_document_files', [
            'original_name' => 'test-document.pdf',
            'user_id' => $this->user->id,
        ]);

        $documentFile = DocumentFile::where('original_name', 'test-document.pdf')->first();
        $this->assertNotNull($documentFile);
        Storage::disk('local')->assertExists($documentFile->name);
    }

    public function test_customer_creation_then_customer_file_upload_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Create a customer file (simulating file upload workflow)
        $customerFile = CustomerFile::create([
            'file_name' => 'customer-contract.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 1024,
            'file_position' => 1,
            'file_customers_id' => $customer->customers_id,
            'file_adddate' => now(),
        ]);

        $this->assertDatabaseHas('crm_customers_db_files', [
            'file_customers_id' => $customer->customers_id,
            'file_name' => 'customer-contract.pdf',
        ]);

        // Verify the relationship
        $this->assertEquals($customer->customers_id, $customerFile->file_customers_id);
    }

    public function test_customer_creation_then_case_creation_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_email' => 'test@example.com',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Create a case for the customer
        $case = CrmCase::create([
            'case_title' => 'Test Case',
            'case_name' => 'Test Case Name',
            'case_firstname' => $customer->customers_firstname,
            'case_lastname' => $customer->customers_lastname,
            'case_customer_id' => $customer->customers_id,
            'case_trader_id' => $this->user->id,
            'case_phone' => $customer->customers_phone,
            'case_email' => $customer->customers_email,
            'case_status' => 'open',
            'case_adddate' => now(),
        ]);

        $this->assertDatabaseHas('crm_case', [
            'case_customer_id' => $customer->customers_id,
            'case_title' => 'Test Case',
        ]);

        // Verify the relationship
        $this->assertEquals($customer->customers_id, $case->case_customer_id);
    }

    public function test_customer_case_file_upload_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_email' => 'test@example.com',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Create a case for the customer
        $case = CrmCase::create([
            'case_title' => 'Test Case',
            'case_name' => 'Test Case Name',
            'case_customer_id' => $customer->customers_id,
            'case_trader_id' => $this->user->id,
            'case_status' => 'open',
            'case_adddate' => now(),
        ]);

        // Step 3: Upload a file for the case
        $caseFile = CaseFile::create([
            'file_name' => 'case-document.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 2048,
            'file_case_id' => $case->case_id,
            'file_customers_id' => $customer->customers_id,
            'file_adddate' => now(),
        ]);

        $this->assertDatabaseHas('crm_case_files', [
            'file_case_id' => $case->case_id,
            'file_customers_id' => $customer->customers_id,
            'file_name' => 'case-document.pdf',
        ]);

        // Verify relationships
        $this->assertEquals($case->case_id, $caseFile->file_case_id);
        $this->assertEquals($customer->customers_id, $caseFile->file_customers_id);
    }

    public function test_customer_advertisement_assignment_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Create an advertisement
        $advertisement = Advertisement::create([
            'adv_status' => 'Wolne',
            'adv_reservation' => 0,
            'adv_machine_name' => 'Test Machine',
            'adv_machine_type' => 1,
            'adv_producer' => 1,
            'adv_model' => 'Model X',
            'adv_price' => 10000,
            'adv_price_netto' => 8000,
            'adv_magazyn_type' => '0',
            'adv_position' => 1,
            'adv_created_at' => now(),
        ]);

        // Step 3: Create a customer file linked to both customer and advertisement
        $customerFile = CustomerFile::create([
            'file_name' => 'advertisement-contract.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 1536,
            'file_position' => 1,
            'file_customers_id' => $customer->customers_id,
            'file_adv_id' => $advertisement->adv_id,
            'file_adddate' => now(),
        ]);

        $this->assertDatabaseHas('crm_customers_db_files', [
            'file_customers_id' => $customer->customers_id,
            'file_adv_id' => $advertisement->adv_id,
        ]);

        // Verify the relationship
        $this->assertEquals($customer->customers_id, $customerFile->file_customers_id);
        $this->assertEquals($advertisement->adv_id, $customerFile->file_adv_id);
    }

    public function test_customer_deletion_with_related_files_edge_case(): void
    {
        // Step 1: Create a customer with related files
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_adres' => 'Test Address',
        ]);

        $customerFile = CustomerFile::create([
            'file_name' => 'test-file.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 512,
            'file_position' => 1,
            'file_customers_id' => $customer->customers_id,
            'file_adddate' => now(),
        ]);

        // Step 2: Verify files exist
        $this->assertDatabaseHas('crm_customers_db_files', [
            'file_customers_id' => $customer->customers_id,
        ]);

        // Step 3: Delete customer (this should handle related files appropriately)
        // Note: Depending on your database constraints, this might cascade or require manual cleanup
        $customer->delete();

        // Step 4: Verify customer is deleted
        $this->assertDatabaseMissing('crm_customers_db', [
            'customers_id' => $customer->customers_id,
        ]);

        // Note: Related files might still exist depending on foreign key constraints
        // This test documents the current behavior
    }

    public function test_multiple_documents_for_single_customer_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Upload multiple document files
        $files = [
            UploadedFile::fake()->create('document1.pdf', 100),
            UploadedFile::fake()->create('document2.pdf', 200),
            UploadedFile::fake()->create('document3.pdf', 150),
        ];

        $uploadedFiles = [];
        foreach ($files as $file) {
            $response = $this->actingAs($this->user)
                ->postJson(route('documents.store'), [
                    'file' => $file,
                ]);

            $response->assertStatus(200);
            $uploadedFiles[] = DocumentFile::where('original_name', $file->name)->first();
        }

        // Step 3: Verify all files were uploaded
        $this->assertCount(3, $uploadedFiles);
        foreach ($uploadedFiles as $file) {
            $this->assertNotNull($file);
            $this->assertEquals($this->user->id, $file->user_id);
        }
    }

    public function test_customer_with_case_and_multiple_files_workflow(): void
    {
        // Step 1: Create a customer
        $customer = Customer::factory()->create([
            'customers_trader_id' => $this->user->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_email' => 'test@example.com',
            'customers_adres' => 'Test Address',
        ]);

        // Step 2: Create a case
        $case = CrmCase::create([
            'case_title' => 'Complex Case',
            'case_name' => 'Complex Case Name',
            'case_customer_id' => $customer->customers_id,
            'case_trader_id' => $this->user->id,
            'case_status' => 'open',
            'case_adddate' => now(),
        ]);

        // Step 3: Verify case was created
        $this->assertDatabaseHas('crm_case', [
            'case_customer_id' => $customer->customers_id,
        ]);

        // Step 4: Get the case ID from database
        $caseFromDb = CrmCase::where('case_customer_id', $customer->customers_id)->first();
        $this->assertNotNull($caseFromDb);
        $caseId = $caseFromDb->id ?? $caseFromDb->getKey();

        // Step 5: Create multiple case files
        $caseFiles = [];
        for ($i = 1; $i <= 3; $i++) {
            $caseFiles[] = CaseFile::create([
                'file_name' => "case-file-{$i}.pdf",
                'file_type' => 'application/pdf',
                'file_size' => 1024 * $i,
                'file_case_id' => $caseId,
                'file_customers_id' => $customer->customers_id,
                'file_adddate' => now(),
            ]);
        }

        // Step 6: Verify all relationships
        $this->assertEquals($customer->customers_id, $caseFromDb->case_customer_id);
        $this->assertCount(3, $caseFiles);

        foreach ($caseFiles as $file) {
            $this->assertEquals($caseId, $file->file_case_id);
            $this->assertEquals($customer->customers_id, $file->file_customers_id);
        }

        $this->assertDatabaseCount('crm_case_files', 3);
    }

    public function test_customer_trader_assignment_workflow(): void
    {
        // Step 1: Create a trader user
        $trader = User::factory()->create(['user_level' => 5]);

        // Step 2: Create a customer assigned to the trader
        $customer = Customer::factory()->create([
            'customers_trader_id' => $trader->id,
            'customers_firstname' => 'Test',
            'customers_lastname' => 'Customer',
            'customers_phone' => '123456789',
            'customers_email' => 'test@example.com',
            'customers_adres' => 'Test Address',
        ]);

        // Step 3: Verify the relationship
        $this->assertEquals($trader->id, $customer->customers_trader_id);

        // Step 4: Create a case with the same trader
        $case = CrmCase::create([
            'case_title' => 'Trader Case',
            'case_name' => 'Trader Case Name',
            'case_customer_id' => $customer->customers_id,
            'case_trader_id' => $trader->id,
            'case_status' => 'open',
            'case_adddate' => now(),
        ]);

        // Step 5: Verify trader consistency across modules
        $this->assertEquals($trader->id, $customer->customers_trader_id);
        $this->assertEquals($trader->id, $case->case_trader_id);
    }
}
