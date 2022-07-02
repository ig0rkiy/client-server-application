<?php

namespace App\FileManager {

    class FileManager
    {
        private static string $m_rootDir = "Storage";


        public static function getRootDir(): string
        {
            return self::$m_rootDir;
        }

        public static function getCurrentDirPath(): string
        {
            return $_SESSION["path"] ?? "";
        }

        public static function getDirData(): array
        {
            $diffData = empty(self::getCurrentDirPath())
                            ? [".", ".."]
                            : ["."];

            return array_diff(
                            @scandir(self::getFullPathToData())
                                    ? scandir(self::getFullPathToData())
                                    : die(),
                            $diffData
            );
        }

        public static function getFullPathToData(string $dataName = ""): string
        {
            return !empty(self::getCurrentDirPath())
                ? __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . self::getRootDir() . DIRECTORY_SEPARATOR . self::getCurrentDirPath() . DIRECTORY_SEPARATOR . $dataName
                : __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . self::getRootDir() . DIRECTORY_SEPARATOR . $dataName;
        }

        public static function isDir(string $dataName): bool
        {
            return is_dir(self::getFullPathToData($dataName));
        }

        public static function createDir(string $dirName): bool
        {
            return mkdir(self::getFullPathToData($dirName));
        }

        public static function deleteFile(string $fileName): bool
        {
            return unlink(self::getFullPathToData($fileName));
        }

        public static function deleteDir(string $dirPath): void
        {
            $dir = opendir($dirPath);

            while ($data = readdir($dir))
            {
                if ($data !== "." && $data !== "..")
                {
                    $dataPath = $dirPath . DIRECTORY_SEPARATOR . $data;

                    is_dir($dataPath)
                        ? self::deleteDir($dataPath)
                        : unlink($dataPath);
                }
            }

            closedir($dir);
            rmdir($dirPath);
        }

        public static function loadFile(string $filePath, string $fileName): bool
        {
            return move_uploaded_file($filePath, self::getFullPathToData($fileName));
        }
    }
}
