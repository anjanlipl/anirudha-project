<div class="row">
          <div class="col col-md-12">
            <div class="header-divider">Scheme </div>
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
           <div class="col col-md-12">
                <div class="form-group">
            <label for="schemeName">Scheme Name:</label>
            <input type="text" name="schemeName" class="form-control" id="schemeName" required>
          </div>
           </div>
           
          
          <!-- <div class="col col-md-6">
            <div class="form-group">
            <label for="budget">Budget (In Lakhs)
            :</label>
            <input type="text" required name="budget" class="form-control" id="budget">
          </div>
          </div> -->
          <div class="col col-md-12">
            <div class=" col-md-6">
                <div class="form-group">
            <label for="budget">Code
            :</label>
            <input type="text" required name="budget" class="form-control" id="code">
          </div>

            </div>
            
          </div>
          
          <div class="col col-md-6">
              <div class="form-group">
                    <label for="unit_id">Scheme Type:</label>
                    <select class="form-control" id="scheme_tag" name="unit_id" required >
                        @foreach($typevarieties as $type)
                  <option value="{{$type->id}}" >{{$type->name}}</option>
                @endforeach
                    </select>
                    
                </div>
           </div>
           <div class="col col-md-6">
                  <div class="form-group">
                    <label for="budget">State Share:</label>
                <input type="text" required name="revenue_be" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="budget">Central Share:</label>
                <input type="text" required name="revenue_be" class="form-control" >
                </div>
           </div>
          
          
          <!-- <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div> -->
          
         </div>
         <div class="col col-md-6">
           
          
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
            <div class="col col-md-12">
            <div class="form-group">
            <label for="remarks">Remarks:</label>
            
            <textarea rows="3" style="width:100%;" name="remarks"></textarea>
          </div>

          </div>
            
            <!-- <div id="Objectives">
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
            </div> -->

         </div>
       </div>