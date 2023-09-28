<?php

namespace App\Http\Controllers\Api;

use App\Models\CommentsCourse;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsCourseResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsCourseRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class CommentsCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $CommentsCourse = CommentsCourseResource::collection(CommentsCourse::all());

            if ($CommentsCourse->isEmpty()) {
                return $this->apiResponse(null, 'No CommentsCourse found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($CommentsCourse, 'CommentsCourse retrieved successfully', Response::HTTP_OK);
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
    public function store(CommentsCourseRequest $request)
    {
        try {
            $CommentsCourse = new CommentsCourseResource(CommentsCourse::create($request->validated()));

            return $this->apiResponse($CommentsCourse, 'CommentsCourse created successfully', Response::HTTP_CREATED);
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
            $CommentsCourse = new CommentsCourseResource(CommentsCourse::findOrFail($id));
            return $this->apiResponse($CommentsCourse, 'CommentsCourse retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsCourse not found', Response::HTTP_NOT_FOUND);
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
    public function update(CommentsCourseRequest $request, $id)
    {
        try {
            $CommentsCourse = new CommentsCourseResource(CommentsCourse::findOrFail($id));
            $CommentsCourse->update($request->validated());
            return $this->apiResponse($CommentsCourse, 'CommentsCourse updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsCourse not found', Response::HTTP_NOT_FOUND);
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
            $CommentsCourse = new CommentsCourseResource(CommentsCourse::findOrFail($id));
            $CommentsCourse->delete();
            return $this->apiResponse($CommentsCourse, 'CommentsCourse deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsCourse not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
