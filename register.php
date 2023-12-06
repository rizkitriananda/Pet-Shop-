<?php 
require 'functions.php';

if(isset($_POST['register'])){
    if(register($_POST) > 0 ){
        echo "<script>
                alert('user baru ditambahkan');
            </script>";
    }else {
        echo mysqli_error($koneksi);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="../image/logo.png" type="image/x-icon" />
    <title>Home</title>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            spacing: {
              13: "3.25rem",
            },
            fontFamily: {
              poppins: ["Poppins", "sans-serif"],
            },
          },
        },
      };
    </script>

    <style type="text/tailwindcss"></style>
  </head>
  <body class="font-poppins bg-[#cfcece]">
    <main class="h-screen w-screen flex items-center">
      <form action="" method="post" class="bg-[#ffff] flex flex-col justify-center w-[90%] h-fit py-16 px-12 mx-auto rounded-lg md:w-[500px]">
        <div class="flex gap-6">
            <div class="flex flex-col w-[40%]>
              <label for="nama">Nama</label>
              <input type="text" id="username" class="rounded px-2 border border-[#b1b0b0] h-[35px]" name="nama" />
            </div>

            <div class="flex flex-col w-[40%]">
              <label for="username">Username</label>
              <input type="text" id="username" class="rounded px-2 border border-[#b1b0b0]  h-[35px]" name="username" />
            </div>
        </div>

        <label for="password" class="mt-3">Password</label>
        <input type="password" class="rounded px-2 border border-[#b1b0b0] h-[35px]" name="password" />
        
        <label for="password" class="mt-3">Confirm Password</label>
        <input type="password" class="rounded px-2 border border-[#b1b0b0] h-[35px]" name="password2" />

        <label for="level" class="mt-3">Level</label>
        <input type="text" class="rounded px-2 border border-[#b1b0b0] h-[35px]" name="level" />

        <button type="submit" class="bg-[#830FF3] mt-3 rounded-lg text-white hover:bg-[#aa4fff] h-[35px]" name="register">Submit</button>
        <span class="mt-3">Do you have an account?<a href="index.php" class="text-blue-700"> Sign up</a></span>
      </form>
      </form>
    </main>
    <script></script>
  </body>
</html>
