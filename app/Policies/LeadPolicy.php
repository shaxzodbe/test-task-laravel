<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }


    public function view(User $user, Lead $lead): bool
    {
        return $user->id === $lead->assigned_to;
    }


    public function create(User $user): bool
    {
        return true;
    }


    public function update(User $user, Lead $lead): bool
    {
        return $user->id === $lead->assigned_to;
    }


    public function delete(User $user, Lead $lead): bool
    {
        return $user->id === $lead->assigned_to;
    }


    public function restore(User $user, Lead $lead): bool
    {
        return false;
    }


    public function forceDelete(User $user, Lead $lead): bool
    {
        return false;
    }
}
