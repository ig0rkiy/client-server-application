<?php

session_start();

use App\FileManager\FileManager;

include_once "App/FileManager.php";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/css/style.css">
    <title>File-Manager</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-7 position-fixed" style="padding-top: 25px;">
                <div class="p-3 text-white bg-dark sidebar" style="width: 100%; height: auto">
                    <form action="Controller/fileManager.cont.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="create-dir" class="form-control" placeholder="Создать папку">
                            <button class="btn btn-outline-secondary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <form action="Controller/fileManager.cont.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="file" name="uploaded-file" class="form-control" id="floatingInput">
                                <label style="color: black; margin-left: 5px;" for="floatingInput">Загрузить файл</label>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" name="load-file">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <br>
                    <p>
                        Текущая директория:
                        <br>
                        &emsp;<i><?php echo "." . DIRECTORY_SEPARATOR . FileManager::getRootDir() . DIRECTORY_SEPARATOR . FileManager::getCurrentDirPath() ?></i>
                    </p>
                </div>
            </div>

            <form style="text-align: right; padding: 0 25px 15px 0" action="Controller/fileManager.cont.php" method="post">
                <div class="btn-group-vertical">

                    <?php foreach (FileManager::getDirData() as $data): ?>

                        <div style="margin-top: 15px;" class="btn-group">
                            <button style="text-align: left" type="submit" name="path" value="<?= $data ?>" class="btn btn-lg btn-outline-light">

                                <?php if (!FileManager::isDir($data)): ?>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                                        <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                                    </svg>

                                <?php else: ?>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                        <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"></path>
                                    </svg>

                                <?php endif; ?>

                                <?= $data ?>

                            </button>

                            <form action="Controller/fileManager.cont.php" method="post">
                                <button type="submit" name="delete" value="<?= $data ?>" class="btn btn-lg btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>

                    <?php endforeach; ?>

                </div>
            </form>
        </div>
    </div>
</body>
</html>
