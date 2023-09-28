<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Lessone;
use Illuminate\Http\Request;
use App\Http\Resources\LessoneResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessoneRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class LessoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Lessone = LessoneResource::collection(Lessone::all());

            if ($Lessone->isEmpty()) {
                return $this->apiResponse(null, 'No Lessone found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Lessone, 'Lessone retrieved successfully', Response::HTTP_OK);
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
    public function store(LessoneRequest $request)
    {
        try {
            $Lessone = new LessoneResource(Lessone::create($request->validated()));

            return $this->apiResponse($Lessone, 'Lessone created successfully', Response::HTTP_CREATED);
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
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            return $this->apiResponse($Lessone, 'Lessone retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Lessone not found', Response::HTTP_NOT_FOUND);
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
    public function update(LessoneRequest $request, $id)
    {
        try {
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            $Lessone->update($request->validated());
            return $this->apiResponse($Lessone, 'Lessone updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Lessone not found', Response::HTTP_NOT_FOUND);
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
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            $Lessone->delete();
            return $this->apiResponse($Lessone, 'Lessone deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Lessone not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
