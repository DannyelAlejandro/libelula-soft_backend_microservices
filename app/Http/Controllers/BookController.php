<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public BookService $service;
    public AuthorService $authorService;

    public function __construct(BookService $service, AuthorService $authorService)
    {
        $this->service = $service;
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('books.index');
        $books = json_decode($this->service->getItems())->data;

        foreach ($books as $index => $book) {
            $author = json_decode($this->authorService->getItem($book->author_id))->data;
            $books[$index]->author = $author;
        }

        return $this->validResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('books.create');
        $this->authorService->getItem($request->author_id);

        return $this->successResponse($this->service->createItem($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $book)
    {
        $this->authorize('books.show');

        $aux = json_decode($this->service->getItem($book))->data;
        $author = json_decode($this->authorService->getItem($aux->author_id))->data;
        $aux->author = $author;
        
        return $this->validResponse($aux);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $book)
    {
        $this->authorize('books.update');
        $this->authorService->getItem($request->author_id);

        return $this->successResponse($this->service->editItem($request->all(), $book));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $book)
    {
        $this->authorize('books.destroy');
        
        return $this->successResponse($this->service->deleteItem($book));
    }
}
