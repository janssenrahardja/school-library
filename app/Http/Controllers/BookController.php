<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dataBook = Book::all();

        return view('pages.book.index', [
            'dataBook' => $dataBook
        ]);
    }

    public function create() {
        $dataAuthor = Author::all();

        return view('pages.book.create', [
            'dataAuthor' => $dataAuthor
        ]);
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $data = new Book();
            $data->author_id = $request->author_id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->created_by = Auth::id();
            $data->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect('/dashboard/books')->with('success', 'Book Created');
    }

    public function show($id)
    {
        $dataAuthor = Author::all();
        $data = Book::findOrFail($id);

        return view('pages.book.detail', [
            'dataAuthor' => $dataAuthor,
            'data' => $data
        ]);
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();

            $data['author_id'] = $request->author_id;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['updated_by'] = Auth::id();
            
            Book::where('id', $id)->update($data);

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect(url()->previous())->withInput()->with('success', 'Book Updated');
    }

    public function delete($id)
    {
        $data['deleted_by'] = Auth::id();
        Book::where('id', $id)->update($data);

        $dataBook = Book::findOrFail($id);

        if ($dataBook) {
            $dataBook->delete();
        }

        return redirect(url()->previous())->withInput()->with('success', 'Book Deleted');
    }
}
