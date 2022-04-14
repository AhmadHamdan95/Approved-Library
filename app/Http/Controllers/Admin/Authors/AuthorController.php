<?php

namespace App\Http\Controllers\Admin\Authors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authors\CreateAuthorRequest;
use App\Http\Requests\Admin\Authors\EditAuthorRequest;
use App\Models\Authors\Author;
use App\Models\Publishers\Publisher;
use App\Models\Author_Publisher;
use App\Repositories\Admin\Authors\AuthorRepository;
use App\Repositories\Admin\Publishers\PublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorRepository $authorRepo)
    {
        $authors = $authorRepo->getAuthors(20);
        return response()->view('admin.authors.index', ['authors' => $authors]);
    }

    public function show($id){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        return response()->view('admin.authors.create', ['publishers' => $publishers]);
    }
    // public function create(PublisherRepository $publisherRepo)
    // {
    //     $publishers = $publisherRepo->getPublishers(2);
    //     return response()->view('admin.authors.create', ['publishers' => $publishers]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAuthorRequest $request, AuthorRepository $authorRepo)
    {
        $validated = $request->validated();
        $image = $validated['image'];
        $imageName = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/authors', $imageName, ['disk' => 'public']);        
        $validated['image'] = 'authors/' . $imageName;
        $model = $authorRepo->store($validated);
        $model->publishers()->sync($validated['publishers']);

        if(!$model){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->route('admin.authors.index');
        }
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);
        return redirect()->route('admin.authors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthorRepository $authorRepo, $id)
    {
        $author = $authorRepo->getAuthor($id);
        $publishers = Publisher::all();
        return response()->view('admin.authors.edit', ['author' => $author, 'publishers' => $publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAuthorRequest $request, AuthorRepository $authorRepo, $id)
    {
        $data = $request->validated();
        $author = $authorRepo->getAuthor($id);

        if(isset($data['image'])) {
            $image = $data['image'];
            $imageName = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/authors', $imageName, ['disk' => 'public']);
            $data['image'] = 'authors/' . $imageName;
            Storage::disk('public')->delete($author->image);
        } else {
            $data['image'] = $author->image;
        }

        $model = $authorRepo->update($id,$data);
        $author->publishers()->sync($data['publishers']);
        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.authors.index');
        }

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AuthorRepository $authorRepo, $id)
    {
        // $categoryRepo->getCategory($id);
        $imageName = $authorRepo->getAuthor($id)->image;
        // dd($imageName);
        $isDeleted = $authorRepo->destroy($id);
        if (!$isDeleted) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.authors.index');
        }

        Storage::disk('public')->delete($imageName);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.authors.index');
    }

    // public function getPublishers(AuthorRepository $authorRepo, $id)
    // {
    //     $author = $authorRepo->getAuthor($id);
    //     $publishers = $author->publishers;
    //     $allPublishers = Publisher::all();
    //     return response()->view('admin.authors.getPublishers', ['author' => $author, 'publishers' => $publishers, 'allPublishers' => $allPublishers]);
    // }

    // public function addPublishers(Request $request, AuthorRepository $authorRepo)
    // {
    //     $author = $authorRepo->getAuthor($request->author);
    //     $author->publishers()->syncWithoutDetaching($request->publishers);
    //     return redirect()->back();
    // }

    // public function deletePublisher(AuthorRepository $authorRepo, $author, $id)
    // {
    //     $author = $authorRepo->getAuthor($author);
    //     $author->publishers()->detach($id);
    //     return redirect()->back();
    // }
}
