<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CrmUserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CrmUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  CrmUserRepositoryInterface  $crmUserRepository
     */
    public function __construct(protected CrmUserRepositoryInterface $crmUserRepository)
    {
        // constructor does not return anything
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->crmUserRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'department' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $user = $this->crmUserRepository->create($data);

        return response($user, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Models\CrmUser
     */
    public function show(int $id): \App\Models\CrmUser
    {
        return $this->crmUserRepository->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'department' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $user = $this->crmUserRepository->update($id, $data);

        return response($user, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {
        $this->crmUserRepository->delete($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
