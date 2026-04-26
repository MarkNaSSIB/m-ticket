<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\{get, post, assertAuthenticated, assertGuest};

it('shows the login page', function () {
    get('/login')
        ->assertStatus(200)
        ->assertSee('Sign In');
});

it('logs in a user with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'mark@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = post('/login', [
        'email' => 'mark@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('success');

    assertAuthenticated();
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create([
        'email' => 'mark@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = post('/login', [
        'email' => 'mark@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors();

    assertGuest();
});

it('requires email and password', function () {
    post('/login', [])
        ->assertSessionHasErrors(['email', 'password']);

    assertGuest();
});

it('logs out an authenticated user', function () {
    /** @var \Tests\TestCase $this */
    /** @var User $user */

    $user = User::factory()->create();

    $this->actingAs($user);

    $this->assertAuthenticatedAs($user);

    $response = get('/logout');

    $response->assertRedirect('/');
    $response->assertSessionHas('success');

    $this->assertGuest();
});

