<?php

class collection implements countable, IteratorAggregate  
{
	protected $items;

	public function __construct($items = [])
	{
		$this->items = is_array($items) ? $items : $this->getArrayable($items);
	}


	/**
		@return an arry of all the collection()
	*/
	public function all()
	{
		return $this->items;
	}

	/*
		@return first item of collection
	*/
	public function first($default = null)
	{

		return isset($this->items[0]) ? $this->items[0] : $default;
	}

	/*
		@return last item of collection
	*/
	public function last($default = null)
	{
		$reversed = array_reverse($this->items);

		return isset($reversed[0]) ?  $reversed[0] : $default;
	}

	/*
	loop through each iteams and do wse = (what so ever). you want with it. :)
	*/
	public function each(callable $callback)
	{
		foreach ($this->items as $key => $item) {
			$callback($item, $key);
		}

		return $this;
	}

	/*
		filter the items with a callback function
	*/
	public function filter(callable $callback = null)
	{
		if($callback)
		{
			return new static(array_filter($this->items, $callback));
		}

		return new static(array_filter($this->items));
	}


	/*
	 count the items
	*/
	public function count()
	{
		return count($this->items);
	}



	/*
		@return the keys of each items
	*/
	public function keys()
	{
		return new static( array_keys($this->items));
	}




	/*
		map the items with a callback function and do wse = (what so ever). you want with it. :)
	*/
	public function map(callable $callback = null)
	{
		$keys = $this->keys()->all();

		$items = array_map($callback, $this->items, $keys);

		return new static(array_combine($keys, $items));
	}

	/*
		get the item as a json
	*/
	public function toJson()
	{
		return json_encode($this->items);
	}

	/*
		echo items as a string 
	*/
	public function __toString()
	{
		return $this->toJson();
	}

	// just a classique merge to fussion 2 or more arrays
	public function merge($items)
	{
		return new static(array_merge($this->items, $this->getArrayable($items)));
	}

	// allow to do something like foreach on a obj 
	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}

	//this allows to merge two or more collections
	protected function getArrayable($items)
	{
		if($items instanceof Collection){
			return $items->all();
		}
		return $items;
	}
	
}