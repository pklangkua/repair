<?php
/**
 * test visibity public private protected
 */
class human
{
   public function say()
  {
      $a=1+1;
  return $a;
  }
  private function body()
  {
   return " My body : my nude ,arm , head, figer";
  }
  protected  function walk()
  {
    return "Walk : walk on the road";
  }
  public function Output()
  {
    echo "Public function : ". $this->say()."<br>";
    echo "Private function : ". $this->body()."<br>";
    echo "Protected function : ". $this->walk()."<br>";
  }
}
 ?>