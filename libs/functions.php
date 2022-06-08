<?php


function getData() {
    $myfile = fopen("db.json","r");
    $size = filesize("db.json");
    $result = json_decode(fread($myfile, $size), true);
    fclose($myfile);
    return $result;
}

function createUser(string $name,string $username,string $email,string $password) {
    $db = getData();
    array_push($db["users"], array(
       "id" => count($db["users"]) + 1,
       "username" => $username,
       "password" => $password,
       "name" => $name,
       "email" => $email  
    ));
    $myfile = fopen("db.json","w");
    fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    fclose($myfile);
}

function getUser(string $username) {
    $users = getData()["users"];

    foreach($users as $user) {
        if($user["username"] == $username) {
            return $user;
        }
    }
    return null;
}

function createBlog(string $title,string $sdescription, string $description, string $imageUrl,string $url, int $isActive=0) {
   include "ayar.php";

   $query = "INSERT INTO blogs(title, short_description, description, imageUrl, url, isActive) VALUES (?, ?, ?, ?, ?, ?)";
   $result = mysqli_prepare($connection,$query);

   mysqli_stmt_bind_param($result, 'sssssi', $title,$sdescription,$description,$imageUrl,$url,$isActive);
   mysqli_stmt_execute($result);
   mysqli_stmt_close($connection);

   return $result;
}

function getBlogs() {
    include "ayar.php";

    $query = "SELECT * from blogs";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByFilters($categoryId, $keyword, $page) {
    include "ayar.php";

    $pageCount = 2;
    $offset = ($page-1) * $pageCount; 
    $query = "";

    if(!empty($categoryId)) {
        $query = "from blog_category bc inner join blogs b on bc.blog_id=b.id WHERE bc.category_id=$categoryId AND isActive=1";
    } else {
        $query = "from blogs b WHERE b.isActive=1";
    }

    if(!empty($keyword)) {
        $query .= " && b.title LIKE '%$keyword%' or b.description LIKE '%$keyword%'";
    }

    $total_sql = "SELECT COUNT(*) ".$query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount);

    echo $total_pages;

    $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result
    );
}

function getHomePageBlogs() {
    include "ayar.php";

    $query = "SELECT * from blogs WHERE isActive=1 and isHome=1 ORDER BY dateAdded DESC LIMIT 5";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


function getBlogById(int $movieId) {
    include "ayar.php";

    $query = "SELECT * from blogs WHERE id='$movieId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}

function editBlog(int $id, string $title, string $description, string $sdescription,string $imageUrl,string $url, int $isActive, int $isHome) {
    include "ayar.php";

    $query = "UPDATE blogs SET title='$title',short_description='$sdescription', description='$description',imageUrl='$imageUrl', url='$url', isActive=$isActive,isHome=$isHome WHERE id=$id";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function clearBlogCategories(int $blogid) {
    include "ayar.php";

    $query = "DELETE FROM blog_category WHERE blog_id=$blogid";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function addBlogToCategories(int $blogid, array $categories) {
    include "ayar.php";

    $query = "";

    foreach($categories as $catid) {
        $query .= "INSERT INTO blog_category(blog_id,category_id) VALUES ($blogid, $catid);";
    }

    $result = mysqli_multi_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function deleteBlog(int $id) {
    include "ayar.php";
    $query = "DELETE FROM blogs WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}

function getCategories() {
    include "ayar.php";

    $query = "SELECT * from categories";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getCategoriesByBlogId($id) {
    include "ayar.php";

    $query = "SELECT c.id,c.name from blog_category bc inner join categories c on bc.category_id=c.id WHERE bc.blog_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByCategoryId($id) {
    include "ayar.php";

    $query = "SELECT * from blog_category bc inner join blogs b on bc.blog_id=b.id WHERE bc.category_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByKeyword($q) {
    include "ayar.php";

    $query = "SELECT * FROM blogs WHERE title LIKE '%$q%' or description LIKE '%$q%'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


function createCategory(string $categoryname) {
    include "ayar.php";
 
    $query = "INSERT INTO categories(name) VALUES (?)";
    $result = mysqli_prepare($connection,$query);
 
    mysqli_stmt_bind_param($result, 's', $categoryname);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($connection);
 
    return $result;
 }

 function getCategoryById(int $categoryId) {
    include "ayar.php";

    $query = "SELECT * from categories WHERE id='$categoryId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}

function editCategory(int $id, string $categoryname, int $isActive) {
    include "ayar.php";

    $query = "UPDATE categories SET name='$categoryname', isActive=$isActive WHERE id=$id";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function deleteCategory(int $id) {
    include "ayar.php";
    $query = "DELETE FROM categories WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}


function control_input($data) {
    // $data = strip_tags($data);
    $data = htmlspecialchars($data);
    // $title = htmlentities($data);
    $data = stripslashes($data); # sql injection

    return $data;
}

function kisaAciklama($aciklama, $limit) {
    if (strlen($aciklama) > $limit) {
        echo substr($aciklama,0,$limit)."...";
    } else {
        echo $aciklama;
    };
}


function saveImage($file) {
    $message = ""; 
    $uploadOk = 1;
    $fileTempPath = $file["tmp_name"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $maxfileSize = ((1024 * 1024) * 1);
    $dosyaUzantilari = array("jpg","jpeg","png");
    $uploadFolder = "./img/";

    if($fileSize > $maxfileSize) {
        $message = "Dosya boyutu fazla.<br>";
        $uploadOk = 0;
    }

    $dosyaAdi_Arr = explode(".", $fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
    $dosyaUzantisi = $dosyaAdi_Arr[1];

    if(!in_array($dosyaUzantisi, $dosyaUzantilari)) {
        $message .= "dosya uzantısı kabul edilmiyor.<br>";
        $message .= "kabul edilen dosya uzantıları : ".implode(", ", $dosyaUzantilari)."<br>";
        $uploadOk = 0;
    }

    $yeniDosyaAdi = md5(time().$dosyaAdi_uzantisiz).'.'.$dosyaUzantisi;
    $dest_path = $uploadFolder.$yeniDosyaAdi;

    if($uploadOk == 0) {
        $message .= "Dosya yüklenemedi.<br>";
    } else {
        if(move_uploaded_file($fileTempPath, $dest_path)) {
            $message .="dosya yüklendi.<br>";
        }
    }

    return array(
        "isSuccess" => $uploadOk,
        "message" => $message,
        "image" => $yeniDosyaAdi
    );
}
?>