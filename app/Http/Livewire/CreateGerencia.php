<?php

namespace App\Http\Livewire;
use App\Models\Gerencia;
use App\Models\User;
use Livewire\Component;

class CreateGerencia extends Component
{
    public $open = false;
     
    public $nombre;

    protected $rules = [
        'nombre' => 'required'
    ];

    public function save(){

        $this->validate();

        Gerencia::create([
            'nombre' => $this->nombre,
            'id_usuario_enc' => 2
        ]);

        $this->reset(['open','nombre']);

        $this->emitTo('show-gerencias', 'render');
        $this->emit('alert', 'Registro Guardado!!');
    }

    public function valor($id){
        $usuario = User::where('id', $this->id);
        return view('livewire.show-gerencias', compact('usuario'));
    }

    public function render()
    {
        return view('livewire.create-gerencia');
    }
}
