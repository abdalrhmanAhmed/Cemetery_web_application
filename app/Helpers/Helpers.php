<?php

function grave_name_generate($model, $trow, $length = 4, $prefix = '')
{

        $data = $model::withTrashed()->orderBy('id', 'desc')->first();
        if(!$data)
        {
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i = 0; $i<$og_length; $i++)
        {
            $zeros .= "0";
        }
        return $prefix . "-" . $zeros . $last_number;

}


function upload(string $dir, string $format, $image = null)
{
    if ($image != null) {
        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        Storage::disk('public')->putFileAs($dir, $image, $imageName);
        // Check if the directory exists, and create it if it doesn't
        if (!File::exists('storage')) {
            File::makeDirectory('storage', 0755, true, true);
        }
        $publicPath = $dir;
        // Save the file to the public directory
        $image->move('public/'.$publicPath, $imageName);        
    } else {
        $imageName = 'def.png';
    }

    return $imageName;
}


function contactMethod()
{
    $data = array
    (
        ['key'=>1, 'value'=>__('Whatsapp')],
        ['key'=>2, 'value'=>__('Facebook')],
        ['key'=>3, 'value'=>__('Instagram')],
        ['key'=>4, 'value'=>__('Twitter')],
        ['key'=>5, 'value'=>__('phone')],
        ['key'=>6, 'value'=>__('Email')]
    );
    return $data;
}



function CondolencesMethod()
{
    $data = array
    (
        ['key'=>1, 'value'=>__('Condolence recipient')],
        ['key'=>2, 'value'=>__('Condolences website for men')],
        ['key'=>3, 'value'=>__('Condolences website for women')],
        ['key'=>4, 'value'=>__('Location of the mosque')],
        ['key'=>5, 'value'=>__('Cemetery location')],
        ['key'=>6, 'value'=>__('Instagram')]
    );
    return $data;
}