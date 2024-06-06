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
        <i class="fas fa-users mr-2"></i>
        Employees
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
    integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script defer src="../src/js/alpine.js"></script>
</body>
</html>