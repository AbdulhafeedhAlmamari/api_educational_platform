<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\RatingsCourse;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\RatingsCourseResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ratings\RatingsCourseRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class RatingsCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $RatingsCourse = RatingsCourseResource::collection(RatingsCourse::all());

            if ($RatingsCourse->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي تقيمات عن هاذا الكرس', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($RatingsCourse, 'تم عرض التقيمات بنجاح', Response::HTTP_OK);
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
    public function store(RatingsCourseRequest $request)
    {
        try {
            // $user = auth()->user();
            $RatingsCourse = new RatingsCourseResource(RatingsCourse::create(array_merge($request->validated(), ['' => $user->id])));

            return $this->apiResponse($RatingsCourse, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $RatingsCourse = new RatingsCourseResource(RatingsCourse::findOrFail($id));
            return $this->apiResponse($RatingsCourse, 'تم عرض التقيم بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا التقيم غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(RatingsCourseRequest $request, $id)
    {
        try {
            $RatingsCourse = new RatingsCourseResource(RatingsCourse::findOrFail($id));
            $RatingsCourse->update($request->validated());
            return $this->apiResponse($RatingsCourse, 'تم التعديل بنجاح', Response::HTTP_CREATED);
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
            $RatingsCourse = new RatingsCourseResource(RatingsCourse::findOrFail($id));
            $RatingsCourse->delete();
            return $this->apiResponse($RatingsCourse, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا التقيم غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
