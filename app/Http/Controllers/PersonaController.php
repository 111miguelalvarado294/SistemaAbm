<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['personas']=Persona::paginate(2);
        return view ('persona.index',$datos);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('persona.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

$campos=[
'Nombre'=>'required|string|max:100',
'ApellidoPaterno'=>'required|string|max:100',
'ApellidoMaterno'=>'required|string|max:100',
'Nacionalidad'=>'required|string|max:100',
'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

];
$mensaje=[

'required'=>'El : atributo es requerido',
'Foto.required'=>'La foto requerida'

];
$this->validate($request, $campos,$mensaje);



     $datosPersona = request() -> except(  '_token' );
     if($request->hasFile('Foto')){
        $datosPersona['Foto']=$request->file('Foto')->store('uploads','public');
         
     }
     
     Persona::insert($datosPersona);
     //return response()->json($datosPersona);
      return redirect('persona')->with('mensaje' , 'persona agregada con exito' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $persona=Persona::findOrFail($id);

        return view('persona.edit' , compact ('persona'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Nacionalidad'=>'required|string|max:100',
            
            ];
            $mensaje=[
            
            'required'=>'El : atributo es requerido',
            
            ];
            if($request->hasFile('Foto')){
                $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
                $mensaje=['Foto.required'=>'La foto requerida'];

            }

            $this->validate($request, $campos,$mensaje);



        $datosPersona = request() -> except(['_token'  ,'_method']);

        if($request->hasFile('Foto')){
            $persona=Persona::findOrFail($id); 
            Storage::delete('public/' . $persona->Foto);

           $datosPersona['Foto']=$request->file('Foto')->store('uploads','public');
            
        }

        Persona::where('id','=',$id)->update($datosPersona);
        $persona=Persona::findOrFail($id);
       // return view('persona.edit' , compact ('persona'));
       return  redirect('persona')->with('mensaje','Persona modificada ');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $persona=Persona::findOrFail($id);
        if(Storage::delete('public/' . $persona->Foto)){
            Persona::destroy($id);


        }
        return  redirect('persona')->with('mensaje','Persona borrada con exito ');
    }
}
