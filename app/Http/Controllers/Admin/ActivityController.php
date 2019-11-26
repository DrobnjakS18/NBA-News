<?php

namespace NbaNews\Http\Controllers\Admin;

use NbaNews\Http\Controllers\BaseContoller;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;

class ActivityController extends BaseContoller
{

    public function index(){

        $act = new \NbaNews\Model\Users();


        $this->data['activities'] = $act->getAllActivities();

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
