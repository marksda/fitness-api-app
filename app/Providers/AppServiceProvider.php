<?php

namespace App\Providers;

use App\Enum\PermissionsEnum;
use App\Policies\ManageDataPolicy;
use Illuminate\Http\Resources\Json\JsonResource;
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
    JsonResource::withoutWrapping();

    Gate::define(
      PermissionsEnum::ManageDatas->value, 
      [ManageDataPolicy::class, 'manageData']
    );
  }
}
