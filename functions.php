<?php
  
// koneksi ke database  
$koneksi = mysqli_connect("localhost", "root", "", "tugas-akhir");

// query untuk menampilkan data
function query ($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}

// delete
function hapus($id,$table){
    global $koneksi;
    $result = mysqli_query($koneksi, "DELETE FROM $table WHERE id= $id");

    return mysqli_affected_rows($koneksi);
}




// login register
function register($data){
    global $koneksi;

    $nama = strtolower(stripslashes($data['nama']));
    $username = strtolower(stripslashes($data['username']));
    $level = strtolower(stripslashes($data['level']));
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);


    // ccek username sudah ada atau belum
   $result =  mysqli_query($koneksi, "SELECT username FROM users 
                WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }


    // tambahkan userbaru ke databe
    mysqli_query($koneksi, "INSERT INTO users (nama,username,password,level) 
                VALUES
                ('$nama','$username','$password','$level')");

    // untuk menghasilkan angka 1 untuk berhasil 
    return mysqli_affected_rows($koneksi);
}

function pesan($data){
    global $koneksi;
    $email = htmlspecialchars($data['email']);
    $name = htmlspecialchars($data['name']);
    $message = htmlspecialchars($data['message']);


        // query insert date 
    $query = "INSERT INTO `pesan` (email, name, message) 
                VALUES
                ('$email', '$name', '$message')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// add
function tambahFoods($data){
    global $koneksi;  
    $hewan = htmlspecialchars($data['hewan']);
    $brand = htmlspecialchars($data['brand']);
    $stok = $data['stok'];
    $harga = htmlspecialchars($data['harga']);
    $deskripsi = htmlspecialchars($data['deskripsi']);

    // upload gambar
    $gambar = uploadFoods();
    if(!$gambar){
        return false;
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "INSERT INTO `foods`  (hewan, deskripsi, brand, harga, stok, gambar, total_stok, terjual) 
                                    VALUES ('$hewan', '$deskripsi', '$brand', $harga, $stok, '$gambar',0,0)";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function uploadFoods(){
    $nameFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4){
        // error 4 ketika tidak ada file yang diupload
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";

            // untuk memberhentikan function
            return false;
    }

    // cek type file gambar
    $ekstensiGambarValid = ['jpg','jpeg','png','webp'];
    $ekstensiGambar = explode('.', $nameFile); // memecah nama gambar dgn type
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengambil nama type file dgn yang paling akhir dan str agar huruf kecil
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                alert('yang anda upload bukan gambar!!!');
            </script>";
    } # output boolean

    // cek ukuran jika terlalu besar
    if($sizeFile > 2000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!!!');
            </script>";
    }

    // lolos pengecekan gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    $destinationPath = '../image/foods/' . $namaFileBaru;

    // Check if the destination directory exists, create it if not
    if (!file_exists('image/foods/')) {
        mkdir('image/foods/', 0777, true);
    }

    // Pindahkan berkas yang diunggah ke jalur tujuan
    if (move_uploaded_file($tmpName, $destinationPath)) {
        // Jika berhasil diunggah, kembalikan nama berkas baru
        return $namaFileBaru;
    } else {
        echo "<script>alert('File upload failed.');</script>";
        return false;
    }


    // untuk variabel isi gambar
    return $namaFileBaru;
}

function ubah($data){
    global $koneksi;
   
    // ambil data dari tiap elemen form
    $id = $data['id'];
    $hewan = htmlspecialchars($data['hewan']);
    $brand = htmlspecialchars($data['brand']);
    $stok = $data['stok'];
    $harga = htmlspecialchars($data['harga']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $gambarLama = htmlspecialchars($data['gambarLama']);


    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else {
    $gambar = uploadFoods();
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "UPDATE foods SET hewan = '$hewan', 
                                            deskripsi = '$deskripsi', 
                                            brand = '$brand', 
                                            harga = '$harga', 
                                            stok = $stok,
                                            gambar = '$gambar' WHERE id = $id" ;

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// add
function tambahVM($data){
    global $koneksi;  
    $hewan = $data['hewan'];
    $stok = $data['stok'];
    $harga = htmlspecialchars($data['harga']);
    $nama = htmlspecialchars($data['nama']);

    // upload gambar
    $gambar = uploadVM();
    if(!$gambar){
        return false;
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "INSERT INTO `obat_vitamin`  (hewan, nama, harga, stok, gambar, total_stok, terjual) 
                                    VALUES ('$hewan', '$nama', $harga, $stok, '$gambar',0,0)";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function uploadVM(){
    $nameFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4){
        // error 4 ketika tidak ada file yang diupload
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";

            // untuk memberhentikan function
            return false;
    }

    // cek type file gambar
    $ekstensiGambarValid = ['jpg','jpeg','png','webp'];
    $ekstensiGambar = explode('.', $nameFile); // memecah nama gambar dgn type
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengambil nama type file dgn yang paling akhir dan str agar huruf kecil
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                alert('pilih file gambar!!!');
            </script>";
    } # output boolean

    // cek ukuran jika terlalu besar
    if($sizeFile > 2000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!!!');
            </script>";
    }

    // lolos pengecekan gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    $destinationPath = '../image/VM/' . $namaFileBaru;

    // Check if the destination directory exists, create it if not
    if (!file_exists('../image/VM/')) {
        mkdir('../image/VM/', 0777, true);
    }

    // Pindahkan berkas yang diunggah ke jalur tujuan
    if (move_uploaded_file($tmpName, $destinationPath)) {
        // Jika berhasil diunggah, kembalikan nama berkas baru
        return $namaFileBaru;
    } else {
        echo "<script>alert('File upload failed.');</script>";
        return false;
    }

    // untuk variabel isi gambar
    return $namaFileBaru;
}


function ubahVM($data){
    global $koneksi;
   
    // ambil data dari tiap elemen form
    $id = $data['id'];
    $hewan = $data['hewan'];
    $stok = $data['stok'];
    $harga = htmlspecialchars($data['harga']);
    $nama = htmlspecialchars($data['nama']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else {
    $gambar = uploadVM();
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "UPDATE `obat_vitamin` SET hewan = '$hewan', 
                                            nama = '$nama',  
                                            harga = $harga, 
                                            stok = $stok, 
                                            gambar = '$gambar' WHERE id = $id" ;

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambahServices($data){
    global $koneksi;  
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $layanan = htmlspecialchars($data['layanan']);
    $harga = $data['harga'];

    // upload gambar
    $gambar = uploadServices();
    if(!$gambar){
        return false;
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "INSERT INTO `services`  (deskripsi, layanan, harga, gambar) 
                                    VALUES ('$deskripsi', '$layanan', $harga,'$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function uploadServices(){
    $nameFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4){
        // error 4 ketika tidak ada file yang diupload
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";

            // untuk memberhentikan function
            return false;
    }

    // cek type file gambar
    $ekstensiGambarValid = ['jpg','jpeg','png','webp'];
    $ekstensiGambar = explode('.', $nameFile); // memecah nama gambar dgn type
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengambil nama type file dgn yang paling akhir dan str agar huruf kecil
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                alert('pilih file gambar!!!');
            </script>";
    } # output boolean

    // cek ukuran jika terlalu besar
    if($sizeFile > 1000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!!!');
            </script>";
    }

    // lolos pengecekan gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    $destinationPath = '../image/services/' . $namaFileBaru;

    // Check if the destination directory exists, create it if not
    if (!file_exists('../image/services/')) {
        mkdir('../image/services/', 0777, true);
    }

    // Pindahkan berkas yang diunggah ke jalur tujuan
    if (move_uploaded_file($tmpName, $destinationPath)) {
        // Jika berhasil diunggah, kembalikan nama berkas baru
        return $namaFileBaru;
    } else {
        echo "<script>alert('File upload failed.');</script>";
        return false;
    }

    // untuk variabel isi gambar
    return $namaFileBaru;
}

function ubahServices($data){
    global $koneksi;
   
    // ambil data dari tiap elemen form
    $id = $data['id'];
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $layanan = htmlspecialchars($data['layanan']);
    $harga = $data['harga'];
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else {
    $gambar = uploadServices();
    }


    $query = "UPDATE `services` SET deskripsi = '$deskripsi',
                                            layanan = '$layanan', 
                                            harga = $harga, 
                                            gambar = '$gambar' WHERE id = $id" ;

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
?>