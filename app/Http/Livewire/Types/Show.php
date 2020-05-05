<?php

namespace App\Http\Livewire\Types;

use App\Type;
use Arr;
use Livewire\Component;

class Show extends Component
{
    public $type;

    public $edit = -1;
    public $editValue;



    public function mount(Type $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.types.show');
    }

    public function specToEdit($index, $value)
    {
        $this->edit = $index;
        $this->editValue = $value;
    }

    public function specOpslaan($spec, $value)
    {
        $specificaties = $this->type->specifications;
        $specificaties[$spec] = $value;

        $this->type->specifications = $specificaties;

        dump($specificaties, $this->type);

        $this->type->save();
        $this->reset('edit', 'editValue');

    }
}
