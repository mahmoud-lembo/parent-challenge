<?php

namespace Tests\Unit;

use App\Http\Controllers\ProviderController;
use Tests\TestCase;
use Illuminate\Http\Request;

class ProviderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_providers()
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(200)
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a613')
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a614')
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a615')
        ->assertSee('DataProviderX')
        ->assertSee('DataProviderY');
    }
    /** @test */
    public function test_provider_data(){
        // Only DataProviderX
        $response = $this->get('/api/v1/users?provider=DataProviderX');
        $response->assertStatus(200)
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a613')
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a614')
        ->assertSee('d3d29d70-1d25-11e3-8591-034165a3a615');
    }
    /** @test */
    public function test_provider_filter_data(){
        // DataProviderY & Authorised & Currency AED & Balance Min = 300 & Balance Max = 300
        $response = $this->get('/api/v1/users?provider=DataProviderY&statusCode=authorised&currency=aed&balanceMin=300&balanceMax=300');
        $response->assertStatus(200)
        ->assertDontSee('DataProviderX')
        ->assertDontSee('200')
        ->assertDontSee('EGP')
        ->assertDontSee('3000');
    }
}
