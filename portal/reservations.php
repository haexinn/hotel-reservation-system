<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novotel - Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style type="text/tailwindcss">
    [x-cloak] { display: none !important; }
  </style>
  <link rel="stylesheet" href="../src/fontawesome/css/all.css?<?php echo time(); ?>" />
</head>

<body>
  <div x-data="reservationPortal" class="flex flex-row min-h-screen">
    <div class="h-screen w-1/6 bg-white shadow flex-none">
      <?php require '../layouts/portal/sidebar.php' ?>
    </div>
    <div class="flex flex-col w-5/6 overflow-y-auto">
      <div class="flex flex-row items-center text-xl text-white bg-[#1e22aa] py-6 pl-4">
        <i class="fas fa-calendar-alt mr-2"></i>
        Reservations
      </div>
      <div class="p-6">

        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Customer / Room
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Total Price
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Check In / Out
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Status
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            require $_SERVER['DOCUMENT_ROOT'] . '/requires/conn.php';
            $sql = "SELECT reservations.id as resId, reservations.check_in_date as resCheckIn, reservations.check_out_date as resCheckOut, reservations.adult_count as resAdultCount, reservations.child_count as resChildCount, reservations.room_count as resRoomCount, reservations.total_price as resTotalPrice, reservations.reserve_status as resStatus, rooms.roomname as roomName, rooms.photo as roomPhoto, users.id as userId, users.username as userName FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id INNER JOIN users ON reservations.user_id = users.id ORDER BY reservations.reserve_date DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
              while ($data = $result->fetch_assoc()):
                ?>
                <tr>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 size-16">
                        <img class="w-full h-full rounded object-cover" src="../uploads/<?php echo $data['roomPhoto'] ?>"
                          alt="" />
                      </div>
                      <div class="ml-3">
                        <p class="text-gray-900 whitespace-no-wrap">
                          <?php echo $data['userName'] ?>
                        </p>
                        <p class="text-gray-600 whitespace-no-wrap"><?php echo $data['roomName'] ?></p>
                      </div>
                    </div>
                  </td>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                      <?php echo number_format($data['resTotalPrice'], 2, '.', ',') ?>
                    </p>
                    <p class="text-gray-600 whitespace-no-wrap">PHP</p>
                  </td>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                      <?php echo date_format(new DateTime($data['resCheckIn']), 'M d, Y') ?>
                    </p>
                    <p class="text-gray-600 whitespace-no-wrap">
                      <?php echo date_format(new DateTime($data['resCheckOut']), 'M d, Y') ?>
                    </p>
                  </td>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">.
                    <span
                      class="relative inline-block px-3 py-1 font-semibold <?php if ($data['resStatus'] == 'PENDING'): ?>text-orange-900<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>text-green-900<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>text-red-900<?php elseif ($data['resStatus'] == 'DONE'): ?>text-blue-900<?php endif; ?> leading-tight">
                      <span aria-hidden
                        class="absolute inset-0 <?php if ($data['resStatus'] == 'PENDING'): ?>bg-orange-200<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>bg-green-200<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>bg-red-200<?php elseif ($data['resStatus'] == 'DONE'): ?>bg-blue-200<?php endif; ?> opacity-50 rounded-full"></span>
                      <span class="relative"><?php echo $data['resStatus'] ?></span>
                    </span>
                  </td>
                  <td x-data="{ openContext: false }"
                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                    <button x-ref="contextMenu" @click="openContext = ! openContext"
                      class="inline-block text-gray-500 hover:text-gray-700">
                      <svg class="inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path
                          d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                      </svg>
                    </button>
                    <div x-show="openContext" @click.away="openContext = false" x-anchor.left.start="$refs.contextMenu"
                      class="bg-white rounded shadow-md text-left" x-cloak>
                      <a href="reservations/view-reservation.php?reservationId=<?php echo $data['resId'] ?>"
                        class="block hover:bg-gray-100 px-3 py-2">View Reservation</a>
                      <?php if ($data['resStatus'] == 'PENDING' || $data['resStatus'] == 'CONFIRMED'): ?>
                        <?php if ($data['resStatus'] == 'PENDING'): ?>
                          <form class="hidden" id="confirmForm" method="POST" action="../requires/reservations/setConfirm.php">
                            <input type="hidden" name="resId" value="<?php echo $data['resId'] ?>" />
                          </form>
                          <button type="submit" form="confirmForm" class="block hover:bg-gray-100 px-3 py-2">Confirm
                            Reservation</button>
                        <?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>
                          <form class="hidden" id="pendingForm" method="POST" action="../requires/reservations/setPending.php">
                            <input type="hidden" name="resId" value="<?php echo $data['resId'] ?>" />
                          </form>
                          <button type="submit" form="pendingForm" class="block hover:bg-gray-100 px-3 py-2">Revert
                            Confirmation</button>
                          <form class="hidden" id="doneForm" method="POST" action="../requires/reservations/setDone.php">
                            <input type="hidden" name="resId" value="<?php echo $data['resId'] ?>" />
                          </form>
                          <button type="submit" form="doneForm" class="block hover:bg-gray-100 px-3 py-2">Done
                            Reservation</button>
                        <?php endif; ?>
                        <form class="hidden" id="cancelForm" method="POST" action="../requires/reservations/setCancel.php">
                          <input type="hidden" name="resId" value="<?php echo $data['resId'] ?>" />
                        </form>
                        <button type="submit" form="cancelForm" class="block hover:bg-gray-100 px-3 py-2">Cancel
                          Reservation</button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endwhile; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
  <script defer
    src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js?<?php echo time(); ?>"></script>
  <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>
</body>

</html>