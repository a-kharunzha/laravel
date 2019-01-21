<?php
namespace App;

use Illuminate\Support\Facades\Storage;

class SocketCounter{

	
	const COUNTER_FILE = 'socket_counter.txt';
	protected $counter = 0;
	protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * singleton via the `new` operator.
     */
    protected function __construct()
    {
		$this->readCounter();
    }

    /**
     * Private clone method to prevent cloning of the instance of the singleton instance.
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the singleton instance.
     */
    private function __wakeup()
    {
	}
	
	protected function readCounter(){
		// return $this->counter = Storage::disk('local')->get(static::COUNTER_FILE);
		if(Storage::exists(static::COUNTER_FILE)){
			$this->counter = Storage::get(static::COUNTER_FILE);
		}
	}
	
	protected function storeCounter(){
		// Storage::disk('local')->put(static::COUNTER_FILE, $this->counter);
		Storage::put(static::COUNTER_FILE, $this->counter);
	}

	public function increment(){
		$this->counter++;
		$this->storeCounter();
		// event(new \App\Events\SocketIncremented(['newValue'=>$this->counter]));
		broadcast(new \App\Events\SocketIncremented(['newValue'=>$this->counter]))->toOthers();
		return $this->counter;
	}

	public function value(){
		return $this->counter;
	}
} 