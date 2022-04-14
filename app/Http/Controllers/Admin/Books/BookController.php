<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Books\CreateBookRequest;
use App\Http\Requests\Admin\Books\EditBookRequest;
use App\Models\Authors\Author;
use App\Models\Books\Book;
use App\Models\Categories\Category;
use App\Models\Publishers\Publisher;
use App\Repositories\Admin\Books\BookRepository;
use App\Repositories\Admin\Publishers\PublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookRepository $bookRepo)
    {
        $books = $bookRepo->getBooks(20);
        return response()->view('admin.books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('admin.books.create', ['publishers' => $publishers, 'authors' => $authors, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request, BookRepository $bookRepo, PublisherRepository $publisherRepo)
    {
        $data = $request->validated();
        $imageName = rand() . '.' . $data['image']->getClientOriginalExtension();
        $data['image']->storeAs('/books', $imageName, ['disk' => 'public']);
        $data['image'] = 'books/' . $imageName;

        $model = $bookRepo->store($data);

        if(! $model){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->route('admin.books.index');
        }
        $publisher = $publisherRepo->getPublisher($data['publisher_id']);
        $model->publisher()->associate($publisher);
        $model->authors()->sync($data['authors']);
        $model->categories()->sync($data['categories']);
        
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);
        return redirect()->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRepository $bookRepo, $id)
    {
        $book = $bookRepo->getBook($id);
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('admin.books.edit', ['book' => $book, 'publishers' => $publishers, 'authors' => $authors, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(EditBookRequest $request, BookRepository $bookRepo, PublisherRepository $publisherRepo, $id)
    {
        $data = $request->validated();
        $book = $bookRepo->getBook($id);

        if(isset($data['image'])){
            $imageName = rand() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('/books', $imageName, ['disk' => 'public']);
            $data['image'] = 'books/' . $imageName;
            Storage::disk('public')->delete($book->image);
        }else{
            $data['image'] = $book->image;
        }
        
        $model = $bookRepo->update($id, $data);

        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.books.index');
        }
        $publisher = $publisherRepo->getPublisher($data['publisher_id']);
        $book->publisher()->dissociate();
        $book->publisher()->associate($publisher);
        $book->authors()->sync($data['authors']);
        $book->categories()->sync($data['categories']);

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BookRepository $bookRepo, $id)
    {
        $book = $bookRepo->getBook($id);
        $delete = $bookRepo->destroy($id);

        if (!$delete) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.books.index');
        }

        Storage::disk('public')->delete($book->image);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.books.index');
    }
}
