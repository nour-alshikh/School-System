<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $book;

    public function __construct(BookRepositoryInterface $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        return  $this->book->index();
    }
    public function store(Request $request)
    {
        return  $this->book->store($request);
    }
    public function update(Request $request, string $id)
    {
        return  $this->book->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->book->delete($id);
    }
    public function download(string $id)
    {
        return  $this->book->download($id);
    }
}
