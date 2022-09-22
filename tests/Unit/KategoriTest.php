<?php

namespace Tests\Unit;

use App\Models\Kategori;
use App\Models\User;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_render_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_render_kategori_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');
        
        $response->assertSee('Nama Kategori');
        $response->assertSee('Action');
        $response->assertSee('Show');
        $response->assertSee('Edit');
        $response->assertSee('Delete');
        $response->assertStatus(200);
    }

    public function test_check_one_data_kategori()
    {
        Kategori::create([
            'nama_kategori' => 'testing',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');

        $response->assertStatus(200);

        $response->assertSee('testing');
    }

    public function test_render_kategori_create_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori/create');

        $response->assertStatus(200);
        $response->assertSee('Tambah Kategori');
        $response->assertSee('Nama Kategori');
    }

    public function test_render_edit_kategori_page(){
        $kategori = Kategori::create([
            'nama_kategori' => 'testing',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori/' . $kategori-> id . '/edit');


        $response->assertStatus(200);
        $response->assertSee('Submit');
    }

    public function test_edit_data_kategori_page()
    {
        $kategori = Kategori::create([
            'nama_kategori' => 'testing',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori/' . $kategori-> id . '/edit');
        $response->assertStatus(200);
        
        $kategori = Kategori::where('nama_kategori', 'testing')->update(['nama_kategori' => 'testingTest']);
        
        $response = $this->actingAs($user)->get('/kategori');

        $response->assertSee('testingTest');
    }

    public function test_delete_data_kategori_page()
    {
        $kategori = Kategori::where('nama_kategori', 'testingTest')->delete();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');

        $response->assertDontSee('testingTest');
    }

    public function test_nama_kategori_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/kategori/create', [
            'nama_kategori' => '',
        ]);

        $response->assertStatus(302);
        $response->assertInvalid([
            'nama_kategori' => 'The nama kategori field is required.',
        ]);
    }

    

    
}
