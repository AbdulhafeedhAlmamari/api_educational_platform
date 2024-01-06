<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Resources\AdminResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Admin = AdminResource::collection(Admin::all());

            if ($Admin->isEmpty()) {
                return $this->apiResponse(null, 'No Admin found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Admin, 'Admin retrieved successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        try {
            $Admin = new AdminResource(Admin::create($request->validated()));

            return $this->apiResponse($Admin, 'Admin created successfully', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $Admin = new AdminResource(Admin::findOrFail($id));
            return $this->apiResponse($Admin, 'Admin retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Admin not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, $id)
    {
        try {
            $Admin = new AdminResource(Admin::findOrFail($id));
            $Admin->update($request->validated());
            return $this->apiResponse($Admin, 'Admin updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Admin not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $Admin = new AdminResource(Admin::findOrFail($id));
            $Admin->delete();
            return $this->apiResponse($Admin, 'Admin deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Admin not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
