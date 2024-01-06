<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\FavoriteResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Favorite = FavoriteResource::collection(Favorite::all());

            if ($Favorite->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي اكراس مفضلة لعرضها', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Favorite, 'تم عرض الاكراس المفضلة بنجاح', Response::HTTP_OK);
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
    public function store(FavoriteRequest $request)
    {
        try {
            $Favorite = new FavoriteResource(Favorite::create($request->validated()));

            return $this->apiResponse($Favorite, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $Favorite = new FavoriteResource(Favorite::findOrFail($id));
            return $this->apiResponse($Favorite, 'تم عرض الكرس المفضل بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الكرس المفضل غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(FavoriteRequest $request, $id)
    {
        try {
            $Favorite = new FavoriteResource(Favorite::findOrFail($id));
            $Favorite->update($request->validated());
            return $this->apiResponse($Favorite, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الكرس المفضل غير موجود', Response::HTTP_NOT_FOUND);
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
            $Favorite = new FavoriteResource(Favorite::findOrFail($id));
            $Favorite->delete();
            return $this->apiResponse($Favorite, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الكرس المفضل غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
