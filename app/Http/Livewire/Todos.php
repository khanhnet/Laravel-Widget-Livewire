<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Todo;
use Livewire\WithPagination;

class Todos extends Component
{
	use WithPagination;
	public $name;
	public $detail;
	public $todo;
	public $search;
	public $perPage=5;
	public $isOpen = 0;
	public $isEditOpen = 0;
	public $readyToLoad = false;
	public $currentPage = 1;

	protected $listeners = [
		'showModal' => 'open',
		'closeModal' => 'close',
		'showEditModal' => 'editOpen',
		'closeEditModal' => 'editClose'
	];
	
	public function increment()
	{
		$this->currentPage=2;
	}
	public function open()
	{
		$this->isOpen = 1;
	}
	public function close()
	{
		$this->name='';
		$this->detail='';
		$this->isOpen = 0;
	}
	public function editOpen($id)
	{
		$this->isEditOpen = 1;
	}
	public function editClose()
	{
		$this->name='';
		$this->detail='';
		$this->isEditOpen = 0;
	}
	public function create()
	{
		$this->validate([
			'name' => 'required',
			'detail' => 'required',
		]);
		Todo::create([
			'name' => $this->name,
			'detail' => $this->detail,
		]);
		$this->emit('closeModal');
	}
	public function edit($id){
		$this->emit('showEditModal');
		$this->todo=Todo::find($id);
		$this->name=$this->todo->name;
		$this->detail=$this->todo->detail;
	}
	public function update()
	{
		$this->validate([
			'name' => 'required',
			'detail' => 'required',
		]);
		$this->todo->update([
			'name' => $this->name,
			'detail' => $this->detail,
		]);
		$this->emit('closeEditModal');
	}
	public function delete($id){
		Todo::find($id)->delete();
	}
	public function render()
	{
		$todos=Todo::paginate($this->perPage);
		$this->currentPage=$todos->currentPage();
		return view('livewire.todos',[
			'todos' => $todos,
		]);
	}
}
