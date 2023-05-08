<?php
  include 'controller.php';
  include 'couriercheck.php';

  $data = null;
   if (isset($_GET ['orders_id'])) {
    $data = display("SELECT * FROM orders WHERE orders_id = $_GET[orders_id]")[0];
  }

  if (isset($_POST ['submit'])) {

    //orders
    $orderstatus = $_POST['orderstatus'] ? strtoupper($_POST['orderstatus']) : '';

    $orderid = mysqli_insert_id($conn);

     if (isset($_GET ['orders_id'])) {
      //update
      query("UPDATE orders set orders_status = '$orderstatus'
      WHERE orders_id=$_GET[orders_id]");
    }

    header ("Location: orderdetailcourier.php");  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Courier</title>
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

  <main class="max-h-screen overflow-auto">
    <div class="px-6 py-8 bg-yellow-50">
      <div class="max-w-xl mx-auto bg-white rounded-3xl">
          <div class="w-full py-16 px-12 ">
            <form method="post">
                    <!-- ITEM -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Status</label>
                        <select name = "orderstatus" value="<?=($data != null ? $data['orders_status'] : '')?>" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value ="DELIVERED"<?=($data != null ? $data['orders_status'] == "DELIVERED" ? 'selected':'' : '')?> >DELIVERED</option>  
                        <option value ="PROCESS"<?=($data != null ? $data['orders_status'] == "PROCESS" ? 'selected':'' : '')?> >PROCESS</option>  
                      </select>
                      </div>
                    <a href ="validatecourier.php?orders_id=<?=$data['orders_id'];?>">    
                <button class="w-full bg-purple-500 py-3 text-center text-white" name="submit" type="submit" >Validate</button>
                </a>
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