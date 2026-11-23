<?php

namespace App\Policies;

use App\Models\Laporan;
use App\Models\User;

class LaporanPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Laporan $laporan): bool
    {
        return $user->isAdmin() || $user->id === $laporan->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Laporan $laporan): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Laporan $laporan): bool
    {
        return $user->isAdmin();
    }
}
