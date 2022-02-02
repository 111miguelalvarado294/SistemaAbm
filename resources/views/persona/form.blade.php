<h1>{{$modo}} nuevo usuario </h1>
@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
<ul>
      @foreach($errors->all() as $error)
      <li>   {{$error}} </li>
     @endforeach
</ul>
</div>
@endif

<div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" class="form-control"     name="Nombre"            value="{{isset($persona->Nombre)?$persona->Nombre: old('Nombre') }}"  id="Nombre">
</div>

<div class="form-group">
<label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" class="form-control"      name="ApellidoPaterno"  value="{{isset($persona->ApellidoPaterno)?$persona->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">
</div>

<div class="form-group">
<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" class="form-control"      name="ApellidoMaterno"  value="{{isset($persona->ApellidoMaterno)?$persona->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
</div>

<div class="form-group">
<label for="Correo">Nacionalidad</label>
<input type="text" class="form-control"     name="Nacionalidad"      value="{{isset($persona->Nacionalidad)?$persona->Nacionalidad:old('Nacionalidad' )}}" id="Nacionalidad">
</div>

<div class="form-group">
<label for="Foto">Foto</label>
@if(isset($persona->Foto))
 
<img class="img-thumbnail img-fluid"  src="{{ asset('storage') . '/' . $persona->Foto }}" width="100" alt="">
@endif
<input type="file" class="form-control"  name="Foto"  value="" id="Foto">
</br>
</br>
</div>

<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a class="btn btn-primary" href ="{{url('persona/')}}">Regresar</a>