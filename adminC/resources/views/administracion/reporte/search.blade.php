{!! Form::open(array('url'=>'administracion/reportes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class = "form-grpup">
<select name="categoria" id="categoria" class="form-select" >  
                @foreach($crono as $cat)
                    <option 
                    @if($value=== $cat['name']) 
                    selected="selected"
                    @endif   value="{{$cat['name']}}" >{{$cat['desc']}}</option>
                @endforeach  
        </select>
    <div class="input-group">
    
       
        
        <input type="text"  class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
      
        
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        

{{Form::close()}}