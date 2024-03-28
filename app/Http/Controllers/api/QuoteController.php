<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Teaching;
use App\Models\Procedure;
use App\Models\HistoricalGrave;
use App\Models\Contact;

class QuoteController extends Controller
{
    public function quotes()
    {
        try {
            $quotes = Quote::get();
            $data = [];
            foreach ($quotes as $quote) {
                $data[] = array(
                    'title' => $quote->title,
                    'sub_title' => $quote->sub_title,
                    'text' => $quote->text
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

    public function teachings()
    {
        try {
            $teachings = Teaching::get();
            $data = [];
            foreach ($teachings as $teaching) {
                $data[] = array(
                    'title' => $teaching->title,
                    'sub_title' => $teaching->sub_title,
                    'text' => $teaching->text
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

    public function procedures()
    {
        try {
            $procedures = Procedure::get();
            $data = [];
            foreach ($procedures as $procedure) {
                $data[] = array(
                    'title' => $procedure->title,
                    'sub_title' => $procedure->sub_title,
                    'text' => $procedure->text
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

    public function historical_graves_all()
    {
        try {
            $historical_graves = HistoricalGrave::get();
            $data = [];
            foreach ($historical_graves as $historical_grave) {
                $data[] = array(
                    'title' => $historical_grave->title,
                    'sub_title' => $historical_grave->sub_title,
                    'text' => $historical_grave->text
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }


    public function historical_graves_details($id)
    {
        try {
            $data = HistoricalGrave::where('id', $id)->select('id', 'title', 'name', 'text', 'latitude', 'Longitude')->get();
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }


    public function historical_graves_search($name)
    {
        try {
            $data = HistoricalGrave::where('name->ar', 'LIKE', '%'.$name.'%')->orWhere('name->en', 'LIKE', '%'.$name.'%')->select('id', 'title', 'name', 'text', 'latitude', 'Longitude')->get();
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

    public function contacts()
    {
        try {
            $contacts = Contact::get();
            $data = [];
            foreach ($contacts as $contact) {
                $data[] = array(
                    'name' => $contact->name,
                    'url' => $contact->url,
                    'icon' => $contact->icon
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

}
