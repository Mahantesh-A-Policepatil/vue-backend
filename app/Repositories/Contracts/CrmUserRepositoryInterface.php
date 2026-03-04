<?php

namespace App\Repositories\Contracts;

interface CrmUserRepositoryInterface
{
    /**
     * Get all users ordered by ID.
     */
    public function getAll(array $filters = []);

    /**
     * Get a user by ID.
     */
    public function getById($id);

    /**
     * Create a new user.
     */
    public function create(array $data);

    /**
     * Update an existing user.
     */
    public function update($id, array $data);

    /**
     * Delete a user.
     */
    public function delete($id);

    /**
    * Add many users by calling the database stored procedure.
    */
    public function seedUsingProcedure(int $count): void;


}
