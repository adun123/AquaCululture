<?php

namespace App\Policies;

use App\Models\Device;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    use HandlesAuthorization;

    public function view(User $user, Device $device)
    {
        return $user->id === $device->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Device $device)
    {
        return $user->id === $device->user_id;
    }

    public function delete(User $user, Device $device)
    {
        return $user->id === $device->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Device $device): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Device $device): bool
    {
        return false;
    }
}
