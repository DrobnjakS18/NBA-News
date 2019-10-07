<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseContoller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Activities extends BaseContoller
{

    public function index(){

        $act = new \App\Model\Users();


        $this->data['activities'] = $act->getAllActivities();

        return view('admin.pages.activities',$this->data);
    }


    public function sortByDate(Request $request){

            $day = $request->date;

           $date = new \App\Model\Users();

           try{
                $dat_activities = $date->filterDate($day);
                return $dat_activities;
           } catch (\Exception $e){
               \Log::critical('Error date'.$e->getMessage());
               return $e->getMessage();
           }


    }
}
