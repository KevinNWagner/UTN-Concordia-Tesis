{!! Form::open(array('url'=>'administracion/cronograma','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class = "form-grpup">
    <div class="input-group">
        <input type="text"  class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
{{Form::close()}}