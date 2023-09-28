<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\CategoryMain;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryMainResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryMainRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class CategoryMainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $CategoryMain = CategoryMainResource::collection(CategoryMain::all());

            if ($CategoryMain->isEmpty()) {
                return $this->apiResponse(null, 'No CategoryMain found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($CategoryMain, 'CategoryMain retrieved successfully', Response::HTTP_OK);
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
    public function store(CategoryMainRequest $request)
    {
        try {
            $CategoryMain = new CategoryMainResource(CategoryMain::create($request->validated()));

            return $this->apiResponse($CategoryMain, 'CategoryMain created successfully', Response::HTTP_CREATED);
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
            $CategoryMain = new CategoryMainResource(CategoryMain::findOrFail($id));
            return $this->apiResponse($CategoryMain, 'CategoryMain retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategoryMain not found', Response::HTTP_NOT_FOUND);
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
    public function update(CategoryMainRequest $request, $id)
    {
        try {
            $CategoryMain = new CategoryMainResource(CategoryMain::findOrFail($id));
            $CategoryMain->update($request->validated());
            return $this->apiResponse($CategoryMain, 'CategoryMain updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategoryMain not found', Response::HTTP_NOT_FOUND);
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
            $CategoryMain = new CategoryMainResource(CategoryMain::findOrFail($id));
            $CategoryMain->delete();
            return $this->apiResponse($CategoryMain, 'CategoryMain deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CategoryMain not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
