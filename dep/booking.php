<?php
   function book_car($p_loc, $p_date, $r_loc, $r_date){
    
   }
   
if(isset($_GET['book_car'])){
    $pickup_location = $_GET['pickup_location'];
    $pickup_date =  $_GET['pickup'];
    $return_location = $_GET['return_location'];
    $return_date = $_GET['return'];

    //check if pickup and return locations are selected
    if(!empty($pickup_location) && !empty($return_location)){

        //check if selected date is correct
        if(strtotime($pickup_date) && strtotime($return_date)){

            book_car($pickup_location,$pickup_date,$return_location,$return_date);
        
        }else{
            echo  "<script>
                    document.getElementById('message-div').innerHTML = 'Wrong pickup/return date selected';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
        }

    }else{
        echo  "<script>
                    document.getElementById('message-div').innerHTML = 'Wrong pickup/return locations selected';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
    }
    


}
?>
