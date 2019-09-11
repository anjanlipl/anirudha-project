<link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar.css') }}">

<div class="side-menu-wrapper">
	<div class="side-menu-title">
		<div class="menu-text">Menu</div>
	</div>
	<div class="side-menu-contents">
		<div class="side-content-wrap">
			<button type="button" class="side-list-header side-menu-home-link"><span class="menu-icon"><i class="  fa fa-university" aria-hidden="true"></i></span><a  href="{{route('dashboard')}}">Dashboard</a> </button>
			

			<button type="button" class="side-list-header" data-toggle="collapse" data-target="#schemeslist"><span class="menu-icon"><i class="fa fa-folder-o" aria-hidden="true"></i></span>Manage Schemes <span class="glyphicon glyphicon-chevron-down " style="float:right;margin-right: 5%;"></span></button>
			  <div id="schemeslist" class="collapse out">
			     <ul>
			     	<li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{route('addScheme')}}" >Add Scheme</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{route('addschemeStep2')}}" >Complete part2 details</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{route('scheme.index')}}" >All Schemes</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{route('outputindicator.index')}}" >Output Indicators</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{route('outcomeindicator.index')}}" >Outcome Indicators</a>
				     </li>
				     
				     
				    
			     </ul>
  				</div>	

			  <button type="button" class="side-list-header" data-toggle="collapse" data-target="#masterlist"><span class="menu-icon"><i class="fa fa-cog" aria-hidden="true"></i></span>Master Data <span class="glyphicon glyphicon-chevron-down " style="float:right;margin-right: 5%;"></span></button>
			  <div id="masterlist" class="collapse out">
			     <ul>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('sector.index')}}" >Sectors</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('subsector.index')}}" >Subsectors</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('department.index')}}" > Departments</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('unit.index')}}" >Units</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('tag.index')}}" >Tags</a>
				     </li>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('monitoringtype.index')}}" >Scheme Monitoring Types</a>
				     </li>
				    
			     </ul>
  				</div>	

  				  <button type="button" class="side-list-header" data-toggle="collapse" data-target="#reportsList"><span class="menu-icon glyphicon glyphicon-list-alt" ></span>Reports <span class="glyphicon glyphicon-chevron-down " style="float:right;margin-right: 5%;"></span></button>
			  <div id="reportsList" class="collapse out">
			     <ul>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('outputreport')}}" >Output report</a>
				     </li>
				    
				    
			     </ul>
  				</div>	

  				<button type="button" class="side-list-header" data-toggle="collapse" data-target="#assignlist"><span class="menu-icon glyphicon glyphicon-list-alt" ></span>Assign Programs to users <span class="glyphicon glyphicon-chevron-down " style="float:right;margin-right: 5%;"></span></button>
			  <div id="assignlist" class="collapse out">
			     <ul>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('outputreport')}}" >Output Assign Programs</a>
				     </li>
				    <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('outputreport')}}" >Output Assign Departments</a>
				     </li>
				    
			     </ul>
  				</div>

  				<button type="button" class="side-list-header" data-toggle="collapse" data-target="#usersList"><span class="menu-icon"><i class="  fa fa-user" aria-hidden="true"></i></span>Users <span class="glyphicon glyphicon-chevron-down " style="float:right;margin-right: 5%;"></span></button>
			  <div id="usersList" class="collapse out">
			     <ul>
				     <li class="side-list-item-collapsed">
				     	<a class="side-list-item-link " href="{{ route('user.index')}}" >All Users</a>
				     </li>
				    
				    
			     </ul>
  				</div>


  			 
  				
		</div> <!-- side content wrap end -->
	
			
		
	</div>
</div>


