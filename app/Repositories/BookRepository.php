<?php

namespace App\Repositories;

use App\Http\Resources\BookResource;
use App\Http\traits\AttachFileTrait;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookRepository implements BookRepositoryInterface
{
    use AttachFileTrait;
    public function index()
    {
        $books = Book::with(['grade', 'class_room', 'section', 'teacher'])->get();

        return response()->json([
            'books' => BookResource::collection($books)
        ]);
    }

    public function store($request)
    {
        Book::create([
            'title' => $request->title,
            'file_name' => $request->file('file_name')->GetClientOriginalName(),
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,
        ]);

        $this->uploadFile($request, 'file_name');

        return response()->json([
            'status' => 201,
            'message' => "Book Created Successfully"
        ]);
    }
    public function update($request, $id) {}
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'status' => 200,
            'message' => "Book Deleted Successfully"
        ]);
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);

        return response()->download(storage_path($book->file_name));
    }
}
