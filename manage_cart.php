<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_to_cart']))
    {

        if(isset($_SESSION['cart']))
        {
            $myitem=array_column($_SESSION['cart'],'name');
            if(in_array($_POST['name'],$myitem))
            {
                echo "<script>
                alert('Item already added');
                window.location.href='index.php';
                </script>";
            }
            else{
            $count=count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('name'=>$_POST['name'],'price'=>$_POST['price'],'description'=>$_POST['description'],'Quantity'=>1);    
            echo "<script>
            alert('Item added');
            window.location.href='index.php';
            </script>";
            }
        }
        else
        {
            $_SESSION['cart'][0]=array('name'=>$_POST['name'],'price'=>$_POST['price'],'description'=>$_POST['description'],'Quantity'=>1);    
            echo "<script>
                alert('Item added');
                window.location.href='index.php';
                </script>";
        }
    }

    if(isset($_POST['Remove']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['name'] == $_POST['name'])
            {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>
            alert('Item removed');
            window.location.href='mycart.php';
            </script>";
            }
            }
        }
    }



?>