<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows the registration page', function () {
    get('/register')
        ->assertStatus(200)
        ->assertSee('Create an Account');
});

it('registers a user successfully', function () {
    $response = post('/register', [
        'name' => 'Mark Boutros',
        'email' => 'mark@example.com',
        'password' => 'password123',
        'repassword' => 'password123',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('success', 'Account created successfully!');

    expect(User::where('email', 'mark@example.com')->exists())->toBeTrue();

    assertAuthenticated();
});

it('hashes_the_password', function () {
    post('/register', [
        'name' => 'Mark',
        'email' => 'mark2@example.com',
        'password' => 'password123',
        'repassword' => 'password123',
    ]);

    $user = User::where('email', 'mark2@example.com')->first();

    expect(Hash::check('password123', $user->password))->toBeTrue();
});

it('requires_name_email_password_and_repassword', function () {
    post('/register', [])
        ->assertSessionHasErrors([
            'name',
            'email',
            'password',
            'repassword',
        ]);

    assertGuest();
});

it('requires_valid_email', function () {
    post('/register', [
        'name' => 'Mark',
        'email' => 'not-an-email',
        'password' => 'password123',
        'repassword' => 'password123',
    ])->assertSessionHasErrors(['email']);
});

it('requires_unique_email', function () {
    User::factory()->create(['email' => 'mark@example.com']);

    post('/register', [
        'name' => 'Mark',
        'email' => 'mark@example.com',
        'password' => 'password123',
        'repassword' => 'password123',
    ])->assertSessionHasErrors(['email']);
});

it('requires_password_confirmation_to_match', function () {
    post('/register', [
        'name' => 'Mark',
        'email' => 'mark@example.com',
        'password' => 'password123',
        'repassword' => 'wrongpassword',
    ])->assertSessionHasErrors(['repassword']);
});
