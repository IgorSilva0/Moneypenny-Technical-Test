<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Album;

class AlbumControllerTest extends TestCase
{
    use RefreshDatabase;

    // ## Test created to check (CRUD) operations on Albums ## //

    // Test for Creating a new album (Create)
    public function test_store_album()
    {
        $data = [
            'artist_id' => 1,
            'artist_twitter' => '@artist',
            'artist_name' => 'Artist Name',
            'name' => 'Album Name',
        ];

        $response = $this->post(route('albums.store'), $data);

        // Assert: Check if album is in the database
        $this->assertDatabaseHas('albums', [
            'artist_id' => 1,
            'artist_twitter' => '@artist',
            'artist_name' => 'Artist Name',
            'name' => 'Album Name',
        ]);

        // Assert: Check the response (redirection and flash message)
        $response->assertRedirect(route('albums.index'))
            ->assertSessionHas('success', 'Album created successfully!');
    }

    //#######################################################################//

    // Test for Index (Read)
    public function test_index_displays_albums()
    {
        Album::factory()->count(3)->create();
        $response = $this->get(route('albums.index'));

        $response->assertStatus(200);
        $response->assertViewIs('albums.index');

        // Check if Albums is passed to view
        $response->assertViewHas('albums', function ($albums) {
            return $albums->count() === 3; // Ensure 3 albums are passed
        });
    }

    //#######################################################################//

    // Test for Updating an album (Update)
    public function test_update_modifies_album()
    {
        // Step 1: Create a mock album
        $album = Album::factory()->create([
            'name' => 'Old Name',
            'artist_id' => 1,
            'artist_name' => 'Old Artist',
            'artist_twitter' => '@oldartist',
        ]);

        // Step 2: New data for update
        $updatedData = [
            'name' => 'New Album Name',
            'artist_id' => 2,
            'artist_name' => 'New Artist',
            'artist_twitter' => '@newartist',
        ];

        // Step 3: Send PATCH request
        $response = $this->patch(route('albums.update', $album), $updatedData);

        // Step 4: Assert database was updated
        $this->assertDatabaseHas('albums', [
            'id' => $album->id,
            'name' => 'New Album Name',
            'artist_id' => 2,
            'artist_name' => 'New Artist',
            'artist_twitter' => '@newartist',
        ]);

        // Step 5: Assert redirection and success message
        $response->assertRedirect(route('albums.index'));
        $response->assertSessionHas('success', 'Album updated successfully!');
    }

    //#######################################################################//

    // Test for Deleting an album (Delete)
    public function test_destroy_deletes_album()
    {
        // Step 1: Create a mock album
        $album = Album::factory()->create();

        // Step 2: Send DELETE request
        $response = $this->delete(route('albums.destroy', $album));

        // Step 3: Assert database no longer has the album
        $this->assertDatabaseMissing('albums', [
            'id' => $album->id,
        ]);

        // Step 4: Assert redirection and success message
        $response->assertRedirect(route('albums.index'));
        $response->assertSessionHas('success', 'Album deleted successfully!');
    }
}
