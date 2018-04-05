<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * This Feature Test is sending queries to the DB via the app's RESTful API
 * It tests all the available API endpoints that are rekated to User entity
 * It requests the users index &
 * creates, shows, updates & deletes a fake user account
 */

class UserApiTest extends TestCase
{
    private $email = 'emailaccount@featuretest.com';
    private $emailUpdated = 'emailaccountupdated@featuretest.com';
    
    public function testUserIndex()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/users');
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJson(['data' => true]);
    }
    
    public function testUserStore()
    {
        $response = $this
            ->withHeaders(['Content-Type' => 'application/json'])
            ->json('POST', 'api/users', [
                'name' => str_random(4),
                'email' => $this->email,
                'password' => str_random(8),
                'photo' => 'http://lorempixel.com/output/sports-q-c-500-500-5.jpg',
            ]);
        
        $response
            ->assertStatus(201)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment(['email' => $this->email]);
    }
    
    public function testUserShow()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/users/' . $this->email);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment(['email' => $this->email]);
    }
    
    public function testUserUpdate()
    {
        $response = $this
            ->withHeaders(['Content-Type' => 'application/json'])
            ->json('PUT', 'api/users/' . $this->email, [
                'email' => $this->emailUpdated,
            ]);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment(['email' => $this->emailUpdated]);
    }
    
    public function testUserDelete()
    {
        $response = $this
            ->withHeaders(['Content-Type' => 'application/json'])
            ->json('DELETE', 'api/users/' . $this->emailUpdated);
        
        $response->assertStatus(200);
    }
}
