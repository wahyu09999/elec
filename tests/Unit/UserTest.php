<?php

namespace Tests\Unit;

use App\Models\Barang;
use App\Models\Kategori;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    // ------------------------------------------------- B A R A N G -------------------------------------------------
    public function test_render_home()
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_render_barang_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/barang')->assertStatus(200);
    }

    
    public function test_create_barang(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $barang = Barang::create([
            'kategori_id' => 1,
            'nama' => 'TEST CREATE BARANG',
            'harga' => 1080,
            'stok' => 2,
            'deskripsi' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);
        $response = $this->get('/barang');
        $response->assertStatus(200);
        $response->assertSee('PSU');
        $response->assertSee('1080');
     }


     public function test_render_edit_barang_page(){
        $barang = barang::create([
            'kategori_id' => 1,
            'nama' => 'TestRenderEditPage',
            'harga' => 1080,
            'stok' => 2,
            'deskripsi' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/barang/' . $barang-> id . '/edit');


        $response->assertStatus(200);
        $response->assertSee('Nama Barang');
        $response->assertSee('Nama Kategori');
        $response->assertSee('Harga');
        $response->assertSee('Stok');
        $response->assertSee('Deskripsi');
        $response->assertSee('Foto');
    }

    public function test_edit_data_barang_page()
    {
        $barang = Barang::create([
            'kategori_id' => 3,
            'nama' => 'TestRenderEdittt',
            'harga' => 1080,
            'stok' => 2,
            'deskripsi' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/barang/' . $barang-> id . '/edit');
        $response->assertStatus(200);
        
        $barang = Barang::where('nama', 'TestRenderEdittt')->update(['nama' => 'Edit sukses']);
        
        $response = $this->actingAs($user)->get('/barang');

        $response->assertSee('Edit sukses');
    }

    public function test_delete_data_barang_page()
    {
        $barang = Barang::where('nama', 'Edit sukses')->delete();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/barang');

        $response->assertDontSee('Edit sukses');
    }




// ------------------------------------------------- KATEGORI -------------------------------------------------

    // public function test_render_kategori_page()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user);
    //     $response->get('/kategori')->assertStatus(200);
    // }



    // public function test_store_kategori()
    // {
    //     $user = User::factory()->create();
    //     $this->actingAs($user);
    //     $response = $this->post('/kategori', [
    //         'nama_kategori' => 'Test Store Kategori',
            
    //     ]);
    //     $response->assertStatus(302);
    // }




    // public function test_render_edit_kategori_page(){
    //     $kategori = Kategori::create([
    //         'nama_kategori' => 'testing',
    //     ]);

    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->get('/kategori/' . $kategori-> id . '/edit');
    //     $response->assertStatus(200);
    //     $response->assertSee('Submit');
    // }




    // public function test_edit_data_kategori_page()
    // {
    //     $kategori = Kategori::create([
    //         'nama_kategori' => 'testing',
    //     ]);

    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->get('/kategori/' . $kategori-> id . '/edit');
    //     $response->assertStatus(200);
        
    //     $kategori = Kategori::where('nama_kategori', 'testing')->update(['nama_kategori' => 'testingTest']);
    //     $response = $this->actingAs($user)->get('/kategori');
    //     $response->assertSee('testingTest');
    // }
    



}




