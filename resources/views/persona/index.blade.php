@extends('layouts.app')
@section('content')
<div class="container">
<a href ="{{url('persona/create')}}" class= "btn btn-success"  >Registrar nuevo usuario</a>


    @if(Session::has('mensaje'))
    <div class="alert alert-success  <?php /*alert-dismissible */?>"  role="alert">
    {{Session::get('mensaje')}}

    <?php /*<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button> */ ?>

</div>
@endif

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Nacionalidad</th>
            <th>Acciones</th>            
        </tr>
    </thead>

    <tbody>
        @foreach( $personas as $persona )
            <tr>
                <td>{{$persona->id}}</td>
                <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $persona->Foto }}" width="100" alt="">
                </td>
                <td>{{$persona->Nombre}}</td>
                <td>{{$persona->ApellidoPaterno}}</td>
                <td>{{$persona->ApellidoMaterno}}</td>        
                <td>{{$persona->Nacionalidad}}</td>
                <td>  
                
                <a href ="{{url ('/persona/' . $persona->id . '/edit')}}" class="btn btn-warning">Editar</a> 
           
            |

            <form action="{{ url('/persona/' . $persona->id)}}" class="d-inline" method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
            </form>         
                </td>
        
        @endforeach 
            </tr>
       
    </tbody>

</table>
{!!$personas->links()!!}
</br>
</br>


</div>
@endsection