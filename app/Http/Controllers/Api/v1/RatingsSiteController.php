<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\RatingsSite;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\RatingsSiteResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingsSiteRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class RatingsSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $RatingsSite = RatingsSiteResource::collection(RatingsSite::all());

            if ($RatingsSite->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي تقيمات عن الموقع', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($RatingsSite, 'تم عرض التقيمات بنجاح', Response::HTTP_OK);
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
    public function store(RatingsSiteRequest $request)
    {
        try {
            $RatingsSite = new RatingsSiteResource(RatingsSite::create($request->validated()));

            return $this->apiResponse($RatingsSite, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $RatingsSite = new RatingsSiteResource(RatingsSite::findOrFail($id));
            return $this->apiResponse($RatingsSite, 'تم عرض التقيم بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا التقيم غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(RatingsSiteRequest $request, $id)
    {
        try {
            $RatingsSite = new RatingsSiteResource(RatingsSite::findOrFail($id));
            $RatingsSite->update($request->validated());
            return $this->apiResponse($RatingsSite, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا التقيم غير موجود', Response::HTTP_NOT_FOUND);
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
            $RatingsSite = new RatingsSiteResource(RatingsSite::findOrFail($id));
            $RatingsSite->delete();
            return $this->apiResponse($RatingsSite, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا التقيم غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
