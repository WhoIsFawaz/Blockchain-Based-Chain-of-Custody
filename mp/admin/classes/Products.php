<?php
session_start();
class Products
{
    private $con;

    function __construct()
    {
        include_once ("Database.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function getProducts()
    {
        $q = $this->con->query("SELECT p.product_id, p.product_title, p.product_desc, p.product_image, p.product_keywords, p.product_port FROM products p");

        $products = [];
        if ($q->num_rows > 0) {
            while ($row = $q->fetch_assoc()) {
                $products[] = $row;
            }
            // return ['status'=> 202, 'message'=> $ar];
            $_DATA['products'] = $products;
        }
        return [
            'status' => 202,
            'message' => $_DATA
        ];
    }

    public function addProduct($product_name, $product_desc, $product_keywords, $file, $product_port)
    {
        $fileName = $file['name'];
        $fileNameAr = explode(".", $fileName);
        $extension = end($fileNameAr);
        $ext = strtolower($extension);

        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

            if ($file['size'] > (1024 * 2)) {

                $uniqueImageName = time() . "_" . $file['name'];
                if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/mp/product_images/" . $uniqueImageName)) {

                    $q = $this->con->prepare("INSERT INTO `products`(`product_title`, `product_desc`, `product_image`, `product_keywords`, `product_port`)
                    VALUES (?, ?, ?, ?, ?)");
                    $q->bind_param("sssss", $product_name, $product_desc, $uniqueImageName, $product_keywords, $product_port);
                    $results= $q -> execute();

                    if ($results) {
                        return [
                            'status' => 202,
                            'message' => 'Evidence added successfully'
                        ];
                    } else {
                        return [
                            'status' => 303,
                            'message' => 'Failed to run query'
                        ];
                    }
                } else {
                    return [
                        'status' => 303,
                        'message' => 'Failed to upload image'
                    ];
                }
            } else {
                return [
                    'status' => 303,
                    'message' => 'Large Image ,Max Size allowed 2MB'
                ];
            }
        } else {
            return [
                'status' => 303,
                'message' => 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'
            ];
        }
    }

    public function editProductWithImage($pid, $product_name, $product_desc, $product_keywords, $file, $product_port)
    {
        $fileName = $file['name'];
        $fileNameAr = explode(".", $fileName);
        $extension = end($fileNameAr);
        $ext = strtolower($extension);

        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

            if ($file['size'] > (1024 * 2)) {

                $uniqueImageName = time() . "_" . $file['name'];
                if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/mp/product_images/" . $uniqueImageName)) {

                    $q = $this->con->prepare("UPDATE `products` SET
										`product_title` = ?,
										`product_desc` = ?,
										`product_image` = ?,
										`product_keywords` = ?,
                    `product_port` = ?
										WHERE product_id = ?");
                    $q->bind_param("sssssi", $product_name, $product_desc, $uniqueImageName ,$product_keywords, $product_port, $pid);
                    $results= $q -> execute();

                    if ($results) {
                        return [
                            'status' => 202,
                            'message' => 'Evidence updated successfully'
                        ];
                    } else {
                        return [
                            'status' => 303,
                            'message' => 'Failed to run query'
                        ];
                    }
                } else {
                    return [
                        'status' => 303,
                        'message' => 'Failed to upload image'
                    ];
                }
            } else {
                return [
                    'status' => 303,
                    'message' => 'Large Image ,Max Size allowed 2MB'
                ];
            }
        } else {
            return [
                'status' => 303,
                'message' => 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'
            ];
        }
    }

    public function editProductWithoutImage($pid, $product_name, $product_desc, $product_keywords, $product_port)
    {
        if ($pid != null) {
            $q = $this->con->prepare("UPDATE `products` SET
										`product_title` = ?,
										`product_desc` = ?,
										`product_keywords` = ?,
                    `product_port` = ?
										WHERE product_id = ?");
            $q->bind_param("ssssi", $product_name, $product_desc, $product_keywords, $product_port, $pid);
            $results= $q -> execute();

            if ($results) {
                return [
                    'status' => 202,
                    'message' => 'Evidence updated successfully'
                ];
            } else {
                return [
                    'status' => 303,
                    'message' => 'Failed to run query'
                ];
            }
        } else {
            return [
                'status' => 303,
                'message' => 'Invalid evidence id'
            ];
        }
    }

    public function deleteProduct($pid = null)
    {
        if ($pid != null) {
            $q = $this->con->prepare("DELETE FROM products WHERE product_id = ?");
            $q->bind_param("i", $pid);
            $results= $q -> execute();

            if ($results) {
                return [
                    'status' => 202,
                    'message' => 'Evidence removed'
                ];
            } else {
                return [
                    'status' => 202,
                    'message' => 'Failed to run query'
                ];
            }
        } else {
            return [
                'status' => 303,
                'message' => 'Invalid evidence id'
            ];
        }
    }
}

if (isset($_POST['GET_PRODUCT'])) {
    if (isset($_SESSION['admin_id'])) {
        $p = new Products();
        echo json_encode($p->getProducts());
        exit();
    }
}

if (isset($_POST['add_product'])) {

    extract($_POST);
    if (! empty($product_name) && ! empty($product_desc) && ! empty($product_keywords) && ! empty($_FILES['product_image']) && ! empty($product_port)) {

        $p = new Products();
        $result = $p->addProduct($product_name, $product_desc, $product_keywords, $_FILES['product_image'], $product_port);

        echo json_encode($result);
        exit();
    } else {
        echo json_encode([
            'status' => 303,
            'message' => 'Empty fields'
        ]);
        exit();
    }
}

if (isset($_POST['edit_product'])) {

    extract($_POST);
    if (! empty($pid) && ! empty($e_product_name) && ! empty($e_product_desc) && ! empty($e_product_keywords) && ! empty($e_product_port)) {

        $p = new Products();

        if (isset($_FILES['e_product_image']['name']) && ! empty($_FILES['e_product_image']['name'])) {
            $result = $p->editProductWithImage($pid, $e_product_name, $e_product_desc, $e_product_keywords, $_FILES['e_product_image'] ,$e_product_port);
        } else {
            $result = $p->editProductWithoutImage($pid, $e_product_name, $e_product_desc, $e_product_keywords, $e_product_port);
        }

        echo json_encode($result);
        exit();
    } else {
        echo json_encode([
            'status' => 303,
            'message' => 'Empty fields'
        ]);
        exit();
    }
}

if (isset($_POST['DELETE_PRODUCT'])) {
    $p = new Products();
    if (isset($_SESSION['admin_id'])) {
        if (! empty($_POST['pid'])) {
            $pid = $_POST['pid'];
            echo json_encode($p->deleteProduct($pid));
            exit();
        } else {
            echo json_encode([
                'status' => 303,
                'message' => 'Invalid product id'
            ]);
            exit();
        }
    } else {
        echo json_encode([
            'status' => 303,
            'message' => 'Invalid Session'
        ]);
    }
}
?>
