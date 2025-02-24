<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class MostrarCarrito extends Component
{
    public $carrito = [];
    public $total = 0;

    public function mount()
    {
        // Obtén el carrito de la sesión o un array vacío si no existe.
        $this->carrito = Session::get('carrito', []);
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = 0;
        foreach ($this->carrito as $item) {
            $this->total += $item['precio'] * $item['cantidad'];
        }
    }

    public function incrementarCantidad($id)
    {
        if(isset($this->carrito[$id])){
            $this->carrito[$id]['cantidad']++;
            Session::put('carrito', $this->carrito);
            $this->calcularTotal();
        }
    }

    public function decrementarCantidad($id)
    {
        if(isset($this->carrito[$id]) && $this->carrito[$id]['cantidad'] > 1){
            $this->carrito[$id]['cantidad']--;
            Session::put('carrito', $this->carrito);
            $this->calcularTotal();
        }
    }

    public function vaciarCarrito()
    {
        $this->carrito = [];
        Session::forget('carrito');
        $this->calcularTotal();
    }

    public function render()
    {
        return view('livewire.mostrar-carrito', [
            'carrito' => $this->carrito,
            'total'   => $this->total
        ]);
    }
}
