<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryRequest;
use App\Models\Categories\Category;
use App\Repositories\Admin\Categories\CategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $categoryRepo)
    {
        $categories = $categoryRepo->getCategories(20);
        return response()->view('admin.categories.index', ['categories' => $categories]);
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
        return response()->view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // $validated = $request->validated();

        $validated = $request->validated();
        $image = $validated['image'];
        // $imageName = Carbon::now()->format('Y-m-d-h-i') . '.' . $image->getClientOriginalExtension();
        $imageName = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/categories', $imageName, ['disk' => 'public']);
        // $request->image = 'categories/' . $imageName;
        
        $validated['image'] = 'categories/' . $imageName;
        $isAdded = Category::create($validated);
        if(!$isAdded){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->route('admin.categories.index');
        }
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryRepository $categoryRepo, $id)
    {
        $category = $categoryRepo->getCategory($id);
        return response()->view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, CategoryRepository $categoryRepo, $id)
    {
        $data = $request->validated();
        $category = $categoryRepo->getCategory($id);

        if(isset($data['image'])) {
            $image = $data['image'];
            $imageName = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/categories', $imageName, ['disk' => 'public']);

            $data['image'] = 'categories/' . $imageName;
            Storage::disk('public')->delete($category->image);
        } else {
            $data['image'] = $category->image;
        }

        $model = $categoryRepo->update($id,$data);
        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.categories.index');
        }

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CategoryRepository $categoryRepo, $id)
    {
        // $categoryRepo->getCategory($id);
        $imageName = $categoryRepo->getCategory($id)->image;
        // dd($imageName);
        $isDeleted = $categoryRepo->destroy($id);
        if (!$isDeleted) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.categories.index');
        }

        Storage::disk('public')->delete($imageName);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.categories.index');
    }
}
