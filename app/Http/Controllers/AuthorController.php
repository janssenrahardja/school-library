<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dataAuthor = Author::all();

        return view('pages.author.index', [
            'dataAuthor' => $dataAuthor
        ]);
    }

    public function create() {

        return view('pages.author.create');
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $data = new Author();
            $data->name = $request->name;
            $data->created_by = Auth::id();
            $data->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect('/dashboard/authors')->with('success', 'Author Created');
    }

    public function show($id)
    {
        $data = Author::findOrFail($id);

        return view('pages.author.detail', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();

            $data['name'] = $request->name;
            $data['updated_by'] = Auth::id();
            
            Author::where('id', $id)->update($data);

            DB::commit();
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();

            return redirect(url()->previous())->withInput()->with('failed', 'Please check log');
        }

        return redirect(url()->previous())->with('success', 'Author Updated');
    }

    public function delete($id)
    {
        $data['deleted_by'] = Auth::id();
        Author::where('id', $id)->update($data);

        $dataAuhtor = Author::findOrFail($id);

        if ($dataAuhtor) {
            $dataAuhtor->delete();
        }

        return redirect(url()->previous())->with('success', 'Author Deleted');
    }
}
