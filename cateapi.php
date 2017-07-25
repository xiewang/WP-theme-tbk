
<?php 

    // $c = new TopClient;
    // $c->appkey = "24545248";
    // $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";

    //100000list
    if (!$main ) {
        $page_no = 1;
        $req = new TbkDgItemCouponGetRequest;
        if(wp_is_mobile()){
            $req->setPlatform("2");
        } else {
            $req->setPlatform("1");
        }
        $req->setAdzoneId("119412095");
        $req->setPageSize("6");
        $req->setCat("16,18");
        // $req->setQ("女装");
        $req->setPageNo($page_no);
        $resp = $c->execute($req);

        $temp = json_decode(json_encode($resp),TRUE);
        $tbk_item = $temp['results']['tbk_coupon'];
        $mainList = array2object($tbk_item);
    }
    
    $main = true;
    

?>

