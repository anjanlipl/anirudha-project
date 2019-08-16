@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
      <span class="header-text">Create New Scheme</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

    <div class="form_wrapper" >
      @include('common.errors')
      <form action="{{route('addschemeStep2')}}" method="get">
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         @include('partials.schemeform.part1_scheme')
       
          @include('partials.schemeform.part1_financials')
              
          </div> 
          <div class="col col-md-12" style="text-align: center;">
            <button class="btn btn-primary" type="submit">save</button>
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
<style type="text/css">
table{
  width:100%;
  margin-bottom: 20px;
}
  table tr td,table tr th{
    border:1px solid #ddd;
    text-align: center;
  }
</style>
<script type="text/javascript" src="{{asset('js/addschemeform.js')}}" defer></script>