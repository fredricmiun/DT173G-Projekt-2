<?php
ob_start();
session_start();

spl_autoload_register(function($class) {
    require         "../../../private/app/Model/$class.php";
});

// Hämta metod
$method = $_SERVER['REQUEST_METHOD'];
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Content-type:application/json;charset=utf-8");
// Gör det möjligt att hämta data so mskickas
$input = json_decode(file_get_contents('php://input'),true);

require         "../../../private/functions/icon.php";
require         "../../../private/app/Controller/CvController.php";
require         "../../../private/app/View/CvView.php";

switch ($method) {
    case "POST":
        // Hämta innehåll för lightbox(featherlight) baserat på skickat värde
        if($input['data'] == "adress") {
            
            $mess['type'] = "adress";
            $mess['content'] = $retrieve_cv;
            
            
        } else if ($input['data'] == "kontakta") {

            $mess['type'] = "kontakta";
            $mess['content'] = $retrieve_cv;

        } else if ($input['data'] == "skills") {
            
            $mess['type'] = "skills";
            $mess['content'] = $retrieve_skills;
            
        } else if ($input['data'] == "edu") {

            $mess['type'] = "edu";
            $mess['content'] = $retrieve_edu;

        } else if ($input['data'] == "kur") {
            
            $mess['type'] = "kur";
            $mess['content'] = $retrieve_kur;

        } else if ($input['data'] == "personligt") {

            $mess['type'] = "personligt";
            $mess['content'] = $retrieve_cv;
            
        } else if ($input['data'] == "exp") {

            $mess['type'] = "exp";
            $mess['content'] = $retrieve_exp;
            
        } 
        // Post to DB
        else if ($input['data'] == "insert") {
            $insert_cv = new Cv;
            $result = json_decode($input['form']);
            if($result->key == "edu") {

                if(empty($result->place) || empty($result->description) || empty($result->start)) {
                    $mess = "Message: Fyll i alla fält!";
                } else {
                    $insert_cv->insert_edu_kur(strip_tags($result->place), strip_tags($result->description), strip_tags($result->start), strip_tags($result->end), "edu");
                    $mess = "Skapat!";
                }
                
            } else if ($result->key == "kur") {

                if(empty($result->place) || empty($result->description) || empty($result->start)) {
                    $mess = "Message: Fyll i alla fält!";
                } else {
                    $insert_cv->insert_edu_kur(strip_tags($result->place), strip_tags($result->description), strip_tags($result->start), "", "kur");
                    $mess = "Skapat!";
                }
                
            } else if ($result->key == "exp") {

                if(empty($result->place) || empty($result->role) || empty($result->description) || empty($result->start)) {
                    $mess = "Message: Fyll i alla fält!";
                } else {
                    $insert_cv->insert_experience(strip_tags($result->place), strip_tags($result->role), strip_tags($result->description), strip_tags($result->start), strip_tags($result->end));
                    $mess = "Skapat!";
                }
                
            } else if ($result->key == "skills") {

                if(empty($result->skill)) {
                    $mess = "Message: Fyll i alla fält!";
                } else {
                    $insert_cv->insert_skill(strip_tags($result->skill));
                    $mess = "Skapat!";
                }
                
            }
        }
        
        
    break;
    case "PUT":
    $update_cv = new Cv;
    $result = json_decode($input['form']);
    if($result->key == "adress") {

        /* Adress */
        if(empty($result->street) || empty($result->zip) || empty($result->city) || empty($result->country)) {   
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_address(strip_tags($result->street), strip_tags($result->zip), strip_tags($result->city), strip_tags($result->country));
            $mess = "Sparat!";
        }
    } else if ($result->key == "kontakta") {
            
        /* Kontakt */
        if(empty($result->phone) || empty($result->email)) {  
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_contact(strip_tags($result->phone), strip_tags($result->email), strip_tags($result->website));
            $mess = "Sparat!";
        }
        
    } else if ($result->key == "personligt") {
            
        /* Personligt */
        if(empty($result->fname) || empty($result->lname) || empty($result->title) || empty($result->description)) { 
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_personal(strip_tags($result->fname), strip_tags($result->lname), strip_tags($result->title), strip_tags($result->description));
            $mess = "Message: " . $result->fname;
        }

    } else if ($result->key == "edu") {
        
        if(empty($result->place) || empty($result->description) || empty($result->start)) { 
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_edu_kur(strip_tags($result->id), strip_tags($result->place), strip_tags($result->description), strip_tags($result->start), strip_tags($result->end));
            $mess = "Sparat!";
        }
        
    } else if ($result->key == "kur") {
        
        /* Kuriosa */
        if(empty($result->place) || empty($result->description) || empty($result->start)) { 
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_edu_kur(strip_tags($result->id), strip_tags($result->place), strip_tags($result->description), strip_tags($result->start), "");
            $mess = "Sparat!";
        }
        
    } else if ($result->key == "exp") {
            
        /* Erfarenhet */
        if(empty($result->place) || empty($result->role) || empty($result->description) || empty($result->start) || empty($result->end)) {
            $mess = "Tomma fält!";
        } else {
            $update_cv->update_experience(strip_tags($result->id), strip_tags($result->place), strip_tags($result->role), strip_tags($result->description), strip_tags($result->start), strip_tags($result->end));
            $mess = "Sparat!";
        }

        
    } else if ($result->key == "skills") {
        
        /* Färdighet */
        if(empty($result->skill)) {
            $mess = "Tomt fält!";
        } else {
            $update_cv->update_skills(strip_tags($result->id), strip_tags($result->skill));
            $mess = "Sparat!";
        }
        
    }
    break;
    case "DELETE":
    $delete_cv = new Cv;
    if($input['key'] == "edu") {
        $delete_cv->delete_edu_kur($input['id']);
    } else if($input['key'] == "kur") {
        $delete_cv->delete_edu_kur($input['id']);
    } else if($input['key'] == "exp") {
        $delete_cv->delete_experience($input['id']);
    } else if($input['key'] == "skills") {
        $delete_cv->delete_skill($input['id']);
    }
    $mess = "Borttaget!";
    break;
};
echo json_encode($mess);