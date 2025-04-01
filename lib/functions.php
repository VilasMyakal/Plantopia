<?php
session_start();
date_default_timezone_get('Asia/kolkata');
function getCurrentUrl()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT']==443)? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    return $protocol.$host.$uri;
}
class plantopia
{
            private $con;

            function __construct()
            {
                $this->con = new mysqli("localhost","root","","plantopia");
            }


            function user_data($full_name,$email_id,$password)
            {
                $curr_date = date("Y-m-d" );
                $curr_time = date("h:i:s A");

                if($stmt = $this->con->prepare("INSERT INTO `user_sign_up_data`(`full_name`, `mobile_no`, `password`, `date`, `time`) VALUES (?,?,?,?,?)"))
                {
                    $stmt->bind_param("sssss",$full_name,$email_id,$password,$curr_date,$curr_time);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

            function logined_users_data()
            {
                if($stmt = $this->con->prepare("SELECT `id`, `full_name`, `mobile_no`, `password`, `date`, `time` FROM `user_sign_up_data`"))
                {
                    $stmt->bind_result($Sr_No,$full_name,$email_id,$password,$curr_date,$curr_time);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['Sr_No']=$Sr_No;
                            $data[$counter]['Full_Name']=$full_name;
                            $data[$counter]['Email_Id']=$email_id;
                            $data[$counter]['Password']=$password;
                            $data[$counter]['Date']=$curr_date;
                            $data[$counter]['Time']=$curr_time;

                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
                }
            }

            function checkMyAdmin($mobile_no,$userpassword)
            {
                if($stmt = $this->con->prepare("SELECT  `Full Name` FROM `admin login` WHERE `Mobile_no`=? and `password`=?"))
                {
                    $stmt->bind_param("ss",$mobile_no,$userpassword);
                    $stmt->bind_result($admin_name);

                    if($stmt->execute())
                    {
                        if($stmt->fetch())
                        {
                            return $admin_name;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
            }

            //Return all categories names only start


            function returnCategories()
            {
                if($stmt = $this->con->prepare(" SELECT `Cat_Name` FROM `category_data`  "))
                {
                    $stmt->bind_result($Cat_Name);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['Cat_Name']=$Cat_Name;

                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
                }
            }



            //Return all categories names only end

            
            //Display all categories detail start
            function DisplayCategories_detail()
            {
                if($stmt = $this->con->prepare(" SELECT `id`, `Cat_Name`, `Cat_discount`, `Cat_image`, `Date`, `Time` FROM `category_data`  "))
                {
                    $stmt->bind_result($Cat_id,$Cat_Name,$Cat_discount,$Cat_image,$Date,$Time);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['Cat_id']        =    $Cat_id;
                            $data[$counter]['Cat_Name']      =    $Cat_Name;
                            $data[$counter]['Cat_discount']  =    $Cat_discount;
                            $data[$counter]['Cat_image']     =    $Cat_image;
                            $data[$counter]['Date']          =    $Date;
                            $data[$counter]['Time']          =    $Time;

                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
                }
            }


        //Display all categories detail end


            //Returns all categories detail start
            function returnCategories_detail()
            {
                if($stmt = $this->con->prepare(" SELECT  `Cat_Name`, `Cat_discount`, `Cat_image` FROM `category_data` "))
                {
                    $stmt->bind_result($Cat_Name,$Cat_discount,$Cat_image);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['Cat_Name']=$Cat_Name;
                            $data[$counter]['Cat_discount']=$Cat_discount;
                            $data[$counter]['Cat_image']=$Cat_image;
                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
                }
            }
            

                //Returns all categories detail end

                //returns all category count start


                function returnCategoriesCount()
            {
                if($stmt = $this->con->prepare(" SELECT  `Cat_Name`, `Cat_discount`, `Cat_image` FROM `category_data` "))
                {
                    $stmt->bind_result($Cat_Name,$Cat_discount,$Cat_image);

                    if($stmt->execute())
                    {
                        $counter = 0;

                        while($stmt->fetch())
                        {
                            $counter++;
                        }

                        return $counter;
                        }
                        
                    }
                }
            


                //returns all category count start















        //all products count display start


            function displayproductscount()
            {
                if($stmt = $this->con->prepare(' SELECT `Pro_Name`, `Pro_Price`, `Pro_Image` FROM `products_data` '))
                {
                    $stmt->bind_result($pro_name,$pro_price,$pro_image);

                    if($stmt->execute())
                    {
                        
                        $counter=0;

                        while($stmt->fetch())
                        {

                            $counter++;
                        }

                        return $counter;
                    }
                }
            }


        //all product count display end


        //all MyCart count display start


        function displayMyCartcount()
        {
            if($stmt = $this->con->prepare("SELECT `P_id` FROM `shopping cart`"))
            {
                $stmt->bind_result($p_id);

                if($stmt->execute())
                {
                    
                    $counter=0;

                    while($stmt->fetch())
                    {

                        $counter++;
                    }

                    return $counter;
                }
            }
        }

        //all MyCart count display end






        //My all Conformed Orders count

        function returnOrdersCount()
        {
            if($stmt = $this->con->prepare("SELECT `User_id` FROM `confirm_ordered_users`"))
            {
                $stmt->bind_result($p_id);

                if($stmt->execute())
                {
                    
                    $counter=0;

                    while($stmt->fetch())
                    {

                        $counter++;
                    }

                    return $counter;
                }
            }
        }

          //My all Conformed Orders count
          

//My all Conformed Orders count

        function pending_count()
        {
                if($stmt = $this->con->prepare("SELECT `Mobile_No` FROM `confirm_ordered_users` where `Status`='pending'"))
                {
                    $stmt->bind_result($p_id);

                    if($stmt->execute())
                    {
                        
                        $counter=0;
    
                        while($stmt->fetch())
                        {
    
                            $counter++;
                        }
    
                        return $counter;
                    }
                }
            
        }

          //My all Conformed Orders count



//My all Conformed Orders count

function dispatched_count()
{
    if($stmt = $this->con->prepare("SELECT `Mobile_No` FROM `confirm_ordered_users` where `Status`= 'Dispatched'"))
    {
        $stmt->bind_result($p_id);

        if($stmt->execute())
        {
            
            $counter=0;

            while($stmt->fetch())
            {

                $counter++;
            }

            return $counter;
        }
    }
}

  //My all Conformed Orders count












        //display My Cart Product




        //display My Cart Product

        function MyCartProducts()
        {
            if($stmt= $this->con->prepare("SELECT `P_id`, `P_Name`, `P_Price`, `P_Image` FROM `shopping cart` "))
            {
                $stmt->bind_result($p_id,$p_name,$p_price,$p_image);

                if($stmt->execute())
                {
                    $data = array();
                    $counter = 0;

                    while($stmt->fetch())
                    {
                        $data[$counter]['p_id'] = $p_id;
                        $data[$counter]['p_name'] = $p_name;
                        $data[$counter]['p_price'] = $p_price;
                        $data[$counter]['p_image'] = $p_image;

                        $counter++;
                    }

                    if(!empty($data))
                    {
                        return $data;
                    }
                    else
                    {
                        return false;
                    }
                    
                }
            }
        }

        function showmycartdetails()
        {
            if($stmt= $this->con->prepare("SELECT `P_Image` , `P_Name`, `Quantity`, `P_Price`  FROM `shopping cart` "))
            {
                $stmt->bind_result($p_image,$p_name,$quantity,$p_price);

                if($stmt->execute())
                {
                    $data = array();
                    $counter = 0;
                    

                    while($stmt->fetch())
                    {
                        $data[$counter]['p_image'] = $p_image;
                        $data[$counter]['p_name'] = $p_name;
                        $data[$counter]['quantity'] = $quantity;
                        $data[$counter]['p_price'] = $p_price;

                        $counter++;
                    }

                    if(!empty($data))
                    {
                        return $data;
                    }
                    
                }
            }
        }

        function insert_confirm_orders($p_image,$p_name, $quantity,$price,$mobile_no)
        {
            if($stmt = $this->con->prepare("INSERT INTO `confirm_orders_list`( `Order_image`, `Order_Name`, `Quantity`, `Price`, `Date`, `Time`, `user_mobile_no`) VALUES (?,?,?,?,?,?,?)"))
            {
                
                $curr_date = date("Y-m-d" );
                $curr_time = date("h:i:s A");

                $stmt->bind_param("sssssss",$p_image,$p_name, $quantity,$price,$curr_date,$curr_time,$mobile_no);

                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
        }

        //all product display start
                


           function displayproducts()
            {
                if($stmt = $this->con->prepare(" SELECT `P_id`, `Pro_Name`, `Pro_Price`, `Pro_Category`, `Pro_Slider`, `Pro_Image`, `Date`, `Time` FROM `products_data` "))
                {
                    $stmt->bind_result($p_id, $pro_name,$pro_price,$pro_category,$pro_slider,$pro_image,$date,$time);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['p_id']=$p_id;
                            $data[$counter]['pro_name']=$pro_name;
                            $data[$counter]['pro_price']=$pro_price;
                            $data[$counter]['pro_category']=$pro_category;
                            $data[$counter]['pro_slider']=$pro_slider;
                            $data[$counter]['pro_image']=$pro_image;
                            $data[$counter]['date']=$date;
                            $data[$counter]['time']=$time;

                            $counter++;
                        }
                        if(!empty($data))
                        {
                            return $data;
                        }
                        else
                        {
                        return false;
                        }
                    }
                }
            }

        //all products display end

//insert into my orders

            function all_orders($full_name,$mobile_no,$address,$city,$zipcode,$total)
            {
                $curr_date = date("Y-m-d" );
                $curr_time = date("h:i:s A");

                if($stmt = $this->con->prepare("INSERT INTO `confirm_ordered_users`(`Full_Name`, `Mobile_No`, `Address`, `City`, `zip_code`, `Total`, `Date`, `Time`) VALUES (?,?,?,?,?,?,?,?)"))
                {
                    $stmt->bind_param("ssssssss",$full_name,$mobile_no,$address,$city,$zipcode,$total,$curr_date,$curr_time);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

//insert into my orders


function carttotal()
{
    if($stmt= $this->con->prepare("SELECT `P_Price` FROM `shopping cart` "))
    {
        $stmt->bind_result($total_amount);

        if($stmt->execute())
        {
            $total = 0;

            while($stmt->fetch())
            {
                $total = $total+$total_amount;
            }

            return $total;
            
        }
    }
}

//display my orders

    

function displayDispatchedOrders()
            {
                if($stmt = $this->con->prepare(" SELECT `Full_Name`, `Mobile_No`, `Address`, `City`, `zip_code`, `Total`, `Date`, `Time`, `Status` FROM `confirm_ordered_users` WHERE `Status` = 'Dispatched'"))
                {
                    $stmt->bind_result($user_full_name,$mobile_no,$address,$city,$zipcode,$total,$date,$time,$status);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['user_full_name']=$user_full_name;
                            $data[$counter]['mobile_no']=$mobile_no;
                            $data[$counter]['address']=$address;
                            $data[$counter]['city']=$city;
                            $data[$counter]['zipcode']=$zipcode;
                            $data[$counter]['total']=$total;
                            $data[$counter]['status']=$status;
                            $data[$counter]['date']=$date;
                            $data[$counter]['time']=$time;

                            $counter++;
                        }
                        if(!empty($data))
                        {
                            return $data;
                        }
                        else
                        {
                        return false;
                        }
                    }
                }
            }

    function displayorders()
            {
                if($stmt = $this->con->prepare("SELECT `Full_Name`, `Mobile_No`, `Address`, `City`, `zip_code`, `Total`, `Date`, `Time`, `Status` FROM `confirm_ordered_users` where `Status`='pending'"))
                {
                    $stmt->bind_result($user_full_name,$mobile_no,$address,$city,$zipcode,$total,$date,$time,$status);

                    if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['user_full_name']=$user_full_name;
                            $data[$counter]['mobile_no']=$mobile_no;
                            $data[$counter]['address']=$address;
                            $data[$counter]['city']=$city;
                            $data[$counter]['zipcode']=$zipcode;
                            $data[$counter]['total']=$total;
                            $data[$counter]['status']=$status;
                            $data[$counter]['date']=$date;
                            $data[$counter]['time']=$time;

                            $counter++;
                        }
                        if(!empty($data))
                        {
                            return $data;
                        }
                        else
                        {
                        return false;
                        }
                    }
                }
            }

// display my orders

//display my user_orders

function display_user_orders($mobile)
{
    if($stmt = $this->con->prepare("SELECT `Order_id`,`Order_image`, `Order_Name`, `Quantity`, `Price`,  `Date`, `Time` FROM `confirm_orders_list` WHERE `user_mobile_no`=?"))
    {
        $stmt->bind_param("s",$mobile);
        $stmt->bind_result($order_id,$order_image,$order_name,$quantity,$price,$date,$time);

        if($stmt->execute())
        {
            $data = array();
            $counter=0;

            while($stmt->fetch())
            {
                $data[$counter]['order_id']=$order_id;
                $data[$counter]['order_image']=$order_image;
                $data[$counter]['order_name']=$order_name;
                $data[$counter]['quantity']=$quantity;
                $data[$counter]['price']=$price;
                $data[$counter]['date']=$date;
                $data[$counter]['time']=$time;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
            return false;
            }
        }
    }
}

function dispatch_order($mobile_no,$order_status)
{
    if($stmt=$this->con->prepare("UPDATE `confirm_ordered_users` SET `Status`=? WHERE `Mobile_No` = ?"))
    {
        $stmt->bind_param("ss",$order_status,$mobile_no);
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
}


// display my user_orders


// ------------------------------------------------------------------shopping cart-----------------------------------------------------------




                function CheckMyCart_idExist($add_to_cart_id)
                {
                    if($stmt = $this->con->prepare("SELECT `P_id` FROM `shopping cart` WHERE `P_id`=?"))
                    {
                        $stmt->bind_param("i",$add_to_cart_id);
                        $stmt->bind_result($exist_id);

                        if($stmt->execute())
                        {
                            $data = array();
                            $counter = 1;

                            if($stmt->fetch())
                            {
                                $data['exist_id'] = $exist_id;
                            }

                            if(!empty($data))
                            {
                                return $counter;//the cart id is exist
                            }
                            else
                            {
                                return $counter-1;//the cart id is not exist
                            }
                        }
                    }
                }

                function returnCart_idDetail($add_to_cart_id)
                {
                    if($stmt = $this->con->prepare("SELECT `Pro_Name`, `Pro_Price`, `Pro_Category`, `Pro_Image` FROM `products_data` WHERE `P_id` =?"))
                    {
                        $stmt->bind_param("i",$add_to_cart_id);
                        $stmt->bind_result($Pro_Name,$Pro_Price,$Pro_Category,$Pro_Image);

                        if($stmt->execute())
                        {
                            $Cart_idDetail = array();

                            if($stmt->fetch())
                            {
                                $Cart_idDetail['Pro_Name']      = $Pro_Name;
                                $Cart_idDetail['Pro_Price']     = $Pro_Price;
                                $Cart_idDetail['Pro_Category']  = $Pro_Category;
                                $Cart_idDetail['Pro_Image']     = $Pro_Image;
                            }

                            if(!empty($Cart_idDetail))
                            {
                                return $Cart_idDetail;
                            }
                            else
                            {
                                return false;
                            }
                        }
                    }
                }







        //insert product into shoping cart

        
        function add_My_Cart($p_name, $p_price, $p_category, $quantity, $p_image, $add_to_cart_id )
        {
            $curr_date = date("Y-m-d" );
            $curr_time = date("h:i:s A");

            if($stmt = $this->con->prepare("INSERT INTO `shopping cart`(`P_Name`, `P_Price`, `P_Category`, `Quantity`, `P_Image`, `P_id`, `Date`, `Time`) VALUES (?,?,?,?,?,?,?,?)"))
            {
                $stmt->bind_param("sssssiss",$p_name, $p_price, $p_category, $quantity,$p_image, $add_to_cart_id, $curr_date, $curr_time);

                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        //insert product into shoping cart

function CountTotalCart()
{
    if($stmt = $this->con->prepare("SELECT `Cart_id` FROM `shopping cart`"))
                    {
                        $stmt->bind_result($Cart_id);

                        if($stmt->execute())
                        {
                            
                            $counter=0;
    
                            while($stmt->fetch())
                            {
                                $counter++;
                            }
    
                            return $counter;
                        }
                    }
}

// ------------------------------------------------------------------shopping cart-----------------------------------------------------------




        //all products are displaying

        function displayallproductswithcategories1($Cat_Name)
        {
            

            if($stmt = $this->con->prepare("SELECT `P_id`,`Pro_Name`, `Pro_Price`, `Pro_Image` FROM `products_data` WHERE `Pro_Category`=? and `Pro_Slider`='1'"))
            {
                
                $stmt->bind_param("s",$Cat_Name);

                $stmt->bind_result($P_id,$pro_name,$pro_price,$pro_image);

                if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['P_id']=$P_id;
                            $data[$counter]['pro_name']=$pro_name;
                            $data[$counter]['pro_price']=$pro_price;
                            $data[$counter]['pro_image']=$pro_image;

                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
            }
            
        }



        //all products are displaying







        //all products are displaying


        function displayallproductswithcategories2($Cat_Name)
        {
            

            if($stmt = $this->con->prepare("SELECT `P_id`,`Pro_Name`, `Pro_Price`, `Pro_Image` FROM `products_data` WHERE `Pro_Category`=? and `Pro_Slider`='2'"))
            {
                
                $stmt->bind_param("s",$Cat_Name);

                $stmt->bind_result($P_id,$pro_name,$pro_price,$pro_image);

                if($stmt->execute())
                    {
                        $data = array();
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $data[$counter]['P_id']    = $P_id;
                            $data[$counter]['pro_name']=$pro_name;
                            $data[$counter]['pro_price']=$pro_price;
                            $data[$counter]['pro_image']=$pro_image;

                            $counter++;
                        }

                        if(!empty($data))
                        {
                            return $data;
                        }
                        else{
                            return false;
                        }
                    }
            }
        }


        //all products are displaying













            // Category input section start

                function category_data($category_name,$category_discount,$image)
                {
                    $curr_date = date("Y-m-d" );
                    $curr_time = date("h:i:s A");

                    if($stmt = $this->con->prepare("INSERT INTO `category_data`(`Cat_Name`, `Cat_discount`, `Cat_image`, `Date`, `Time`) VALUES (?,?,?,?,?)"))
                    {
                        $stmt->bind_param("sisss",$category_name,$category_discount,$image,$curr_date,$curr_time);

                        if($stmt->execute())
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }

            //Category input section end












                //return number of users start

                function return_no_of_users()
                {
                    if($stmt = $this->con->prepare("SELECT `full_name` FROM `user_sign_up_data`"))
                    {
                        $stmt->bind_result($full_name);

                        if($stmt->execute())
                        {
                            $data = array();
                            $counter = 0;

                            while($stmt->fetch())
                            {
                                $data[$counter]['full_name']= $full_name;
                                $counter++;
                            }

                            return $counter;
                        }
                    }
                }

                //return number of users end




function returnusername($mobile_no)
{
    if($stmt = $this->con->prepare("SELECT `full_name` FROM `user_sign_up_data` WHERE `mobile_no` = ?"))
    {
        $stmt->bind_param("s",$mobile_no);
        $stmt->bind_result($username);

        if($stmt->execute())
        {
            if($stmt->fetch())
            {
            return $username;
            }
            else
            {
                return false;
            }
        }
      
    }
}










                //delete user sign up data
                function delete_user_sign_up_data($delete_id)
                {
                    if($stmt= $this->con->prepare("DELETE FROM `user_sign_up_data` WHERE `id`=?"))
                    {
                        $stmt->bind_param("i",$delete_id);
                        if($stmt->execute())
                        {
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                }
                //delete user sign up data



                //delete product data
                function delete_product_data($delete_id)
                {
                    if($stmt= $this->con->prepare("DELETE FROM `products_data` WHERE `P_id`=?"))
                    {
                        $stmt->bind_param("i",$delete_id);
                        if($stmt->execute())
                        {
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                }
                //delete product data


                //delete category data
                function delete_category_data($delete_id,$catname)
                {
                    if($stmt= $this->con->prepare("DELETE FROM `category_data` WHERE `id`=?"))
                    {
                        $stmt->bind_param("i",$delete_id);
                        if($stmt->execute())
                        {
                            return true;
                        }
                        else{
                            return false;
                        }
                    }

                    if($stmt = $this->con->prepare("DELETE FROM `products_data` WHERE `Pro_Category`=?"))
                    {
                        $stmt->bind_param("s",$catname);
                        if($stmt->execute())
                        {
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                }
                //delete category data

                //delete my cart

                function deletecart($cart_id)
                {
                    if($stmt = $this->con->prepare("DELETE FROM `shopping cart` WHERE `P_id`=?"))
                    {
                        $stmt->bind_param("i",$cart_id);

                        if($stmt->execute())
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }

    //delete all carts
            function deleteallcart($cart_id)
            {
                if($stmt = $this->con->prepare("DELETE FROM `shopping cart` WHERE `Cart_id`!=?"))
                {
                    $stmt->bind_param("i",$cart_id);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }













            // product input section start

            function add_new_product($p_name, $p_price, $p_category,  $p_slider, $Folder )
            {
                $curr_date = date("Y-m-d" );
                $curr_time = date("h:i:s A");

                if($stmt = $this->con->prepare("INSERT INTO `products_data`(`Pro_Name`, `Pro_Price`, `Pro_Category`, `Pro_Slider`, `Pro_Image`, `Date`, `Time`) VALUES (?,?,?,?,?,?,?)"))
                {
                    $stmt->bind_param("sisssss",$p_name, $p_price, $p_category,  $p_slider, $Folder,$curr_date,$curr_time);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

            //product input section end

            function clearMycart()
            {
                if($stmt = $this->con->prepare("DELETE FROM `shopping cart`"))
                {
                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

            //Count My Cart


            //product edit section

            function edit_product($p_name, $p_price, $p_category,  $p_slider, $p_folder, $edit_id )
            {
                $curr_date = date("Y-m-d" );
                $curr_time = date("h:i:s A");

                if($stmt = $this->con->prepare("UPDATE `products_data` SET `Pro_Name`=?,`Pro_Price`= ?,`Pro_Category`= ?,`Pro_Slider`= ?,`Pro_Image`=?,`Date`=?,`Time`= ? WHERE `P_id` = ?"))
                {
                    $stmt->bind_param("sisssssi",$p_name, $p_price, $p_category,  $p_slider, $p_folder, $curr_date, $curr_time, $edit_id);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

            //View Previous Data

            function display_previous_data($edit_id)
            {
                    if($stmt = $this->con->prepare(" SELECT `Pro_Name`, `Pro_Price`, `Pro_Category`, `Pro_Slider`, `Pro_Image`  FROM `products_data` where `P_id` = ? "))
                    {
                        $stmt->bind_param("i",$edit_id);
                        $stmt->bind_result($pro_name,$pro_price,$pro_category,$pro_slider,$pro_image);
    
                        if($stmt->execute())
                        {
                            $data = array();
    
                            if($stmt->fetch())
                            {
    
                                
                                $data['pro_name']=$pro_name;
                                $data['pro_price']=$pro_price;
                                $data['pro_category']=$pro_category;
                                $data['pro_slider']=$pro_slider;
                                $data['pro_image']=$pro_image;
                                
                                
                            }
                            if(!empty($data))
                            {
                                return $data;
                            }
                            else
                            {
                            return false;
                            }
                        }
                    }
                
            }

            function display_previous_category_data($edit_id)
            {
                if($stmt = $this->con->prepare(" SELECT `Cat_Name`, `Cat_discount`, `Cat_image` FROM `category_data` WHERE `id`=? "))
                    {
                        $stmt->bind_param("i",$edit_id);
                        $stmt->bind_result($cat_name,$Cat_discount,$cat_image);
    
                        if($stmt->execute())
                        {
                            $data = array();
    
                            if($stmt->fetch())
                            {
    
                                
                                $data['cat_name']=$cat_name;
                                $data['Cat_discount']=$Cat_discount;
                                $data['cat_image']=$cat_image;
                                
                                
                            }
                            if(!empty($data))
                            {
                                return $data;
                            }
                            else
                            {
                            return false;
                            }
                        }
                    }
            }

            function checkMobileNumber($mobile_no)
            {
                if($stmt = $this->con->prepare("SELECT  `password` FROM `user_sign_up_data` WHERE `mobile_no`=?"))
                {
                    $stmt->bind_param("s",$mobile_no);
                    $stmt->bind_result($password);

                    if($stmt->execute())
                    {
                        if($stmt->fetch())
                        {
                            return $password;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
            }



            function send_notification($topic , $description)
            {
                $date = date("Y-m-d" );
                $time = date("h:i:s A");
                
                if($stmt = $this->con->prepare("INSERT INTO `notifications`(`topic`, `description`, `date`, `time`) VALUES (?,?,?,?)"))
                {
                    $stmt->bind_param("ssss",$topic,$description,$date,$time);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }

            function view_notification()
            {
                if($stmt = $this->con->prepare("SELECT `topic`, `description`, `date`, `time` FROM `notifications` "))
                {
                    $stmt->bind_result($topic,$description,$date,$time);

                    if($stmt->execute())
                    {
                        $notifications = array();
                        $counter = 0;

                        while($stmt->fetch())
                        {
                            $notifications[$counter]['topic']       = $topic;
                            $notifications[$counter]['description'] = $description;
                            $notifications[$counter]['date']        = $date;
                            $notifications[$counter]['time']        = $time;

                            $counter++;
                        }

                        if(!empty($notifications))
                        {
                            return $notifications;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
            }


            function count_notifications()
            {
                if($stmt = $this->con->prepare("SELECT `topic` FROM `notifications` "))
                {
                    $stmt->bind_result($topic);

                    
                    if($stmt->execute())
                    {
                        
                        $counter=0;

                        while($stmt->fetch())
                        {
                            $counter++;
                        }

                        return $counter;
                    }
                }
            }


        function edit_category_data($category_name,$category_discount,$c_folder,$edit_id)
        {
            $curr_date = date("Y-m-d" );
            $curr_time = date("h:i:s A");

            if($stmt = $this->con->prepare("UPDATE `category_data` SET `Cat_Name`= ?,`Cat_discount`=?,`Cat_image`=?,`Date`=?,`Time`=? WHERE `id`=?"))
            {
                    $stmt->bind_param("sisssi",$category_name, $category_discount, $c_folder, $curr_date, $curr_time, $edit_id);

                    if($stmt->execute())
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                
            }
        }


        function return_notifications()
        {
            if($stmt = $this->con->prepare("SELECT `id`, `topic`, `description`, `date`, `time` FROM `notifications`"))
            {
                $stmt->bind_result($noti_id, $noti_topic, $noti_description, $noti_date, $noti_time);

                if($stmt->execute())
                {
                    $data = array();
                    $counter = 0;

                    while($stmt->fetch())
                    {
                        $data[$counter]['noti_id']          = $noti_id;
                        $data[$counter]['noti_topic']       = $noti_topic;
                        $data[$counter]['noti_description'] = $noti_description;
                        $data[$counter]['noti_date']        = $noti_date;
                        $data[$counter]['noti_time']        = $noti_time;

                        $counter++;

                    }

                    if(!empty($data))
                    {
                        return $data;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
        }

        function delete_notification($delete_id)
        {
            if($stmt = $this->con->prepare("DELETE FROM `notifications` WHERE `id` = ?"))
            {
                $stmt->bind_param("i",$delete_id);
                
                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
        }

       function return_searched_products($search)
       {
            if($stmt= $this->con->prepare("SELECT `P_id`, `Pro_Name`, `Pro_Price`, `Pro_Image` FROM `products_data` where `P_id` like '%$search%' or `Pro_Name` like '%$search%' or `Pro_Category` like '%$search%'"))
            {
                $stmt->bind_result($p_id,$p_name,$p_price,$p_image);

                if($stmt->execute())
                {
                    $data = array();
                    $counter = 0;

                    while($stmt->fetch())
                    {
                        $data[$counter]['P_id']         = $p_id;
                        $data[$counter]['Pro_Name']     = $p_name;
                        $data[$counter]['Pro_Price']    = $p_price;
                        $data[$counter]['Pro_Image']    = $p_image;

                        $counter++;
                    }

                    if(!empty($data))
                    {
                        return $data;
                    }
                    else
                    {
                        return false;
                    }
                    
                }
            }
       }

}//class end


?>