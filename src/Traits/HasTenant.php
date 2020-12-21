<?php
namespace Jinas\LaravelTenant\Traits;

use Jinas\LaravelTenant\Scopes\TenantScope;
use Jinas\LaravelTenant\Models\Tenant;

trait HasTenant
{
    protected static function bootHasTenant()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function($model) {
            if(session()->has('tenant_id')) {
                $model->tenant_id = session()->get('tenant_id');
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}