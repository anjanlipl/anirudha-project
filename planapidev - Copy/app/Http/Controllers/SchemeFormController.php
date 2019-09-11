<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Subsector;
use App\SchemeMonitoringType;
use App\Tag;
use App\TypeVariety;

class SchemeFormController extends Controller
{

	public function __construct()
    {
        //$this->middleware('auth');
        
    }
    public function addscheme()
    {
        $sectors = Sector::all();
        $subsectors = Subsector::all();
        $monitoringTypes = SchemeMonitoringType::all();
        $typevariety = TypeVariety::all();
        $tags = Tag::all();
        return view('scheme.addscheme',array('sectors'=>$sectors,
        	'subsectors'=>$subsectors,
        	'monitoringTypes'=>$monitoringTypes,
        	'tags'=>$tags,
          'typevarieties'=>$typevariety
        ));
    }
    public function addschemeStep2()
    {
        $sectors = Sector::all();
        $subsectors = Subsector::all();
        $monitoringTypes = SchemeMonitoringType::all();
        $tags = Tag::all();
        return view('scheme.addschemepart2',array('sectors'=>$sectors,
        	'subsectors'=>$subsectors,
        	'monitoringTypes'=>$monitoringTypes,
        	'tags'=>$tags
        ));
    }

    public function getsubsectors()
    {
     
        $subsectors = Subsector::all();
        
        $data = "<option value='0'>--select subsector--</option>";
        foreach ($subsectors as $subsector) {
        	if(strpos($subsector->name,'_default') == false){
        		$data .= "<option value='".$subsector->id . "' >".$subsector->name ."</option>";
        	}
        	
        }
        return $data;
    }
    
}
