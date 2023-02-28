<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public $user;
    /**
     * A basic unit test example.
     */
    public function test_user_create(): void
    {
       $user = new User([
            "name" => "test test",
            "email" => "mmmm@mmm.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
       ]);
       $this->assertEquals($user->name, "test test");
       $this->assertEquals($user->email, "mmmm@mmm.com");
       $this->assertEquals($user->password, "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi");
    }


  
   
}
