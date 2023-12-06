<?php 

  session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

require '../functions.php';

$foods = query('SELECT * FROM `foods` ORDER BY id DESC');
$medicinesAndVitamin = query('SELECT * FROM `obat_vitamin` ORDER BY id DESC');

$sumFoods = query("SELECT SUM(stok) AS total_stok FROM foods");
$totalStokFoods = isset($sumFoods[0]['total_stok']) ? $sumFoods[0]['total_stok'] : 0;

$sumMV = query("SELECT SUM(stok) AS total_stok FROM `obat_vitamin`");
$totalStokMV = isset($sumFoods[0]['total_stok']) ? $sumFoods[0]['total_stok'] : 0;

$service = query("SELECT * FROM services ORDER BY id DESC")
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
            <a href="#" class="group hover:text-[#830FF3]">Home</a>
          </li>
          <li class="mt-1">
            <a href="#foods" class="group hover:text-[#830FF3]">Foods</a>
          </li>
          <li class="mt-1">
            <a href="#medicines-vitamin" class="group hover:text-[#830FF3]">Medicines & Vitamin</a>
          </li>
          <li class="mt-1">
            <a href="#services" class="group hover:text-[#830FF3]">Services</a>
          </li>
          <li class="mt-1">
          <h2 class="font-semibold">Add Data</h2>
            <ul class="ml-3">
              <li><a href="addfoods.php" class="hover:text-[#830FF3]">Foods</a></li>
              <li><a href="addVM.php" class="hover:text-[#830FF3]">Medicines And Vitamins</a></li>
              <li><a href="addservices.php" class="hover:text-[#830FF3]">Services</a></li>
            </ul>
          </li>
          <li class="mt-1">
            <a href="message.php" class="group hover:text-[#830FF3]">Message</a>
          </li>
          <li class="logout mt-5">
            <a href="../logout.php" class="border-2 border-[#830FF3] font-semibold text-[#830FF3] hover:bg-[#830FF3] transition-all duration-150 hover:text-white rounded-lg py-[5px] px-5"
              ><i class="fa-solid fa-arrow-right-from-bracket mr-1" style="color: #830ff3"></i>Logout</a
            >
          </li>
        </ul>
      </aside>

      <section class="mt-[58px] px-3 b md:ml-[250px] mx-auto">
        <div class="flex flex-col justify-center gap-5 mt-5 md:flex-row">
          <article class="flex flex-col bg-[#aa4fff] text-black rounded-lg p-2">
            <h2 class="font-semibold">Stock barang</h2>
            <span>Foods <span class="font-semibold">(<?= $totalStokFoods; ?>)</span></span>
            <span>Medicines And Vitamins <span class="font-semibold">(<?= $totalStokMV; ?>)</span></span>
          </article>

          <article class="flex flex-col bg-green-600 text-black rounded-lg p-2">
            <h2 class="font-semibold">Terjual</h2>
            <span>Foods (<span>20</span>)</span>
            <span>Medicines And Vitamins (20)</span>
          </article>
        </div>

        <div id="foods" class="px-5">
          <h2 class="pt-9 font-semibold text-lg md:text-2xl">Foods</h2>

          <table class="md:table-fixed md:border-collapse md:bg-[#ffff] hover:table-fixed w-[100%] odd:bg-slate-900 ">
              <tr class="">
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">No</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">Aksi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[160px]">Hewan</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[350px]">Deskripsi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[150px]">Brand</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[100px]">Stok</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold">Harga</th>
              </tr>

            <?php $i = 1; ?>
            <?php foreach($foods as $row) : ?>
              <tr>
                <td class="text-center pt-5"><?= $i; ?></td>
                <td class="text-center pt-5" id="aksi">
                  <a href="editfoods.php?id=<?= $row["id"];?>"><i class="fa-solid fa-pen-to-square fa-lg mr-2" style="color: #830ff3"></i></a>
                  <a href="hapus.php?id=<?= $row["id"];?>&table=foods"><i class="fa-solid fa-trash fa-lg" style="color: #f00707"></i></a>
                </td>
                <td class="text-center pt-5"><?= $row['hewan']; ?></td>
                <td class="pt-5"><?= $row['deskripsi']; ?></td>
                <td class="text-center pt-5"><?= $row['brand']; ?></td>
                <td class="text-center pt-5"><?= $row['stok']; ?></td>
                <td class="pt-5">Rp<?= $row['harga']; ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
          </table>
        </div>

        <div id="medicines-vitamin" class="mt-20 md:pl-4">
          <h2 class="font-semibold text-lg md:text-2xl">Medicines And Vitamins</h2>

          <table class="md:table-fixed md:border-collapse md:bg-[#fefefe] hover:table-fixed w-[100%] mb-10">
            <thead class="">
              <tr class="">
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">No</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">Aksi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[160px]">Hewan</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[460px]">Deskripsi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[100px]">Stok</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold">Harga</th>
              </tr>
            </thead>

            <tbody>
            <?php $i = 1; ?>
            <?php foreach($medicinesAndVitamin as $row): ?>
              <tr class="">
                <td class="text-center pt-5"><?= $i; ?></td>
                <td class="text-center pt-5">
                  <a href="editVM.php?id=<?= $row["id"];?>" class="edit"><i class="fa-solid fa-pen-to-square fa-lg mr-2" style="color: #830ff3"></i></a>
                  <a href="hapus.php?id=<?= $row["id"];?>&table=obat_vitamin" class="delete"><i class="fa-solid fa-trash fa-lg" style="color: #f00707"></i></a>
                </td>
                <td class="text-center pt-5"><?= $row['hewan']; ?></td>
                <td class="pt-5"><?= $row['nama']; ?></td>
                <td class="text-center pt-5"><?= $row['stok']; ?></td>
                <td class="pt-5 pl-5">Rp<?= $row['harga']; ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

          <div id="services" class="mt-20 md:pl-4">
          <h2 class="font-semibold text-lg md:text-2xl">Services</h2>

          <table class="md:table-fixed md:border-collapse md:bg-[#fefefe] hover:table-fixed w-[100%] mb-10">
            <thead class="">
              <tr class="">
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">No</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[70px] text-center">Aksi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[160px]">Gambar</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[460px]">Deskripsi</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold w-[100px]">Layanan</th>
                <th class="border-b text-xl pt-5 border-slate-600 font-semibold">Harga</th>
              </tr>
            </thead>

            <tbody>
            <?php $i = 1; ?>
            <?php foreach($service as $row): ?>
              <tr class="">
                <td class="text-center pt-5"><?= $i; ?></td>
                <td class="text-center pt-5">
                  <a href="editservices.php?id=<?= $row["id"];?>" class="edit"><i class="fa-solid fa-pen-to-square fa-lg mr-2" style="color: #830ff3"></i></a>
                  <a href="hapus.php?id=<?= $row["id"];?>&table=services" class="delete"><i class="fa-solid fa-trash fa-lg" style="color: #f00707"></i></a>
                </td>
                <td class="flex justify-center  pt-5"><img src="../image/services/<?= $row['gambar']; ?>" alt="" class="w-[60px] h-[60px]"></td>
                <td class="pt-5"><?= $row['deskripsi']; ?></td>
                <td class="text-center pt-5"><?= $row['layanan']; ?></td>
                <td class="pt-5 pl-5">Rp<?= $row['harga']; ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
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




