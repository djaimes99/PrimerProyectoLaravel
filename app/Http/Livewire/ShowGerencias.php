<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gerencia;
//use livewire\WithPagination;

class ShowGerencias extends Component
{
    //use WithPagination;
    public $search, $item;
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners =['render' => 'render'];

    public $open_edit=false;

    protected $rules = [
        'item.nombre' => 'required'
    ];

    public function render()
    {
        $datos = Gerencia::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();

        return view('livewire.show-gerencias', compact('datos'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Gerencia $item){
        $this->item =$item;
        $this->open_edit =true;
    }

    public function update(){
        $this->validate();

        $this->item->save();

        $this->reset(['open_edit']);
        //$this->emit('render'); //se puede usar $this->emitTo('show-gerencias','render'); para renderizar solo la lista
        $this->emit('alert', 'Registro Actualizado!!');
    }

    public function delete($id)
    {
        if ($id) {
            //$this->emit('confirm', 'En Realidad Desea Eliminar El registro?');
            $record = Gerencia::where('id', $id);
            $record->delete();
            $this->emit('alert', 'Registro Eliminado!!');
        }
    }
}
