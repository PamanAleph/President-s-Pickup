<main class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
      <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl p-8 mb-5">
          <div class="grid grid-cols-2 gap-x-20">
            <div>
              <h2 class="text-2xl font-bold mb-4">Status</h2>

              <div class="grid grid-cols-2 gap-4">
                <!-- Courier -->
              <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(courier_id) as total FROM courier";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Total Courier</div>
                  </div>

                  <!-- Drop Off SBH -->

                <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(destination_id) as total FROM orders where destination_id = 7000001";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Drop Off SBH</div>
                  </div>

                <!-- Drop Off NBH -->

                <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(destination_id) as total FROM orders where destination_id = 7000002";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Drop Off NBH</div>
                  </div>

                  <!-- Drop Off Elvis -->

                  <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(destination_id) as total FROM orders where destination_id = 7000003";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Drop Off Elvis</div>
                  </div>

                  <!-- Drop Off Dcataluna -->

                  <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(destination_id) as total FROM orders where destination_id = 7000004";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Drop Off DCataluna</div>
                  </div>

                  <!-- Drop Off Djava -->
                  <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(destination_id) as total FROM orders where destination_id = 7000005";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">Drop Off Djava</div>
                  </div>
              </div>
            </div>
            <div>
              <h2 class="text-2xl font-bold mb-4">Orders Status</h2>

              <div class="space-y-4">
                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">

                <div class="p-4 bg-green-200 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(orders_status) as total FROM orders where orders_status = 'DELIVERED'";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">DELIVERED</div>
                  </div>

                  <div class="p-4 bg-red-200 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(orders_status) as total FROM orders where orders_status = 'LOST'";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">LOST</div>
                  </div>

                  <div class="p-4 bg-yellow-200 rounded-xl text-gray-800">
                  <?php
                      $query = "SELECT COUNT(orders_status) as total FROM orders where orders_status = 'PROCESS'";
                                $result = mysqli_query($conn, $query);
                      $data = mysqli_fetch_assoc($result); 
                  ?>
                  <h4 class="font-bold text-2xl leading-none"><?= $data['total']; ?></h4>
                      <div class="mt-2">PROCESS</div>
                  </div>

              </div>
            </div>
          </div>
        </div>
        <?php

        // Prepare the SQL query
        $sql = "
            SELECT
                destination.destination_name,
                CONCAT(ROUND(AVG(CASE WHEN orders.orders_status = 'DELIVERED' THEN 1 ELSE 0 END) * 100,0), '%') AS success_rate
            FROM
                orders
                INNER JOIN destination ON orders.destination_id = destination.destination_id
            GROUP BY
                destination.destination_name;
        ";

        // Execute the query and store the result in a variable named $result
        $result = mysqli_query($conn, $sql);

        ?>

        <!-- HTML table -->
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
            <!-- Table Header -->
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                        Destination
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                        Success Rate
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
                        <tbody>
                            <?php
                            // Loop through the result set and display each row in an HTML table row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr class="border-b border-gray-200">';
                                echo '<td class="p-3 text-center">';
                                echo $row['destination_name'];
                                echo '</td>';
                                echo '<td class="p-3 font-medium text-center">';
                                echo $row['success_rate'];
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    // Free up the memory used by the result set
                    mysqli_free_result($result);

                    ?>
      </div>
      
    </div>
  </main>