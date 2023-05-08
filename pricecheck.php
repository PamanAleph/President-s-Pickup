<?php

    include 'controller.php';
    
    if (!empty($_POST)) {
        $destination = isset($_POST['destination']) ? $_POST['destination'] : '';
        $servicetype = isset($_POST['servicetype']) ? $_POST['servicetype'] : '';
        $weight      = isset($_POST['weight']) ? $_POST['weight'] : '';
        $insurance   = isset($_POST['insurance']) ? $_POST['insurance'] : '';
    
        if ($servicetype == 'PU EZ') {
            $total = 20000 + ( 0.3 * 20000 * $weight);
        } else if ($servicetype == 'PU ECO') {
            $total = 15000 + ( 0.3 * 15000 * $weight);
        } else if ($servicetype == 'PU SUPER') {
            $total = 30000 + ( 0.3 * 30000 * $weight);
        } else if ($servicetype == 'PU Sameday') {
            $total = 35000 + ( 0.3 * 35000 * $weight);
        } else if ($servicetype == 'PU Instant') {
            $total =  40000 + ( 0.3 * 40000 * $weight);
        }
    
        if ($insurance == 'YES') {
            $total = $total + (0.02 * $total);
        }

        $format_total = number_format($total,0,',',',');
    
    }
    
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

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />

  </head>

  <body class="overflow-y-hidden leading-normal tracking-normal text-indigo-400 m-6 bg-cover bg-fixed" style="background-image: url('header.png');">
    <div class="h-full pr-10 pl-10">
      <!--Nav-->
      <div class="w-full container mx-auto">
        <div class="w-full flex items-center justify-between">
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl">
          President's <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500"> Pick-up</span>
          </a>

        </div>
      </div>

      <!-- Main -->
      <div class="container md:pt-16 mx-auto flex justify-center flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
          <h1 class="my-1  md:text-4xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
            Price
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              Check 
            </span>
          </h1>

    <form class="mt-4 bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="post">
        <div class="mb-4">
            <label class="block text-blue-300 py-2 font-bold mb-2" for="destination" name ="destination">
            Destination
            </label>
            <select class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="destination" name="destination">
            <option>SBH</option>
            <option>NBH</option>
            <option>Elvis Tower</option>
            <option>DCataluna</option>
            <option>DJava Residence</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-blue-300 py-2 font-bold mb-2" for="servicetype" name ="servicetype">
            Service Type
            </label>
            <select class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="servicetype" name="servicetype">
            <option>PU EZ</option>
            <option>PU ECO</option>
            <option>PU SUPER</option>
            <option>PU Sameday</option>
            <option>PU Instant</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-blue-300 py-2 font-bold mb-2" for="weight" name= "weight">
            Weight (in kg)
            </label>
            <input class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="weight" type="number" name="weight" min="1" step="1" required />
        </div>
        <div class="mb-4">
        <label class="block text-blue-300 py-2 font-bold mb-2" for="insurance" name = "insurance">
            Insurance ?
        </label>
        <input id="insurance" type="checkbox" name="insurance" value="YES" class="form-checkbox h-5 w-5 text-gray-600">
        </div>
            <div class="flex items-center justify-between pt-4">
                <button class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out" type="submit" name="submit">
                Calculate Cost
                </button>
                <a href="index.php" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
                Back
                </a>
            </div>
        </form>
    </div>
        <?php if (!empty($_POST)): ?>
        <div class="w-full xl:w-3/5 p-12 overflow-hidden">

        <table class="mx-auto w-full md:w-4/5 text-sm align-middle whitespace-nowrap" id ="search">
            <thead>
             
              <tr class="border-b border-gray-200 bg-gray-200 ">
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Destination
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Service Type
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Weight
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Insurance
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Estimation
                </th>
                <th class="p-3 text-gray-700 font-semibold text-sm tracking-wider uppercase text-center">
                  Price
                </th>
              </tr>
            </thead>
            <!-- END Table Header -->

            <!-- Table Body -->
            <tbody>   
              <tr class="border-b border-gray-200 text-gray-200">
                <td class="p-3 font-medium text-center">
                <?php echo $destination ?>
                </td>
                <td class="p-3">
                  <p class="font-medium text-center">
                  <?php echo $servicetype ?>
                  </p>
                </td>
                <td class="p-3">
                  <p class="font-medium text-center">
                  <?php echo $weight ?>
                  </p>
                </td>
                <td class="p-3">

                  <?php 
                  $text = ($insurance == 'YES') ? 'text-green-500 font-bold' : 'text-red-500 font-bold';
                  $insurance = ($insurance == 'YES') ? $insurance : 'NO';  
                  ?>

                  <p class="<?php echo $text;?> text-center">
                  <?php echo $insurance ?>
                  </p>
                </td>
                <td class="p-3">
                  <p class="font-medium text-center">
                    <?php
                        if($servicetype == 'PU EZ'){
                            $estimation = '2-7 Days';
                        } else if ($servicetype == 'PU ECO'){
                            $estimation = '7-17 Days';
                        } else if ($servicetype == 'PU SUPER'){
                            $estimation = '1-3 Days';
                        } else if ($servicetype == 'PU Sameday'){
                            $estimation = '6-8 Hours';
                        } else if ($servicetype == 'PU Instant'){
                            $estimation = '4 hours MAX';
                        }
                    ?>
                  <?php echo "$estimation" ?>
                  </p>
                </td>
                <td class="p-3">
                  <p class="font-medium text-center">
                  <?php echo "Rp $format_total" ?>
                  </p>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
            <!-- END Table Body -->
          </table>
        </div>
      </div>
    </div>
  </body>
</html>