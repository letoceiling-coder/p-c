<?php


namespace classed;


class ImageCreate
{
    /**
     * @var $settings - НАСТРОЙКИ
     * src  - Путь к изображению, на которое нанесём текст
     * size - Размер шрифта
     * top  - Отступ сверху
     * left - Отступ слева
     * font - Путь к файлу шрифта
     * save - Путь для сохранения
     */
    private $settings ;

    /**
     *
     * @var Содержит пользовательский текст
     *
     */
    private $text;

    /**
     *
     * @param пользовательский текст $text
     *
     */
    public function __construct(){


    }

    /**
     *
     * @return путь к созданному изображению
     *
     */
    public function create($text,$settings,$path = false,$save = false)
    {
        //print_r($settings);
        # Открываем рисунок в формате JPEG
        if($path){
            if(imagecreatefromjpeg($path)){
                $img = imagecreatefromjpeg($path);
            }else{
                $img = imagecreatefrompng($path);
            }

        }
        else {
            if(@imagecreatefromjpeg($settings["src"])){
                $img = imagecreatefromjpeg($settings["src"]);
            }else{
                $img = imagecreatefrompng($settings["src"]);
            }

        }

        # Получаем идентификатор цвета
        $color = imagecolorallocate($img, $settings['color'][0], $settings['color'][1], $settings['color'][2]);

        /* выводим текст на изображение */
        imagettftext(
            $img,
            $settings["size"],
            0,
            $settings["left"],
            $settings["top"],
            $color,
            $settings["font"],
            $text
        );


        # Генерируем путь для сохранения
        $path = $settings["save"] . $save;

        # Сохраняем рисунок в формате JPEG
        imagejpeg($img, $path, 100);

        # Освобождаем память и закрываем изображение
        imagedestroy($img);

        # Возвращаем путь


        return $path;
    }
}