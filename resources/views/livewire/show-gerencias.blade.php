<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!--
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
       
        <x-table>
            <div class="px-6 py-4 flex items-center">
                <x-jet-input class="flex-1 mr-4" placeholder="Escriba aqui lo que quiere Buscar.." type="text"
                    wire:model="search" />
                    @livewire('create-gerencia')
            </div>

            @if ($datos->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">
                                Id

                                {{--sort--}}
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>  
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('nombre')">
                                Gerencia

                                {{--sort--}}
                                @if ($sort == 'nombre')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>  
                                @endif
                               
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id_usuario_enc')">
                                Id Encargado

                                {{--sort--}}
                                @if ($sort == 'id_usuario_enc')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>  
                                @endif
                            </th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($datos as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                            {{ $item->id_usuario_enc }}  
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm font-medium">
                                   {{-- @livewire('edit-gerencia', ['item' => $item], key($item->id))--}}
                                   <a class ="btn btn-green" wire:click="edit({{$item}})">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <a class ="btn btn-red " wire:click="delete({{$item->id}})">
                                    <i class="fas fa-trash fa-fw"></i>
                                </a>
                                
                                </td>
                            </tr>
                        @endforeach


                       
                    </tbody>
                </table>


            @else
                <div class="px-6 py-4">
                    No existe ningún registro coincidente!!
                </div>

            @endif
            <div class="px-6 py-3">
               
            </div>
        </x-table>
-->
    </div>
    <!--<x-jet-dialog-modal wire:model="open_edit">
        <x-slot name='title'>
            Editar la Gerencia {{$item->nombre}}
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Nombre de la Gerencia"/>
                <x-jet-input wire:model="item.nombre" type="text" class="w-full"/>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update"  wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
            
        </x-slot>
    </x-jet-dialog-modal>-->

</div>
