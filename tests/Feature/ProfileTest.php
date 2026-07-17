<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/profile');

    $response
        ->assertOk()
        ->assertSee('My Profile')
        ->assertSee('Informasi Pribadi')
        ->assertSee('Nama Lengkap')
        ->assertSee('Email');
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $component
        ->assertHasErrors('password')
        ->assertNoRedirect();

    $this->assertNotNull($user->fresh());
});

test('birth date can be updated via profile form', function () {
    $user = User::factory()->create([
        'birth_date' => '2000-01-01',
    ]);

    $this->actingAs($user);

    $response = $this->put(route('profile.update'), [
        'name' => $user->name,
        'email' => $user->email,
        'phone' => '081234567890',
        'gender' => 'Laki-laki',
        'birth_date' => '1995-06-15',
        'address' => 'Jl. Test No. 1',
    ]);

    $response->assertRedirect(route('profile'));

    $user->refresh();

    $this->assertSame('1995-06-15', $user->birth_date);
});

test('photo can be uploaded via profile form', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $this->actingAs($user);

    $photo = UploadedFile::fake()->createWithContent('profile.jpg', file_get_contents(__DIR__.'/../../public/favicon.ico'));

    $response = $this->put(route('profile.update'), [
        'name' => $user->name,
        'email' => $user->email,
        'photo' => $photo,
    ]);

    $response->assertRedirect(route('profile'));

    $user->refresh();

    $this->assertNotNull($user->photo);
    $this->assertStringContainsString('photos/', $user->photo);
    Storage::disk('public')->assertExists($user->photo);
});

test('photo validation rejects non-image file', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $this->actingAs($user);

    $file = UploadedFile::fake()->createWithContent('document.pdf', 'fake-pdf-content');

    $response = $this->put(route('profile.update'), [
        'name' => $user->name,
        'email' => $user->email,
        'photo' => $file,
    ]);

    $response->assertSessionHasErrors('photo');
});

test('photo validation rejects oversized file', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $this->actingAs($user);

    $content = str_repeat('a', 3 * 1024 * 1024);
    $file = UploadedFile::fake()->createWithContent('large.jpg', $content);

    $response = $this->put(route('profile.update'), [
        'name' => $user->name,
        'email' => $user->email,
        'photo' => $file,
    ]);

    $response->assertSessionHasErrors('photo');
});

test('profile can be updated with all fields', function () {
    $user = User::factory()->create([
        'birth_date' => '2000-01-01',
        'phone' => null,
        'gender' => null,
        'address' => null,
    ]);

    $this->actingAs($user);

    $response = $this->put(route('profile.update'), [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'phone' => '081234567890',
        'gender' => 'Perempuan',
        'birth_date' => '1995-06-15',
        'address' => 'Jl. Updated No. 2',
    ]);

    $response->assertRedirect(route('profile'));

    $user->refresh();

    $this->assertSame('Updated Name', $user->name);
    $this->assertSame('updated@example.com', $user->email);
    $this->assertSame('081234567890', $user->phone);
    $this->assertSame('Perempuan', $user->gender);
    $this->assertSame('1995-06-15', $user->birth_date);
    $this->assertSame('Jl. Updated No. 2', $user->address);
});
