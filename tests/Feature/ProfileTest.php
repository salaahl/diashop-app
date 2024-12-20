<?php

use App\Models\User;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create([
        'email' => 'sokhona.salaha@gmail.com'
    ]);

    $response = $this
        ->actingAs($user)
        ->patch('/profile/update', [
            'email' => 'john.doe@gmail.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('john.doe@gmail.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile/update', [
            'email' => $user->email
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create([
        'password' => bcrypt('Sokhona'),
    ]);

    $response = $this
        ->actingAs($user)
        ->delete('/profile/delete', [
            'password' => 'Sokhona',
        ]);

    $response->assertSessionHasNoErrors();

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create([
        'password' => bcrypt('Sokhona'),
    ]);

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile/delete', [
            'password' => 'wrong-password',
        ]);

    $response->assertSessionHasErrorsIn('userDeletion', 'password');

    $this->assertNotNull($user->fresh());
});
