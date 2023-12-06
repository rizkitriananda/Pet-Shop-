<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

require '../functions.php';
// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST['submit'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if(tambahVM($_POST) > 0 ){
        echo "<script>
                alert('Data Berhasil ditambahkan');
                document.location.href = 'dashboard.php'
            </script>";
    }else {
            echo "<script>
                alert('Data GAGAL ditambahkan');
                document.location.href = 'dashboard.php'
            </script>";
    }
    
}
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
      <nav class="flex justify-between bg-[#ffffff] fixed top-0 left-0 right-0 z-[100] border-b py-3 border-[#dadadd]">
        <div class="logo w-[150px] ml-3 py-1 md:ml-20 flex justify-between">
          <span class="flex items-center font-bold md:text-xl text-lg mr-3 md:mr-1">Dashboard</span>
        </div>
      </nav>
    </header>

    <main class="flex">
      <section class="mt-[80px] px-3 mx-auto flex flex-col justify-center">
        <h1 class="text-center font-semibold text-2xl">EDIT</h1>
        <form action="" method="post" enctype="multipart/form-data" class="bg-[#fefefe] w-[500px] p-7 rounded-lg flex flex-col">
          <div class="flex justify-between mb-3">
            <label for="hewan" class="self-center">Hewan</label>
            <input type="text" name="hewan" id="hewan"  autofocus class="px-3 py-[2px] w-[250px] rounded focus:outline-[#830FF3] border border-[#777]" />
          </div>

          <div class="flex justify-between mb-3">
            <label for="stok" class="self-center">Stok</label>
            <input type="text" name="stok" id="stok" class="px-3 py-[2px] w-[250px] rounded focus:outline-[#830FF3] border border-[#777]" />
          </div>

          <div class="h-[50px] flex items-center justify-between mb-3 relative overflow-hidden">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="absolute -right-14" />
          </div>

          <div class="flex justify-between mb-3">
            <label for="" class="self-center">Harga</label>
            <input type="text" name="harga" id="harga" class="px-3 py-[2px] w-[250px] rounded focus:outline-[#830FF3] border border-[#777]" />
          </div>

          <div class="flex justify-between mb-3">
            <label for="">Deskripsi</label>
            <textarea name="deskripsi" id=""  cols="30" rows="10" class="rounded w-[250px] px-2 focus:outline-[#830FF3] resize-none border border-[#777]"></textarea>
          </div>

          <button type="submit" name="submit" class="bg-[#830FF3] hover:text-white hover:bg-[#7710d8] tracking-wide py-1 px-7 rounded-lg w-fit self-end">SUBMIT</button>
        </form>
      </section>

      <a href="dashboard.php" class="absolute right-[180px] top-[200px] border-2 rounded-lg border-[#f09433] hover:bg-[#f78d1d] py-2 px-5">Kembali</a>
    </main>
    <footer></footer>

    <script>
      // Navbar
      const checkbox = document.querySelector("nav .menu-bars input");
      const navUl = document.querySelector("nav ul");
      const menuIcon = document.querySelector("nav .menu-bars i");
      const layer = document.querySelector(".layer");

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
