<?php

namespace App\Repositories;

use App\Models\CrmUser;
use App\Repositories\Contracts\CrmUserRepositoryInterface;
use Illuminate\Support\Str;

class CrmUserRepository implements CrmUserRepositoryInterface
{
    /**
     * Paginate users applying optional search, filters and sorting.
     *
     * Supported options:
     *   - page
     *   - perPage
     *   - search
     *   - filterType
     *   - filterValue
     *   - sortKey
     *   - sortOrder
     *
     * @param  array  $options
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $options = [])
    {
        $query = CrmUser::query();

        // global search across all columns
        if (!empty($options['search'])) {
            $keyword = strtolower($options['search']);
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw('LOWER(first_name) like ?', ["%{$keyword}%"])
                  ->orWhereRaw('LOWER(last_name) like ?', ["%{$keyword}%"])
                  ->orWhereRaw('CAST(age AS CHAR) like ?', ["%{$keyword}%"])
                  ->orWhereRaw('LOWER(department) like ?', ["%{$keyword}%"])
                  ->orWhereRaw('LOWER(city) like ?', ["%{$keyword}%"]);
            });
        }

        // dropdown filter
        if (!empty($options['filterType']) && !empty($options['filterValue'])) {
            $column = Str::snake($options['filterType']);
            $query->where($column, $options['filterValue']);
        }

        // sorting
        if (!empty($options['sortKey'])) {
            $column = Str::snake($options['sortKey']);
            $order = $options['sortOrder'] ?? 'asc';
            $query->orderBy($column, $order);
        } else {
            $query->orderBy('id');
        }

        $perPage = $options['perPage'] ?? 5;
        return $query->paginate($perPage);
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
     * Return distinct department and city values for filtering dropdowns.
     *
     * @return array
     */
    public function filterValues(): array
    {
        return [
            'department' => CrmUser::select('department')->distinct()->pluck('department')->filter()->values(),
            'city'       => CrmUser::select('city')->distinct()->pluck('city')->filter()->values(),
        ];
    }
}
