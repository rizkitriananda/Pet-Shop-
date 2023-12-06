<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

require '../functions.php';

$royalCanin = [];
$acana = [];
$alpo = [];
$vitakraft = [];

$title;

if(isset($_GET['royalCanin'])){
  $royalCanin = query("SELECT * FROM `foods` WHERE brand = 'Royal Canin'");
  $title = 'Royal Canin';
}

if(isset($_GET['acana'])){
  $acana = query("SELECT * FROM `foods` WHERE brand = 'Acana'");
  $title = 'Acana';
}

if(isset($_GET['alpo'])){
  $alpo = query("SELECT * FROM `foods` WHERE brand = 'Alpo'");
  $title = 'Alpo';
}

if(isset($_GET['vitakraft'])){
  $vitakraft = query("SELECT * FROM `foods` WHERE brand = 'Vitakraft'");
  $title = 'Vitakraft';
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
    <link rel="shortcut icon" href="../image/logo.png" type="image/x-icon">
    <title><?= $title;?></title>
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
          class="absolute right-0 top-[58px] h-[500px] hidden flex-col gap-2 px-7 border-b border-l bg-[#fefefe] translate-x-[125px] md:border-0 md:translate-x-0 md:flex md:flex-row md:top-0 md:h-full md:items-center md:mr-20 md:gap-5"
        >
          <li class="mt-8 md:mt-0"><a href="index.php" class="hover:text-[#830FF3]">Home</a></li>
          <li><a href="index.php" class="hover:text-[#830FF3]">Foods</a></li>
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
          <li><a href="" class="hover:text-[#830FF3]">Services</a></li>
          <li><a href="contact.php" class="hover:text-[#830FF3]">Contact</a></li>
          <li class="mt-4 md:mt-0"><a href="../logout.php" class="border-2 border-[#830FF3] font-semibold text-[#830FF3] hover:bg-[#830FF3] transition-all duration-150 hover:text-white rounded-lg py-[5px] px-5">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="layer fixed w-full h-screen z-10 bg-[rgba(0,0,0,0.5)] hidden transition-all duration-100"></div>
    <main class="flex">
    <aside class="hidden fixed w-[250px] h-screen shadow-lg mt-[58px] pl-10 md:flex md:flex-col bg-[#f3f3f6]">
        <h2 class="font-semibold text-[18px] mt-10 text-[#830FF3]">Kategori</h2>
        <ul id="hewan">
          <li class="mt-1">
            <a href="show-data.php?kucing" class="group"><i class="fa-solid fa-paw mr-2" style="color: #f97316"></i><span class="group-hover:text-[#f97316]">Kucing</span></a>
          </li>
          <li class="mt-1">
            <a href="show-data.php?anjing" class="group"><i class="fa-solid fa-paw mr-2" style="color: #f97316"> </i><span class="group-hover:text-[#f97316]">Anjing</span></a>
          </li>
          <li class="mt-1">
            <a href="show-data.php?burung" class="group"><i class="fa-solid fa-paw mr-2" style="color: #f97316"> </i><span class="group-hover:text-[#f97316]">Burung</span> </a>
          </li>
        </ul>

        <h2 class="text-[18px] text-[#830FF3] mt-5 font-semibold">Brand</h2>
        <ul class="brands">
          <li class="mt-1">
            <a href="data-by-brand.php?royalCanin" class="hover:text-[#f97316]">Royal Canin</a>
          </li>
          <li class="mt-1">
            <a href="data-by-brand.php?acana" class="hover:text-[#f97316]">Acana</a>
          </li>
          <li class="mt-1">
            <a href="data-by-brand.php?alpo" class="hover:text-[#f97316]">Alpo</a>
          </li>
          <li class="mt-1">
            <a href="data-by-brand.php?vitakraft" class="hover:text-[#f97316]">Vitakraft</a>
          </li>
        </ul>
      </aside>

      <section class="mt-[58px] px-3 b md:ml-[250px] mx-auto">
        <div id="foods">
          <h2 class="text-lg pt-9 font-semibold md:text-2xl md:pl-4">Foods<span class="ml-1 text-[#830FF3]">"<?= $title; ?>"</span></h2>

          <div class="flex flex-wrap justify-center gap-4">
          <?php foreach($royalCanin as $row) : ?>
            <article class="border border-[dadadd] w-fit md:h-[450px] mt-4 pb-3 mx-auto flex flex-col rounded-md overflow-hidden hover:border-[#830FF3] relative">
              <img src="../image/kucing/<?= $row['gambar']; ?>" alt="" class="mb-2 w-[300px] md:w-[250px]" />
              <span class="pl-2 text-[#830FF3] font-bold">Rp<?= $row['harga']; ?></span>
              <p class="pl-2 w-[200px] md:w-[250px]"><?= $row['deskripsi']; ?></p>
              <a href="transaksi.html" class="bg-orange-500 text-white w-fit py-1 px-4 rounded-lg self-end mr-3 mt-4 absolute bottom-6 right-4">Buy</a>
            </article>
            <?php endforeach; ?>

            <?php foreach($acana as $row) : ?>
            <article class="border border-[dadadd] w-fit md:h-[450px] mt-4 pb-3 mx-auto flex flex-col rounded-md overflow-hidden hover:border-[#830FF3] relative">
              <img src="../image/anjing/<?= $row['gambar']; ?>" alt="" class="mb-2 w-[300px] md:w-[250px]" />
              <span class="pl-2 text-[#830FF3] font-bold">Rp<?= $row['harga']; ?></span>
              <p class="pl-2 w-[200px] md:w-[250px]"><?= $row['deskripsi']; ?></p>
              <a href="transaksi.html" class="bg-orange-500 text-white w-fit py-1 px-4 rounded-lg self-end mr-3 mt-4 absolute bottom-6 right-4">Buy</a>
            </article>
            <?php endforeach; ?>

            <?php foreach($alpo as $row) : ?>
            <article class="border border-[dadadd] w-fit md:h-[450px] mt-4 pb-3 mx-auto flex flex-col rounded-md overflow-hidden hover:border-[#830FF3] relative">
              <img src="../image/anjing/<?= $row['gambar']; ?>" alt="" class="mb-2 w-[300px] md:w-[250px]" />
              <span class="pl-2 text-[#830FF3] font-bold">Rp<?= $row['harga']; ?></span>
              <p class="pl-2 w-[200px] md:w-[250px]"><?= $row['deskripsi']; ?></p>
              <a href="transaksi.html" class="bg-orange-500 text-white w-fit py-1 px-4 rounded-lg self-end mr-3 mt-4 absolute bottom-6 right-4">Buy</a>
            </article>
            <?php endforeach; ?>

            <?php foreach($vitakraft as $row) : ?>
            <article class="border border-[dadadd] w-fit md:h-[450px] mt-4 pb-3 mx-auto flex flex-col rounded-md overflow-hidden hover:border-[#830FF3] relative">
              <img src="../image/burung/<?= $row['gambar']; ?>" alt="" class="mb-2 w-[300px] md:w-[250px]" />
              <span class="pl-2 text-[#830FF3] font-bold">Rp<?= $row['harga']; ?></span>
              <p class="pl-2 w-[200px] md:w-[250px]"><?= $row['deskripsi']; ?></p>
              <a href="transaksi.html" class="bg-orange-500 text-white w-fit py-1 px-4 rounded-lg self-end mr-3 mt-4 absolute bottom-6 right-4">Buy</a>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
    <footer></footer>

    <script>
      // Navbar
      const checkbox = document.querySelector("nav .menu-bars input");
      const navUl = document.querySelector("nav ul");
      const menuIcon = document.querySelector("nav .menu-bars i");
      const layer = document.querySelector('.layer');

      checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
          navUl.classList.replace("hidden", "flex");
          navUl.classList.replace("translate-x-[125px]", "translate-x-0");
          menuIcon.style.color = "#830FF3";
          layer.classList.replace('hidden','flex')
          document.body.classList.add('overflow-hidden')
        } else {
          navUl.classList.replace("flex", "hidden");
          navUl.classList.replace("translate-x-0", "translate-x-[125px]");
          menuIcon.classList.add("rotate-0");
          menuIcon.style.color = "black";
          layer.classList.replace('flex','hidden')
          document.body.classList.remove('overflow-hidden')
        }
      });
    </script>
  </body>
</html>
