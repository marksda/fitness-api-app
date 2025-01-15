<?php

namespace App\Policies;

// use Illuminate\Auth\Access\HandlesAuthorization;
// use Illuminate\Auth\Access\Response;

class PropinsiPolicy
{
  
  /**
   * Determine whether the user can view any models.
   */
  // public function viewAny(User $user): bool
  // {
  //   return  $user->hasPermissionTo(PermissionsEnum::ManageKontenNews->value);
  // }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, Propinsi $propinsi): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, Propinsi $propinsi): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can delete the model.
     */
    // public function delete(User $user, Propinsi $propinsi): Response
    // {
    //   return $user->id === $propinsi->user_id
    //         ? Response::allow()
    //         : Response::deny('Hak akses ditolak untuk menghapus data propinsi');
    // }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Propinsi $propinsi): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Propinsi $propinsi): bool
    // {
    //     return false;
    // }
}
