<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;
    protected $auth_user;
    protected $not_auth_user;
    public function setUp()
    {
        parent::setUp();
        $this->auth_user = factory(User::class)->create();
        $this->not_auth_user = factory(User::class)->create();


    }

    use CreatesApplication;
}
