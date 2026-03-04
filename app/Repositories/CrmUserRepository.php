<?php

namespace App\Repositories;

use App\Models\CrmUser;
use App\Repositories\Contracts\CrmUserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CrmUserRepository implements CrmUserRepositoryInterface
{
    /**
     * Get all users ordered by ID.
     */
    public function getAll(array $filters = [])
    {
        $allowedSortColumns = ['id', 'first_name', 'last_name', 'age', 'department', 'city', 'created_at'];

        $search = $filters['search'] ?? null;
        $filterType = $filters['filter_type'] ?? null;
        $filterValue = $filters['filter_value'] ?? null;
        $sortBy = $filters['sort_by'] ?? 'id';
        $sortOrder = $filters['sort_order'] ?? 'asc';

        if (! in_array($sortBy, $allowedSortColumns, true)) {
            $sortBy = 'id';
        }

        if (! in_array($sortOrder, ['asc', 'desc'], true)) {
            $sortOrder = 'asc';
        }

        return CrmUser::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('age', 'like', "%{$search}%");
                });
            })
            ->when($filterType && $filterValue, function ($query) use ($filterType, $filterValue) {
                $allowedFilterColumns = ['department', 'city'];

                if (in_array($filterType, $allowedFilterColumns, true)) {
                    $query->where($filterType, $filterValue);
                }
            })
            ->orderBy($sortBy, $sortOrder)
            ->get();
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

    /**
     * Add many users by calling the database stored procedure.
     */
    public function seedUsingProcedure(int $count): void
    {
        DB::statement('CALL seed_crm_users(?)', [$count]);
    }

}
