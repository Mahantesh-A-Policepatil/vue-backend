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
     */
    public function __construct(
        protected CrmUserRepositoryInterface $crmUserRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->crmUserRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
     */
    public function show($id)
    {
        return $this->crmUserRepository->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
     */
    public function destroy($id)
    {
        $this->crmUserRepository->delete($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
