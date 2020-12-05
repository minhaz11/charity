<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Preference;

class CompanyDetailsController extends Controller
{
    /**
     * view company details form and save form data
     * @param  Request $request all form data
     * @return blade void
     */
    public function save(Request $request)
    {
        $option['menu'] = 'company-details';
        if ($request->isMethod('GET')) {
            $option['preference'] = Preference::all()->where('category', 'company-details')->pluck('value', 'field')->toArray();
            return view('admin.company-details.details', $option);
        }

    	$request->validate([
		    'name' => 'required|min:3|max:15',
		    'email' => 'required|email'
		]);

        $option['menu'] = 'company-details';
        $postData = $request->all();
        $request->except(['_token']);

        $i = 0;

        foreach ($postData as $key => $value) {
            $optionReqeust[$i]['category'] = "company-details";
            $optionReqeust[$i]['field'] = $key;
            $optionReqeust[$i]['value'] = is_null($value) ? '' : $value;
            $i++;
        }

        foreach($optionReqeust as $key => $value) {
            $category = $value['category'];
            $field    = $value['field'];
            $val      = $value['value'];
            $res      = Preference::all()->where('field', $field)->count();
            if($res == 0) {
                $newPreference= new Preference();
                $newPreference->category = $category;
                $newPreference->field    = $field;
                $newPreference->value    = $val;
                $newPreference->save();
            } else {
                $preferenceToUpdate = Preference::where('category', 'company-details')
                                                ->where('field', $field)
                                                ->update(['value' => $val]);
            }
        }

        \Session::flash('success', 'Successfully Saved');
        return redirect('company-details/save');
    }
}
