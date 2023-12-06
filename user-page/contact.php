<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

  require "../functions.php";
  
  // cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST['submit'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if(pesan($_POST) > 0 ){
        echo "<script>
                alert('Pesan Berhasil dikirim');
                document.location.href = 'index.php'
            </script>";
    }else {
            echo "<script>
                alert('Pesan TIDAK terkirim!');
            </script>";
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
    <title>Contact</title>
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
  <body class="font-poppins bg-[#FFFEFE]">
    <header>
      <nav class="flex justify-between bg-[#FFFEFE] fixed top-0 left-0 right-0 z-[100] border-b py-1 border-[#dadadd]">
        <div class="logo w-[150px] ml-3 py-1 md:ml-20 flex justify-between">
          <img src="../image/logo.png" alt="" class="w-[50px]" />
          <span class="flex items-center font-bold md:text-xl text-lg mr-3 md:mr-1">Pet Shop</span>
        </div>

        <div class="menu-bars flex items-center mr-5 md:hidden">
          <div class="relative">
            <input type="checkbox" class="absolute w-full h-full opacity-0 cursor-pointer z-10 peer" />
            <i class="fa-solid fa-bars fa-xl cursor-pointer transition-all duration-200 peer-checked:rotate-180" style="color: #000000"></i>
          </div>
        </div>

        <ul
          class="absolute right-0 top-[58px] h-[500px] hidden flex-col gap-2 px-7 border-b border-l bg-[#FFFEFE] translate-x-[125px] md:border-0 md:translate-x-0 md:flex md:flex-row md:top-0 md:h-full md:items-center md:mr-20 md:gap-5"
        >
          <li class="mt-8 md:mt-0 hover:text-[#830FF3] font-semibold md:font-normal"><a href="index.php">Home</a></li>
          <li><a href="index.php" class="hover:text-[#830FF3] font-semibold md:font-normal">Foods</a></li>
          <li class="md:hidden">
            <h2 class="font-semibold">Categories</h2>
            <ul class="pl-3">
              <li><a href="show-data.php?kucing" class="hover:text-[#830FF3]">Kucing</a></li>
              <li><a href="show-data.php?anjing" class="hover:text-[#830FF3]">Anjing</a></li>
              <li><a href="show-data.php?burung" class="hover:text-[#830FF3]">Burung</a></li>
            </ul>
          </li>
          <li class="md:hidden">
            <h2 class="font-semibold">Brands</h2>
            <ul class="pl-3">
              <li><a href="data-by-brand.php?royalCanin" class="hover:text-[#830FF3]">Royal Canin</a></li>
              <li><a href="data-by-brand.php?acana" class="hover:text-[#830FF3]">Acana</a></li>
              <li><a href="data-by-brand.php?alpo" class="hover:text-[#830FF3]">Alpo</a></li>
              <li><a href="data-by-brand.php?vitakraft" class="hover:text-[#830FF3]">Vitakraft</a></li>
            </ul>
          </li>
          <li><a href="show-data.php?services" class="hover:text-[#830FF3] font-semibold md:font-normal">Services</a></li>
          <li><a href="" class="hover:text-[#830FF3] font-semibold md:font-normal">Contact</a></li>
          <li class="logout mt-4 md:mt-0">
            <a href="../logout.php" class="border-2 border-[#830FF3] font-semibold text-[#830FF3] hover:bg-[#830FF3] transition-all duration-150 hover:text-white rounded-lg py-[5px] px-5"
              ><i class="fa-solid fa-arrow-right-from-bracket mr-1" style="color: #830ff3"></i>Log out</a
            >
          </li>
        </ul>
      </nav>
    </header>

    <div class="layer fixed w-full h-screen z-10 bg-[rgba(0,0,0,0.5)] hidden transition-all duration-100"></div>
    <main class="flex">
      <section class="mt-[58px] mx-auto">
        <h2 class="text-lg pt-9 font-semibold md:text-2xl md:pl-4 text-center mb-2">Contact us</h2>

        <form action="" method="post" class="bg-[#efefef] p-4 md:p-7 rounded flex flex-col w-[90%] mx-auto md:w-[700px]">
          <label for="email" class="">Email :</label>
          <input type="text" name="email" id="email" class="mb-2 px-2 rounded focus:outline-[#830FF3]" required/>

          <label for="name" class="">Name :</label>
          <input type="text" name="name" id="name" class="mb-2 px-2 rounded focus:outline-[#830FF3]" required />

          <label for="" class="">Message :</label>
          <textarea name="message" id="" cols="30" rows="10" class="border border-[#b4b4b4] resize-none p-2 focus:outline-[#830FF3] rounded-lg bg-[#fefefe] focus:bg-white"></textarea>

          <div class="flex justify-end">
            <button type="submit" name="submit" class="bg-[#830FF3] py-1 px-4 mt-5 rounded-lg text-white hover:bg-[#773fac]">Submit</button>
          </div>
        </form>
      </section>
    </main>
    <footer></footer>

    <script>
      // Navbar
      const checkbox = document.querySelector("nav .menu-bars input");
      const navUl = document.querySelector("nav ul");
      const menuIcon = document.querySelector("nav .menu-bars i");
      const layer = document.querySelector(".layer");

      checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
          navUl.classList.replace("hidden", "flex");
          navUl.classList.replace("translate-x-[125px]", "translate-x-0");
          menuIcon.style.color = "#830FF3";
          layer.classList.replace("hidden", "flex");
          document.body.classList.add("overflow-hidden");
        } else {
          navUl.classList.replace("flex", "hidden");
          navUl.classList.replace("translate-x-0", "translate-x-[125px]");
          menuIcon.classList.add("rotate-0");
          menuIcon.style.color = "black";
          document.body.classList.remove("overflow-hidden");
          layer.classList.replace("flex", "hidden");
        }
      });

      const aLogout = document.querySelector(".logout a");
      const iconLogout = document.querySelector(".logout a i");

      aLogout.addEventListener("mouseover", function () {
        iconLogout.style.color = "#fff";
      });

      aLogout.addEventListener("mouseout", function () {
        iconLogout.style.color = "#830FF3";
      });
    </script>
  </body>
</html>
