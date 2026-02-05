<?php

namespace Tests\Unit\Modules\Documents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Documents\Models\DocumentFile;
use Modules\Users\Models\User;
use Tests\TestCase;

class DocumentFileModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_document_file_has_fillable_attributes(): void
    {
        $file = new DocumentFile;
        $this->assertContains('name', $file->getFillable());
        $this->assertContains('original_name', $file->getFillable());
        $this->assertContains('size', $file->getFillable());
        $this->assertContains('user_id', $file->getFillable());
    }

    public function test_document_file_size_for_humans_attribute(): void
    {
        $user = User::factory()->create();
        $file = DocumentFile::create([
            'name' => 'documents/test.pdf',
            'original_name' => 'test.pdf',
            'size' => 1024,
            'user_id' => $user->id,
        ]);
        $this->assertSame('1024 B', $file->size_for_humans);
    }

    public function test_document_file_belongs_to_user(): void
    {
        $file = new DocumentFile;
        $this->assertTrue(method_exists($file, 'user'));
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $file->user());
    }
}
