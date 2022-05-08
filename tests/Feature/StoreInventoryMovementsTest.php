<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Tests\TestCase;

class StoreInventoryMovementsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_store_inventory_movements()
    {
        // given
        $user = User::factory()->create();
        $formData = [
            'inventory_movements_file' => $this->inventoryMovementsFile(),
        ];

        // when
        $response = $this->actingAs($user)->postJson(route('inventory-movements.store'), $formData);

        // then
        $response->assertSuccessful()->json([
            'message' => 'Successfully imported inventory movements.',
        ]);

        $this->assertDatabaseCount('inventory_movements', 2);

        $this->assertDatabaseHas('inventory_movements', [
            'transacted_at' => '2020-12-21',
            'type' => 'p',
            'quantity' => 10,
            'price' => 5,
        ]);

        $this->assertDatabaseHas('inventory_movements', [
            'transacted_at' => '2020-12-22',
            'type' => 'a',
            'quantity' => 10,
            'price' => null,
        ]);
    }

    private function inventoryMovementsFile(): File
    {
        $header = 'Date,Type,Quantity,Unit Price';
        $purchaseRow = '21/12/2020,Purchase,10,5,';
        $applicationRow = '22/12/2020,Application,-10,,';

        $content = implode("\n", [$header, $purchaseRow, $applicationRow]);

        return UploadedFile::fake()->createWithContent('test.csv', $content);
    }
}
