<?php

namespace App\Http\Controllers\API;

use App\Book;
use App\Filters\Book\BookFilters;
use App\Filters\QueryFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Filters\Book\BookFilters $filters
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, BookFilters $filters)
    {

        $collection = $request->user()
                              ->books()
                              ->filter($filters)
                              ->paginate(10);

        return BookResource::collection($collection);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \App\Http\Resources\BookResource
     */
    public function show(Request $request, int $id)
    {
        $book = $request->user()->books()->findOrFail($id);

        return new BookResource($book);
    }
}
