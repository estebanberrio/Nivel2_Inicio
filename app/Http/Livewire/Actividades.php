<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividade;

class Actividades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $fechaActividad, $area, $idEmpleado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.actividades.view', [
            'actividades' => Actividade::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('fechaActividad', 'LIKE', $keyWord)
						->orWhere('area', 'LIKE', $keyWord)
						->orWhere('idEmpleado', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
		$this->descripcion = null;
		$this->fechaActividad = null;
		$this->area = null;
		$this->idEmpleado = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'fechaActividad' => 'required',
		'area' => 'required',
		'idEmpleado' => ['required', 'numeric'],
        ],
        ['required'=>'Campo Obligatorio'],
        ['numeric'=>'Este Campo solo acepta números']
        );

        Actividade::create([
			'descripcion' => $this-> descripcion,
			'fechaActividad' => $this-> fechaActividad,
			'area' => $this-> area,
			'idEmpleado' => $this-> idEmpleado
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Actividade Successfully created.');
    }

    public function edit($id)
    {
        $record = Actividade::findOrFail($id);

        $this->selected_id = $id;
		$this->descripcion = $record-> descripcion;
		$this->fechaActividad = $record-> fechaActividad;
		$this->area = $record-> area;
		$this->idEmpleado = $record-> idEmpleado;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'fechaActividad' => 'required',
		'area' => 'required',
		'idEmpleado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Actividade::find($this->selected_id);
            $record->update([
			'descripcion' => $this-> descripcion,
			'fechaActividad' => $this-> fechaActividad,
			'area' => $this-> area,
			'idEmpleado' => $this-> idEmpleado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Actividade Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Actividade::where('id', $id);
            $record->delete();
        }
    }
}
