<?php

namespace App\Http\Livewire;
use App\Models\Gerencia;
use Livewire\Component;

class EditGerencia extends Component
{
    public $item; 
    public $open =false;

    protected $rules = [
        'item.nombre' => 'required'
    ];
    public function mount(Gerencia $item){
        $this->item = $item;
    }

    public function save(){

        $this->validate();

        $this->item->save();

        $this->reset(['open']);
        $this->emit('render'); //se puede usar $this->emitTo('show-gerencias','render'); para renderizar solo la lista
        $this->emit('alert', 'Registro Actualizado!!');
    }

    public function render()
    {
        return view('livewire.edit-gerencia');
    }
}
