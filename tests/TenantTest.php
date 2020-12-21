<?php

namespace Jinas\LaravelTenant\Tests;

use Illuminate\Foundation\Auth\User;
use Jinas\LaravelTenant\LaravelTenantServiceProvider;
use Jinas\LaravelTenant\Models\Tenant;
use Jinas\LaravelTenant\Traits\HasTenant;
use Orchestra\Testbench\TestCase;

class TenantTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        require_once __DIR__.'/../database/migrations/create_tenants_table.php';

        (new \CreateTenantsTable())->up();

        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app)
    {
        return [LaravelTenantServiceProvider::class];
    }

    /** @test */
    public function it_can_create_tenants()
    {
        $tenant = Tenant::create([
            'name' => 'STO',
        ]);

        $this->assertTrue($tenant->exists);
    }

    /** @test */
    public function it_can_associate_tenants()
    {
        Tenant::create([
            'name' => 'STO',
        ]);

        $user = TestUser::create([
            'name' => 'Jinas',
            'email' => 'j@live.mv',
            'password' => 'password',
        ]);

        $this->assertEquals('STO', $user->tenant->name);
    }
}

class TestUser extends User
{
    use HasTenant;

    protected $guarded = [];
    //Testing
    protected $appends = ['tenant_id'];
    protected $table = 'users';

    /**
     * getTenantIdAttribute.
     *
     *  Accessor for testing. tenant ID
     *
     * @return void
     */
    public function getTenantIdAttribute()
    {
        return 1;
    }
}
