<?php

namespace App\Repositories;

use App\Models\CrmUser;
use App\Repositories\Contracts\CrmUserRepositoryInterface;

class CrmUserRepository implements CrmUserRepositoryInterface
{
    /**
     * Get all users ordered by ID.
     */
    public function getAll()
    {
        return CrmUser::orderBy('id')->get();
    }

    /**
     * Get a user by ID.
     */
    public function getById($id)
    {
        return CrmUser::findOrFail($id);
    }

    /**
     * Create a new user.
     */
    public function create(array $data)
    {
        return CrmUser::create($data);
    }

    /**
     * Update an existing user.
     */
    public function update($id, array $data)
    {
        $user = CrmUser::findOrFail($id);
        $user->update($data);

        return $user;
    }

    /**
     * Delete a user.
     */
    public function delete($id)
    {
        $user = CrmUser::findOrFail($id);
        $user->delete();

        return true;
    }
}
