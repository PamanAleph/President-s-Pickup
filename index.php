<?php

  include 'controller.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>President's Pick-up</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

      html {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }
        @keyframes move-truck {
            0% {
              transform: translateX(-100%);
            }
            50% {
              transform: translateX(0%);
              animation-timing-function: ease-in-out;
            }
            100% {
              transform: translateX(100%);
              animation-timing-function: ease-out;
            }
           }
          .truck-image {
          animation-name: move-truck;
          animation-duration: 5s;
          animation-iteration-count: infinite;
          animation-direction: alternate;
          animation-fill-mode: forwards;
        }
    </style>
  </head>

  <body class="leading-normal tracking-normal text-indigo-400 m-6 bg-cover bg-fixed" style="background-image: url('header.png');">
    <div class="h-full pr-10 pl-10">
      <!--Nav-->
      <div class="w-full container mx-auto">
        <div class="w-full flex items-center justify-between">
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl">
            President's <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500"> Pick-up</span>
          </a>
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-2xl" href="/delivery/pricecheck.php">
            Calculate
          </a>
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-2xl" href="/delivery/loginadmin.php">
            Login <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500"> Admin</span>
          </a>

        </div>
      </div>

      <!--Main-->
      <div class="container pt-18 md:pt-18 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start">
          <h1 class=" animate__animated animate__slideInLeft my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
            Effortlessly Deliver
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              Your Essentials
            </span>
            To Your Dormitory
          </h1>
          <p class=" animate__animated animate__slideInLeft leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
            No Hassle, No Stress.
          </p>

          <form method="post" class="animate__animated animate__zoomIn bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
              <label class="block text-blue-300 py-2 font-bold mb-2" for="emailaddress">
                Track Your Item
              </label>
              <input
                class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                id="emailaddress"
                type="text"
                placeholder="60xxxxx"
                name = "search"
              />
            </div>

            <div class="flex items-center justify-between pt-4">
            <a href="#search">
                <button
                  class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                  type="submit"
                  name="cari">
                  Search
                </button>
              </a>
            </div>
          </form>
        </div>

        <!--Right Col-->
        <div class="w-full xl:w-3/5 p-12 overflow-hidden">
          <img class="mx-auto w-full md:w-4/5 transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6 object-scale-down contrast-50" src="/delivery/img/paket.png">
        </div>

        <?php 

          if (isset($_POST['cari'])) {
            $search = $_POST['search'];
            $search_results = display("SELECT * from orders where orders_id = '$search' LIMIT 1 ");
        }
        if (!empty($search_results)) {

        ?>
        <table class="min-w-full text-sm align-middle whitespace-nowrap" id ="search">
    <!-- Table Header -->
            <thead>
             
              
              <tr class="border-b border-gray-200 bg-gray-200 ">
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Order Id
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Sender Name
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Recipient Name
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Item Name
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Destination
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                Status
                </th>
              </tr>
            </thead>
            <?php
              }
            ?>
            <!-- END Table Header -->

            <!-- Table Body -->
            <tbody>
                      <?php
                          
                        
                        if (!empty($search_results)) {
                          foreach ($search_results as $data):

                            
                            // =========================================================================================

                          $sendername = $data['sender_id'];
                          $senders = mysqli_query($conn,"SELECT sender_name from sender where sender_id = $sendername");
                          $sender = mysqli_fetch_assoc($senders);
                          
                          $recipientname = $data['recipient_id'];
                          $recipients = mysqli_query($conn,"SELECT recipient_name from recipient where recipient_id = $recipientname");
                          $recipient = mysqli_fetch_assoc($recipients);

                          $itemname = $data['item_id'];
                          $items = mysqli_query($conn,"SELECT item_name from item where item_id = $itemname");
                          $item = mysqli_fetch_assoc($items);

                          $couriername = $data['courier_id'];
                          $couriers = mysqli_query($conn,"SELECT courier_name from courier where courier_id = $couriername");
                          $courier = mysqli_fetch_assoc($couriers);
                            // =========================================================================================
                      ?>
                      
              <tr class="border-b border-gray-200 text-gray-200">
                <td class="p-3 text-center">
                <?= $data['orders_id']; ?>

                </td>
                <td class="p-3 text-center">
                  <p class="font-medium">
                  <?=$sender["sender_name"];?>
                  </p>
                </td>
                <td class="p-3 text-center">
                  <p class="font-medium">
                  <?= $recipient['recipient_name']; ?>
                  </p>
                </td>
                <td class="p-3 text-center">
                  <p class="font-medium">
                  <?= $item['item_name']; ?>
                  </p>
                </td>

                <td class="p-3 text-center">
                <?= $destination_type[$data['destination_id']]; ?>
                </td>
                <?php
                      if ($data['orders_status'] == "PROCESS") {
                        $color = "p-3 text-yellow-800 font-bold border bg-yellow-300 border-yellow-300 border-solid";
                      } if ($data['orders_status'] == "LOST") {
                        $color = "p-3 text-red-800 font-bold border bg-red-300 border-red-500 border-solid";
                      } if ($data['orders_status'] == "DELIVERED"){
                        $color = "p-3 text-green-800 font-bold border bg-green-300 border-green-500 border-solid";
                      }
                    ?>
                    <td class="<?php echo $color; ?> text-center">
                      <?php echo $data['orders_status']; ?>
                    </td>
              </tr>
              <?php
                      endforeach;
                    }
                      ?>
            </tbody>
            <!-- END Table Body -->
          </table>

          <!-- steps -->

          <!-- component -->
                <div class=" mx-auto text-white w-full py-10 pt-20">
                  <div class="text-center">
                    <h3 class="text-3xl mb-3 text-white font-bold" data-aos="fade-up"> Visit Our Booth</h3>
                      <!-- <p> Stay fit. All day, every day. </p> -->
                        <marquee  direction="right" scrollamount="20"><img class= "w-16"src="/delivery/img/delivery.png"/></marquee>
                          <div class="flex justify-center my-3">
                            <div class="flex items-center border w-auto rounded-lg px-4 py-2 w-52 mx-2" data-aos="zoom-in-right">
                              <img src="/delivery/img/airport.png" class="w-7 md:w-8">
                              <div class="text-left ml-3">
                                  <p class='text-xs text-gray-200'>From </p>
                                  <p class="text-sm md:text-base"> Soekarno Hatta </p>
                                  <p class="text-sm md:text-base">International Airport </p>
                              </div>
                          </div>
                          <div class="flex items-center border w-auto rounded-lg px-4 py-2 w-44 mx-2" data-aos="zoom-in-left">
                              <img src="/delivery/img/dormitory.png" class="w-7 md:w-8">
                              <div class="text-left ml-3">
                                  <p class='text-xs text-gray-200'>To </p>
                                  <p class="text-sm md:text-base"> President University </p>
                                  <p class="text-sm md:text-base"> Official Dormitory </p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="mt-10 flex flex-col md:flex-row md:justify-center items-center text-sm text-gray-400">
                      <p class="order-2 md:order-1 mt-8 md:mt-0 "> &copy; Muhammad Alief Firmanda 001202200023</p>
                  </div>
              </div>
          </div>
      </div>
      <script>
  AOS.init();
</script>
  </body>
</html>
