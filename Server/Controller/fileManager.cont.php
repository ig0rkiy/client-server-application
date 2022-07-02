<?php

session_start();

use App\FileManager\FileManager;

include_once "../App/FileManager.php";

if (isset($_POST["path"]))
{
    if (FileManager::isDir($_POST["path"]))
    {
        if ($_POST["path"] === "..")
        {
            $path = [];
            preg_match_all("/.+&?(?=\\\)/", $_SESSION["path"] ?? "", $path);

            $_SESSION["path"] = $path[0][0];
        }
        else
        {
            $_SESSION["path"] = isset($_SESSION["path"])
                ? $_SESSION["path"] . DIRECTORY_SEPARATOR . $_POST["path"] ?? ""
                : $_POST["path"] ?? "";
        }
    }
}

if (isset($_POST["create-dir"]))
{
    FileManager::createDir($_POST["create-dir"] ?? "");
}

if (isset($_POST["delete"]))
{
    $dataName = $_POST["delete"] ?? "";

    FileManager::isDir($dataName)
        ? FileManager::deleteDir(FileManager::getFullPathToData($dataName))
        : FileManager::deleteFile($dataName);
}

if (isset($_POST["load-file"]) &&
    isset($_FILES["uploaded-file"]) &&
    $_FILES["uploaded-file"]["error"] === UPLOAD_ERR_OK)
{
    FileManager::loadFile($_FILES["uploaded-file"]["tmp_name"], $_FILES["uploaded-file"]["name"]);
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
