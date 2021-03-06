<?php 
session_start();
if(isset( $_SESSION['subscription_id']) && !empty( $_SESSION['subscription_id'])) {
   $subscriptionID =  $_SESSION['subscription_id'];
 }else{
    header('Location:https://tailormadetraffic.com/dashboard/test-subscription.php');;
 }

try{
    require 'vendor/autoload.php';

    $client = new \GoCardlessPro\Client([
        'access_token' =>'sandbox_wfsxbTJt7uLZhnXSbrt-zetpIKiN8CM6ntls0dxI',
        'environment' => \GoCardlessPro\Environment::SANDBOX
    ]);
      
      $subscription = $client->subscriptions()->get($subscriptionID);
      
      //echo $subscription->id . "\n";
      $amount = $subscription->amount;
      $amount = $amount / (float) 100.00;
      $amount = sprintf("%.2f", $amount);
      $subscription_number = $subscription->metadata->subscription_number ."\n";
     // echo $subscription->created_at ."\n";


}catch(Exception $subscription_error){
    echo $subscription_error;
}

?>
<!doctype html>
<html>
    <head>
        <title>Invoice Tailor Made Traffic</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css">
        <link href="css/grid.css" rel="stylesheet" type="text/css">
        <link href="https://tailormadetraffic.com/dashboard/sandbox/style.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
       <!-- <script src="js/google.js?nocache=1"></script> -->
    </head>
    <body>
        
        <!-- ===========NAVIGATION CONTAINER============== -->
        <div class="nav-container"> 
            <div class="container">
                <div class="full-width">
                    <div class="one-half first">
                        <h1>Tailor Made Traffic Dashboard</h1>
                    </div>
                    <div class="one-half last">
                        <div class="home-button">
                            <span><a href="https://tailormadetraffic.com/dashboard/my_subscriptions.php"><i class="fa fa-home" aria-hidden="true"></i>Back to Home</a></span>
                        <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div> 
            </div>    
        </div>   
        <!-- ===========NAVIGATION CONTAINER============== -->
        
    <div id="print-area">
        <div class="container">
            <div class="full-width">
               <div class="invoice">
                    <div class="invoice-head">
                        <div class="one-half first items">
                            <div class="logo">
                                <img src="images/tailor_made_traffic.png" alt="tailor_logo">                  
                                </div>
                
                        </div>
                        <div class="one-half last items right">
                            <h1>Tailor Made Traffic Inc</h1>
                            <h1>34 Hendford Hill</h1>
                            <h1>MOYLES COURT BH24 8HU</h1>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="invoice-body">
                        <div class="one-half first">
                            <div class="details">
                                <ul class="invoice-payment-details">
                                    <li>Invoice Number:</li>
                                    <li>Subscription Type:</li>
                                    <li>Subscription Date:</li>
                                    <li>Invoice To:</li>
                                    <li>Invoice Date:</li>
                                </ul>
                            </div>
                            <div class="details">
                                    <ul class="invoice-payment-fields">
                                    <li><?php echo $subscription_number; ?></li>
                                    <li><?php echo $_SESSION['subscription-type']; ?></li>
                                    <li><?php echo $subscription->created_at ?></li>
                                    <li><?php echo $_SESSION['given_name'] ." ". $_SESSION['family_name'];  ?></li>
                                    <li><?php echo date("Y-m-d"); ?></li>
                                    </ul>
                                </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>

                        <div class="one-half first address">
                            <h1>Billing Address</h1>
                            <ul class="billing-address-details">
                                <li><h2><?php echo $_SESSION['given_name'] ." ". $_SESSION['family_name'];  ?></h2></li>
                                <li><h2><?php echo $_SESSION['address_line1']; ?></h2></li>
                                <li><h2><?php echo $_SESSION['city']; ?></h2></li>
                                <li><h2><?php echo $_SESSION['postal_code'] ?></h2></li>
                                <li><h2><?php echo $_SESSION['email']; ?></h2></li>
                                <li><h2><?php echo $_SESSION['contact-num']; ?></h2></li>
                            </ul>
                        </div>
                        <div class="one-half last address">
                                <h1>Company Address</h1>
                                <ul class="billing-address-details">
                                    <li><h2><?php echo  $_SESSION['given_name'] ." ". $_SESSION['family_name']  ?></h2></li>
                                    <li><h2><?php echo$_SESSION['address_line1'] ?></h2></li>
                                    <li><h2><?php echo $_SESSION['city'] ?></h2></li>
                                    <li><h2><?php echo $_SESSION['postal_code'] ?></h2></li>
                                    <li><h2><?php echo $_SESSION['email'] ?></h2></li>
                                    <li><h2><?php echo $_SESSION['contact-num'] ?></h2></li>
                                </ul>
                        </div>
                        <div class="clear"></div>

                        <div class="invoice-subscription">
                            <h1>Subscription Details</h1>
                            <div class="one-third first subscription-thead"><h2>Subscription Type</h2></div>
                            <div class="one-third subscription-thead"><h2>Monthly Fee</h2></div>
                            <div class="one-third last subscription-thead"><h2>Total</h2></div>
                            <div class="clear"></div>

                            <div class="one-third first subscription-items"><h2><?php echo $_SESSION['subscription-type'] ?></h2></div>
                            <div class="one-third subscription-items"><h2><?php echo $amount ?> <i class="fa fa-gbp"></i></h2></div>
                            <div class="one-third last subscription-items"><h2><?php echo $amount ?> <i class="fa fa-gbp"></i></h2></div>
                            <div class="clear"></div>

                            <div class="sub-total">
                                <h1>Sub Total</h1>
                                <h2><?php echo $amount?> <i class="fa fa-gbp"></i></h2>
                            </div>
                            <div class="clear"></div>   
                        </div>
                    </div>
               </div>
            </div>
           
        </div>
    </div>
    <a href="https://tailormadetraffic.com/dashboard/print.php?subscription_id=<?php echo $subscriptionID."&&accid="; ?><?php echo $accid; ?>" target="_blank" id="print" class="btn-print"><i class="fa fa-print"> </i>Print</a>
    <?php session_destroy(); ?>
    </body>
</html>