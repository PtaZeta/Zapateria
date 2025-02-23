<?php

namespace App\Livewire;

use App\Models\Carrito;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\LineaCarrito;

class CarritoMenu extends Component
{
    public $cantidadTotal = 0;

    protected $listeners = ['carritoActualizado' => 'actualizarCarrito'];

    public function mount()
    {
        $this->actualizarCarrito();
    }

    public function actualizarCarrito()
    {
        if (Auth::check()) {
            $this->cantidadTotal = Carrito::where('user_id', Auth::id())->sum('cantidad');
        } else {
            $this->cantidadTotal = 0;
        }
    }

    public function render()
    {
        return view('livewire.carrito-menu', [
            'cantidadTotal' => $this->cantidadTotal,
        ]);
    }
}
