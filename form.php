<?php
  include 'controller.php';
  include 'admincheck.php';

  $data = null;
   if (isset($_GET ['orders_id'])) {
    $data = display("SELECT * FROM orders WHERE orders_id = $_GET[orders_id]")[0];
  }

  if (isset($_POST ['submit'])) {
    //sender
    $sendername = $_POST['sendername'];
    $senderpnumber = $_POST['senderpnumber'];
    $senderemail = $_POST['senderemail'];
    // $senderpickup = $_POST['senderpickup'];
    //recipient
    $recipientname = $_POST['recipientname'];
    $recipientpnumber = $_POST['recipientpnumber'];
    $recipientemail = $_POST['recipientemail'];
    //item
    $itemname = $_POST['itemname'];
    $itemtype = $_POST['itemtype'];
    $itemweight = $_POST['itemweight'];
    $iteminsurance = $_POST['iteminsurance'];
    //servicesname
    $servicesid = (int) $_POST['servicesid'];
    $destinationid = (int) $_POST['destinationid'];
    //orders
    // $orderstatus = $_POST['orderstatus'] ? strtoupper($_POST['orderstatus']) : '';

    // Sender Data
    $senderid = insert("INSERT into sender (sender_name,sender_pnumber,sender_email,sender_address) 
    values ('$sendername',$senderpnumber,'$senderemail','Warehouse')"
    );

    // Recipient Data
    $recipientid = insert("INSERT into recipient (recipient_name,recipient_pnumber,recipient_email,destination_id) 
    values ('$recipientname',$recipientpnumber,'$recipientemail',$destinationid)"
    );
    
    // Item Data
    $itemid = insert("INSERT into item (item_name,item_type,item_weight,item_insurance) 
    values ('$itemname','$itemtype',$itemweight,'$iteminsurance')");

    // Randomizer Courier Based The Destination
    $courierid = display("SELECT courier_id from courier where destination_id = $destinationid 
    ORDER BY RAND() LIMIT 1") [0]['courier_id'] ;

    // Prices Counter
    $prices = display("SELECT services_price + (0.3 *services_price * item_weight) as total FROM services 
    INNER JOIN item on item_id=$itemid WHERE services_id = $servicesid");

    $total = (int) $prices[0]['total'];

    if ($iteminsurance == "YES") {
      $total = $total + ($total * 0.02); // Calculate 2% of total price
    }

    // insert the data
    query("INSERT INTO orders (sender_id,recipient_id,courier_id,item_id,services_id,destination_id,orders_price,orders_status)
    values ($senderid,$recipientid,$courierid,$itemid,$servicesid,$destinationid,$total,'PROCESS')"
    );

    $orderid = mysqli_insert_id($conn);

     if (isset($_GET ['orders_id'])) {
      //update
      query("UPDATE orders set orders_status = '$orderstatus'
      WHERE orders_id=$_GET[orders_id]");
    }

    header ("Location: orderdetails.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:ital@1&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script>
  tailwind.config = {
    darkMode: "class",
    theme: {
      fontFamily: {
        sans: ["Roboto", "sans-serif"],
        body: ["Roboto", "sans-serif"],
        mono: ["ui-monospace", "monospace"],
      },
    },
    corePlugins: {
      preflight: false,
    },
  };
</script>
</head>
  <body>
  <?php include 'sidebar.php'?>

  <main class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8 bg-yellow-50">
      <div class="max-w-4xl mx-auto bg-white rounded-3xl">
          <div class="w-full lg:w-1/2 py-16 px-12 ">
            <h2 class="text-3xl mb-4">Sender</h2>
            <form method="post">
                    <!-- sender -->

                    <div class="mb-6">
                        <label for="sendername" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input name="sendername"  id="sendername" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input name="senderpnumber" placeholder="628" id="senderphonenumber" type="bigint"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input name="senderemail" id="senderemail" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@google.com" required>
                    </div>

                    <!-- <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick Up</label>
                        <select data-te-select-init name="senderpickup" id="senderpickup">
                            <option>SBH</option>
                        </select>
                    </div> -->

                    <!-- Recipient -->

                    <h2  class="text-3xl mb-4">Recipient</h2>
                    <div class="mb-6">
                        <label for="recipientname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input name="recipientname" id="recipientname" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input name="recipientpnumber" placeholder="628" id="recipientphonenumber" type="bigint"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input name="recipientemail" id="recipientemail" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@google.com" required>
                    </div>

                    <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drop Off</label>
                        <select data-te-select-init name="destinationid" id="destinationid">
                            <option value = "7000001">SBH</option>
                            <option value = "7000002">NBH</option>
                            <option value = "7000003">Elvis</option>
                            <option value = "7000004">DCataluna</option>
                            <option value = "7000005">Djava</option>
                        </select>
                    </div>

                    <!-- ITEM -->
                    <h2  class="text-3xl mb-4">Package Information</h2>

                    <div class="mb-6">
                        <label for="recipientname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Name</label>
                        <input name="itemname" type="text" id="itemname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight</label>
                        <input name="itemweight" id="itemweight" type="int" placeholder="kg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Type</label>
                             <select data-te-select-init name="itemtype">
                                <option>Goods</option>
                                <option>Document</option>
                            </select>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Insurance</label>
                             <select data-te-select-init name="iteminsurance">
                                <option>YES</option>
                                <option>NO</option>
                            </select>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services</label>
                             <select data-te-select-init name="servicesid">
                                <option value="5000001">PU EZ</option>
                                <option value="5000002">PU ECO</option>
                                <option value="5000003">PU SUPER</option>
                                <option value="5000004">PU Sameday</option>
                                <option value="5000005">PU Instant</option>
                            </select>
                    </div>
                    <!-- <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Status</label>
                        <input name="orderstatus" value="<?=($data != null ? $data['orders_status'] : '')?>" id="orderstatus" type="text" placeholder="PROCESS/DELIVERED" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div> -->
                <button class="w-full bg-purple-500 py-3 text-center text-white" name="submit" type="submit" >Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
</main>
    <script type="module" src="/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
  </body>
</html>
</body>
</html>