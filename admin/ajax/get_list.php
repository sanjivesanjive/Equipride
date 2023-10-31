<?php

include '../../connection.php';

if(isset($_POST['type']))
{
    if($_POST['type']=='get_list')
    {
        $html='<option>Select sub_category</option>';
        $id = explode('-',$_POST['sub_category']); 
        $qry=mysqli_query($con,"SELECT * FROM `sub_category` where `category_id`='".$id[1]."'")or die(mysqli_error($con));
        if(mysqli_num_rows($qry)==0)
        {
            $html.='<option disabled>sub_category Not Found!</option>';

        }
        while($row=mysqli_fetch_array($qry))
        {
            $html.='<option value="'.$row['sub_category'].'">'.$row['sub_category'].' - '.$row['category_id'].' </option>';
        }
        //print_r($_POST);
        echo $html;
    }
   
}


?>