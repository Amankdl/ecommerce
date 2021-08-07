<?php
session_start();
class Add_to_cart{
  function add_product_to_cart($pid, $qty){
    $_SESSION['cart'][$pid]['qty'] = $qty;
  }  

  function update_product_in_cart($pid, $qty){
      if(isset($_SESSION['cart'][$pid])){
          $_SESSION['cart'][$pid]['qty'] = $qty;
        }
  }  

  function remove_product_from_cart($pid){
    if(isset($_SESSION['cart'][$pid])){
        unset($_SESSION['cart'][$pid]);
    }
  }  

  function empty_cart(){
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
  }  

  function total_prod_in_cart(){
    if(isset($_SESSION['cart'])){
        return count($_SESSION['cart']);
    }else{
        return 0;
    }
  } 
}

?>