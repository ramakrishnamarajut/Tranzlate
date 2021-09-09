<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;

class Clients extends Component
{
	public $clients, $name, $secretkey, $client_id;
    public $isOpen = 0;


    public function render()
    {
    	$this->clients = Client::all();
        return view('livewire.clients');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->secretkey = '';
        $this->client_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'secretkey' => 'required',
        ]);
   
        Client::updateOrCreate(['id' => $this->client_id], [
            'name' => $this->name,
            'secretkey' => $this->secretkey
        ]);
  
        session()->flash('message', 
            $this->client_id ? 'Client Updated Successfully.' : 'Client Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $this->client_id = $id;
        $this->name = $client->title;
        $this->secretkey = $client->body;
    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Client::find($id)->delete();
        session()->flash('message', 'Client Deleted Successfully.');
    }
}
