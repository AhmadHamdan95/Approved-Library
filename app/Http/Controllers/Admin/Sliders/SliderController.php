<?php

namespace App\Http\Controllers\Admin\Sliders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sliders\CreateSliderRequest;
use App\Http\Requests\Admin\Sliders\EditSliderRequest;
use App\Repositories\Admin\Sliders\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SliderController extends Controller
{
    public function index(SliderRepository $sliderRepo)
    {
        $sliders = $sliderRepo->getSliders(20);
        return response()->view('admin.sliders.index', ['sliders' => $sliders]);
    }

    public function create()
    {
        return  response()->view('admin.sliders.create');
    }

    public function store(CreateSliderRequest $request, SliderRepository $sliderRepo)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try{
            $imageName = rand() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('/sliders', $imageName, ['disk' => 'public']);
            $data['image'] = 'sliders/' . $imageName;

            $model = $sliderRepo->store($data);
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
        }

        if(! $model){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->route('admin.sliders.index');
        }
        
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);
        return redirect()->route('admin.sliders.index');
    }

    public function edit(SliderRepository $sliderRepo, $id)
    {
        $slider = $sliderRepo->getSlider($id);
        return response()->view('admin.sliders.edit', ['slider' => $slider]);
    }

    public function update(EditSliderRequest $request, SliderRepository $sliderRepo, $id)
    {
        $data = $request->validated();
        $slider = $sliderRepo->getSlider($id);

        DB::beginTransaction();
        try{
            if(isset($data['image'])){
                $imageName = rand() . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->storeAs('/sliders', $imageName, ['disk' => 'public']);
                $data['image'] = 'sliders/' . $imageName;
                Storage::disk('public')->delete($slider->image);
            }else{
                $data['image'] = $slider->image;
            }
            
            $model = $sliderRepo->update($id, $data);
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
        }

        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.sliders.index');
        }
        
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.sliders.index');
    }

    public function destroy(Request $request, SliderRepository $sliderRepo, $id)
    {
        $slider = $sliderRepo->getSlider($id);
        $delete = $sliderRepo->destroy($id);

        if (!$delete) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.sliders.index');
        }

        Storage::disk('public')->delete($slider->image);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.sliders.index');
    }
}