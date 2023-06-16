
<?php
// Includes ===========================================
include("../../database/model/Comic.php");
// ====================================================


class BL_COMIC
{
  public $mysqli;
  // Constructor================
  function __construct($mysqli)
  {
      $this->mysqli = $mysqli;
  }
  //============================

  // Request Methods ========================================

  function GetComic($uid,$request_id)
  {
    $objComic = new Comic($this->mysqli);
    // Setting Reuqest Object values for Insert
    $objComic->uid = $uid;

    $Comic = $objComic->Select();

    if($objComic->error =="")
    {
      $res["status"] = "success";
      $res["data"] = $Comic;
      $res["error"] = "";
    }
    else
    {
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $objComic->error;
    }

    return $res;

  }

  function SaveComic(
        $title,
        $description,
        $image
  )
  {
    //$this->mysqli->begin_transaction();
    try
    {

      $objComic = new Comic($this->mysqli);
      // Setting Reuqest Object values for Insert
      $objComic->Title = $Title;
      $objComic->Description = $Description;
      $objComic->Image = $Image;      
    
      // Setting Return Object
      $rtrn = $objComic->Insert();

      $inserted_request_id = $this->mysqli->insert_id;


      if($rtrn)
      {
          $res["status"] = "success";
          $res["data"] = $inserted_request_id;
          $res["error"] = "";
      }
      else {
        $res["status"] = "failed";
        $res["data"] = "";
        $res["error"] = $objComic->error;
      }

      //$this->mysqli->commit();

    }
    catch (mysqli_sql_exception $exception)
    {
      //$this->mysqli->rollback();
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $exception;

    }

    return $res;
  }

  function UpdateComic(
    $uid, 
    $Title, 
    $Description, 
    $Image
    )
{
    //$this->mysqli->begin_transaction();
    try
    {

      $objComic = new Comic($this->mysqli);

      // Key Column 
      $objComic->uid = $uid;
      // Setting Reuqest Object values for Insert
      $objComic->Title = $Title;
      $objComic->Description = $Description;
      $objComic->Image = $Image;      
     
      // Setting Return Object
      $rtrn = $objComic->Update();

      if($rtrn)
      {
          $res["status"] = "success";
          $res["data"] = "";
          $res["error"] = "";
      }
      else {
        $res["status"] = "failed";
        $res["data"] = "";
        $res["error"] = $objComic->error;
      }

      //$this->mysqli->commit();

    }
    catch (mysqli_sql_exception $exception)
    {
      //$this->mysqli->rollback();
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $exception;

    }

    return $res;
}

// function DeleteComic($uid)
// {
//   $objComic = new Comic($this->mysqli);
//   // Setting Reuqest Object values for Insert
//   $objComic->uid = $uid;

//   $Comic = $objComic->Delete();

//   if($objComic->error =="")
//   {
//     $res["status"] = "success";
//     $res["data"] = "";
//     $res["error"] = "";
//   }
//   else
//   {
//     $res["status"] = "failed";
//     $res["data"] = "";
//     $res["error"] = $objComic->error;
//   }

//   return $res;

// }

// =========================================================

  


}

 ?>
