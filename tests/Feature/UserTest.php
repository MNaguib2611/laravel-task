<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_failed_validation_register_user_missing_attributes(): void
    {
        $response = $this->json('POST', 'api/register');
        $response->assertStatus(422);

        $response = $this->json('POST', 'api/register', [
            "name" => "Mohammed Naguib",
            "password" => "AaBbCcDd"
        ]);
        $response->assertStatus(422);

        $response = $this->json('POST', 'api/register', [
            "name" => "Mohammed Naguib",
            "name" => "m.naguib2611@gmail.com",
            "password" => "AaBbCcDd"
        ]);
        $response->assertStatus(422);

        $response = $this->json('POST', 'api/register', [
            "name" => "m.naguib2611@gmail.com",
            "password" => "AaBbCcDd",
            "password_confirmation" => "AaBbCcDd",
        ]);

        $this->assertDatabaseCount('users', 0);
    }


    public function test_successful_register_passed_validation(): void
    {
        $response = $this->json('POST', 'api/register', [
            "name" => "Mohammed Naguib",
            "email" => "m.naguib2611@gmail.com",
            "password" => "AaBbCcDd",
            "password_confirmation" => "AaBbCcDd",
        ]);
        $response->assertStatus(201);


        //assert it was registered and stored in database
        $this->assertDatabaseCount('users', 1);



        $response2 = $this->json('POST', 'api/register', [
            "name" => "test2 test2",
            "email" => "test2@gmail.com",
            "password" => "AaBbCcDd",
            "password_confirmation" => "AaBbCcDd",
        ]);
        $response2->assertStatus(201);

        $this->assertDatabaseCount('users', 2);

    }


    public function test_verify_email_is_sent_upon_registration()
    {
        \Event::fake(Registered::class);

        $response = $this->json('POST', 'api/register', [
            "name" => "Mohammed Naguib",
            "email" => "m.naguib2611@gmail.com",
            "password" => "AaBbCcDd",
            "password_confirmation" => "AaBbCcDd",
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseCount('users', 1);

        \Event::assertDispatched(Registered::class);
    }

    public function test_user_can_verify_email(): void
    {
        // VerifyEmail extends Illuminate\Auth\Notifications\VerifyEmail in this example
        $notification = new VerifyEmail();
        $user =  User::create([
            "name" => "Mohammed Naguib",
            "email" => "m.naguib2611@gmail.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);
        // New user should not has verified their email yet
        $this->assertFalse($user->hasVerifiedEmail());

        $mail = $notification->toMail($user);
        $uri = $mail->actionUrl;

        // Simulate clicking on the validation link
        $this->actingAs($user)
            ->get($uri);

        // User should have verified their email
        $this->assertTrue(User::find($user->id)->hasVerifiedEmail());
    }




}
