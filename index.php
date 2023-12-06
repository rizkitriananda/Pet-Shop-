<?php 
session_start();
  if(isset($_SESSION['user'])){
    header('location:../user-page/index.php');
    exit;
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
            background: {
              satu: ["linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%)"],
            },
          },
        },
      };
    </script>

    <style type="text/tailwindcss"></style>
  </head>
  <body class="font-poppins bg-[#cfcece]">
    <main class="h-screen w-screen flex items-center">
      <img src="./image/pet.webp" alt="" class="absolute top-[90px] md:top-0 left-[70px] md:left-[550px] w-[70%] md:w-[300px] drop-shadow-lg" />
      <form action="cek_login.php" method="post" class="bg-[#ffff] flex flex-col justify-center w-[90%] h-fit px-12 py-16 mx-auto rounded md:w-[500px]">
        <h2 class="text-2xl text-center font-semibold mb-5">Log in</h2>
        <label for="username">Username</label>
        <input type="text" id="username" class="rounded px-2 h-[35px] border border-[#b1b0b0]" name="username" />

        <label for="password" class="mt-5">Password</label>
        <input type="password" class="rounded px-2 border h-[35px] border-[#b1b0b0]" name="password" />

        <button type="submit" class="bg-[#830FF3] mt-4 h-[35px] rounded-lg text-white hover:bg-[#aa4fff]" name="login" onclick="this.disabled=true;this.form.submit();">Masuk</button>
        <span class="mt-3">Don’t you have an account?<a href="register.php" class="text-blue-700"> Sign up</a></span>
      </form>
    </main>
    <script></script>
  </body>
</html>
