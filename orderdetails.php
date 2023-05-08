<?php
  include 'controller.php';
  include 'admincheck.php';

  if (isset($_POST ['delete'])) {
    $orders_id = $_POST['orders_id'];

    $check = query("SELECT * FROM orders WHERE orders_id = $orders_id");
    if ($check >0 ){
      echo "Tidak Delete";
   }else{

   query("DELETE FROM orders WHERE orders_id = $orders_id");
   header ("Location: orderdetail.php");
   }
  
  
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:ital@1&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
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
      <div class="max-w-7xl mx-auto bg-white rounded-3xl">
          <!-- component -->
          <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
            
        <form class="flex items-center px-60 pb-2" method ="post">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" autofocus name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by ID">
            </div>
            <button type="submit" name="cari" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="sr-only">Search</span>
            </button>
        </form>

  <!-- Bordered Table -->
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
            <!-- Table Header -->
            <thead>
            <tr class="border-b border-gray-200">
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Order Id
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Sender Name
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Recipient Name
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Courier Name
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Item Name
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Weight
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Service Type
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Destination
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Order Date
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Order Price
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Status
                </th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                Validate
                </th>
            </tr>
            </thead>
            <!-- END Table Header -->

            <!-- Table Body -->
            <tbody>
              <?php
                  if (isset($_POST['cari'])) {
                    $search = $_POST['search'];
                    $search_results = display("SELECT * from orders where orders_id like '$search%'");
                } else {
                    $search_results = display("SELECT * FROM orders");
                }
                
                foreach ($search_results as $data):

                    
                    // =========================================================================================

                  $sendername = $data['sender_id'];
                  $senders = mysqli_query($conn,"SELECT sender_name from sender where sender_id = $sendername");
                  $sender = mysqli_fetch_assoc($senders);
                  
                  $recipientname = $data['recipient_id'];
                  $recipients = mysqli_query($conn,"SELECT recipient_name from recipient where recipient_id = $recipientname");
                  $recipient = mysqli_fetch_assoc($recipients);

                  $itemname = $data['item_id'];
                  $items = mysqli_query($conn,"SELECT item_name,item_weight from item where item_id = $itemname");
                  $item = mysqli_fetch_assoc($items);

                  $couriername = $data['courier_id'];
                  $couriers = mysqli_query($conn,"SELECT courier_name from courier where courier_id = $couriername");
                  $courier = mysqli_fetch_assoc($couriers);
                    // =========================================================================================
              ?>
            <tr class="border-b border-gray-200">
                <td class="p-3 text-center">
                    
                <?= $data['orders_id']; ?>

                </td>
                <td class="p-3 font-medium text-center">
                  <!-- sendername -->
                <?=$sender["sender_name"];?>

                </p>
                </td>
                <td class="p-3 text-gray-500 text-center">
                    <!-- recipientname -->
                <?= $recipient['recipient_name']; ?>

                </td>
                <td class="p-3 text-center">
                  <!-- couriername -->
                <?= $courier['courier_name']; ?>

                </td>
                <td class="p-3 text-center">
                    <!-- itemname -->
                <?= $item['item_name']; ?>

                </td>
                <td class="p-3 text-center">
                    <!-- itemweight -->
                <?= $item['item_weight'] . ' Kg'; ?>

                </td>
                <td class="p-3 text-gray-500 text-center">
                    <!-- services name -->
                <?= $service_type[$data['services_id']]; ?>

                </td>
                <td class="p-3 text-gray-500 text-center">
                    <!-- destination -->
                <?= $destination_type[$data['destination_id']]; ?>

                </td>
                <td class="p-3 text-gray-500 text-center">
                
                <?= $data['orders_date']; ?>

                </td>
                <td class="p-3 text-gray-500 text-center">

                <?= $data['orders_price']; ?>

                </td>
                <td class="p-3 text-gray-500 text-center">

                <?= $data['orders_status']; ?>

                </td>
                <td class="p-3 text-center">
                <a href ="validateadmin.php?orders_id=<?=$data['orders_id'];?>">    
                <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="hi-solid hi-pencil inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                    <span>Validate</span>
                </button>
                </a>
                <form method = "post" action = "deleteorder.php">
                  <input hidden name ="orders_id"value ="<?=$data['orders_id'];?>"/>
                <button name ="delete"type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-red-500 text-white shadow-sm hover:text-gray-300 hover:bg-red-700 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="hi-solid hi-pencil inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                    <span>Delete</span>
                </button>
                </form>
                </td>
            </tr>
            <?php
              endforeach;
              ?>
            </tbody>
            <!-- END Table Body -->
        </table>
  <!-- END Bordered Table -->
</div>
</div>
</div>
</main>    
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
  </body>
</html>
</body>
</html>