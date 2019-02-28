<?php

namespace IAtelier\Atelier\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EditorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function manage_atelier(User $user)
	{
		return $user->id == 1;
	}
}