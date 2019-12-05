<?php

namespace NbaNews\Http\Controllers\Admin;


use NbaNews\Http\Controllers\BaseContoller;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;
use NbaNews\Model\Activity;
use NbaNews\Model\Users;

class ActivityController extends BaseContoller
{

    public function index(){
        $this->data['activities'] = Activity::paginate(15);

        return view('admin.pages.activities',$this->data);
    }


    public function sortByDate(Request $request){

            $day = $request->date;

           $date = new \NbaNews\Model\Users();

           try{
                $dat_activities = $date->filterDate($day);
                return $dat_activities;
           } catch (\Exception $e){
               \Log::critical('Error date'.$e->getMessage());
               return $e->getMessage();
           }


    }
}
