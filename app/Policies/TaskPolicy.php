<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage (edytować/usunąć) zadanie.
     */
    public function manage(User $user, Task $task)
    {
        // Tylko pracodawca może zarządzać zadaniami
        return $user->role === 'employer';
    }
}
