<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementRequest;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        // Валидация параметров сортировки
        $allowedSortFields = ['created_at', 'price'];
        $allowedSortOrders = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'created_at'; // Значение по умолчанию
        }

        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'desc'; // Значение по умолчанию
        }

        $advertisements = Advertisement::orderBy($sortBy, $sortOrder)->paginate($perPage);

        return AdvertisementResource::collection($advertisements)->response()->setStatusCode(200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        $data = $request->validated();
        $advertisement = Advertisement::create($data);
        return (new AdvertisementResource($advertisement))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement, Request $request)
    {
        return new AdvertisementResource($advertisement);
    }
}