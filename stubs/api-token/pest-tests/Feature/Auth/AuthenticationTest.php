<?php

use App\Models\User;
use function Pest\Laravel\{post, get, assertGuest, assertStatus, withHeaders};

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('users can authenticate with token', function () {
    $user = User::factory()->create();

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password', // Use the default password or your actual password
    ]);

    assertStatus(200);

    $token = $response->json('token');
    assertNotNull($token);

    $response = withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/user'); // Change this to your API endpoint

    assertStatus(200);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $response = withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('/logout');

    assertStatus(302);
});
