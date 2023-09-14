<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class Pupil_Controller extends Controller
{
    // add new details for a pupil page
    public function create_new_pupil_page()
    {
        $all_grades=Grade::get();
        
        return view('admins.admin_add_pupil',compact('all_grades'));
    }

    //store pupil details 
    public function create_new_pupil(Request $request)
    {
        $data=$request->all();
        
        dd($data);die();
        
        $rules=[
            'rental_details'=>'required',
            'rentalcat_id'=>'required',
            'location_id'=>'required',
            'total_rooms'=>'required|numeric|min:1',
            'landlord_id'=>'required',
            'rental_address'=>'required'
        ];

        $custommessages=[
            'rental_details.required'=>'Write Merchadise description',
            'rentalcat_id.required'=>'The Category cant be blank.Select a category',
            'location_id.required'=>'The Location cant be blank.Select a Location',
            'total_rooms.required'=>'Kindly write the total rooms for the house',
            'total_rooms.numeric'=>'The total rooms should be a number',
            'total_rooms.min:1'=>'The total rooms should greater than 1',
            'rental_address.required'=>'Enter an address for the House in the Location',
            'landlord_id.required'=>'The Name Of the Landlord cannot be blank.Select the Landlord'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }else{

            // show if a house has wifi amenity
            if(empty($data['wifi'])){
                $wifi='no';
            }else{
                $wifi='yes';
            }

            // show if a house has wifi amenity
            if(empty($data['wifi'])){
                $wifi='no';
            }else{
                $wifi='yes';
            }

            // show if a house has generator amenity
            if(empty($data['generator'])){
                $generator='no';
            }else{
                $generator='yes';
            }

            // show if a house has balcony amenity
            if(empty($data['balcony'])){
                $balcony='no';
            }else{
                $balcony='yes';
            }

            // show if a house has parking amenity
            if(empty($data['parking'])){
                $parking='no';
            }else{
                $parking='yes';
            }

            // show if a house has cctv_cameras amenity
            if(empty($data['cctv_cameras'])){
                $cctv_cameras='no';
            }else{
                $cctv_cameras='yes';
            }

            // show if a house has servant_quarters amenity
            if(empty($data['servant_quarters'])){
                $servant_quarters='no';
            }else{
                $servant_quarters='yes';
            }

            // show if a house is featured
            if(empty($data['is_featured'])){
                $is_featured='no';
            }else{
                $is_featured='yes';
            }

            if($request->hasFile('rental_image')){
                $imagetmp=$request->file('rental_image');
                if($imagetmp->isValid()){
                    $extension=$imagetmp->getClientOriginalExtension();
                    $image_name=$request->get('rental_name').'-'.rand(111,9999).'.'.$extension;

                    $large_image_path='imagesforthewebsite/rentalhouses/rentalimages/large/'.$image_name;
                    $medium_image_path='imagesforthewebsite/rentalhouses/rentalimages/medium/'.$image_name;
                    $small_image_path='imagesforthewebsite/rentalhouses/rentalimages/small/'.$image_name;

                    Image::make($imagetmp)->resize(1040,1200)->save($large_image_path);
                    Image::make($imagetmp)->resize(520,600)->save($medium_image_path);
                    Image::make($imagetmp)->resize(260,300)->save($small_image_path);

                }
            }

            $rental_house=new Rental_house();
            $rental_house->rental_name=$data['rental_name'];
            $rental_house->rental_slug=$data['rental_slug'];
            $rental_house->monthly_rent=$data['monthly_rent'];
            $rental_house->rental_address=$data['rental_address'];
            $rental_house->rental_image=$image_name;
            // $rental_house->rental_video=$video_name;
            $rental_house->rental_details=$data['rental_details'];
            $rental_house->rentalcat_id=$data['rentalcat_id'];
            $rental_house->landlord_id=$data['landlord_id'];
            $rental_house->location_id=$data['location_id'];
            $rental_house->total_rooms=$data['total_rooms'];
            $rental_house->is_featured=$is_featured;
            $rental_house->wifi=$wifi;
            $rental_house->generator=$generator;
            $rental_house->balcony=$balcony;
            $rental_house->parking=$parking;
            $rental_house->cctv_cameras=$cctv_cameras;
            $rental_house->servant_quarters=$servant_quarters;
            $rental_house->rental_status=0;
            $rental_house->total_rooms=$data['total_rooms'];
            $rental_house->save();

            $rental_house->housetags()->attach(request('rentaltags'));

            return redirect()->route('inactiverentalhses')->with('success','The Rental House has been added successfuly.');
        }
    }

    
}
