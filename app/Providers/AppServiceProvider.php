<?php

namespace App\Providers;

use App\Enum\PermissionsEnum;
use App\Policies\PropinsiPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
      //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Gate::define(PermissionsEnum::ManageKontenNews, [PropinsiPolicy::class, 'viewAny']);
  }
}
