<?php
  include 'controller.php';
  include 'admincheck.php';

  $data = null;
  if(isset($_GET['courier_id'])) {
    $data= display("SELECT * FROM courier WHERE courier_id = $_GET[courier_id]")[0];
  }
  if (isset($_POST ['submit'])) {
    //sender
    $couriername = $_POST['couriername'];
    $courierphonenumber = $_POST['courierphonenumber'];
    $courieremail = $_POST['courieremail'];
    $courieraddress = $_POST['courieraddress'];
    $couriertype = $_POST['couriertype'];

    if ($couriertype === 'SBH'){
      $couriertype = 7000001;
    }
    else if ($couriertype === 'NBH'){
      $couriertype = 7000002;
    }
    if ($couriertype === 'Elvis'){
      $couriertype = 7000003;
    }
    if ($couriertype === 'DCataluna'){
      $couriertype = 7000004;
    }
    if ($couriertype === 'Djava'){
      $couriertype = 7000005;
    }

  
    // Edit
    if(isset($_GET['courier_id'])) {
      query("UPDATE courier SET courier_pnumber=$courierphonenumber, 
      courier_email='$courieremail', 
      courier_address='$courieraddress', 
      courier_name = '$couriername'
      WHERE courier_id=$_GET[courier_id]"
    );
      //Delete
     if (isset($_GET ['courier_id']) && isset($_GET['delete'])) {
      query("DELETE FROM courier WHERE courier_id=$_GET[courier_id]");
    }

    } else {
      // New Courier
      query("INSERT into courier (courier_name,courier_pnumber,courier_email,courier_address,destination_id) 
    values ('$couriername',$courierphonenumber,'$courieremail','$courieraddress',$couriertype)"
    );

    }
  
    header ("Location: courierdetail.php");
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Courier</title>
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
            <h2  class="text-3xl mb-4">Courier</h2>
            <form method="post">
                    <!-- courier -->

                    <div class="mb-6">
                        <label for="couriername" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input name="couriername" value="<?=($data != null ? $data['courier_name'] : '')?>" id="couriername" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input name="courierphonenumber" value="<?=($data != null ? $data['courier_pnumber'] : '')?>" placeholder="+628" id="courierphonenumber" type="bigint"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input name="courieremail" value="<?=($data != null ? $data['courier_email'] : '')?>"   id="courieremail" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@google.com" required>
                    </div>

                    <div class="mb-6">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input name="courieraddress" value="<?=($data != null ? $data['courier_address'] : '')?>" id="courieraddress" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="District Shinganshina" required>
                    </div>  
                    <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courier Type</label>
                        <select data-te-select-init name="couriertype" id="couriertype" >
                            <option>SBH</option>
                            <option>NBH</option>
                            <option>Elvis</option>
                            <option>DCataluna</option>
                            <option>Djava</option>
                        </select>
                    </div>                  
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