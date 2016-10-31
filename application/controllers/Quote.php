<?php
class Quote extends CI_Controller{
    function index(){
        $quotes = array(
            'Hành trình vạn dặm bắt đầu bằng một bước chân',
            'Kẻ thù lớn nhất của đời người là chính mình',
            'Không biết tiếng Anh thời nay cũng giống không biết chữ thời xưa',
            'Học cũng như đun nước, không duy trì lửa, nước nguội ngay',
            'Giải trí hay học? Bạn có chiến thắng được bản thân?',
            'Bạn muốn mình như thế nào 10 năm sau?'
        );
        
        $quote = $quotes[rand(0, count($quotes) -1)];
        echo "<i class='text-muted quote'>".$quote."</i>";
    }
}