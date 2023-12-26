<?php

namespace App\Http\Controllers\blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\blockRequest;
use App\Models\Block;
use App\Models\Cemetery;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::all();
        $cemeteries = Cemetery::all();
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 25.1338688,
                    'lng' => 56.3332739
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('blocks.index', compact('blocks', 'cemeteries', 'initialMarkers'));
    }


    public function store(blockRequest $request)
    {
        try
        {
            $block = new Block();
            $block->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $block->cemetery_id = $request->cemetery;
            $block->latitude = $request->latitude;
            $block->Longitude = $request->longitude;
            $block->save();

            toastr()->success('تم حفظ البيانات بنجاح');
            return redirect()->route('blocks.index');
        }
        catch(\Exception $e)
        {
            toastr()->error('هنالك مشكلة في البيانات المدخلة');
            return redirect()->route('blocks.index');
        }
    }

    public function update(blockRequest $request, $id)
    {
        try
        {
            $block = Block::findOrFail($id);
            $block->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $block->cemetery_id = $request->cemetery;
            $block->latitude = $request->latitude;
            $block->Longitude = $request->longitude;
            $block->save();

            toastr()->success('تم تعديل البيانات بنجاح');
            return redirect()->route('blocks.index');
        }
        catch(\Exception $e)
        {
            toastr()->error('هنالك مشكلة في البيانات المدخلة');
            return redirect()->route('blocks.index');
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
        Block::destroy($id);
        toastr()->success('تم حذف البيانات بنجاح');
        return redirect()->route('blocks.index');

    }
}
