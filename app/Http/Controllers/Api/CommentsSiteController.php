<?php

namespace App\Http\Controllers\Api;

use App\Models\CommentsSite;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsSiteResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsSiteRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class CommentsSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $CommentsSite = CommentsSiteResource::collection(CommentsSite::all());

            if ($CommentsSite->isEmpty()) {
                return $this->apiResponse(null, 'No CommentsSite found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($CommentsSite, 'CommentsSite retrieved successfully', Response::HTTP_OK);
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
    public function store(CommentsSiteRequest $request)
    {
        try {
            $CommentsSite = new CommentsSiteResource(CommentsSite::create($request->validated()));

            return $this->apiResponse($CommentsSite, 'CommentsSite created successfully', Response::HTTP_CREATED);
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
            $CommentsSite = new CommentsSiteResource(CommentsSite::findOrFail($id));
            return $this->apiResponse($CommentsSite, 'CommentsSite retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsSite not found', Response::HTTP_NOT_FOUND);
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
    public function update(CommentsSiteRequest $request, $id)
    {
        try {
            $CommentsSite = new CommentsSiteResource(CommentsSite::findOrFail($id));
            $CommentsSite->update($request->validated());
            return $this->apiResponse($CommentsSite, 'CommentsSite updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsSite not found', Response::HTTP_NOT_FOUND);
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
            $CommentsSite = new CommentsSiteResource(CommentsSite::findOrFail($id));
            $CommentsSite->delete();
            return $this->apiResponse($CommentsSite, 'CommentsSite deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'CommentsSite not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
