<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novotel - Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/alpine.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="flex flex-row min-h-screen">
    <div class="h-screen w-1/6 bg-white shadow flex-none">
      <?php require '../layouts/portal/sidebar.php' ?>
    </div>
    <div class="flex flex-col w-5/6 overflow-y-auto">
      <div class="flex flex-row items-center text-2xl text-white bg-[#1e22aa] py-6 pl-4">
        <i class="fas fa-tachometer-alt mr-2"></i>
        Dashboard
      </div>
      <div class="p-6 flex flex-row justify-between *:w-full *:mr-4">
        <div class="rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
          <div class="p-6">
            <h5
              class="mb-2 font-sans font-semibold leading-snug tracking-normal text-orange-900 antialiased px-3 py-2 bg-orange-200 rounded-full text-center">
              PENDING
            </h5>
          </div>
          <?php
            require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
            $sql = "SELECT COUNT(reserve_status) as pendingCount FROM reservations WHERE reserve_status = 'PENDING'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                while ($data = $result->fetch_assoc()):
                    ?>
          <div class="p-6 pt-0 text-3xl">
            <?php echo $data['pendingCount'] ?>
          </div>
          <?php endwhile; endif; ?>
        </div>
        <div class="rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
          <div class="p-6">
            <h5
              class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-green-900 antialiased  px-3 py-2 bg-green-200 rounded-full text-center">
              COFIRMED
            </h5>
          </div>
          <?php
            require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
            $sql = "SELECT COUNT(reserve_status) as confirmedCount FROM reservations WHERE reserve_status = 'CONFIRMED'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                while ($data = $result->fetch_assoc()):
                    ?>
          <div class="p-6 pt-0 text-3xl">
            <?php echo $data['confirmedCount'] ?>
          </div>
          <?php endwhile; endif; ?>
        </div>
        <div class="rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
          <div class="p-6">
            <h5
              class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-red-900 antialiased  px-3 py-2 bg-red-200 rounded-full text-center">
              CANCELLED
            </h5>
          </div>
          <?php
            require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
            $sql = "SELECT COUNT(reserve_status) as cancelledCount FROM reservations WHERE reserve_status = 'CANCELLED'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                while ($data = $result->fetch_assoc()):
                    ?>
          <div class="p-6 pt-0 text-3xl">
            <?php echo $data['cancelledCount'] ?>
          </div>
          <?php endwhile; endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
    integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script defer src="../src/js/alpine.js"></script>
</body>

</html>