@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
      <span class="header-text">Scheme Objectives</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

    <div class="form_wrapper">
      @include('common.errors')
      <form action="{{route('scheme.store')}}" method="post">
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         
         <div class="objectiveWrapper">
            <div class="firstObjective">
                <div class="header-divider">Objectives <a href=""><i class="fa fa-plus"></i>Add more</a></div>
                @include('partials.schemeform.part2_output')
            </div>
         </div>
         <div class="row">
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
<script type="text/javascript" src="{{asset('js/addschemeform.js')}}" defer></script>