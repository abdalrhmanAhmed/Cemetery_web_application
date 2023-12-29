<?php

namespace App\Http\Controllers\blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\blockRequest;
use App\Models\Block;
use App\Models\Cemetery;
use App\Models\Grave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try
        {
            $block = new Block();
            $block->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $block->cemetery_id = $request->cemetery;
            $block->latitude = $request->latitude;
            $block->Longitude = $request->longitude;
            $block->save();
            
            for($i = 1; $i<=$request->grave_count; $i++)
            {
                $generata_name = grave_name_generate(new Grave(), 'name', 5, 'A');
                $grave = new Grave();
                $grave->name = $generata_name;
                $grave->block_id = $block->id;
                $grave->status = 0;
                $grave->save();
            }

            DB::commit();
            toastr()->success('تم حفظ البيانات بنجاح');
            return redirect()->route('blocks.index');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            toastr()->error('هنالك مشكلة في البيانات المدخلة');
            return redirect()->route('blocks.index');
        }
    }


    public function edit($id)
    {
        $block = Block::findOrFail($id);
        $cemeteries = Cemetery::all();
        // return floatval($block->latitude) . '<br>' . $block->latitude;
        $initialMarkers = [
            [
                'position' => [
                    'lat' => floatval($block->latitude),
                    'lng' => floatval($block->Longitude)
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('blocks.edit', compact('block', 'cemeteries', 'initialMarkers'));
    }

    public function update(blockRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $numbers = [];
            $block = Block::findOrFail($id);
            if($block->graves->count() > $request->grave_count)
            {
                foreach($block->graves as $grave)
                {
                    $number = explode('-', $grave->name);
                    $numbers[] = $number[1];
                }
                $rest = $block->graves->count() - $request->grave_count;
                
                for($i = 1; $i<=$rest; $i++)
                {
                    $lastGrave = max($numbers);
                    $key = array_search(max($numbers), $numbers);
                    unset($numbers[$key]);
                    $row = 'A-'.$lastGrave;
                    $d_grave = Grave::whereName($row)->delete();
                }
            }
            else if($block->graves->count() < $request->grave_count)
            {
                $rest = $request->grave_count - $block->graves->count();
                for($i = 1; $i<=$rest; $i++)
                {
                    $generata_name = grave_name_generate(new Grave(), 'name', 5, 'A');
                    $grave = new Grave();
                    $grave->name = $generata_name;
                    $grave->block_id = $block->id;
                    $grave->status = 0;
                    $grave->save();
                }
            }

            $block->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $block->cemetery_id = $request->cemetery;
            $block->latitude = $request->latitude;
            $block->Longitude = $request->longitude;
            $block->save();

            DB::commit();
            toastr()->success('تم تعديل البيانات بنجاح');
            return redirect()->route('blocks.index');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
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
