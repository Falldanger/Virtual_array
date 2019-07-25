<?php
	echo '<b>Virtual array:</b>'.'</br>';

    class Test implements Iterator,ArrayAccess {
        public $index=1;
        public $list = ['Kyiv', 'Zhytomyr', 'Cherkasy', 'Lviv'];

        public function rewind() {
            $this->index = 0; 
        }
        
        public function current() {
            return $this->list[$this->index];
        }
        
        public function key() {
            return $this->index;
        }
        
        public function next() {
            $this->index++;
        }
        
        public function valid() {
           $list = key($this->list);
            return ($list !== null && $list !== false);
        }
        public function offsetExists($index) {
             return isset($this->list[$index]);
         }
         public function offsetGet($index) {
             return $this->list[$index];
         }
        
         public function offsetSet($index,$value) {
             $this->list[$index] = $value;
         }
         public function offsetUnset($index) {
             unset($this->list[$index]);
         }
    }

    $test = new Test();
    foreach ($test->list as $key => $value) echo "$value =>$key; ";
    
    $test->offsetSet(5,'Bucha'); // add a new item
    $test->offsetSet(4,'Irpin');
    $test->offsetUnset(4); // delete a new item #4
    echo '</br>'.$test->offsetGet(2).'</br>'; // Get the item #2
    
    foreach ($test->list as $key => $value) echo "$value =>$key; ";
   
    echo $test->offsetExists(7).'</br>';// Check for the existence of an item
    $test[6]='Odessa';
    foreach ($test->list as $key => $value) echo "$value =>$key; ";

?>