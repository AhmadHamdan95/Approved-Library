<?php

namespace App\Http\Controllers\Admin\Publishers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Publishers\CreatePublisherRequest;
use App\Http\Requests\Admin\Publishers\EditPublisherRequest;
use App\Models\Authors\Author;
use App\Models\Publishers\Publisher;
use App\Repositories\Admin\Publishers\PublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PublisherRepository $publisherRepo)
    {
        $publishers = $publisherRepo->getPublishers(20);
        return response()->view('admin.publishers.index', ['publishers' => $publishers]);
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
        return response()->view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePublisherRequest $request)
    {
        $validated = $request->validated();
        $image = $validated['image'];
        $imageName = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/publishers', $imageName, ['disk' => 'public']);        
        $validated['image'] = 'publishers/' . $imageName;
        $isAdded = Publisher::create($validated);
        if(!$isAdded){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->route('admin.publishers.index');
        }
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);
        return redirect()->route('admin.publishers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PublisherRepository $publisherRepo, $id)
    {
        $publisher = $publisherRepo->getPublisher($id);
        return response()->view('admin.publishers.edit', ['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPublisherRequest $request, PublisherRepository $publisherRepo, $id)
    {
        $data = $request->validated();
        $publisher = $publisherRepo->getPublisher($id);

        if(isset($data['image'])) {
            $image = $data['image'];
            $imageName = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/publishers', $imageName, ['disk' => 'public']);

            $data['image'] = 'publishers/' . $imageName;
            Storage::disk('public')->delete($publisher->image);
        } else {
            $data['image'] = $publisher->image;
        }

        $model = $publisherRepo->update($id,$data);
        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.publishers.index');
        }

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PublisherRepository $publisherRepo, $id)
    {
        // $categoryRepo->getCategory($id);
        $imageName = $publisherRepo->getPublisher($id)->image;
        // dd($imageName);
        $isDeleted = $publisherRepo->destroy($id);
        if (!$isDeleted) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.publishers.index');
        }

        Storage::disk('public')->delete($imageName);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.publishers.index');
    }

    public function getAuthors(PublisherRepository $publisherRepo, $id)
    {
        $publisher = $publisherRepo->getPublisher($id);
        $authors = $publisher->authors;
        $allAuthors = Author::all();
        return response()->view('admin.publishers.getAuthors', ['publisher' => $publisher, 'authors' => $authors, 'allAuthors' => $allAuthors]);
    }

    public function addAuthors(Request $request, PublisherRepository $publisherRepo)
    {
        $publisher = $publisherRepo->getPublisher($request->publisher);
        $publisher->authors()->syncWithoutDetaching($request->authors);
        return redirect()->back();
    }

    public function deleteAuthor(PublisherRepository $publisherRepo, $publisher, $id)
    {
        $publisher = $publisherRepo->getPublisher($publisher);
        $publisher->authors()->detach($id);
        return redirect()->back();
    }
}
