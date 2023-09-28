<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\CategorySub;
use Illuminate\Http\Request;
use App\Http\Resources\CategorySubResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySubRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class CategorySubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $CategorySub = CategorySubResource::collection(CategorySub::all());

            if ($CategorySub->isEmpty()) {
                return $this->apiResponse(null, 'No CategorySub found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($CategorySub, 'CategorySub retrieved successfully', Response::HTTP_OK);
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
    public function store(CategorySubRequest $request)
    {
        try {
            $CategorySub = new CategorySubResource(CategorySub::create($request->validated()));

            return $this->apiResponse($CategorySub, 'CategorySub created successfully', Response::HTTP_CREATED);
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
            $CategorySub = new CategorySubResource(CategorySub::findOrFail($id));
            return $this->apiResponse($CategorySub, 'CategorySub retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategorySub not found', Response::HTTP_NOT_FOUND);
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
    public function update(CategorySubRequest $request, $id)
    {
        try {
            $CategorySub = new CategorySubResource(CategorySub::findOrFail($id));
            $CategorySub->update($request->validated());
            return $this->apiResponse($CategorySub, 'CategorySub updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategorySub not found', Response::HTTP_NOT_FOUND);
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
            $CategorySub = new CategorySubResource(CategorySub::findOrFail($id));
            $CategorySub->delete();
            return $this->apiResponse($CategorySub, 'CategorySub deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategorySub not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
