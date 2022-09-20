<?php
    require_once("module/model/koneksi/koneksi.php");

    $request = 0;
    if(isset($_POST['request'])){
    $request = $_POST['request'];
    }

    // Get company list
    if($request == 1)
    {
        $search = "";
        if(isset($_POST['search'])){
        $search = $_POST['search'];
        }

        $query = "select * from m_company where company_name like'%".$search."%'";
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $response[] = array("value"=>$row['company_id'],"label"=>$row['company_name']);
        }

        // encoding array to json format
        echo json_encode($response);
        exit;
    }

    // Get details
    if($request == 2)
    {
        $company_id = 0;
        if(isset($_POST['company_id'])){
        $company_id = $_POST['company_id'];
        }
        $sql = "select * from m_company where company_id=".$company_id;
        $company_arr = array();

        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $company_id = $row['company_id'];
            $company_name = $row['company_name'];
            $company_address = $row['company_address'];

            $company_arr[] = array("company_id" => $company_id, "company_name" => $company_name,"company_address" => $company_address);
        }

        // encoding array to json format
        echo json_encode($users_arr);
        exit;
    }
?>