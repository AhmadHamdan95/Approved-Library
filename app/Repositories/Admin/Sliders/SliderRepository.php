<?php

namespace App\Repositories\Admin\Sliders;

use App\Models\Sliders\Slider;

class SliderRepository{
    public function getSlider($id)
    {
        return Slider::query()->findOrFail($id);
    }

    public function getSliders($perPage){
        return Slider::query()->paginate($perPage);
    }

    public function destroy($id)
    {
        return Slider::query()->findOrFail($id)->delete();
    }

    public function store(array $data)
    {
        return Slider::query()->create($data);
    }

    public function update($id, array $data)
    {
        return Slider::query()->findOrFail($id)->update($data);
    }
}