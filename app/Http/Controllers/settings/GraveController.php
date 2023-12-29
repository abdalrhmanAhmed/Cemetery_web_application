<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraveRequest;
use App\Models\Block;
use App\Models\Grave;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GraveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::all();
        $graves = Grave::all();
        return view('settings.graves.index', compact('blocks', 'graves'));
    }


    public function store(GraveRequest $request)
    {
        try
        {
            $grave = new Grave();
            $grave->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $grave->block_id = $request->block_id;
            $grave->save();

            toastr()->success('تم حفظ البيانات بنجاح');
            return redirect()->route('graves.index');
        }
        catch(\Exception $e)
        {
            toastr()->error('هنالك مشكلة في البيانات المدخلة');
            return redirect()->route('graves.index');
        }
    }


    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'name_ar' => ['required', Rule::unique('graves')->ignore($id),],
                'name_en' => ['required', Rule::unique('graves')->ignore($id),],
                'block_id' => 'required',
            ]);
            $grave = Grave::findOrFail($id);
            $grave->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $grave->block_id = $request->block_id;
            $grave->save();

            toastr()->success('تم تعديل البيانات بنجاح');
            return redirect()->route('graves.index');
        }
        catch(\Exception $e)
        {
            toastr()->error('هنالك مشكلة في البيانات المدخلة');
            return redirect()->route('graves.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grave::destroy($id);
        toastr()->success('تم حذف البيانات بنجاح');
        return redirect()->route('graves.index');
    }
}
