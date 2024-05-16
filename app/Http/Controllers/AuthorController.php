<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public AuthorService $service;
    public BookService $bookService;

    public function __construct(AuthorService $service, BookService $bookService)
    {
        $this->service = $service;
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('authors.index');

        $authors = json_decode($this->service->getItems())->data;
        foreach ($authors as $index => $author) {
            $books = json_decode($this->bookService->getItems([ 'author_id' => $author->id ]));
            $authors[$index]->books = $books->data;
        }

        return $this->validResponse($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('authors.create');
        return $this->successResponse($this->service->createItem($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $author)
    {
        $this->authorize('authors.show');
        
        $aux = json_decode($this->service->getItem($author))->data;
        $books = json_decode($this->bookService->getItems([ 'author_id' => $aux->id ]));
        $aux->books = $books->data;

        return $this->validResponse($aux);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $author)
    {
        $this->authorize('authors.update');
        return $this->successResponse($this->service->editItem($request->all(), $author));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $author)
    {
        $this->authorize('authors.destroy');
        return $this->successResponse($this->service->deleteItem($author));
    }
}
