<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Test user phone number mutator formatting.
     */
    public function test_user_phone_normalization(): void
    {
        $user = new User();

        // 1. Starts with 0
        $user->phone = '08123456789';
        $this->assertEquals('628123456789', $user->phone);

        // 2. Starts with +62
        $user->phone = '+628123456789';
        $this->assertEquals('628123456789', $user->phone);

        // 3. Starts with 62 already
        $user->phone = '628123456789';
        $this->assertEquals('628123456789', $user->phone);

        // 4. Starts with 812 (raw number)
        $user->phone = '8123456789';
        $this->assertEquals('628123456789', $user->phone);

        // 5. With spaces, hyphens, and other characters
        $user->phone = '+62 812-3456-789';
        $this->assertEquals('628123456789', $user->phone);

        // 6. Empty or null
        $user->phone = null;
        $this->assertNull($user->phone);
    }
}
