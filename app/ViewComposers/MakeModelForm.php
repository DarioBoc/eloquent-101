<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

use App\Models\MakeYear;
use App\Models\Make;
use App\Models\Model;

Class MakeModelForm
{
    public function compose(View $view)
    {
        $makeForm = Request::only(['make_id', 'makeyear_id', 'model_id']);

        $makes = Make::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $makeYears = $models = [];

        if ($makeForm['make_id']) {
            $makeYears = MakeYear::where('make_id', $makeForm['make_id'])->orderBy('year', 'DESC')->pluck('year', 'id')->toArray();

            if ($makeForm['makeyear_id']) {
                $models = Model::where('makeyear_id', $makeForm['makeyear_id'])->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
            }
        }

        $view->with(compact('makeForm', 'makes', 'makeYears', 'models'));
    }
}