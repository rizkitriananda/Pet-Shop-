<?php 
    session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

require '../functions.php';

$pesan = query('SELECT * FROM `pesan`');

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
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
    <title>Dasboard</title>
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
  <body class="font-poppins bg-[#efefef]">
    <header>
      <nav class="flex justify-between bg-[#ffffff] fixed top-0 left-[250px] right-0 z-[100] border-b py-3 border-[#dadadd]">
        <div class="logo w-[150px] ml-3 py-1 md:ml-20 flex justify-between">
          <span class="flex items-center font-bold md:text-xl text-lg mr-3 md:mr-1">Dashboard</span>
        </div>

        <div class="menu-bars flex items-center mr-5 md:hidden">
          <div class="relative">
            <input type="checkbox" class="absolute w-full h-full opacity-0 cursor-pointer z-10 peer" />
            <i class="fa-solid fa-bars fa-xl cursor-pointer transition-all duration-200 peer-checked:rotate-180" style="color: #000000"></i>
          </div>
        </div>
      </nav>
    </header>

    <div class="layer fixed w-full h-screen z-10 bg-[rgba(0,0,0,0.5)] hidden transition-all duration-100"></div>
    <main class="flex">
      <aside class="hidden fixed w-[250px] h-screen shadow-lg pl-10 md:flex md:flex-col bg-[#f3f3f6]">
        <div class="mt-5 mb-4">
          <img src="../image/logo.png" alt="" class="w-[50px]" />
        </div>
        <ul>
          <h2 class="font-semibold text-xl">Pet Shop</h2>
          <li class="mt-1">
            <a href="dashboard.php" class="group">Home</a>
          </li>
          <li class="mt-1">
            <a href="dashboard.php" class="group">Foods</a>
          </li>
          <li class="mt-1">
            <a href="dashboard.php" class="group">Medicines & Vitamin</a>
          </li>
          <li class="mt-1">
            <a href="dashboard.php" class="group">Services</a>
          </li>
          <li class="mt-1">
            <a href="#" class="group">Message</a>
          </li>
          <li class="logout mt-5">
            <a href="../logout.php" class="border-2 border-[#830FF3] font-semibold text-[#830FF3] hover:bg-[#830FF3] transition-all duration-150 hover:text-white rounded-lg py-[5px] px-5"
              ><i class="fa-solid fa-arrow-right-from-bracket mr-1" style="color: #830ff3"></i>Logout</a
            >
          </li>
        </ul>
      </aside>

      <section class="mt-[58px] px-3 b md:ml-[250px] mx-auto">
        <div class="flex flex-col justify-center gap-5 mt-5 md:flex-row flex-wrap">
        <?php foreach($pesan as $row) : ?>
          <article class="bg-gray-100 shadow-lg w-[250px] h-[300px] p-4 pt-6 rounded-lg relative">
            <a href="hapus.php?id=<?= $row["id"];?>&table=pesan" class="absolute top-2 right-2"><i class="fa-solid fa-xmark fa-xl" style="color: #333333"></i></a>
            <ul class="flex flex-col w-full h-full">
              <li class="truncate"><span class="font-semibold">Email :</span><span class="ml-2"><span></span><?= $row['email']; ?></span></li>
              <li class=""><span class="font-semibold">Nama :</span><span class="ml-2"><span></span><?= $row['name']; ?></span></li>
              <li class="basis-full overflow-auto">
                <span class="font-semibold">Pesan :</span>
                <span class="ml-2overflow-hidden"><?= $row['message']; ?></span>
              </li>
            </ul>
          </article>
        <?php endforeach; ?>
        </div>
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

      const linkEdit = document.querySelector(".edit");
      const editButton = document.querySelector("#aksi .fa-pen-to-square");
      const linkDelete = document.querySelector(".delete");
      const deleteButton = document.querySelector("#aksi .fa-trash");

      linkDelete.addEventListener("mouseover", function () {
        editButton.style.color = "#fff";
      });

      editButton.addEventListener("mouseout", function () {
        editButton.style.color = "#830FF3";
      });
    </script>
  </body>
</html>
