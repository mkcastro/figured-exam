<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreInventoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_upload_csv()
    {
        // given
        $user = User::factory()->create();
        $data = [
            'inventory' => UploadedFile::fake()->createWithContent(
                'inventory.csv',
                $this->getCsvString()
            ),
        ];

        // when
        $response = $this->actingAs($user)->postJson(route('inventory.store'), $data);

        // then/
        $response
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Inventory updated successfully',
            ]);
    }

    private function getCsvString(): string
    {
        return 'Date,Type,Quantity,Unit Price
            05/06/2020,Purchase,10,5
            07/06/2020,Purchase,30,4.5
            08/06/2020,Application,-20,
            09/06/2020,Purchase,10,5
            10/06/2020,Purchase,34,4.5
            15/06/2020,Application,-25,
            23/06/2020,Application,-37,
            10/07/2020,Purchase,47,4.3
            12/07/2020,Application,-38,
            13/07/2020,Purchase,10,5
            25/07/2020,Purchase,50,4.2
            26/07/2020,Application,-28,
            31/07/2020,Purchase,10,5
            14/08/2020,Purchase,15,5
            17/08/2020,Purchase,3,6
            29/08/2020,Purchase,2,7
            31/08/2020,Application,-30,';
    }
}
