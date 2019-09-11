@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
      <span class="header-text">Create New Scheme</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

    <div class="form_wrapper">
      @include('common.errors')
      <form action="{{route('scheme.store')}}" method="post">
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="row">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="schemeName">Scheme Name:</label>
            <input type="text" name="schemeName" class="form-control" id="schemeName" required>
          </div>
          <div class="col-md-6">
                  <div class="form-group">
                <label for="unit_id">Select Department:</label>
                <select class="form-control" name="unit_id" required>
                  <option value="0">--select department--</option>
                    
                </select>
                
                </div>
          </div>
          <div class="col-md-6">
                <div class="form-group">
                <label for="unit_id">Select Unit:</label>
                <select class="form-control" name="unit_id" required>
                  <option value="0">--select unit--</option>
                    
                </select>
                
                </div>
          </div>
          <div class="col col-md-6">
            <div class="form-group">
            <label for="budget">Budget (In Lakhs)
            :</label>
            <input type="text" required name="budget" class="form-control" id="budget">
          </div>
          </div>
          <div class="col col-md-6">
            <div class="form-group">
            <label for="budget">Code
            :</label>
            <input type="text" required name="budget" class="form-control" id="code">
          </div>
          </div>
          
          <div class="form-group">
            <label for="remarks">Remarks:</label>
            
            <textarea rows="3" style="width:100%;" name="remarks"></textarea>
          </div>
          <!-- <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div> -->
          
         </div>
         <div class="col col-md-6">
           
           <div class="col-md-6">
                 <div class="form-group">
                <label for="unit_id">Select Sector:</label>
                <select class="form-control" id="sector_select" name="unit_id" required>
                  <option value="0">--select sector--</option>
                  @foreach($sectors as $sector)
                  <option value="{{$sector->id}}" >{{$sector->name}}</option>
                @endforeach
                    
                </select>
                
                </div>
           </div>
           <div class="col-md-6">
                 <div class="form-group">
                    <label for="unit_id">Select Subsector:</label>
                    <select class="form-control" id="subsector_select" name="unit_id" required>
                      <option value="0">--select subsector--</option>
                        
                    </select>
                    
                </div>
           </div>

           <div class="col col-md-6">
            <div class="form-group">
            <label for="start_date">Start Date:</label>
            
            <input type="text" name="start_date" class=" datepicker" required id="start_date" >
          </div>
          </div>
          <div class="col col-md-6" >
            <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="text" name="end_date" class=" datepicker" required id="end_date">
          </div>
          </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="unit_id">Scheme Monitoring Type:</label>
                    <select class="form-control" id="monitoring_type" name="unit_id" required multiple="multiple">
                      
                        @foreach($monitoringTypes as $monitoringType)
                  <option value="{{$monitoringType->id}}" >{{$monitoringType->abbreviation}}</option>
                @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="col col-md-6">
              <div class="form-group">
                    <label for="unit_id">Tags:</label>
                    <select class="form-control" id="scheme_tag" name="unit_id" required multiple="multiple">
                        @foreach($tags as $tag)
                  <option value="{{$tag->id}}" >{{$tag->tag_name}}</option>
                @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="col col-md-12"><div class="header-in-form">Objectives</div></div>
            <div id="Objectives">
              <div id="one-obj">
              <div class="col col-md-8">
                
                <div class="form-group">
            <label for="objective">Objective :</label>
            <textarea rows="5" style="width:100%;" name="objective"  ></textarea>
            
          </div>
              </div>

              <div class="col col-md-2">
                <button class="form-control btn btn-primary addObj" id="addObj"><i class="fa fa-plus"></i></button>
              </div>
            </div>
            </div>

         </div>
       </div>
       <div class="row" style="margin-bottom: 20px;">
          <div class="col col-md-12" style="text-align: center;font-weight: 600;font-size: 1.7rem;border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;margin-bottom:10px;background-color: darkcyan;color:white;">Complete Financials Details</div>
          <div class="col col-md-6" id="left-col-be">
            <div class="header-in-form">Budget Estimate</div>
            <div id="one-be">
              <div class="col col-md-6">
                
                  <div class="form-group">
                  <label for="budget">Revenue
                :</label>
                <input type="text" required name="revenue_be" class="form-control" >
                </div>

                 <div class="form-group">
                  <label for="budget">Loan
                :</label>
                <input type="text" required name="loan_be" class="form-control" >
            </div>


              </div>
              <div class="col col-md-6">
                
                  <div class="form-group">
                    <label for="budget">Capital
                  :</label>
                  <input type="text" required name="capital_be" class="form-control" >
                </div>
                <div class="form-group">
                  <label for="budget">Add more Estimates
                :</label>
                <button class="form-control btn btn-primary addBE" style="width:20%;margin-left:40%;" id="addBE"><i class="fa fa-plus"></i></button>
            </div>
              </div>
           </div>
          </div> <!-- left column form end -->

          <div class="col col-md-6">
              <div class="header-in-form">Revised Estimate</div>
              <div class="col col-md-6">
                
                  <div class="form-group">
                  <label for="budget">Revenue
                :</label>
                <input type="text" required name="revenue_be" class="form-control" >
                </div>

                 <div class="form-group">
                  <label for="budget">Loan
                :</label>
                <input type="text" required name="loan_be" class="form-control" >
            </div>


              </div>
              <div class="col col-md-6">
                
                  <div class="form-group">
                    <label for="budget">Capital
                  :</label>
                  <input type="text" required name="capital_be" class="form-control" >
                </div>


                <div class="form-group">
                  <label for="budget">Add more Estimates
                :</label>
                <button class="form-control btn btn-primary" style="width:20%;margin-left:40%;" id="addRE"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              
          </div> <!-- right column form end -->

          <div class="col col-md-12" style="text-align: center;">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
       </div>
          
          
           
      </form>
    </div>
  </div>
  @else
  <div class="main-content">
    <div class="alert alert-danger">You dont have Permission to create.</div>
  </div>
@endrole
</div>
@endsection
<script type="text/javascript" src="{{asset('js/addschemeform.js')}}" defer></script>