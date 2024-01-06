<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Resources\SectionResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Section = SectionResource::collection(Section::all());

            if ($Section->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي اقسام حاليا', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Section, 'تم استرجاع الاقسام بنجاح', Response::HTTP_OK);
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
    public function store(SectionRequest $request)
    {
        try {
            $Section = new SectionResource(Section::create($request->validated()));

            return $this->apiResponse($Section, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $Section = new SectionResource(Section::findOrFail($id));
            return $this->apiResponse($Section, 'تم استرجاع القسم بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا القسم غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(SectionRequest $request, $id)
    {
        try {
            $Section = new SectionResource(Section::findOrFail($id));
            $Section->update($request->validated());
            return $this->apiResponse($Section, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا القسم غير موجود', Response::HTTP_NOT_FOUND);
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
            $Section = new SectionResource(Section::findOrFail($id));
            $Section->delete();
            return $this->apiResponse($Section, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا القسم غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
